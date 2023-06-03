<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppPaginator;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\Reinvest;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class ReinvestmentController extends Controller
{
    public function index(Request $request)
    {
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }

        $AppPaginator = new AppPaginator;
        $users;
        $reinvestments;

        if ($request['user_id'] == null) {
            $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();
            $reinvestments = Reinvest::orderBy('reinvest.id', 'DESC')->get();
        } else {
            $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();
            $reinvestments = Reinvest::orderBy('reinvest.id', 'DESC')->where('reinvest.user_id', $request['user_id'])->get();
        }

        $myCollectionObj1 = collect($reinvestments);
        $reinvestments = $AppPaginator->paginate($myCollectionObj1, 'admin/reinvestments');

        foreach ($reinvestments as $key => $invest) {
            $hasError = false;
            try {
                $userInvest = UsersInvestments::findOrFail($invest->user_investments_id);

            } catch (\Exception$e) {
                $hasError = true;
            }
            if ($hasError == false) {
                $packageData = Investment_Packages::findOrFail($userInvest->investment_packages_id);
                $user = DB::table('users')
                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                    ->where('users.id', $userInvest->user_id)
                    ->get()->first();

                if ($user != null) {
                    $invest->username = "{$user->name}";
                    $invest->email = $user->email;
                }

                $invest->packagename = $packageData->name;
                $invest->date = $userInvest->date;

            }

            //dd($invest);
        }

        return view('admin.invest.reinvest',
            ['investments' => $reinvestments, "priviledge" => $priviledge,
                'page_title' => "All Reinvestments "]);

    }

    public function update(Request $req, $id)
    {

        $singleReinvest = Reinvest::findOrFail($id);
        $thisInvestment = UsersInvestments::findOrFail($singleReinvest->user_investments_id);
        $package = Investment_Packages::findOrFail($thisInvestment->investment_packages_id);
        $packagename = $package->name;

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $singleReinvest->user_id)
            ->get()->first();

        // if($req->has('activate')){
        //     echo "Activate";
        // }else{
        //     if ($singleReinvest->txn_id != null && $singleReinvest->txn_id != "old" && $singleReinvest->txn_id != "coin-sub") {
        //         $secretKey = env('PLISIO_SECRET_KEY');
        //         try {
        //             $client = new Client(['verify' => false]);
        //             $request = $client->get("https://plisio.net/api/v1/operations/$singleReinvest->txn_id?api_key=$secretKey");
        //             $response = json_decode($request->getBody());
        //             if ($response->status == "success") {
        //                 $transact = $response->data;
    
        //                 if ($transact->status == "completed" || $transact->status == "mismatch") {
    
        //                 } else {
        //                     $req->session()->flash('error', "Reinvestment is $transact->status");
        //                     return redirect("admin/reinvestments");
        //                 }
        //             }
        //         } catch (\Exception$e) {
    
        //         }
        //     }
        // }

        $thisInvestment->amount = $singleReinvest->amount;
        $thisInvestment->returns = $singleReinvest->returns;
        $thisInvestment->status = "completed";
        $singleReinvest->status = "completed";

        //Save Activity
        $activity = new Activities;
        $activity->title = "Reinvestment Successful";
        $activity->user_id = $singleReinvest->user_id;
        $activity->user_investments_id = $singleReinvest->user_investments_id;
        $activity->investment_packages_id = $thisInvestment->investment_packages_id;
        $activity->category = "deposit";
        $activity->date = Carbon::now()->toDayDateTimeString();
        $activity->amount = $singleReinvest->topup_amount;
        $activity->descp = "Reinvestment of $$singleReinvest->topup_amount on $packagename is successful";
        $activity->save();
        $thisInvestment->update();
        $singleReinvest->update();

        //$user->email
        try {
            Mail::to($user->email)->send(new UserRegisteredMail([
                'subject' => 'Reinvestment Successful',
                'title' => "Congratulations {$user->name} {$user->last_name}",
                'url' => "{$req->getSchemeAndHttpHost()}/user/user-investments",
                'descp' => "We are delighted to inform you that your reinvestment into  $packagename portfolio
                    has been received successfully.",
                'action-text' => 'Client Access',
                'img' => 'assets/images/emails/investment-banner.jpg',
            ]));

            // Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
            //     'subject' => 'Portfolio Payment',
            //     'title' => "Hi Admin",
            //     'url' => "{$req->getSchemeAndHttpHost()}/admin/users-investments",
            //     'descp' => "A user just successfully reinvested in $packagename on Palmalliance.
            //              These are the user details.... NAME: $user->name $user->last_name, EMAIL: $user->email, PHONE: $user->phone, AMOUNT: $$singleReinvest->topup_amount .....
            //              Please Login to view investments",
            //     'action-text' => 'Vew Investments',
            //     'img' => 'assets/images/emails/Palm-Alliance-Management-Building.jpg',
            // ]));
        } catch (\Exception$e) {

        }
        $reinvestAmount = $singleReinvest->topup_amount;
        //Check Referal
        if ($user->referred_by != null && $user->referred_by != "") {

            //Save Activity
            $referredUser = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $user->referred_by)
                ->get()->first();
            //dd($referredUser);

            //==========================================================================================================================
            //Check For Stage 1 user
            //==========================================================================================================================
            if ($referredUser != null) {

                $bonusAmount = $reinvestAmount * $package->level1_bonus;
                //Get Wallet Balance
                $currentAmount = 0;
                if ($referredUser->main_wallet == null) {
                    $currentAmount = 0;
                } else {
                    $currentAmount = $referredUser->main_wallet;
                }

                //Save Wallet
                $userInfo = UserInfo::where('user_id', $user->referred_by)->firstOrFail();
                $userInfo->main_wallet = $currentAmount + $bonusAmount;
                $userInfo->update();

                //Save Activity
                $activity = new Activities;
                $activity->title = "Referral Bonus";
                $activity->user_id = $referredUser->user_id;
                $activity->category = "bonus";
                $activity->date = Carbon::now()->toDayDateTimeString();
                $activity->amount = $bonusAmount;
                $activity->descp = "Credited 10% - $$bonusAmount as referral bonus";
                $activity->save();
                // $referredUser->email

                try {
                    Mail::to($referredUser->email)->send(new UserRegisteredMail([
                        'subject' => 'Members Benefit Commissions',
                        'title' => "Hi $referredUser->name $referredUser->last_name ",
                        'url' => "{$req->getSchemeAndHttpHost()}/user/referred-users",
                        'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
                        'action-text' => 'Client Access',
                        'img' => 'assets/images/emails/first-referal-banner.jpg',
                    ]));
                } catch (\Exception$e) {

                }
                // dd($referredUser);

                //=======================================================================================================================================
                //Check For Stage 2 user
                //=======================================================================================================================================
                $referredUser_stage2 = null;
                if ($referredUser->referred_by != null) {

                    $referredUser_stage2 = DB::table('users')
                        ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                        ->where('users.id', $referredUser->referred_by)
                        ->get()->first();
                    if ($referredUser_stage2 != null) {
                        $bonusAmount_stage2 = $reinvestAmount * $package->level2_bonus;

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

                        //Save Activity
                        $activity = new Activities;
                        $activity->title = "Referral Bonus";
                        $activity->user_id = $referredUser_stage2->user_id;
                        $activity->category = "bonus";
                        $activity->date = Carbon::now()->toDayDateTimeString();
                        $activity->amount = $bonusAmount_stage2;
                        $activity->descp = "Credited 5% - $$bonusAmount_stage2 as referral bonus";
                        $activity->save();
                        // $referredUser_stage2->email

                        try {
                            // Mail::to($referredUser_stage2->email)->send(new UserRegisteredMail([
                            //     'subject' => 'Members Benefit Commissions',
                            //     'title' => "Hi $referredUser_stage2->name $referredUser_stage2->last_name ",
                            //     'url' => "{$req->getSchemeAndHttpHost()}/user/referred-users",
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
                                $bonusAmount_stage3 = $reinvestAmount * $package->level3_bonus;

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

                                //Save Activity
                                $activity = new Activities;
                                $activity->title = "Referral Bonus";
                                $activity->user_id = $referredUser_stage3->user_id;
                                $activity->category = "bonus";
                                $activity->date = Carbon::now()->toDayDateTimeString();
                                $activity->amount = $bonusAmount_stage3;
                                $activity->descp = "Credited 2.5% - $$bonusAmount_stage3 as referral bonus";
                                $activity->save();
                                // $referredUser_stage2->email

                                try {
                                    // Mail::to($referredUser_stage3->email)->send(new UserRegisteredMail([
                                    //     'subject' => 'Members Benefit Commissions',
                                    //     'title' => "Hi $referredUser_stage3->name $referredUser_stage3->last_name ",
                                    //     'url' => "{$req->getSchemeAndHttpHost()}/user/referred-users",
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

        $req->session()->flash('success', "Reinvestment of $$singleReinvest->topup_amount on $packagename for {$user->name} {$user->last_name} is successful");
        return redirect("admin/reinvestments?user_id=$id");

    }

    public function destroy(Request $request, $id)
    {
        Reinvest::destroy($id);
        $request->session()->flash('success', 'Reinvestment deleted!');
        return redirect('admin/reinvestments');
    }

}
