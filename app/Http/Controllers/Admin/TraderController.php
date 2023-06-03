<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Traders;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class TraderController extends Controller
{
    public function index(){
        $traders = Traders::all();

        return view('admin.traders',
        ['traders'=>$traders,
        'page_title'=>"Traders Account"]);
    }

    public function store(Request $req){

        $trader=new Traders;
      if( $req->file('image')!=null){
        $imageName=time().'.'.$req->image->extension();
        $path= $req->image->move(public_path('uploads'), $imageName);
        $trader->image=$imageName;
      }


       $trader->name=$req['name'];
       $trader->position=$req['position'];
       $trader->phone=$req['phone'];
       $trader->descp=$req['descp'];
       $trader->mail=$req['mail'];
       $trader->link=$req['link'];
       $trader->save();
       $req->session()->flash('success','Trader account added successfully');
        return  redirect('admin/traders');

    }

    public function update(Request $req, $id)
    {
        $trader=Traders::findOrFail($id);
        if(!$trader){
            $req->session()->flash('error','Could not find trader');
            return  redirect('admin/traders');
        }
        //dd($req);
        if( $req->file('image')!=null){
            $imageName=time().'.'.$req->image->extension();
            $path= $req->image->move(public_path('uploads'), $imageName);
            $trader->image=$imageName;
        }

        $trader->name=$req->name;
        $trader->position=$req->position;
        $trader->phone=$req->phone;
        $trader->descp=$req->descp;
        $trader->mail=$req->mail;
        $trader->link=$req->link;
        $trader->update();
        $req->session()->flash('success','Update successful');
        return  redirect('admin/traders');
    }


    public function destroy(Request $request,$id)
    {
        Traders::destroy($id);
        $request->session()->flash('success','You have deleted trader account');
        return  redirect('admin/traders');
    }

}
