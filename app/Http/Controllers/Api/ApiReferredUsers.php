<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppPaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiReferredUsers extends Controller
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
            $AppPaginator=new AppPaginator;
            $id = $request->input("user_id");
            $user = User::where('users.id', $id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();

            $referrals = DB::table('users')->join('referrals', 'users.id', "=", 'referrals.user_id')->where('users.id', $id)->orderBy('referrals.id', 'DESC')->get();
           

            $sortedReferrals = [];

            foreach ($referrals as $key => $ref_user) {
                $aUser = DB::table('users')
                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                    ->where('users.id', $ref_user->referred_user_id)
                    ->get()->first();

                if ($aUser != null) {
                    $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                        ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                        ->where('users.id', $ref_user->referred_user_id)->get(['user_investments.amount', 'user_investments.status', 'users.email']);

                    if (count($investments) > 0) {
                        foreach ($investments as $key => $vest) {
                            if ($vest->status == "completed" || $vest->status == "finished") {

                                $aUser->invested = true;
                            } else {
                                $aUser->invested = false;
                            }
                        }

                    } else {
                        $aUser->invested = false;
                    }

                    array_push($sortedReferrals, (object) $aUser);

                }

            }

            foreach ($sortedReferrals as $key => $thisUser) {

                $aUserStage1Rfs = DB::table('users')->join('referrals', 'users.id', "=", 'referrals.user_id')->where('users.id', $thisUser->user_id)->orderBy('referrals.id', 'DESC')->get();
                $stage1Users = [];
                if (count($aUserStage1Rfs) > 0) {

                    foreach ($aUserStage1Rfs as $key => $stage1Rfs) {
                        $secondUser = DB::table('users')
                            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                            ->where('users.id', $stage1Rfs->referred_user_id)
                            ->get()->first();
                        if($secondUser){
                            array_push($stage1Users, (object) $secondUser);
                        }
                    }
                }
                $thisUser->stage1Users = $stage1Users;

            }
            $myCollectionObj1 = collect($sortedReferrals);
            $sortedReferrals = $AppPaginator->paginate($myCollectionObj1,"api/partners?user_id=$id");
            return  ['user' => $user, 'referrals' => $sortedReferrals,  'referral_code' => $user->referalcode];
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
