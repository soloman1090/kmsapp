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

class MigrationController extends Controller
{

    public function index(Request $req){
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
    return view('admin.user-migration',['page_title'=>"User Migration",  "priviledge" => $priviledge,]);
    }

    public function store(Request $req){
        $email1=$req->email1;
        $email2=$req->email2;

        $user1 = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.email',  $email1)
                ->get()->first();

        $user2 = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.email',  $email2)
                ->get()->first();
        if($user1->user_id==null){
            $req->session()->flash('error', "User 1 does not exists");
            return redirect("admin/user-data-migration");
        }
        if($user2->user_id==null){
            $req->session()->flash('error', "User 2 does not exists");
            return redirect("admin/user-data-migration");
        }
     
        Activities::where('user_id', $user1->user_id)->update(['user_id' => $user2->user_id]);
        UsersInvestments::where('user_id', $user1->user_id)->update(['user_id' => $user2->user_id]);
        WithdrawalRequests::where('user_id', $user1->user_id)->update(['user_id' => $user2->user_id]);
        Referrals::where('user_id', $user1->user_id)->update(['user_id' => $user2->user_id]);
        Reinvest::where('user_id', $user1->user_id)->update(['user_id' => $user2->user_id]);
        Activities::where('user_id', $user1->user_id)->update(['user_id' => $user2->user_id]);

        // Copy data
        $userInfo2 = UserInfo::where('user_id', $user2->user_id)->firstOrFail();
        $userInfo2->last_name=$user1->last_name;
        $userInfo2->phone=$user1->phone;
        $userInfo2->city=$user1->city;
        $userInfo2->state=$user1->state;
        $userInfo2->zip_code=$user1->zip_code;
        $userInfo2->kyc=$user1->kyc;
        $userInfo2->image=$user1->image;
        $userInfo2->verified= $user1->verified;
        $userInfo2->main_wallet=$user1->main_wallet;
        $userInfo2->compound_wallet=$user1->compound_wallet;
        $userInfo2->referred_by=$user1->referred_by;
        $userInfo2->withdrawal_limit=$user1->withdrawal_limit;
        $userInfo2->invested=$user1->invested;
        $userInfo2->referalcode=$user1->referalcode;
        $userInfo2->code_2fa=$user1->code_2fa;
        
        $userInfo2->update();


        UserInfo::where('referred_by', $user1->user_id)->update(['referred_by' => $user2->user_id]);

        $req->session()->flash('success', "User Data Migrated from $email1 ----------- $email2");
        return redirect("admin/user-data-migration");

    }

}