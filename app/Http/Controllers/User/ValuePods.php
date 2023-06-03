<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\Activities;
use App\Models\Wallet_Payments;
use \Datetime;
use App\Mail\UserRegisteredMail;
use Mail;
use Carbon\Carbon;

class ValuePods extends Controller
{
    public function index()
    {
        $packages = Investment_Packages::where("package_type","pods")->where("active_status","active")->get();
        function getAmountAttribute($value)
        {
            return number_format($value);
        }

        foreach ($packages as $key => $pack) {
            $pack->formatted_min=getAmountAttribute($pack->min_amt);
        }
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();


             //Change Payout
        function getPayout($data)
        {
            switch ($data) {
                    case 'daily_payout':
                        return "Daily Payout";
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

         

         

        
        

        

        $userActivities=User::join('activities', 'activities.user_id', '=', 'users.id')
        ->join('investment_packages', 'investment_packages.id', '=', 'activities.investment_packages_id')
        ->where('users.id', $id)
        ->where('investment_packages.package_type', "pods")
        ->orderBy('activities.id', 'DESC')
        ->get();



         
        $investments= User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
        ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
        ->where('users.id', $id)
        ->where('investment_packages.package_type', "pods")
        ->orderBy('user_investments.id', 'DESC')
        ->get(['users.name as username','users.email', 'investment_packages.name as packagename',  'investment_packages.id as package_id','user_investments.date','user_investments.id as investment_id','user_investments.end_date','investment_packages.category_name',
        'user_investments.amount','user_investments.returns', 'investment_packages.duration', 'user_investments.payout', 'user_investments.active','user_investments.status','user_investments.txn_id','user_investments.compounding_amount' ]);

        
        $usersInvestments=[];
        $totalInvested=0;
        $totalReturns=0;
        $totalActive=0;
        $totalPending=0;
        $totalCompouding=0;

        for ($i=0; $i < count($investments); $i++) {
            //$investments[$i]['end_date']
            $totalInvested=$totalInvested+$investments[$i]['amount'];
            $totalReturns=$totalReturns + $investments[$i]['returns'];
            if($investments[$i]['status']=="completed"){
                $totalActive=$totalActive + 1;
                $totalCompouding=$totalCompouding+$investments[$i]['compounding_amount'];
            }else if($investments[$i]['status']=="pending"){
                $totalPending=$totalPending + 1;
            }

                $d1 = strtotime(Carbon::now()->toDayDateTimeString());
                $d2 = strtotime($investments[$i]['end_date']);
                $totalSecondsDiff = abs($d1-$d2);
                $totalDaysDiff  =intval(round($totalSecondsDiff/60/60/24));
                if ($d1 < $d2) {
                    $dayLeft=100;
                    if ($totalDaysDiff < 100) {
                        $dayLeft=$totalDaysDiff;
                    }
                    $data= ['days'=>$totalDaysDiff,'daysLeft'=>$dayLeft,'username'=>$investments[$i]['username'],'email'=>$investments[$i]['email'],'packagename'=>$investments[$i]['packagename'],'category_name'=>$investments[$i]['category_name'],'date'=>$investments[$i]['date'],'amount'=>$investments[$i]['amount'],'returns'=>$investments[$i]['returns'],'duration'=>$investments[$i]['duration'],
                    'payout'=>getPayout($investments[$i]['payout']),'active'=>$investments[$i]['active'],'investment_id'=>$investments[$i]['investment_id'],'package_id'=>$investments[$i]['package_id'],'status'=>$investments[$i]['status'],'txn_id'=>$investments[$i]['txn_id'],"compounding_amount"=> $investments[$i]['compounding_amount']];
                    array_push($usersInvestments, (object)$data);
                }
        }

        return view('user.value-pods', ['user' => $user, 'user_id' => $id, 'page_title' => " ",'activities'=>$userActivities, 'investments'=>$usersInvestments, 'packages' => $packages, 'username' => $user->name, "totalInvested"=> getAmountAttribute($totalInvested),
        "totalReturns"=> getAmountAttribute($totalReturns),
        "totalActive"=>$totalActive,
        "totalPending"=>$totalPending,"totalCompouding"=> getAmountAttribute($totalCompouding)], );
    }
}