<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CompoundInterest extends Controller
{

    public function index()
    {
        // $message=new Messages;
        // $message->title="Cron Job";
        // $message->descp="Testing Cron Job";
        // $message->save();
        
        DB::table('user_investments')->where('status', "pending")->orWhere('status', "expired")->orWhere('status', "cancelled")->orWhere('status', "error")->delete();
        DB::table('reinvest')->where('status', "pending")->orWhere('status', "expired")->orWhere('status', "cancelled")->orWhere('status', "error")->orWhere('status', "pending_reinvest")->delete();

        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->orderBy('user_investments.id', 'DESC')
            ->where('user_investments.status', 'completed')
            ->get(['users.name as username', 'users.email', 'investment_packages.name as packagename', 'investment_packages.id as package_id', 'user_investments.date', 'user_investments.id as investment_id', 'user_investments.end_date', 'investment_packages.category_name', 'users.id as user_id',
                'user_investments.amount', 'user_investments.returns', 'user_investments.duration', 'user_investments.payout', 'user_investments.active', 'user_investments.status', 'user_investments.txn_id']);

                 

        $usersInvestments = [];
        for ($i = 0; $i < count($investments); $i++) {
            //$investments[$i]['end_date']

            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($investments[$i]['end_date']);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 < $d2 || $d1 > $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                }
                $data = ['days_left' => $dayLeft, 'packagename' => $investments[$i]['packagename'], 'payout' => $investments[$i]['payout'], 'amount' => $investments[$i]['amount'], 'returns' => $investments[$i]['returns'], 'duration' => $investments[$i]['duration'], 'active' => $investments[$i]['active'], 'investment_id' => $investments[$i]['investment_id'], 'user_id' => $investments[$i]['user_id'], 'package_id' => $investments[$i]['package_id']];
                array_push($usersInvestments, (object) $data);
            }
        }

        $day = date("D", strtotime(Carbon::now()->toDayDateTimeString()));

        foreach ($usersInvestments as $key => $userInvest) {
            
            $thisInvest = UsersInvestments::findOrFail($userInvest->investment_id);
            $package = Investment_Packages::findOrFail($userInvest->package_id);
            

            $canCompound = false;
            if ( $package->running_days == 7) {
                $canCompound = true;
            } else if ( $package->running_days == 5 && $day!="Sat" && $day!="Sun") {
                $canCompound = true;
            }

            if ($canCompound == true) {
               
                // if ($userInvest->days_left == 1) {
                //     $thisInvest->status = "finished";
                //     $thisInvest->update();
                // }

                //Calculate Percentage
                $percentage=null;
                if ($userInvest->payout == "6_months_compounding" ||
                    $userInvest->payout == "7_months_compounding" ||
                    $userInvest->payout == "8_months_compounding" ||
                    $userInvest->payout == "9_months_compounding" ||
                    $userInvest->payout == "10_months_compounding" ) {
                    $percentage = $package->compound_percent / 100;
                    
                }else if($userInvest->payout == "pods"|| $userInvest->payout == "short"){
                    $percentage = $package->compound_percent / 100;
                } else {
                    $percentage = $package->min_percent / 100;
                }

                

                $user = DB::table('users')
                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                    ->where('users.id', $userInvest->user_id)
                    ->get()->first();

                //Get Wallet Balance
                $currentAmount = 0;
                if ($user->main_wallet == null) {
                    $currentAmount = 0;
                } else {
                    $currentAmount = $user->main_wallet;
                }
               

                //Get Compounding Balance
                $currentCompoundingAmount = 0;
                if ($user->compound_wallet == null) {
                    $currentCompoundingAmount = 0;
                } else {
                    $currentCompoundingAmount = $user->compound_wallet;
                }

                //Save Wallet
                $userInfo = UserInfo::where('user_id', $userInvest->user_id)->firstOrFail();

                //Add twice the amount to receive
                //$creditAmount=$creditAmount+$creditAmount;
                $creditAmount =null;
               
                if ($userInvest->payout == "pods" || $userInvest->payout == "short") { 
                    if ($thisInvest->compounding_amount == null) {
                        $creditAmount  = $percentage * $userInvest->amount;
                        $thisInvest->compounding_amount = $creditAmount + $userInvest->amount;
                        $thisInvest->returns=$creditAmount;                         
                    } else {

                        $creditAmount  = $percentage * $thisInvest->compounding_amount;

                        $thisInvest->compounding_amount = $thisInvest->compounding_amount + $creditAmount;

                        $thisInvest->returns=$creditAmount;
                      
                    } 
                    $thisInvest->update();
                    
                } else {
                    $creditAmount  = $percentage * $userInvest->amount;
                    if ($userInvest->payout == "6_months_compounding" ||
                        $userInvest->payout == "7_months_compounding" ||
                        $userInvest->payout == "8_months_compounding" ||
                        $userInvest->payout == "9_months_compounding" ||
                        $userInvest->payout == "10_months_compounding") {
                        $userInfo->compound_wallet = $currentCompoundingAmount + $creditAmount;
                    } else {
                        $userInfo->main_wallet = $currentAmount + $creditAmount;
                    }
                    $userInfo->update();
                } 

                //Save Activity Wed, Nov 10, 2021 1:00 AM  Carbon::now()->toDayDateTimeString()
                $activity = new Activities();
                if ($package->package_type == "pods") {
                    $activity->title ="Pods Earning";
                }  else if ($package->package_type == "short") {
                    $activity->title ="Short Term Earning";
                }else {
                    $activity->title ="Daily Earning";
                }
                
                $activity->user_id = $userInvest->user_id;
                $activity->user_investments_id = $userInvest->investment_id;
                $activity->investment_packages_id = $userInvest->package_id;
                $activity->category = "earning";
                $activity->date = Carbon::now()->toDayDateTimeString();
                $activity->amount = $creditAmount;
                //$activity->descp="Client appreciation disbursement of $$creditAmount ";
                if ($package->package_type == "pods" || $package->package_type == "short") {
                    $activity->descp="Compounding $$creditAmount interest of  $package->name to your invested capital";
                }   else {
                    $activity->descp="Credited $$creditAmount interest of  $package->name";
                }

                $activity->save();
            }
        }

        return ["response" => "Week earning Done"];
    }

}
