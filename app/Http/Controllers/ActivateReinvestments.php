<?php

namespace App\Http\Controllers;

use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\Reinvest;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Coinremitter\Coinremitter;
use Illuminate\Support\Facades\DB;
use Mail;

class ActivateReinvestments extends Controller
{

    public function index()
    {
        //For reinvestments
        
        $thisReinvestment = Reinvest::where('status', 'pending')->orderBy('id', 'DESC')->get();

        // if (count($thisReinvestment) > 0) {
            foreach ($thisReinvestment as $key => $thisReinvest) { 
            //$thisReinvest = $thisReinvestment[0];

            $singleReinvest = Reinvest::findOrFail($thisReinvest->id);
            $thisInvestment = UsersInvestments::findOrFail($singleReinvest->user_investments_id);
            $package = Investment_Packages::findOrFail($thisInvestment->investment_packages_id);
            $packagename = $package->name;

            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $singleReinvest->user_id)
                ->get()->first();

            $transactionCompleted = false;
            $onlineTransation = false;
            

           if ($thisReinvest->txn_id != null && $thisReinvest->txn_id != "old" && $thisReinvest->txn_id != "coin-sub" && $thisReinvest->currency!=null) {
               
                $remitter = new Coinremitter($thisReinvest->currency);
               
                try {
                    // $client = new Client(['verify' => false]);
                    // $request = $client->get("https://plisio.net/api/v1/operations/$thisReinvest->txn_id?api_key=$secretKey");
                    // $response = json_decode($request->getBody());
                    
                    $param = [
                        'invoice_id'=>$thisReinvest->txn_id
                    ];
                    $response = $remitter->get_invoice($param);
                    

                    if ($response["flag"]  == 1) {

                        $transact = $response["data"];
                        //|| $transact->status == "mismatch"
                        if ($transact["status_code"] == 1 || $transact["status_code"] == 2 || $transact["status_code"] ==3  ) {
                            $thisInvestment->amount = $singleReinvest->amount;
                            $thisInvestment->returns = $singleReinvest->returns;
                            $thisInvestment->status = "completed";
                            $singleReinvest->status = "completed";
                            $transactionCompleted = true;
                            $onlineTransation = true;
                            $thisInvestment->update();
                            $singleReinvest->update();
                        } 
                    }
                } catch (\Exception$e) {

                }

            } else if ($thisReinvest->txn_id == null && $thisReinvest->txn_id != "old") {
                $thisInvestment->amount = $singleReinvest->amount;
                $thisInvestment->returns = $singleReinvest->returns;
                $thisInvestment->status = "completed";
                $singleReinvest->status = "completed";
                $transactionCompleted = true;
                $onlineTransation = false;
                $thisInvestment->update();
                $singleReinvest->update();
            }

            if ($transactionCompleted == true ) {
                //Save Activity
                
                $activity = new Activities;
                $activity->title = "Reinvestment Successful";
                $activity->user_id = $singleReinvest->user_id;
                $activity->user_investments_id = $singleReinvest->user_investments_id;
                $activity->investment_packages_id = $thisInvestment->investment_packages_id;
                $activity->category = "deposit";
                $activity->date = Carbon::now()->toDayDateTimeString();
                $activity->amount = $singleReinvest->topup_amount;
                $activity->descp = "Reinvestment of $$singleReinvest->topup_amount on $packagename is successful";
                $activity->save();


                //$user->email
                try {
                    Mail::to($user->email)->send(new UserRegisteredMail([
                        'subject' => 'Reinvestment Successful',
                        'title' => "Congratulations {$user->name} {$user->last_name}",
                        'url' => "https://Dell Group.com/user/user-investments",
                        'descp' => "We are delighted to inform you that your reinvestment into  $packagename portfolio
                has been received successfully.",
                        'action-text' => 'Client Access',
                        'img' => 'assets/images/emails/investment-banner.jpg',
                    ]));
                } catch (\Exception $e) {

                }

                //Send Admin Mail
                // if($onlineTransation==true){
                try {
                    // Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                    //     'subject' => 'Portfolio Payment',
                    //     'title' => "Hi Admin",
                    //     'url' => "https://Dell Group.com/admin/users-investments",
                    //     'descp' => "A user just successfully reinvested in $packagename on Dell Group.
                    //  These are the user details.... NAME: $user->name $user->last_name, EMAIL: $user->email, PHONE: $user->phone, AMOUNT: $$singleReinvest->topup_amount .....
                    //  Please Login to view investments",
                    //     'action-text' => 'Vew Investments',
                    //     'img' => 'assets/images/emails/Dell Group--Management-Building.jpg',
                    // ]));
                } catch (\Exception$e) {

                }

                $reinvestAmount = $singleReinvest->topup_amount;
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

                        $bonusAmount = $reinvestAmount * 0.10;
                        $userInfo = UserInfo::where('user_id', $user->referred_by)->firstOrFail();
                        //Get Wallet Balance

                        $wallet_type = "";
                        if ($thisInvestment->payout == "daily_payout") {
                            if ($referredUser->main_wallet == null) {
                                $userInfo->main_wallet = $bonusAmount;
                            } else {
                                $userInfo->main_wallet = $userInfo->main_wallet + $bonusAmount;
                            }
                            $wallet_type = "Main Wallet";
                        } else {
                            if ($referredUser->compound_wallet == null) {
                                $userInfo->compound_wallet = $bonusAmount;
                            } else {
                                $userInfo->compound_wallet = $userInfo->compound_wallet + $bonusAmount;
                            }
                            $wallet_type = "Compound Wallet";
                        }

                        $userInfo->update();

                        //Save Activity
                        $activity = new Activities;
                        $activity->title = "Referral Bonus";
                        $activity->user_id = $referredUser->user_id;
                        $activity->category = "bonus";
                        $activity->date = Carbon::now()->toDayDateTimeString();
                        $activity->amount = $bonusAmount;
                        $activity->descp = "Credited 10% - $$bonusAmount as referral bonus from $user->name to your $wallet_type";
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
                                $bonusAmount_stage2 = $reinvestAmount * 0.05;
                                $userInfo_stage2 = UserInfo::where('user_id', $referredUser_stage2->user_id)->firstOrFail();

                                //Get Wallet Balance
                                $wallet_type = "";
                                if ($thisInvestment->payout == "daily_payout") {
                                    if ($referredUser_stage2->main_wallet == null) {
                                        $userInfo_stage2->main_wallet = $bonusAmount_stage2;
                                    } else {
                                        $userInfo_stage2->main_wallet = $userInfo_stage2->main_wallet + $bonusAmount_stage2;
                                    }
                                    $wallet_type = "Main Wallet";
                                } else {
                                    if ($referredUser_stage2->compound_wallet == null) {
                                        $userInfo_stage2->compound_wallet = $bonusAmount_stage2;
                                    } else {
                                        $userInfo_stage2->compound_wallet = $userInfo_stage2->compound_wallet + $bonusAmount_stage2;
                                    }
                                    $wallet_type = "Compound Wallet";
                                }
                                //Save Wallet

                                $userInfo_stage2->update();

                                //Save Activity
                                $activity = new Activities;
                                $activity->title = "Referral Bonus";
                                $activity->user_id = $referredUser_stage2->user_id;
                                $activity->category = "bonus";
                                $activity->date = Carbon::now()->toDayDateTimeString();
                                $activity->amount = $bonusAmount_stage2;
                                $activity->descp = "Credited 5% - $$bonusAmount_stage2 as referral bonus from $user->name to your $wallet_type";
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
                                        $bonusAmount_stage3 = $reinvestAmount * 0.025;
                                        $userInfo_stage3 = UserInfo::where('user_id', $referredUser_stage3->user_id)->firstOrFail();
                                        //Get Wallet Balance
                                        $wallet_type = "";
                                        if ($thisInvestment->payout == "daily_payout") {
                                            if ($referredUser_stage3->main_wallet == null) {
                                                $userInfo_stage3->main_wallet = $bonusAmount_stage3;
                                            } else {
                                                $userInfo_stage3->main_wallet = $userInfo_stage3->main_wallet + $bonusAmount_stage3;
                                            }
                                            $wallet_type = "Main Wallet";
                                        } else {
                                            if ($referredUser_stage3->compound_wallet == null) {
                                                $userInfo_stage3->compound_wallet = $bonusAmount_stage3;
                                            } else {
                                                $userInfo_stage3->compound_wallet = $userInfo_stage3->compound_wallet + $bonusAmount_stage3;
                                            }
                                            $wallet_type = "Compound Wallet";
                                        }
                                        $userInfo_stage3->update();

                                        //Save Activity
                                        $activity = new Activities;
                                        $activity->title = "Referral Bonus";
                                        $activity->user_id = $referredUser_stage3->user_id;
                                        $activity->category = "bonus";
                                        $activity->date = Carbon::now()->toDayDateTimeString();
                                        $activity->amount = $bonusAmount_stage3;
                                        $activity->descp = "Credited 2.5% - $$bonusAmount_stage3 as referral from $user->name to your $wallet_type";
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

            }

        }
        return ["response" => "Reinvestment Activation Successful"];
    }

}
