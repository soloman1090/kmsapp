<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\AppPaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UserInfo;
use App\Models\Voyager;

class VoyagerController extends Controller
{
    public function index(){
        $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        $AppPaginator=new AppPaginator;

        $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();

        $voyagers = Voyager::join('users', 'users.id', '=', 'voyager.user_id')
        ->orderBy('voyager.id','DESC')
        ->get(['users.id as user_id','users.name as username','users.email', 'voyager.status','voyager.date',
            'voyager.activation_key','voyager.amount','voyager.id as voyager_id','voyager.total_amount', ]);
       

        $myCollectionObj1 = collect($voyagers);
            $voyagers = $AppPaginator->paginate($myCollectionObj1,'admin/voyagers');

        return view('admin.voyager',
        [
        'voyagers'=>$voyagers,
        'users'=>$users,"priviledge" => $priviledge,
        'page_title'=>"Voyagers"
    ]);
    }





}
