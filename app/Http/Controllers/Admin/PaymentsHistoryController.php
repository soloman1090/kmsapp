<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentsHistoryController extends Controller
{
    public function index(){
        $payments = [
            ['id'=>1, 'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'12000','status'=>false,],
            ['id'=>2, 'method'=>'Litecoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'1000','status'=>true,],
            ['id'=>3, 'method'=>'Ethereum','order_id'=>'jade-5cc75ce5ade20','amount'=>'2340','status'=>true,],
            ['id'=>4, 'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade77','amount'=>'1233','status'=>true,],
            ['id'=>5, 'method'=>'Litecoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'4534','status'=>false,],
            ['id'=>6, 'method'=>'Litecoin','order_id'=>'jade-5cc75ceade456','amount'=>'5674','status'=>false,],
            ['id'=>7, 'method'=>'Ethereum','order_id'=>'jade-5cc75ctre66443','amount'=>'3243','status'=>true,],
            ['id'=>8, 'method'=>'Litecoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'56344','status'=>false,],
            ['id'=>9, 'method'=>'Bitcoin','order_id'=>'jade-5cc754vertde20','amount'=>'346457','status'=>true,],
            ['id'=>10, 'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'2321','status'=>false,],
            ['id'=>11, 'method'=>'Ethereum','order_id'=>'jade-5cc75ce5ade342','amount'=>'56344','status'=>true,],
            ['id'=>12, 'method'=>'Bitcoin','order_id'=>'jade-5cc75ce5ade20','amount'=>'346457','status'=>true,],
            ['id'=>13, 'method'=>'Ethereum','order_id'=>'jade-5cc75ce5ade20','amount'=>'2321','status'=>false,]
        ];
        return view('admin.payments.payment-history',
        [
        'payments'=>$payments,
        'page_title'=>"Payments History"
    ]);
    }



}
