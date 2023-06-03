<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentsController extends Controller
{
    public function index(){
        $payments = [
            ['id'=>1,'user_name'=>"Thomas Zinsmeister H",  'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'12000','status'=>false, ],
            ['id'=>2, 'user_name'=>"Ridwahn . du Plessis", 'method'=>'Litecoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'1000','status'=>true,],
            ['id'=>3, 'user_name'=>"Nuno Miguel Marques Baptista", 'method'=>'Ethereum','order_id'=>'jade-5cc75ce5ade20','amount'=>'2340','status'=>true,],
            ['id'=>4, 'user_name'=>"Nancy X Botha", 'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade77','amount'=>'1233','status'=>true,],
            ['id'=>5,'user_name'=>"Nancy X Botha",  'method'=>'Litecoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'4534','status'=>false,],
            ['id'=>6, 'user_name'=>"Marthinus Frederik Hitge", 'method'=>'Litecoin','order_id'=>'jade-5cc75ceade456','amount'=>'5674','status'=>false,],
            ['id'=>7,'user_name'=>"Jacques Goosen Goosen",  'method'=>'Ethereum','order_id'=>'jade-5cc75ctre66443','amount'=>'3243','status'=>true,],
            ['id'=>8,'user_name'=>"Gerhard Heinz Kobus",  'method'=>'Litecoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'56344','status'=>false,],
            ['id'=>9,'user_name'=>"Adrian Robert Lees",  'method'=>'Bitcoin','order_id'=>'jade-5cc754vertde20','amount'=>'346457','status'=>true,],
            ['id'=>10,'user_name'=>"Nancy X Botha",  'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'2321','status'=>false,],
            ['id'=>11,'user_name'=>"Thomas Zinsmeister H",  'method'=>'Ethereum','order_id'=>'jade-5cc75ce5ade342','amount'=>'56344','status'=>true,],
            ['id'=>12,'user_name'=>"Gerhard Heinz Kobu",  'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'346457','status'=>true,],
            ['id'=>13,'user_name'=>"Jacques Goosen Goosen",  'method'=>'Ethereum','order_id'=>'jade-5cc75ce5ade20','amount'=>'2321','status'=>false,]
        ];
        return view('admin.payments.all-payments',
        [
        'payments'=>$payments,
        'page_title'=>"All Payments"
    ]);
    }


    public function paginate($items, $perPage = 10, $page = null )
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => url('admin/users')]);
    }
}
