<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bond_Packages;
use App\Models\UserInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BondPackagesController extends Controller
{
    public function index(){
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        $packages = Bond_Packages::all();
        return view('admin.bonds.bond-packages',
        ['packages'=>$packages, "priviledge" => $priviledge,
        'page_title'=>"Bonds Packages"]);
    }


    public function store(Request $req){

        $bond=new Bond_Packages;

        $bond->name=$req['name'];
        $bond->min_amt=$req['min_amt'];
        $bond->max_amt=$req['max_amt'];
        $bond->min_percent=$req['min_percent'];
        $bond->max_percent=$req['max_percent'];
        $bond->compound_duration=$req['compound_duration'];
        $bond->compound_percent=$req['compound_percent'];
        $bond->duration=$req['duration'];
        $bond->info_head_1=$req['info_head_1'];
        $bond->info_detail_1=$req['info_detail_1'];
        $bond->info_head_2=$req['info_head_2'];
        $bond->info_detail_2=$req['info_detail_2'];
        $bond->info_head_3=$req['info_head_3'];
        $bond->info_detail_3=$req['info_detail_3'];
        $bond->info_head_4=$req['info_head_4'];
        $bond->info_detail_4=$req['info_detail_4'];
        $bond->info_head_5=$req['info_head_5'];
        $bond->info_detail_5=$req['info_detail_5'];


        $bond->save();
        $req->session()->flash('success','Package added successfully');
        return  redirect('admin/bond-packages');

     }

     public function update(Request $req, $id){
        $bond=Bond_Packages::findOrFail($id);
        if(!$bond){
            $req->session()->flash('error','Could not find package');
            return  redirect('admin/bond-packages');
        }

        $bond->name=$req['name'];
        $bond->min_amt=$req['min_amt'];
        $bond->max_amt=$req['max_amt'];
        $bond->min_percent=$req['min_percent'];
        $bond->max_percent=$req['max_percent'];
        $bond->compound_duration=$req['compound_duration'];
        $bond->compound_percent=$req['compound_percent'];
        $bond->duration=$req['duration'];
        $bond->info_head_1=$req['info_head_1'];
        $bond->info_detail_1=$req['info_detail_1'];
        $bond->info_head_2=$req['info_head_2'];
        $bond->info_detail_2=$req['info_detail_2'];
        $bond->info_head_3=$req['info_head_3'];
        $bond->info_detail_3=$req['info_detail_3'];
        $bond->info_head_4=$req['info_head_4'];
        $bond->info_detail_4=$req['info_detail_4'];
        $bond->info_head_5=$req['info_head_5'];
        $bond->info_detail_5=$req['info_detail_5'];
        $bond->update();
       $req->session()->flash('success','Package Updated successfully');
       return   redirect('admin/bond-packages');
    }

    public function destroy(Request $request,$id)
    {
        Bond_Packages::destroy($id);
        $request->session()->flash('success','You have deleted a package');
        return   redirect('admin/bond-packages');
    }

}
