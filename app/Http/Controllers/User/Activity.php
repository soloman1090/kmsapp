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


class Activity extends Controller
{
    public function index(){
        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();


        $activities =DB::table('users')
        ->join('activities','users.id',"=", 'activities.user_id')
        ->where('activities.user_id',$id)
        ->orderBy('activities.id','DESC')
        ->get();

        $usersInvestments= User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                        ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                        ->where('users.id',$id)
                        ->get(['users.name as username','users.email', 'investment_packages.name as packagename','user_investments.date',
                        'user_investments.id as investment_id',
                                'user_investments.amount','user_investments.returns', 'user_investments.duration', 'user_investments.payout', 'user_investments.active', ]);

        return view('user.activity',['user'=>$user,'investments'=>$usersInvestments, 'user_id'=>$id, 'page_title'=>"Account Activities", 'activities'=>$activities,'username'=>$user->name]);
    }


}
