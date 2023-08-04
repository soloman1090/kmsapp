<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment_Packages;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class InvestPackagesController extends Controller
{
    public function index()
    {
        $priviledge = "admin";
        $user = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($user->last_name == "subadmin") {
            return redirect("admin/users");
        }
        $user = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($user->last_name == "subadmin") {
            return redirect("admin/users");
        }
        $packages = Investment_Packages::all();

        return view(
            'admin.invest.invest-packages',
            [
                'packages' => $packages, "priviledge" => $priviledge,
                'page_title' => "Investment Packages"
            ]
        );
    }

    public function store(Request $req)
    {
        //dd($req);
        $invest = null;
        if ($req['update'] == "true") {
            $invest = Investment_Packages::findOrFail($req['package_id']);
        } else {
            $invest = new Investment_Packages;
        }
        if ($req->file('image') != null) {
            $imageName = time() . '.' . $req->image->extension();
            $path = $req->image->move(public_path('uploads'), $imageName);
            $invest->image = $imageName;
        }
        $invest->name = $req['name'];
        $invest->min_amt = $req['min_amt'];
        $invest->max_amt = $req['max_amt'];
        $invest->min_percent = $req['min_percent'];
        $invest->max_percent = $req['max_percent'];
        $invest->compound_duration = $req['compound_duration'];
        $invest->compound_percent = $req['compound_percent'];
        $invest->duration = $req['duration'];
        $invest->info_head_1 = $req['info_head_1'];
        $invest->info_detail_1 = $req['info_detail_1'];
        $invest->info_head_2 = $req['info_head_2'];
        $invest->info_detail_2 = $req['info_detail_2'];
        $invest->info_head_3 = $req['info_head_3'];
        $invest->info_detail_3 = $req['info_detail_3'];
        $invest->info_head_4 = $req['info_head_4'];
        $invest->info_detail_4 = $req['info_detail_4'];
        $invest->info_head_5 = $req['info_head_5'];
        $invest->info_detail_5 = $req['info_detail_5'];
        $invest->category_name = $req['category_name'];
        $invest->package_type = $req['package_type'];
        $invest->active_status = $req['active_status'];
        $invest->start_date = $req['start_date'];
        $invest->expire_date = $req['expire_date'];
        $invest->level1_bonus = $req['level1_bonus'];
        $invest->level2_bonus = $req['level2_bonus'];
        $invest->level3_bonus = $req['level3_bonus'];
        $invest->slots = $req['slots'];
        $invest->bonus_percentage = $req['bonus_percentage'];
        $invest->running_days = $req['running_days'];

        if ($req['update'] == "true") {
            $invest->update();
            $req->session()->flash('success', 'Package Updated successfully');
        } else {
            $invest->save();
            $req->session()->flash('success', 'Package added successfully');
        }
        return redirect('admin/investment-packages');
    }

    public function edit(Request $request, $id)
    {
        $priviledge = "admin";
        $package = Investment_Packages::findOrFail($id);

        // dd($package);

        return view(
            'admin.invest.update-package',
            [
                'pac' => $package,
                "priviledge" => $priviledge,
                'page_title' => "Update Packages"
            ]
        );
    }


    public function destroy(Request $request, $id)
    {
        Investment_Packages::destroy($id);
        $request->session()->flash('success', 'You have deleted a package');
        return redirect('admin/investment-packages');
    }
}
