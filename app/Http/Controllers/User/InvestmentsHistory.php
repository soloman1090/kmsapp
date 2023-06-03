<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class InvestmentsHistory extends Controller
{
    public function index()
    {
        $id = auth()->id();

        //Change Payout
        function getPayout($data)
        {
            switch ($data) {
                case 'weekly':
                    return "Weekly Payout";
                    break;
                case 'monthly_payout':
                    return "Monthly Payout";
                    break;
                case '6_months_compounding':
                    return "6 Months Compounding";
                    break;
                case '7_months_compounding':
                    return "7 Months Compounding";
                    break;
                case '8_months_compounding':
                    return "8 Months Compounding";
                    break;
                case '9_months_compounding':
                    return "9 Months Compounding";
                    break;
                case '10_months_compounding':
                    return "10 Months Compounding";
                    break;

            }
        }

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $activities = DB::table('users')
            ->join('activities', 'users.id', "=", 'activities.user_id')
            ->where('activities.user_id', $id)
            ->orderBy('activities.id', 'DESC')
            ->get();

        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('users.id', $id)
            ->orderBy('user_investments.id', 'DESC')
            ->get(['users.name as username', 'users.email', 'investment_packages.name as packagename', 'investment_packages.id as package_id', 'user_investments.date', 'user_investments.id as investment_id', 'user_investments.end_date', 'investment_packages.category_name',
                'user_investments.amount', 'user_investments.returns', 'user_investments.duration', 'user_investments.payout', 'user_investments.active', 'user_investments.status', 'user_investments.txn_id']);

        $usersInvestments = [];
        for ($i = 0; $i < count($investments); $i++) {
            //$investments[$i]['end_date']
            $startDate = date('Y-m-d', strtotime($investments[$i]['date']));
            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($investments[$i]['end_date']);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 > $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                }
                $data = ['days' => $totalDaysDiff, 'daysLeft' => $dayLeft, 'username' => $investments[$i]['username'], 'email' => $investments[$i]['email'], 'packagename' => $investments[$i]['packagename'], 'date' => $startDate, 'end_date' => $investments[$i]['end_date'], 'amount' => $investments[$i]['amount'], 'returns' => $investments[$i]['returns'], 'duration' => $investments[$i]['duration'], 'payout' => getPayout($investments[$i]['payout']), 'active' => $investments[$i]['active'], 'investment_id' => $investments[$i]['investment_id'], 'category_name' => $investments[$i]['category_name'], 'status' => $investments[$i]['status']];
                array_push($usersInvestments, (object) $data);
            };
             

        };

        return view('user.investment-history', ['user' => $user, 'user_id' => $id, 'activities' => $activities, 'page_title' => "All Investment History", 'investments' => $usersInvestments, 'username' => $user->name]);
    }

    public function update(Request $req, $id)
    {

        if ($req->type == "withdraw") {
            $thisInvestment = UsersInvestments::where('id', $id)->firstOrFail();
            $thisInvestment->status = "dormant";

            $userInfo = UserInfo::where('user_id', $thisInvestment->user_id)->firstOrFail();

            if ($thisInvestment->payout == "6_months_compounding" ||
                $thisInvestment->payout == "7_months_compounding" ||
                $thisInvestment->payout == "8_months_compounding" ||
                $thisInvestment->payout == "9_months_compounding" ||
                $thisInvestment->payout == "10_months_compounding") {
                $userInfo->compound_wallet = $userInfo->compound_wallet + $thisInvestment->amount;
            } else {
                $userInfo->main_wallet = $userInfo->main_wallet + $thisInvestment->amount;
            }

            $activity = new Activities;
            $activity->title = "Capital Reimbursement";
            $activity->user_id = $thisInvestment->user_id;
            $activity->category = "deposit";
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->amount = $thisInvestment->amount;
            $activity->descp = "Reimbursement of investmented capital";
            $activity->save();

            $userInfo->update();
            $thisInvestment->update();
            $req->session()->flash('success', "Capital has been withdrawn to your wallet.....! Start a new investment or withdraw from your wallet");
            return redirect('user/dashboard');

        } else if ($req->type == "reinvest") {
            $thisInvestment = UsersInvestments::where('id', $id)->firstOrFail();
            $amount = $thisInvestment->amount;

            $package = Investment_Packages::findOrFail($thisInvestment->investment_packages_id);
            $packagename = $package->name;
            $user_id = auth()->id();

            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $user_id)
                ->get()->first();

            $thisInvestment->date = Carbon::now()->toDayDateTimeString();
            $thisInvestment->end_date = date('Y-m-d', strtotime("+{$thisInvestment->duration} months", strtotime(Carbon::now()->toDayDateTimeString())));

            $thisInvestment->active = true;
            $thisInvestment->status = "completed";

            $thisInvestment->update();

            $activity = new Activities;
            $activity->title = "Investment Restarted";
            $activity->user_id = $user->user_id;
            $activity->user_investments_id = $thisInvestment->id;
            $activity->investment_packages_id = $thisInvestment->investment_packages_id;
            $activity->category = "deposit";
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->amount = $thisInvestment->amount;
            $activity->descp = "Deposit of $-{$thisInvestment->amount} made for $packagename";

            $activity->save();

            //$user->email
            try {
                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => 'Investment Restarted',
                    'title' => "Congratulations {$user->name} {$user->last_name}",
                    'url' => "{env('APP_URL')}/user/user-investments",
                    'descp' => "We are delighted to inform you that your portfolio re-purchase of $packagename
                    has been received successfully. Your Investor account will be activated shortly.
                        This is the best step you could possibly take toward regaining control of your financial life.
                        Our key Goal is providing efficient and reliable financial services to our clients.
                        We very much admire your shrewdness in taking this decisive action now. There is every reason to believe you are on your way to the top!",
                    'action-text' => 'Client Access',
                    'img' => 'assets/images/emails/investment-banner.jpg',
                ]));

                Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                    'subject' => 'Investment Restarted',
                    'title' => "Hi Admin",
                    'url' => "{env('APP_URL')}/admin/users-investments",
                    'descp' => "A user just successfully restarted $packagename .
                             These are the user details.... NAME: $user->name $user->last_name, EMAIL: $user->email, PHONE: $user->phone, AMOUNT: $$amount.....
                             Please Login to confirm investments",
                    'action-text' => 'Vew Investments',
                    'img' => 'assets/images/emails/Palm-Alliance-Management-Building.jpg',
                ]));

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

                        $bonusAmount = $amount * 0.10;
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

                        //Save Activity
                        $activity = new Activities;
                        $activity->title = "Referral Bonus";
                        $activity->user_id = $referredUser->user_id;
                        $activity->category = "bonus";
                        $activity->date = Carbon::now()->toDayDateTimeString();
                        $activity->amount = $bonusAmount;
                        $activity->descp = "Credited 10% - $$bonusAmount as referral bonus";
                        $activity->save();
                        // $referredUser->email

                        try {
                            Mail::to($referredUser->email)->send(new UserRegisteredMail([
                                'subject' => 'Members Benefit Commissions',
                                'title' => "Hi $referredUser->name $referredUser->last_name ",
                                'url' => "https://palmalliance.com/user/referred-users",
                                'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
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
                                $bonusAmount_stage2 = $amount * 0.05;

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

                                //Save Activity
                                $activity = new Activities;
                                $activity->title = "Referral Bonus";
                                $activity->user_id = $referredUser_stage2->user_id;
                                $activity->category = "bonus";
                                $activity->date = Carbon::now()->toDayDateTimeString();
                                $activity->amount = $bonusAmount_stage2;
                                $activity->descp = "Credited 5% - $$bonusAmount_stage2 as referral bonus";
                                $activity->save();
                                // $referredUser_stage2->email

                                try {
                                    // Mail::to($referredUser_stage2->email)->send(new UserRegisteredMail([
                                    //     'subject' => 'Members Benefit Commissions',
                                    //     'title' => "Hi $referredUser_stage2->name $referredUser_stage2->last_name ",
                                    //     'url' => "https://palmalliance.com/user/referred-users",
                                    //     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
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
                                        $bonusAmount_stage3 = $amount * 0.025;

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

                                        //Save Activity
                                        $activity = new Activities;
                                        $activity->title = "Referral Bonus";
                                        $activity->user_id = $referredUser_stage3->user_id;
                                        $activity->category = "bonus";
                                        $activity->date = Carbon::now()->toDayDateTimeString();
                                        $activity->amount = $bonusAmount_stage3;
                                        $activity->descp = "Credited 2.5% - $$bonusAmount_stage3 as referral bonus";
                                        $activity->save();
                                        // $referredUser_stage2->email

                                        try {
                                            // Mail::to($referredUser_stage3->email)->send(new UserRegisteredMail([
                                            //     'subject' => 'Members Benefit Commissions',
                                            //     'title' => "Hi $referredUser_stage3->name $referredUser_stage3->last_name ",
                                            //     'url' => "https://palmalliance.com/user/referred-users",
                                            //     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
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
            } catch (\Exception$e) {
                $req->session()->flash('error', 'An error occured sending mails');
            }
            $req->session()->flash('success', "Investment restarted successfully");
            return redirect('user/user-investments');
        }

    }
}
