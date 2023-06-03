<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;


class Kyc extends Controller
{
    public function index(){
        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();
        return view('user.kyc',['user'=>$user, 'user_id'=>$id, 'page_title'=>"KYC",'username'=>$user->name]);
    }


    public function store(Request $req){

        $userInfo=UserInfo::where('user_id', auth()->id())->firstOrFail();
     
        if( $req->file('image')!=null){
            $imageName=time().'.'.$req->image->extension();
            $path= $req->image->move(public_path('uploads'), $imageName);
            $userInfo->image=$imageName;
            $req->session()->flash('success','KYC Uploaded, Pending Approval');
            $userInfo->update();
        }

        return redirect('user/kyc');
    }

}
