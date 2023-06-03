<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use App\Models\WithdrawalRequests;
use App\Models\Referrals;
use App\Models\Payment_Orders;
use App\Models\Reinvest;

class InvestmentSummaryController extends Controller
{
    public function index(){
        $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                ->where('user_investments.status', "completed")
                ->where('user_investments.active', true)
                ->orwhere('user_investments.status', "finished")
                ->orderBy('user_investments.id', 'DESC')
                ->get(['user_investments.id', 'users.name as username', 'users.email', 'users.id as user_id', 'investment_packages.name as packagename', 'user_investments.date', 'user_investments.end_date', 'user_investments.amount', 'user_investments.returns', 'investment_packages.id as package_id', 'user_investments.duration', 'user_investments.txn_id', 'user_investments.payout', 'user_investments.status', 'user_investments.active']);

        $packages = Investment_Packages::all();
         function getAmountAttribute($value)
        {
            return number_format( $value);
        }

       $allPackages=[];
       $amountInvests=[];
       $totalSystemInvested=0;
        foreach ($packages as $key => $package) {
            $totalInvested=0;
            foreach ($investments as $key => $invest) {
               if($invest->package_id==$package->id && $invest->user_id!=75 	
               && $invest->user_id!=81){
                $totalInvested=$totalInvested+$invest->amount;
               
               }
            }

            array_push($allPackages,$package->name);
            array_push($amountInvests,$totalInvested);
            $totalSystemInvested=  $totalSystemInvested+$totalInvested;
            $package->totalInvested=$totalInvested;
        }

        

        return view('admin.investment-summary',['packages'=>$packages,"priviledge" => $priviledge,'totalSystemInvested'=>  getAmountAttribute($totalSystemInvested), 'allPackages'=>$allPackages, 'amountInvests'=>$amountInvests, 'page_title'=>"Investment Summary", ]
    );
    }
}