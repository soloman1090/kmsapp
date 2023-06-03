<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment_Method;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentsMethodController extends Controller
{
    public function index(){
        $payment_method= Payment_Method::all();

        return view('admin.payments.payment-methods',
        [
        'methods'=>$payment_method,
        'page_title'=>"Payments Methods"
    ]);
    }


    public function store(Request $req){
        $path="";
        $imageName=time().'.'.$req->image->extension();
      if( $req->file('image')!=null){
        $path= $req->image->move(public_path('uploads'), $imageName);
      }
       $newMethod= $req->only(['name','address','image',]);
       $newMethod['image'] = $imageName;

       $payment_method=new Payment_Method;
       $payment_method->name=$newMethod['name'];
       $payment_method->address=$newMethod['address'];
       $payment_method->image=$newMethod['image'];
       $payment_method->active=false;
       $payment_method->save();
       $req->session()->flash('success','Payment method added successfully');
        return  redirect('admin/payment-methods');

    }

    public function update(Request $req, $id)
    {
        $payment_method=Payment_Method::findOrFail($id);
        if(!$payment_method){
            $req->session()->flash('error','Could not find method');
            return  redirect('admin/payment-methods');
        }
        //dd($req->active);

        if($req->active=="1"){
            $payment_method->active=false;
        }else if($req->active=="0"){
            $payment_method->active=true;
        }


        if( $req->file('image')!=null){
            $imageName=time().'.'.$req->image->extension();
            $path= $req->image->move(public_path('uploads'), $imageName);
            $payment_method->image=$imageName;
        }
        $payment_method->name=$req->name;
        $payment_method->address=$req->address;
       $payment_method->update();
        $req->session()->flash('success','Update successful');
        return  redirect('admin/payment-methods');
    }





    public function destroy(Request $request,$id)
    {
        Payment_Method::destroy($id);
        $request->session()->flash('success','You have deleted a method');
        return  redirect('admin/payment-methods');
    }
}
