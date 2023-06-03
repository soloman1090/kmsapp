<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReferredUsers extends Controller
{
    public function index()
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
                ->where('users.id', $userID)->where('user_investments.status', "completed")
                ->get(['user_investments.amount', 'user_investments.status', 'users.email']);
            return $investments;
        }

        function getReferrals($userID)
        {
            $referrals = DB::table('users')->join('referrals', 'users.id', "=", 'referrals.user_id')->where('users.id', $userID)->orderBy('referrals.id', 'DESC')->get();
            return $referrals;
        }

        $user = getUserDetails($id);

        $sortedReferrals = [];
        $totalInvested = 0;

        //REFERRALS 1
        $referrals_1 = getReferrals($id);

        foreach ($referrals_1 as $key => $ref_user_1) {

            $aUser = getUserDetails($ref_user_1->referred_user_id);
            if ($aUser != null) {

                $investments = getUserInvestments($ref_user_1->referred_user_id);

                if (count($investments) > 0) {
                    foreach ($investments as $key => $vest) {
                        $aUser->invested = true;
                        $totalInvested = $totalInvested + $vest->amount;
                    }
                } else {
                    $aUser->invested = false;
                }

                //REFERRALS 2
                $referrals_2 = getReferrals($ref_user_1->referred_user_id);
                $stage1Users = [];
                foreach ($referrals_2 as $key => $ref_user_2) {

                    $aUser2 = getUserDetails($ref_user_2->referred_user_id);

                    if ($aUser2 != null) {

                        $investments2 = getUserInvestments($ref_user_2->referred_user_id);
                        if (count($investments2) > 0) {
                            foreach ($investments2 as $key => $vest) {
                                $aUser2->invested = true;
                                $totalInvested = $totalInvested + $vest->amount;
                            }
                        } else {
                            $aUser2->invested = false;
                        }

                        //REFERRALS 3
                        $referrals_3 = getReferrals($ref_user_2->referred_user_id);
                        $stage2Users = [];
                        foreach ($referrals_3 as $key => $ref_user_3) {

                            $aUser3 = getUserDetails($ref_user_3->referred_user_id);

                            if ($aUser3 != null) {

                                $investments3 = getUserInvestments($ref_user_3->referred_user_id);
                                if (count($investments3) > 0) {
                                    foreach ($investments3 as $key => $vest) {
                                        $aUser3->invested = true;
                                        $totalInvested = $totalInvested + $vest->amount;
                                    }
                                } else {
                                    $aUser3->invested = false;
                                }

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
       //dd($sortedReferrals);
        return view('user.referred-users', ['user' => $user, 'referrals' => $sortedReferrals, 'user_id' => $id, 'page_title' => " Referred Members", 'username' => $user->name, 'referral_code' => $user->referalcode]);
    }
}
