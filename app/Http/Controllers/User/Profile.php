<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;


class Profile extends Controller
{
    public function index(){
        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();
        return view('user.profile',['user'=>$user, 'user_id'=>$id, 'page_title'=>"Profile",'username'=>$user->name]);
    }


    public function store(Request $req){

        $userInfo=UserInfo::where('user_id', auth()->id())->firstOrFail();
        
        if( $req->file('image')!=null){
            $imageName=time().'.'.$req->image->extension();
            $path= $req->image->move(public_path('uploads'), $imageName);
            $userInfo->image=$imageName;
            $req->session()->flash('success','Profile Pucture update successful');
            $userInfo->update();
        }

        return redirect('user/profile');
    }

    public function update(Request $request, $id){

        
         $user=User::findOrFail($id);
         $userInfo=UserInfo::where('user_id', $id)->firstOrFail();
         if($request->email == $user->email){
            $user->name=$request->name;
            $user->update();
            $userInfo->update($request->except(['_token', 'roles','name',]));
            $request->session()->flash('success','Profile Update successful');
         }else{
            $request->session()->flash('error','Invalid Email Address');
         }
        
        return redirect('user/profile');

    }

}
