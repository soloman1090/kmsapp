<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\Reinvest;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Mail;
use Coinremitter\Coinremitter;

class ActivatePortfolios extends Controller
{
    public function index()
    {

        UserInfo::query()->update(['code_2fa' => null]);

        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('user_investments.status', 'pending')
            ->get(['users.name as username', 'users.email', 'users.id as user_id', 'investment_packages.name as packagename',
                'investment_packages.id as package_id', 'user_investments.date',
                'user_investments.id as investment_id', 'user_investments.end_date', 'investment_packages.category_name',
                'user_investments.amount', 'user_investments.returns', 'investment_packages.duration', 'user_investments.payout',
                'user_investments.active', 'user_investments.status', 'user_investments.txn_id','user_investments.currency']);

        $usersInvestments = [];

        for ($i = 0; $i < count($investments); $i++) {
            
            //$investments[$i]['end_date']
            if ($investments[$i]['txn_id'] != "TRX") {
                $d1 = strtotime(Carbon::now()->toDayDateTimeString());
                $d2 = strtotime($investments[$i]['end_date']);
                $totalSecondsDiff = abs($d1 - $d2);
                $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
                if ($d1 < $d2) {
                    $dayLeft = 100;
                    if ($totalDaysDiff < 100) {
                        $dayLeft = $totalDaysDiff;
                    }
                    $data = ['days' => $totalDaysDiff, 'daysLeft' => $dayLeft, 'username' => $investments[$i]['username'], 'user_id' => $investments[$i]['user_id'], 'email' => $investments[$i]['email'],
                        'packagename' => $investments[$i]['packagename'], 'category_name' => $investments[$i]['category_name'], 'date' => $investments[$i]['date'],
                        'amount' => $investments[$i]['amount'], 'returns' => $investments[$i]['returns'], 'duration' => $investments[$i]['duration'],
                        'payout' => $investments[$i]['payout'], 'active' => $investments[$i]['active'], 'investment_id' => $investments[$i]['investment_id'],
                        'package_id' => $investments[$i]['package_id'], 'status' => $investments[$i]['status'], 'txn_id' => $investments[$i]['txn_id'], 'currency' => $investments[$i]['currency']];
                    array_push($usersInvestments, (object) $data);
                }

                $user = DB::table('users')
                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                    ->where('users.id', $investments[$i]['user_id'])
                    ->get()->first();

                //Check Payment Status
                $amount = $investments[$i]['amount'];
                $packagename = $investments[$i]['packagename'];
                $packageId = $investments[$i]['package_id'];
                $monthCount = $investments[$i]['duration'];
                $thisInvestment = UsersInvestments::findOrFail($investments[$i]['investment_id']);
                $thisPackage=Investment_Packages::findOrFail($packageId);
                
                if ($investments[$i]['status'] == "pending" ) {
                    
                    $txn_id = $investments[$i]['txn_id'];
                    
                     if ($txn_id != "old" && $txn_id != null  && $thisInvestment->currency!=null) {
                        try {
                            $remitter = new Coinremitter($thisInvestment->currency);
                            $param = [
                                'invoice_id'=>$txn_id
                            ];
                            $response = $remitter->get_invoice($param);
                             

                            // $request = $client->get("https://plisio.net/api/v1/operations/$txn_id?api_key=$key");
                            // $response = json_decode($request->getBody());
                            //dd($response);
                            

                            if ($response["flag"] == 1) {
                                $transact = $response["data"];
                               
                                 if ($transact["status_code"] == 1 || $transact["status_code"] == 2 || $transact["status_code"] ==3 ) {
                                    //|| $transact->status == "mismatch"

                                    $investments[$i]['status'] = "completed";
                                    $thisInvestment->status = "completed";
                                    $thisInvestment->active = true;
                                    $thisInvestment->compounding_amount = $thisInvestment->amount;
                                    $thisInvestment->duration = $monthCount;
                                    $thisInvestment->date = Carbon::now()->toDayDateTimeString();
                                    $thisInvestment->end_date = date('Y-m-d', strtotime("+$monthCount months", strtotime(Carbon::now()->toDayDateTimeString())));

                                    //Save Investment
                                    //Save Activity

                                    $activity = new Activities;
                                    $activity->title = "Investment initialized";
                                    $activity->user_id = $investments[$i]['user_id'];
                                    $activity->user_investments_id = $investments[$i]['investment_id'];
                                    $activity->investment_packages_id = $investments[$i]['package_id'];
                                    $activity->category = "deposit";
                                    $activity->date = Carbon::now()->toDayDateTimeString();
                                    $activity->amount = $amount;
                                    $activity->descp = "Deposit of $$amount made for $packagename";
                                    //dd($activity);
                                    $activity->save();

                                    //dd("Enter Here");

                                    //Send Mails $user->email
                                    try {
                                        Mail::to($user->email)->send(new UserRegisteredMail([
                                            'subject' => 'Congratulations on your Portfolio Purchase',
                                            'title' => "Congratulations {$user->name} {$user->last_name}",
                                            'url' => "https://Dell Group.com/user/user-investments",
                                            'descp' => "We are delighted to inform you that your portfolio purchase of $packagename
                                has been received successfully. Your Investor account will be activated shortly.
                                    This is the best step you could possibly take toward regaining control of your financial life.
                                    Our key Goal is providing efficient and reliable financial services to our clients.
                                    We very much admire your shrewdness in taking this decisive action now. There is every reason to believe you are on your way to the top!",
                                            'action-text' => 'Client Access',
                                            'img' => 'assets/images/emails/investment-banner.jpg',
                                        ]));

                                        //Send Admin Mail
                                        Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                                            'subject' => 'Portfolio Payment',
                                            'title' => "Hi Admin",
                                            'url' => "https://Dell Group.com/admin/users-investments",
                                            'descp' => "A user just successfully made payment $packagename on Dell Group.
                            These are the user details.... NAME: $user->name $user->last_name, EMAIL: $user->email, PHONE: $user->phone, AMOUNT: $$amount.....
                            Please Login to view investments",
                                            'action-text' => 'Vew Investments',
                                            'img' => 'assets/images/emails/Dell Group--Management-Building.jpg',
                                        ]));
                                    } catch (\Exception$e) {

                                    }
                                    //dd($user);

                                    //Check Referal
                                    if ($user->referred_by != null && $user->referred_by != "") {

                                        //Save Activity
                                        $referredUser = DB::table('users')
                                            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                                            ->where('users.id', $user->referred_by)
                                            ->get()->first();

                                        //dd($referredUser);
                                        //==========================================================================================================================
                                        //Check For Stage 1 user
                                        //==========================================================================================================================
                                        if ($referredUser != null) {

                                            $bonusAmount = $amount *  $thisPackage->level1_bonus;
                                            //Get Wallet Balance
                                            $currentAmount = 0;
                                            if ($referredUser->main_wallet == null) {
                                                $currentAmount = 0;
                                            } else {
                                                $currentAmount = $referredUser->main_wallet;
                                            }

                                            //Save Wallet
                                            $userInfo = UserInfo::where('user_id', $user->referred_by)->firstOrFail();
                                            $userInfo->main_wallet = $currentAmount + $bonusAmount;
                                            $userInfo->update();
                                            $firstPecentage=($bonusAmount / $amount) * 100;
                                            //Save Activity
                                            $activity = new Activities;
                                            $activity->title = "Referral Bonus";
                                            $activity->user_id = $referredUser->user_id;
                                            $activity->category = "bonus";
                                            $activity->date = Carbon::now()->toDayDateTimeString();
                                            $activity->amount = $bonusAmount;
                                            $activity->descp = "Credited $firstPecentage% - $$bonusAmount as referral bonus from $user->name";
                                            $activity->save();
                                            // $referredUser->email

                                            try {
                                                Mail::to($referredUser->email)->send(new UserRegisteredMail([
                                                    'subject' => 'Members Benefit Commissions',
                                                    'title' => "Hi $referredUser->name $referredUser->last_name ",
                                                    'url' => "https://Dell Group.com/user/referred-users",
                                                    'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@Dell Group.com",
                                                    'action-text' => 'Client Access',
                                                    'img' => 'assets/images/emails/first-referal-banner.jpg',
                                                ]));
                                            } catch (\Exception$e) {

                                            }
                                            // dd($referredUser);

                                            //=======================================================================================================================================
                                            //Check For Stage 2 user
                                            //=======================================================================================================================================
                                            $referredUser_stage2 = null;
                                            if ($referredUser->referred_by != null) {

                                                $referredUser_stage2 = DB::table('users')
                                                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                                                    ->where('users.id', $referredUser->referred_by)
                                                    ->get()->first();

                                                if ($referredUser_stage2 != null) {
                                                    $bonusAmount_stage2 = $amount * $thisPackage->level2_bonus;

                                                    //Get Wallet Balance
                                                    $currentAmount = 0;
                                                    if ($referredUser_stage2->main_wallet == null) {
                                                        $currentAmount = 0;
                                                    } else {
                                                        $currentAmount = $referredUser_stage2->main_wallet;
                                                    }
                                                    $newAmount = $currentAmount + $bonusAmount_stage2;
                                                    //Save Wallet
                                                    $userInfo_stage2 = UserInfo::where('user_id', $referredUser_stage2->user_id)->firstOrFail();
                                                    $userInfo_stage2->main_wallet = $newAmount;
                                                    $userInfo_stage2->update();
                                                    $secPecentage=($bonusAmount_stage2 / $amount) * 100;
                                                    //Save Activity
                                                    $activity = new Activities;
                                                    $activity->title = "Referral Bonus";
                                                    $activity->user_id = $referredUser_stage2->user_id;
                                                    $activity->category = "bonus";
                                                    $activity->date = Carbon::now()->toDayDateTimeString();
                                                    $activity->amount = $bonusAmount_stage2;
                                                    $activity->descp = "Credited  $secPecentage% - $$bonusAmount_stage2 as referral bonus from $user->name";
                                                    $activity->save();
                                                    // $referredUser_stage2->email

                                                    try {
                                                        // Mail::to($referredUser_stage2->email)->send(new UserRegisteredMail([
                                                        //     'subject' => 'Members Benefit Commissions',
                                                        //     'title' => "Hi $referredUser_stage2->name $referredUser_stage2->last_name ",
                                                        //     'url' => "https://Dell Group.com/user/referred-users",
                                                        //     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@Dell Group.com",
                                                        //     'action-text' => 'Client Access',
                                                        //     'img' => 'assets/images/emails/first-referal-banner.jpg',
                                                        // ]));
                                                    } catch (\Exception$e) {

                                                    }

                                                    //=======================================================================================================================================
                                                    //Check For Stage 3 user
                                                    //=======================================================================================================================================
                                                    $referredUser_stage3 = null;
                                                    if ($referredUser_stage2->referred_by != null) {
                                                        $referredUser_stage3 = DB::table('users')
                                                            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                                                            ->where('users.id', $referredUser_stage2->referred_by)
                                                            ->get()->first();

                                                        if ($referredUser_stage3 != null) {
                                                            $bonusAmount_stage3 = $amount * $thisPackage->level3_bonus;

                                                            //Get Wallet Balance
                                                            $currentAmount_3 = 0;
                                                            if ($referredUser_stage3->main_wallet == null) {
                                                                $currentAmount_3 = 0;
                                                            } else {
                                                                $currentAmount_3 = $referredUser_stage3->main_wallet;
                                                            }
                                                            $newAmount = $currentAmount_3 + $bonusAmount_stage3;
                                                            //Save Wallet
                                                            $userInfo_stage3 = UserInfo::where('user_id', $referredUser_stage3->user_id)->firstOrFail();
                                                            $userInfo_stage3->main_wallet = $newAmount;
                                                            $userInfo_stage3->update();
                                                            $thirdPecentage=($bonusAmount_stage3 / $amount) * 100;
                                                            //Save Activity
                                                            $activity = new Activities;
                                                            $activity->title = "Referral Bonus";
                                                            $activity->user_id = $referredUser_stage3->user_id;
                                                            $activity->category = "bonus";
                                                            $activity->date = Carbon::now()->toDayDateTimeString();
                                                            $activity->amount = $bonusAmount_stage3;
                                                            $activity->descp = "Credited $thirdPecentage% - $$bonusAmount_stage3 as referral bonus from $user->name";
                                                            $activity->save();
                                                            // $referredUser_stage2->email

                                                            try {
                                                                // Mail::to($referredUser_stage3->email)->send(new UserRegisteredMail([
                                                                //     'subject' => 'Members Benefit Commissions',
                                                                //     'title' => "Hi $referredUser_stage3->name $referredUser_stage3->last_name ",
                                                                //     'url' => "https://Dell Group.com/user/referred-users",
                                                                //     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@Dell Group.com",
                                                                //     'action-text' => 'Client Access',
                                                                //     'img' => 'assets/images/emails/first-referal-banner.jpg',
                                                                // ]));
                                                            } catch (\Exception$e) {

                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                        }
                                    }
                                } else { 
                                    $thisInvestment->status = "expired";

                                    //Save Activity
                                    $activity = new Activities;
                                    $activity->title = "Transaction {$transact['status']}";
                                    $activity->user_id = $investments[$i]['user_id'];
                                    $activity->user_investments_id = $investments[$i]['investment_id'];
                                    $activity->investment_packages_id = $investments[$i]['package_id'];
                                    $activity->category = "expired";
                                    $activity->date = Carbon::now()->toDayDateTimeString();
                                    $activity->amount = $amount;
                                    $activity->descp = "Deposit of $$amount made for $packagename has $transact->status";
                                    $activity->save();
                                } 
                                //Update Investment
                                $thisInvestment->update();
                            } 
                        } catch (\Exception$e) {

                        }
                    }
                }
            }
        }
        

        return ["response" => "Activation Successful"];

    }
}
