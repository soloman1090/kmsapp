<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Investment_Packages;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class InvestCalculator extends Controller
{
    public function index(Request $req)
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
        $user = getUserDetails($id);

        $packages = Investment_Packages::all();


        return view('user.invest-calculator', ['user' => $user, 'user_id' => $id, 'page_title' => "Investment Calculator",'username' => $user->name, 'packages'=>$packages]);
    }
}