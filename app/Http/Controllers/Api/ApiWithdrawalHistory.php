<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WithdrawalRequests;
use App\Models\Withdrawal_Methods;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppPaginator;

class ApiWithdrawalHistory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->has('user_id')) {
            $id = $request->input("user_id");

            $user = User::where('users.id', $id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();

            $requests = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
                            ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
                            ->where('users.id',$id)
                            ->orderBy('withdrawal_requests.id','DESC')
                            ->get(['users.name as username','users.email', 'withdrawal_methods.name as methodname','withdrawal_requests.id as request_id','withdrawal_requests.amount_paid',
                                'withdrawal_requests.amount_credited','withdrawal_requests.charge','withdrawal_requests.created_at as date',
                                 'withdrawal_requests.wallet_address', 'withdrawal_requests.wallet_type', 'withdrawal_requests.approved', ]);
            return ['user'=>$user,  'requests'=>$requests,];
        } else {
            return ['error' =>true, "msg"=> "An error occured","type" => "INVALID_CREDENTIAL"];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        return ['error' =>true, "msg"=> "Sorry you no longer have the right to delete a withdrawal","type" => "INVALID_CREDENTIAL"];
        // WithdrawalRequests::destroy($id);
        // return ["success" => true ,"msg"=> 'Withdrawal request deleted!'];
    }
}
