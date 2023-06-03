<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Messages;

class Message extends Controller
{
    public function index(){
        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();

        //$message =  DB::table('users')->join('messages','users.id',"=", 'messages.user_id')->where([ ['users.id', '=',"0"],])->get();
        $messages = Messages::where('owner',"0")->orWhere('user_id',$id)-> orderBy('id','DESC')->get();
        return view('user.message',['user'=>$user, 'messages'=>$messages, 'user_id'=>$id, 'page_title'=>"Messages",  'username'=>$user->name]);
    }
}
