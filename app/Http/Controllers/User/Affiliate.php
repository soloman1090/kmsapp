<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use App\Models\Voyager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class Affiliate extends Controller
{
    public function index(Request $req)
    {

        $id = auth()->id();
        //Join user table and userinfos table together

        function getUserDetails($userID)
        {
            $aUser = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $userID)
                ->get()->first();
            return $aUser;
        }

        function getUserInvestments($userID)
        {
            $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                ->where('users.id', $userID)->where('user_investments.status', "completed")->where('user_investments.active', true)
                ->get(['user_investments.amount', 'user_investments.status', 'users.email']);
            return $investments;
        }

        function getReferrals($userID)
        {
            $referrals = DB::table('users')->join('referrals', 'users.id', "=", 'referrals.user_id')->where('users.id', $userID)->orderBy('referrals.id', 'DESC')->get();
            return $referrals;
        }

        $user = getUserDetails($id);

        try {
            if ($req->has('request')) {

                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => 'Voyager Client Request',
                    'title' => "Hi $user->name $user->last_name",
                    'url' => "{$req->getSchemeAndHttpHost()}/user/voyager-program/create",
                    'descp' => "<p>We are delighted to have received your request to become a unique and esteemed voyager client. As a voyager client, our board of directors has decided to reward small and medium-scale partners who will like to benefit extra from their members’ benefit programme with extra incentives for surpassing their voyager milestones. To continue this process, kindly follow the link in this email and fill out the form provided to let us know a bit more about you and your intended community. Approval of this application is solely based on merit.</p><p> A mail will be sent back to you within 3 working days explaining if your request has been approved or denied. We look forward to working with you and your community. Kindly reach out to our customer fulfilment centre if you need help with understanding this unique programme.</p>",
                    'action-text' => 'Click Here To Apply',
                    'img' => 'assets/images/emails/withdrawal-banner.jpg',
                ]));
                $req->session()->flash('success', 'Please check your email, and completed the application form');
            }
        } catch (\Exception$e) {

        }

        $sortedReferrals = [];
        $totalInvested = 0;
        $totalReferrals = 0;

        //REFERRALS 1
        $referrals_1 = getReferrals($id);

        foreach ($referrals_1 as $key => $ref_user_1) {

            $aUser = getUserDetails($ref_user_1->referred_user_id);
            if ($aUser != null) {
                $totalReferrals = $totalReferrals + 1;

                $investments = getUserInvestments($ref_user_1->referred_user_id);

                $userTotalInvested = 0;
                if (count($investments) > 0) {
                    foreach ($investments as $key => $vest) {
                        $aUser->invested = true;
                        $totalInvested = $totalInvested + $vest->amount;
                        $userTotalInvested = $userTotalInvested + $vest->amount;
                    }
                } else {
                    $aUser->invested = false;
                }
                $aUser->totalInvested = $userTotalInvested;

                //REFERRALS 2
                $referrals_2 = getReferrals($ref_user_1->referred_user_id);
                $stage1Users = [];
                foreach ($referrals_2 as $key => $ref_user_2) {
                    $totalReferrals = $totalReferrals + 1;
                    $aUser2 = getUserDetails($ref_user_2->referred_user_id);

                    if ($aUser2 != null) {

                        $investments2 = getUserInvestments($ref_user_2->referred_user_id);
                        $user2TotalInvested = 0;
                        if (count($investments2) > 0) {
                            foreach ($investments2 as $key => $vest) {
                                $aUser2->invested = true;
                                $totalInvested = $totalInvested + $vest->amount;
                                $user2TotalInvested = $user2TotalInvested + $vest->amount;
                            }
                        } else {
                            $aUser2->invested = false;
                        }
                        $aUser2->totalInvested = $user2TotalInvested;

                        //REFERRALS 3
                        $referrals_3 = getReferrals($ref_user_2->referred_user_id);
                        $stage2Users = [];
                        foreach ($referrals_3 as $key => $ref_user_3) {
                            $totalReferrals = $totalReferrals + 1;
                            $aUser3 = getUserDetails($ref_user_3->referred_user_id);

                            if ($aUser3 != null) {

                                $investments3 = getUserInvestments($ref_user_3->referred_user_id);
                                $user3TotalInvested = 0;
                                if (count($investments3) > 0) {
                                    foreach ($investments3 as $key => $vest) {
                                        $aUser3->invested = true;
                                        $totalInvested = $totalInvested + $vest->amount;
                                        $user3TotalInvested = $user3TotalInvested + $vest->amount;
                                    }
                                } else {
                                    $aUser3->invested = false;
                                }
                                $aUser3->totalInvested = $user3TotalInvested;

                                array_push($stage2Users, (object) $aUser3);
                            }
                        }

                        //Save Step 3 Users
                        $aUser2->stage2Users = $stage2Users;

                        array_push($stage1Users, (object) $aUser2);
                    }
                }

                //Save Step 2 Users
                $aUser->stage1Users = $stage1Users;

                array_push($sortedReferrals, (object) $aUser);
            }
        }

        function calculatePercentage($v, $t)
        {
            return 100 * $v / $t;
        }

        $accumulatedBonus = $totalInvested;
        $level = "Level_0";
        $levelDescp = "In Progress To Voyager Basic";
        $currentPrecentage = calculatePercentage($accumulatedBonus, 100000);

        if ($accumulatedBonus > 100000 && $accumulatedBonus < 500000) {
            $currentPrecentage = calculatePercentage($accumulatedBonus, 500000);
            $level = "Level_1";
            $levelDescp = "In Progress To Voyager Inter";
        } elseif ($accumulatedBonus > 500000 && $accumulatedBonus < 1000000) {
            $currentPrecentage = calculatePercentage($accumulatedBonus, 1000000);
            $level = "Level_2";
            $levelDescp = "In Progress To Voyager Pro";
        } elseif ($accumulatedBonus > 1000000 && $accumulatedBonus < 2000000) {
            $currentPrecentage = calculatePercentage($accumulatedBonus, 2000000);
            $level = "Level_3";
            $levelDescp = "In Progress To Voyager Silver";
        } elseif ($accumulatedBonus > 2000000 && $accumulatedBonus < 5000000) {
            $currentPrecentage = calculatePercentage($accumulatedBonus, 5000000);
            $level = "Level_4";
            $levelDescp = "In Progress To Voyager Bronze";
        } elseif ($accumulatedBonus > 5000000 && $accumulatedBonus < 10000000) {
            $currentPrecentage = calculatePercentage($accumulatedBonus, 10000000);
            $level = "Level_5";
            $levelDescp = "In Progress To Voyager Gold";
        } elseif ($accumulatedBonus > 10000000) {
            $currentPrecentage = 100;
            $level = "Level_6";
            $levelDescp = "Voyage Completed";
        }

        $voyager = Voyager::where('user_id', $id)->get()->first();
       
        function getAmountAttribute($value)
        {
            return number_format($value);
        }
        
       

        $totalDaysDiff=0;
        $dayLeft=0;
        if($voyager!=null){
            $voyager->amount=getAmountAttribute($voyager->amount);
            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($voyager->date);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 < $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                }
            }
        }

        return view('user.affiliates', ['user' => $user, 'user_id' => $id,'days'=>$totalDaysDiff,'daysLeft'=>$dayLeft, 'referrals' => $sortedReferrals, 'level_descp' => $levelDescp, 'page_title' => "Voyager Program", 'username' => $user->name, 'referral_code' => $user->referalcode, "accumulatedBonus" => getAmountAttribute($accumulatedBonus), "currentPrecentage" => $currentPrecentage, "level" => $level, "totalReferrals" => getAmountAttribute($totalReferrals), "voyager" => $voyager]);

    }

    public function create()
    {

        $id = auth()->id();
        //Join user table and userinfos table together

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        return view('user.voyage-apply', ['page_title' => "Voyager Client Application", 'user' => $user, 'user_id' => $id, 'username' => $user->name]);
    }

    public function store(Request $req, )
    {

        $sendData = "<b>NAME:</b> $req->full_name <br/>
        <b>Email:</b> $req->email <br/>
        <b>DATE-OF-BIRTH:</b>$req->day/$req->month/$req->year   <br/>
        <hr/>
        <h4>BUSINESS INFO:</h4>
        <hr/>
        <b>BUSINESSNAME:</b> $req->business_name <br/>
        <b>BUSINESS-REGISTRATION:</b> $req->business_reg <br/>
        <b>BUSINESS-POSITION:</b> $req->business_position <br/>
        <hr/>
        <h4>OTHER INFO:</h4>
        <hr/>
        <b>PASSPORT NUMBER:</b> $req->passport_no <br/>
        <b>PHONE:</b> $req->phone <br/>
        <b>STREET:</b> $req->street <br/>
        <b>CITY:</b> $req->city <br/>
        <b>COUNTRY :</b> $req->country <br/>
        <hr/>
        <h4>ACCOUNT INFO:</h4>
        <hr/>
        <b>NAME:</b> $req->account_name <br/>
        <b>REFERRAL-CODE :</b> $req->referral_code <br/>
        <hr/>
        <h4>Dell Group INFO:</h4>
        <hr/>
        <b>COMMUNICATION:</b> $req->communication <br/>
        <b>TARGET CLIENTS:</b> $req->target_clients <br/>
        <b>PROMOTIONS:</b> $req->promotion_materials <br/>
        <b>MARKETING MATERIALS:</b> $req->marketing_materials <br/>
        <b>INSTITUTIONS:</b> $req->financial_institution <br/>   ";

        try {
            Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                'subject' => 'Voyager Client Application',
                'title' => "Hi Admin",
                'url' => "{$req->getSchemeAndHttpHost()}/admin/users",
                'descp' => "$sendData",
                'action-text' => 'Approve Application',
                'img' => 'assets/images/emails/withdrawal-banner.jpg',
            ]));
            $req->session()->flash('success', 'Application sent successfully... A mail will be sent back to you within 3 working days to confirm your request ');
            return redirect("user/voyager-program");

        } catch (\Exception$e) {

        }
    }

    public function update(Request $req, $id)
    {
        $userVoyager = Voyager::where('user_id', $id)->get()->first();
        if ($req["activation_key"] == $userVoyager->activation_key) {
            $voyager = Voyager::where('user_id', $id)->firstOrFail();
            $voyager->date = date('Y-m-d', strtotime("+8 months", strtotime(Carbon::now()->toDayDateTimeString())));
            $voyager->status = "active";
            $voyager->update();
            $req->session()->flash('success', "Your voyager account is now active ");
            return redirect("user/voyager-program");
        } else {
            $req->session()->flash('error', "Invalid Activation Key ");
            return redirect("user/voyager-program");
        }

    }

}
