<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\User;
use App\Models\Voyager;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompoundVoyage extends Controller
{

    public function index()
    {

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
        function calculatePercentage($v, $t)
        {
            return 100 * $v / $t;
        }

        $day = date("D", strtotime(Carbon::now()->toDayDateTimeString()));
        if ($day == "Sat" || $day == "Sun") {
            return ["response" => "No Earning today"];
        } else {
            $voyagers = Voyager::where("status", "active")->get();

            foreach ($voyagers as $key => $voy) {

                $user_id = $voy->user_id;
                //Join user table and userinfos table together

                $user = getUserDetails($user_id);

                $sortedReferrals = [];
                $totalInvested = 0;
                $totalReferrals = 0;
                
                //REFERRALS 1
                $referrals_1 = getReferrals($user_id);

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

                $accumulatedBonus = $totalInvested;
                $level = "Level_0";
                $levelDescp = "Voyager Basic";
                $currentPrecentage = calculatePercentage($accumulatedBonus, 100000);
                $currentAmount = 0.0;

                if ($accumulatedBonus > 100000 && $accumulatedBonus < 500000) {
                    $currentPrecentage = calculatePercentage($accumulatedBonus, 500000);
                    $currentAmount = 12000;
                    $level = "Level_1";
                    $levelDescp = "Voyager Basic";
                } elseif ($accumulatedBonus > 500000 && $accumulatedBonus < 1000000) {
                    $currentPrecentage = calculatePercentage($accumulatedBonus, 1000000);
                    $currentAmount = 60000;
                    $level = "Level_2";
                    $levelDescp = "Voyager Inter";
                } elseif ($accumulatedBonus > 1000000 && $accumulatedBonus < 2000000) {
                    $currentPrecentage = calculatePercentage($accumulatedBonus, 2000000);
                    $currentAmount = 120000;
                    $level = "Level_3";
                    $levelDescp = "Voyager Pro";
                } elseif ($accumulatedBonus > 2000000 && $accumulatedBonus < 5000000) {
                    $currentPrecentage = calculatePercentage($accumulatedBonus, 5000000);
                    $currentAmount = 240000;
                    $level = "Level_4";
                    $levelDescp = "Voyager Silver";
                } elseif ($accumulatedBonus > 5000000 && $accumulatedBonus < 10000000) {
                    $currentPrecentage = calculatePercentage($accumulatedBonus, 10000000);
                    $currentAmount = 600000;
                    $level = "Level_5";
                    $levelDescp = "Voyager Bronze";
                } elseif ($accumulatedBonus > 10000000) {
                    $currentPrecentage = 100;
                    $currentAmount = 12000000;
                    $level = "Level_6";
                    $levelDescp = "Voyager Gold";
                }
                $voyager = Voyager::where('user_id', $user_id)->firstOrFail();
                $creditAmount = $currentAmount;
                $return=$creditAmount * 0.0112;

                if ( $currentAmount > 0 && $voyager->amount < $creditAmount) {

                    //Save Activity Wed, Nov 10, 2021 1:00 AM  Carbon::now()->toDayDateTimeString()
                    
                    $voyager->amount = $creditAmount;
                    $voyager->total_amount=$voyager->total_amount + $return;
                    $voyager->daily_return = $return;
                   $voyager->update();
                   $date=Carbon::now()->toDayDateTimeString();
                   echo "Credited:$creditAmount ------- User:$user_id------- Return:$return-------Date:$date\n\n";

                    $activity = new Activities();
                    $activity->title = "$levelDescp commision";
                    $activity->user_id = $user_id;
                    $activity->category = "deposit";
                    $activity->date = Carbon::now()->toDayDateTimeString();
                    $activity->amount = $creditAmount;
                    $activity->descp = "Sum of $12,000 has been added to your  $levelDescp bonus";
                    $activity->save();

                }else if($currentAmount > 0 && $voyager->amount == $creditAmount){

                    $voyager->total_amount = $voyager->total_amount + $return;
                    $voyager->update();
                    $date=Carbon::now()->toDayDateTimeString();
                    echo "Returns:$return ------- User:$user_id ------- Date-$date \n\n";

                    $activity = new Activities();
                    $activity->title = "Voyager Earning";
                    $activity->user_id = $user_id;
                    $activity->category = "earning";
                    $activity->date = Carbon::now()->toDayDateTimeString();
                    $activity->amount = $return;
                    $activity->descp = "Credited $$return interest of $levelDescp to voyager wallet";
                    $activity->save();
                }
            }

            return ["response" => "Voyager compounding Done"];
        }
    }

}
