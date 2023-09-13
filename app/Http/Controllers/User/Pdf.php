<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\ContentLibary;
use App\Models\Activities;

class Pdf extends Controller
{
    public function index(){
        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();

        $allDocuments = ContentLibary::where('category', "document")->where("created_at", "<", Carbon::now())->orderBy("created_at", 'desc')->get();
       //dd($allDocuments);


        return view('user.pdf',['user'=>$user,'user_id'=>$id, 'page_title'=>"Dellgroup Documents", 'username'=>$user->name, "documents"=> $allDocuments]);
    }
}