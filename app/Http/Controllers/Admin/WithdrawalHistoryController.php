<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\AppPaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UserInfo;
use App\Models\Withdrawal_Methods;
use App\Models\WithdrawalRequests;

class WithdrawalHistoryController extends Controller
{
    public function index(){
        $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        $AppPaginator=new AppPaginator;

        $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();
         $withdrawals = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
        ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
        ->orderBy('withdrawal_requests.id','DESC')
        ->get(['users.name as username','users.email', 'withdrawal_methods.name as methodname','withdrawal_requests.amount_paid',
            'withdrawal_requests.amount_credited','withdrawal_requests.charge', 'withdrawal_requests.wallet_address','withdrawal_requests.created_at as date',
             'withdrawal_requests.wallet_type', 'withdrawal_requests.approved', ]);
        $methods = Withdrawal_Methods::all();

        $myCollectionObj1 = collect($withdrawals);
            $withdrawals = $AppPaginator->paginate($myCollectionObj1,'admin/withdrawal-history');

        return view('admin.withdrawal.w-history',
        [
        'withdrawals'=>$withdrawals,
        'users'=>$users,"priviledge" => $priviledge,
        'methods'=>$methods,
        'page_title'=>"Withdrawal History"
    ]);
    }



}
