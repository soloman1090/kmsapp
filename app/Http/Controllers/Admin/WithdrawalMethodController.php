<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Withdrawal_Methods;

class WithdrawalMethodController extends Controller
{
    public function index(){
        $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            
            return  redirect("admin/users");
        }
        $methods = Withdrawal_Methods::all();
        return view('admin.withdrawal.w-method',
        [
        'methods'=>$methods,"priviledge" => $priviledge,
        'page_title'=>"Withdrawal Methods"
    ]);
    }


    public function store(Request $req){

       $method=new Withdrawal_Methods;
       if( $req->file('image')!=null){
         $imageName=time().'.'.$req->image->extension();
         $path= $req->image->move(public_path('uploads'), $imageName);
         $method->image=$imageName;
       }
       $method->name=$req['name'];
       $method->min_amt=$req['min_amt'];
       $method->max_amt=$req['max_amt'];
       $method->charges=$req['charges'];
       $method->currency_code=$req['currency_code'];
       $method->active=true;
       $method->save();
       $req->session()->flash('success','Withdrawal method added successfully');
        return  redirect('admin/withdrawal-method');
    }

    public function update(Request $req, $id){

        $method=Withdrawal_Methods::findOrFail($id);
        $method->name=$req['name'];
        $method->min_amt=$req['min_amt'];
        $method->max_amt=$req['max_amt'];
        $method->charges=$req['charges'];
        $method->active=$req['active'];
        $method->currency_code=$req['currency_code'];
        $method->update();
        $req->session()->flash('success','Withdrawal method updated successfully');
         return  redirect('admin/withdrawal-method');

     }

    public function destroy(Request $request,$id)
    {
        Withdrawal_Methods::destroy($id);
        $request->session()->flash('success','You have deleted a method');
        return  redirect('admin/withdrawal-method');
    }


}
