<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Popup_Data;
use App\Models\UserInfo;

class PopupController extends Controller
{
    public function index(){
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        
        $popups = Popup_Data::all();
        return view('admin.popup',
        [
        'popups'=>$popups, "priviledge" => $priviledge,
        'page_title'=>"Popup Manager"
    ]);
    }


    public function store(Request $req){

       $popup=new Popup_Data;
       if( $req->file('image')!=null){
         $imageName=time().'.'.$req->image->extension();
         $path= $req->image->move(public_path('uploads'), $imageName);
         $popup->image=$imageName;
       }
       $popup->title=$req['title']; 
       $popup->descp=$req['descp'];
       $popup->link=$req['link'];
       $popup->status=$req['status'];
        
       $popup->save();
       $req->session()->flash('success','Popup added successfully');
        return  redirect('admin/popups');
    }

    public function update(Request $req, $id){

        $popup=Popup_Data::findOrFail($id);
        
        

        if( $req->file('image')!=null){
             
            $imageName=time().'.'.$req->image->extension();
            $path= $req->image->move(public_path('uploads'), $imageName);
            $popup->image=$imageName;
          
          }
         
          $popup->title=$req['title']; 
          $popup->descp=$req['descp'];
          $popup->url=$req['link'];
          $popup->status=$req['status'];
     
        $popup->update();
        $req->session()->flash('success','Popup updated successfully');
         return  redirect('admin/popups');

     }

    public function destroy(Request $request,$id)
    {
        Popup_Data::destroy($id);
        $request->session()->flash('success','You have deleted a popup');
        return  redirect('admin/popups');
    }


}
