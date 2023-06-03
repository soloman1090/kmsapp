<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserBondController extends Controller
{
    public function index(){
        $bonds = [
            ['id'=>1, 'name'=>'Francois Dominikus Thero','package'=>"Private Bonds",'date'=>"02 September 2021 , 07 : 57am", 'amount'=>720,'duration'=>12,'roi'=>2.88,'payout'=>"Daily Payout",'status'=>true, ],
            ['id'=>2, 'name'=>'Ronan Martin Mannion	','package'=>"Private Bonds",'date'=>"02 September 2021 , 07 : 57am", 'amount'=>720,'duration'=>12,'roi'=>2.88,'payout'=>"Daily Payout",'status'=>true,],
            ['id'=>3, 'name'=>'Andrea Andrea Mielke','package'=>"Private Bonds",'date'=>"02 September 2021 , 07 : 57am", 'amount'=>720,'duration'=>12,'roi'=>2.88,'payout'=>"Daily Payout",'status'=>true,],
            ['id'=>4, 'name'=>'	Vitrice Martial Douanla M.','package'=>"Private Bonds",'date'=>"02 September 2021 , 07 : 57am", 'amount'=>720,'duration'=>12,'roi'=>2.88,'payout'=>"Daily Payout",'status'=>true,],
        ];
        return view('admin.bonds.user-bond',
        [
        'bonds'=>$bonds,
        'page_title'=>"Bonds History"
    ]);
    }

}
