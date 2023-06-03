<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\WithdrawalRequests;
use App\Models\Payment_Method;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;

class DashboardController extends Controller
{
    public function index(){
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }

        $users=  DB::table('users')->join('user_infos','users.id',"=", 'user_infos.user_id')->get();
        $request=User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
        ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
        ->orderBy('withdrawal_requests.id','DESC')
        ->get(['users.name as username','users.email', 'withdrawal_methods.name as methodname','withdrawal_requests.amount_paid',
            'withdrawal_requests.amount_credited','withdrawal_requests.charge', 'withdrawal_requests.wallet_address','withdrawal_requests.created_at as date',
             'withdrawal_requests.wallet_type', 'withdrawal_requests.approved', ]);
             
        $payment_methods= Payment_Method::all();

        $packages = Investment_Packages::all();
        $userInvestments= User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
        ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
        ->orderBy('user_investments.id', 'DESC')
        ->get(['user_investments.id','users.name as username','users.email','users.id as user_id', 'investment_packages.name as packagename','user_investments.date',
                'user_investments.amount','user_investments.returns','user_investments.txn_id', 'user_investments.duration', 'user_investments.payout','user_investments.status', 'user_investments.active', ]);


        $blockedUsers=0;
        $recentUsers=[];
        foreach ($users as $key => $user) {

            if($user->blocked=="blocked"){
                $blockedUsers=$blockedUsers+1;
            }

            if($user->blocked!="approved" && count($recentUsers) < 6){
                array_push($recentUsers,(object)$user);
            }

        }

        $totalInvested=0;
        $recentInvestments=[];
        foreach ($userInvestments as $key => $invest) {
            $totalInvested=$totalInvested+$invest->amount;

            if(  count($recentInvestments) < 6){
                array_push($recentInvestments,(object)$invest);
            }

        }

        $totalWithdrawn=0;
        $recentWithdrawn=[];
        foreach ($request as $key => $req) {
            $totalWithdrawn=$totalWithdrawn+$req->amount_credited;

            if(  count($recentWithdrawn) < 6){
                array_push($recentWithdrawn,(object)$req);
            }
        }





        return view('admin.dashboard',
        [
        'users'=>count($users),
        'withdrawals'=>count($request),
        'payment_methods'=>count($payment_methods),
        'packages'=>count($packages), "priviledge" => $priviledge,
        'totalInvested'=>$totalInvested,
        'blockedUsers'=>$blockedUsers,
        'totalWithdrawn'=>$totalWithdrawn,
        'recentUsers'=>$recentUsers,
        'recentInvestments'=>$recentInvestments,
        'recentWithdrawals'=>$recentWithdrawn,
        'page_title'=>"Dashboard"
    ]);
    }
}
