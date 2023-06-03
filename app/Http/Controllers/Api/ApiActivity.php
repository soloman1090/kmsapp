<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppPaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\Activities;

class ApiActivity extends Controller
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
            $user=User::where('users.id', $id )->join('user_infos','users.id',"=", 'user_infos.user_id')->first();

            $activities =User::where('users.id', $id )
                ->join('activities', 'users.id', "=", 'activities.user_id')
                ->where('activities.user_id', $id)
                ->orderBy('activities.id', 'DESC')
                ->get();



                $usersActivities=[];


                for ($i=0; $i < count($activities); $i++) {

                    $usersInvestments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                ->where('user_investments.id', $activities[$i]->user_investments_id)
                ->get([ 'user_investments.id as investment_id',
                    'user_investments.amount', 'user_investments.returns', 'user_investments.duration', 'user_investments.payout', 'user_investments.active']);

                    $data= ['title'=>$activities[$i]->title ,'user_id'=>$activities[$i]->user_id,'user_investments_id'=>$activities[$i]->user_investments_id,'investment_packages_id'=>$activities[$i]->investment_packages_id,'category'=>$activities[$i]->category,'descp'=>$activities[$i]->descp, 'amount'=>$activities[$i]->amount,'date'=>$activities[$i]->date, "investment"=>$usersInvestments ];

                    array_push($usersActivities, (object)$data);
                }

                $AppPaginator=new AppPaginator;
                $myCollectionObj1 = collect($usersActivities);
                        $usersActivities = $AppPaginator->paginate($myCollectionObj1,"api/activities?user_id=$id");
            return ['user'=>$user, 'activities'=>$usersActivities,];
        } else {
            return ['error' =>true, "msg"=> "user not found","type" => "INVALID_CREDENTIAL"];
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
    public function destroy($id)
    {
        //
    }
}
