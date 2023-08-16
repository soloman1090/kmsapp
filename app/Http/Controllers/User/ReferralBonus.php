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

class ReferralBonus extends Controller
{
    public function index(){
        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();


        $userBonus = DB::table('users')
        ->join('activities','users.id',"=", 'activities.user_id')
        ->where('activities.user_id',$id)
        ->where('category', 'LIKE', '%bonus%')
        ->orderBy('activities.id','DESC')
        ->get();

        $totalBonus=0.00;
        foreach ($userBonus as $key => $value) {
            $totalBonus=$totalBonus+ $value->amount;
        }

        return view('user.referral-bonus',['user'=>$user, 'user_id'=>$id,"totalBonus"=>$totalBonus, 'bonus'=> $userBonus, 'page_title'=>"Members Benefit Commissions", 'username'=>$user->name,'referral_code'=>$user->referalcode,]);
    }
}
