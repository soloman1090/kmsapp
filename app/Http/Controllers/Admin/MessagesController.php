<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\Messages;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class MessagesController extends Controller
{
    public function index(){
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        $messages = Messages::all();
        $users =  DB::table('users')->join('user_infos','users.id',"=", 'user_infos.user_id')->orderBy('users.id','DESC')->get();

        return view('admin.messages',
        ['messages'=>$messages, 'users'=>$users, "priviledge" => $priviledge, 'page_title'=>"All Messages"]);
    }

    public function store(Request $req){

       $message = new Messages;
       $message->title=$req['title'];
       if($req['user_id']==0){
        $message->user_id=null;
        $message->owner=0;
       }else{
        $message->user_id=$req['user_id'];
        $message->owner= DB::table('users')
        ->where('users.id',$req['user_id'])
        ->get()->first()->name;
       }


       $message->category=$req['category'];
       $message->descp=$req['descp'];
       $message->date=Carbon::now()->toDayDateTimeString();

       $message->save();
       $req->session()->flash('success','Messages Sent successfully');
        return  redirect('admin/messsages');

    }

    public function destroy(Request $request,$id)
    {
        Messages::destroy($id);
        $request->session()->flash('success','You have deleted this message');
        return  redirect('admin/messsages');
    }
}
