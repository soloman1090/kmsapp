<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppPaginator;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $priviledge = "admin";
        $user = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($user->last_name == "subadmin") {
            return redirect("admin/users");
        }

        $activities = null;
        $pageName = "System Activites";
        $singleActivities = "false";
        $userInvestments = [];
        $user_id = 0;

        function getReferredUser($id)
        {
            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $id)
                ->get()->first();
            if ($user != null) {
                return "$user->name $user->last_name ($user->email)";
            }
            return "";

        }

        $AppPaginator = new AppPaginator;
        if ($request['user_id'] == null) {
            $activities = null;
            if ($request->search) {
                $activities = Activities::where('category', 'LIKE', "%{$request->search}%")->orWhere('title', 'LIKE', "%{$request->search}%")->orWhere('date', 'LIKE', "%{$request->search}%")->orderBy('activities.id', 'DESC')->get();
            } else {
                $activities = Activities::orderBy('activities.id', 'DESC')->get();
            }

            $myCollectionObj1 = collect($activities);
            $activities = $AppPaginator->paginate($myCollectionObj1, 'admin/activities');
            foreach ($activities as $key => $activity) {
                $activity->name = getReferredUser($activity->user_id);
            }
        } else {
            $singleActivities = "true";
            $userInvestments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                ->where('users.id', $request['user_id'])
                ->orderBy('user_investments.id', 'DESC')
                ->get(['user_investments.id', 'users.name as username', 'users.email', 'users.id as user_id', 'investment_packages.name as packagename',
                    'user_investments.investment_packages_id', 'investment_packages.id as package_id',
                    'user_investments.amount', 'user_investments.returns', 'user_investments.duration', 'user_investments.txn_id', 'user_investments.payout']);
            if (count($userInvestments) < 1) {
                $singleActivities = "false";
                $activities = Activities::orderBy('activities.id', 'DESC')->get();
                foreach ($activities as $key => $activity) {
                    $activity->name = getReferredUser($activity->user_id);
                }
                $myCollectionObj2 = collect($activities);
                $activities = $AppPaginator->paginate($myCollectionObj2, 'admin/activities');

            } else {
                $user_id = $request['user_id'];

                $activities = DB::table('users')
                    ->join('activities', 'users.id', "=", 'activities.user_id')
                    ->where('activities.user_id', $request['user_id'])
                    ->orderBy('activities.id', 'DESC')
                    ->get();

                $myCollectionObj2 = collect($activities);
                $activities = $AppPaginator->paginate($myCollectionObj2, 'admin/activities');

                $userName = getReferredUser($request['user_id']);
                $pageName = "$userName Activites";
            }
        }

        return view('admin.activities', ['activities' => $activities, "priviledge" => $priviledge, 'page_title' => $pageName, 'single' => $singleActivities, 'userInvestments' => $userInvestments, 'user_id' => $user_id]
        );
    }

    public function store(Request $request)
    {
        $startDate = new \DateTime($request['start_date']);
        $endDate = new \DateTime($request['end_date']);

        function generateActivity($request,$multiDate)
        {
            $userInfo = UserInfo::where('user_id', $request['user_id'])->firstOrFail();
            $user = User::where('id', $request['user_id'])->firstOrFail();
            $activity = new Activities;
            $activity->title = $request['title'];
            $activity->user_id = $request['user_id'];

            if ($request['user_investments_id'] != null) {
                $activity->user_investments_id = $request['user_investments_id'];
                $userInvestments = UsersInvestments::findOrFail($request['user_investments_id']);
                $activity->investment_packages_id = $userInvestments->investment_packages_id;
            }
            $activity->category = $request['category'];
            if($request['send_type'] == "multiple"){
                $activity->date = $multiDate;
            }else{
                $activity->date = Carbon::parse($request['start_date'])->toDayDateTimeString();
            }

            if ($request['category'] == "bonus") {
                $bonusAmount = $request['amount'] * 0.10;
                $activity->amount = $bonusAmount;
                $activity->descp = "Credited  10% - $$bonusAmount as referral bonus ";
                $userInfo->main_wallet = $userInfo->main_wallet +  $bonusAmount;
            } else {
                $userInfo->main_wallet = $userInfo->main_wallet + $request['amount'];
                $activity->amount = $request['amount'];
                $activity->descp = $request['descp'];
            }
            $userInfo->update();
            //dd( $activity);
            $activity->save();

            if ($request['category'] == "bonus") {
                $referredUser = $userInfo;
                $amount = $request['amount'];

                if ($referredUser->referred_by != null) {

                    $referredUser_stage2 = DB::table('users')
                        ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                        ->where('users.id', $referredUser->referred_by)
                        ->get()->first();

                    if ($referredUser_stage2 != null) {
                        $bonusAmount_stage2 = $amount * 0.05;

                        //Get Wallet Balance
                        $currentAmount = 0;
                        if ($referredUser_stage2->main_wallet == null) {
                            $currentAmount = 0;
                        } else {
                            $currentAmount = $referredUser_stage2->main_wallet;
                        }
                        $newAmount = $currentAmount + $bonusAmount_stage2;
                        //Save Wallet
                        $userInfo_stage2 = UserInfo::where('user_id', $referredUser_stage2->user_id)->firstOrFail();
                        $userInfo_stage2->main_wallet = $newAmount;
                        $userInfo_stage2->update();
                        $secPecentage = ($bonusAmount_stage2 / $amount) * 100;
                        //Save Activity
                        $activity = new Activities;
                        $activity->title = "Referral Bonus";
                        $activity->user_id = $referredUser_stage2->user_id;
                        $activity->category = "bonus";
                        $activity->date = Carbon::parse($request['start_date'])->toDayDateTimeString();
                        $activity->amount = $bonusAmount_stage2;
                        $activity->descp = "Credited  $secPecentage% - $$bonusAmount_stage2 as referral bonus ";
                        $activity->save();
                        // $referredUser_stage2->email

                        try {
                            // Mail::to($referredUser_stage2->email)->send(new UserRegisteredMail([
                            //     'subject' => 'Members Benefit Commissions',
                            //     'title' => "Hi $referredUser_stage2->name $referredUser_stage2->last_name ",
                            //     'url' => "https://palmalliance.com/user/referred-users",
                            //     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
                            //     'action-text' => 'Client Access',
                            //     'img' => 'assets/images/emails/first-referal-banner.jpg',
                            // ]));
                        } catch (\Exception$e) {

                        }

                        //=======================================================================================================================================
                        //Check For Stage 3 user
                        //=======================================================================================================================================
                        $referredUser_stage3 = null;
                        if ($referredUser_stage2->referred_by != null) {
                            $referredUser_stage3 = DB::table('users')
                                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                                ->where('users.id', $referredUser_stage2->referred_by)
                                ->get()->first();

                            if ($referredUser_stage3 != null) {
                                $bonusAmount_stage3 = $amount * 0.025;

                                //Get Wallet Balance
                                $currentAmount_3 = 0;
                                if ($referredUser_stage3->main_wallet == null) {
                                    $currentAmount_3 = 0;
                                } else {
                                    $currentAmount_3 = $referredUser_stage3->main_wallet;
                                }
                                $newAmount = $currentAmount_3 + $bonusAmount_stage3;
                                //Save Wallet
                                $userInfo_stage3 = UserInfo::where('user_id', $referredUser_stage3->user_id)->firstOrFail();
                                $userInfo_stage3->main_wallet = $newAmount;
                                $userInfo_stage3->update();
                                $thirdPecentage = ($bonusAmount_stage3 / $amount) * 100;
                                //Save Activity
                                $activity = new Activities;
                                $activity->title = "Referral Bonus";
                                $activity->user_id = $referredUser_stage3->user_id;
                                $activity->category = "bonus";
                                $activity->date = Carbon::parse($request['start_date'])->toDayDateTimeString();
                                $activity->amount = $bonusAmount_stage3;
                                $activity->descp = "Credited $thirdPecentage% - $$bonusAmount_stage3 as referral bonus ";
                                $activity->save();
                                // $referredUser_stage2->email

                                try {
                                    // Mail::to($referredUser_stage3->email)->send(new UserRegisteredMail([
                                    //     'subject' => 'Members Benefit Commissions',
                                    //     'title' => "Hi $referredUser_stage3->name $referredUser_stage3->last_name ",
                                    //     'url' => "https://palmalliance.com/user/referred-users",
                                    //     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
                                    //     'action-text' => 'Client Access',
                                    //     'img' => 'assets/images/emails/first-referal-banner.jpg',
                                    // ]));
                                } catch (\Exception$e) {

                                }
                            }
                        }
                    }
                }
            }
        }

        if ($request['send_type'] == "multiple") {
            for ($date = $startDate; $date <= $endDate; $date->modify('+1 day')) {
                //$date->format('Y M d, h:m:s')

                $day = date("D", strtotime(Carbon::parse($date)->toDayDateTimeString()));
                if ($day == "Sat" || $day == "Sun") {

                } else {
                    //Save Activity
                    generateActivity($request,Carbon::parse($date)->toDayDateTimeString());
                }
            }
        } else {
            generateActivity($request);
        }

        return redirect("admin/activities?user_id={$request['user_id']}");
    }

    public function destroy(Request $request, $id)
    {

        $activity = Activities::findOrFail($id);
        $userInfo = UserInfo::where('user_id', $activity->user_id)->firstOrFail();
        if ($activity->category == "earning" || $activity->category == "bonus") {
            $userInfo->main_wallet = $userInfo->main_wallet - $activity->amount;
            $userInfo->update();
        }

        Activities::destroy($id);
        $request->session()->flash('success', 'User activity deleted!');

        return redirect("admin/activities?user_id={$request->user_id}");
    }
}
