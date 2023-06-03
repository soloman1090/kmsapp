<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppPaginator;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class UserInvestmentsController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();
        $packages = Investment_Packages::all();
        function getReferredUser($id)
        {
            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $id)
                ->get()->first();
            if ($user != null) {
                return "$user->name $user->last_name";
            }
            return "";
        }

        $investments = null;
        $pageName = "Investment History";
        $AppPaginator = new AppPaginator;
        if ($request['user_id'] == null) {
            $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                ->orderBy('user_investments.id', 'DESC')
                ->get(['user_investments.id', 'users.name as username', 'users.email', 'users.id as user_id', 'investment_packages.name as packagename', 'user_investments.date', 'user_investments.end_date', 'user_investments.amount', 'user_investments.returns', 'investment_packages.id as package_id', 'user_investments.txn_id', 'user_investments.duration', 'user_investments.payout', 'user_investments.status', 'user_investments.active', 'user_investments.wallet_id']);
            $myCollectionObj1 = collect($investments);
            $investments = $AppPaginator->paginate($myCollectionObj1, 'admin/users-investments');
        } else {
            $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
                ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
                ->where('users.id', $request['user_id'])
                ->orderBy('user_investments.id', 'DESC')
                ->get(['user_investments.id', 'users.name as username', 'users.email', 'users.id as user_id', 'investment_packages.name as packagename', 'user_investments.date', 'user_investments.end_date', 'user_investments.amount', 'user_investments.returns', 'investment_packages.id as package_id', 'user_investments.duration', 'user_investments.txn_id', 'user_investments.payout', 'user_investments.status', 'user_investments.active', 'user_investments.wallet_id']);
            $myCollectionObj1 = collect($investments);
            $investments = $AppPaginator->paginate($myCollectionObj1, 'admin/users-investments');
            $userName = getReferredUser($request['user_id']);
            $pageName = "$userName Investments";
        }

        foreach ($investments as $key => $invest) {
            $invest->start_date = date('Y-m-d', strtotime(Carbon::parse($invest->date)->toDayDateTimeString()));

        }

        $priviledge = "admin";
        $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($userAdmin->last_name == "subadmin") {
            $priviledge = "subadmin";
        }

        return view('admin.invest.user-investments',
            [
                'investments' => $investments,
                'page_title' => $pageName,
                "priviledge" => $priviledge,
                'users' => $users,
                'packages' => $packages,
            ]);
    }
    public function store(Request $req)
    {
        $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($userAdmin->last_name == "subadmin") {
            return redirect("admin/users");
        }
        $invest = new UsersInvestments;
        $invest->user_id = $req['user_id'];
        $invest->investment_packages_id = $req['package_id'];
        $invest->date = Carbon::parse($req['start_date'])->toDayDateTimeString();
        $invest->end_date = $req['end_date'];
        $invest->amount = $req['amount'];
        $invest->duration = $req['duration'];
        $invest->returns = $req['return'];
        $invest->txn_id = $req['transaction_id'];
        $invest->payout = $req['payout'];
        if ($req['status'] == "pending") {
            $invest->active = false;
        } else {
            $invest->active = true;
        }
        $invest->status = $req['status'];

        $invest->save();

        $packageData = Investment_Packages::findOrFail($req['package_id']);

        $activity = new Activities;
        $activity->title = "Investment initialized";
        $activity->user_id = $req['user_id'];
        $activity->user_investments_id = $invest->id;
        $activity->investment_packages_id = $req['package_id'];
        $activity->category = "deposit";
        $activity->date = Carbon::parse($req['start_date'])->toDayDateTimeString();
        $activity->amount = $req['amount'];
        $activity->descp = "Deposit of $$activity->amount made for $packageData->name";

        $activity->save();
        return redirect('admin/users-investments');
    }

    public function update(Request $req, $id)
    {
        $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($userAdmin->last_name == "subadmin") {
            return redirect("admin/users");
        }
        if ($req->update == "return_capital") {
            $thisInvestment = UsersInvestments::where('id', $id)->firstOrFail();
            $thisInvestment->status = "dormant";
            $userInfo = UserInfo::where('user_id', $thisInvestment->user_id)->firstOrFail();
            $walletName="";


            if ($thisInvestment->payout == "6_months_compounding" ||
                $thisInvestment->payout == "7_months_compounding" ||
                $thisInvestment->payout == "8_months_compounding" ||
                $thisInvestment->payout == "9_months_compounding" ||
                $thisInvestment->payout == "10_months_compounding") {
                $userInfo->compound_wallet = $userInfo->compound_wallet + $thisInvestment->amount;
                $walletName="Compound Wallet";
            } else {
                $userInfo->main_wallet = $userInfo->main_wallet + $thisInvestment->amount;
                $walletName="Main Wallet";
            }

            $activity = new Activities;
            $activity->title = "Capital Reimbursement";
            $activity->user_id = $thisInvestment->user_id;
            $activity->category = "deposit";
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->amount = $thisInvestment->amount;
            $activity->descp = "Reimbursement of investmented capital to $walletName";
            $activity->save();

            $userInfo->update();
            $thisInvestment->update();
            $req->session()->flash('success', "Capital has been withdrawn $walletName.");
            return redirect('admin/users-investments');
        }
        if ($req->update == "normal_update") {
            $invest = UsersInvestments::findOrFail($id);
            $invest->user_id = $req['user_id'];
            $invest->investment_packages_id = $req['package_id'];
            $invest->date = Carbon::parse($req['start_date'])->toDayDateTimeString();
            $invest->end_date = $req['end_date'];
            $invest->amount = $req['amount'];
            $invest->duration = $req['duration'];
            $invest->returns = $req['return'];
            $invest->txn_id = $req['transaction_id'];
            $invest->payout = $req['payout'];
            if ($req['status'] == "pending") {
                $invest->active = false;
            } else {
                $invest->active = true;
            }
            $invest->status = $req['status'];
            $invest->update();
            $req->session()->flash('success', "Investment Updated");
        } else {

            $thisInvestment = UsersInvestments::findOrFail($id);
            $packageData = Investment_Packages::findOrFail($thisInvestment->investment_packages_id);
            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $thisInvestment->user_id)
                ->get()->first();

            $amount = $thisInvestment->amount;
            $packagename = $packageData->name;
            $monthCount = $packageData->duration;

            $thisInvestment->status = "completed";
            $thisInvestment->active = true;
            $thisInvestment->compounding_amount = $thisInvestment->amount;
            $thisInvestment->duration = $monthCount;
            $thisInvestment->date = Carbon::now()->toDayDateTimeString();
            $thisInvestment->end_date = date('Y-m-d', strtotime("+$monthCount months", strtotime(Carbon::now()->toDayDateTimeString())));
            //dd($packageData->duration);

            $activity = new Activities;
            $activity->title = "Investment initialized";
            $activity->user_id = $user->user_id;
            $activity->user_investments_id = $id;
            $activity->investment_packages_id = $thisInvestment->investment_packages_id;
            $activity->category = "deposit";
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->amount = $amount;
            $activity->descp = "Deposit of $$amount made for $packagename";
            $activity->save();
            //dd($activity);

            //Send Mails $user->email
            try {
                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => 'Congratulations on your Portfolio Purchase',
                    'title' => "Congratulations {$user->name} {$user->last_name}",
                    'url' => "{$req->getSchemeAndHttpHost()}/user/user-investments",
                    'descp' => "We are delighted to inform you that your portfolio purchase of $packagename
                has been received successfully. Your Investor account will be activated shortly.
                 This is the best step you could possibly take toward regaining control of your financial life.
                 Our key Goal is providing efficient and reliable financial services to our clients.
                  We very much admire your shrewdness in taking this decisive action now. There is every reason to believe you are on your way to the top!",
                    'action-text' => 'Client Access',
                    'img' => 'assets/images/emails/investment-banner.jpg',
                ]));

                Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                    'subject' => 'Portfolio Payment',
                    'title' => "Hi Admin",
                    'url' => "{$req->getSchemeAndHttpHost()}/admin/users-investments",
                    'descp' => "A user just successfully made payment $packagename on Palmalliance.
                 These are the user details.... NAME: $user->name $user->last_name, EMAIL: $user->email, PHONE: $user->phone, AMOUNT: $$amount.....
                 Please Login to view investments",
                    'action-text' => 'Vew Investments',
                    'img' => 'assets/images/emails/Palm-Alliance-Management-Building.jpg',
                ]));
            } catch (\Exception$e) {

            }

            //Check Referal
            if ($user->referred_by != null && $user->referred_by != "") {
                //Save Activity
                $referredUser = DB::table('users')
                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                    ->where('users.id', $user->referred_by)
                    ->get()->first();

                if ($referredUser != null) {
                    $bonusAmount = $amount * $packageData->level1_bonus;

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
                    // dd($userInfo);
                    $userInfo->update();
                    $firstPecentage = ($bonusAmount / $amount) * 100;

                    //Save Activity
                    $activity = new Activities;
                    $activity->title = "Referral Bonus";
                    $activity->user_id = $referredUser->user_id;
                    $activity->category = "bonus";
                    $activity->date = Carbon::now()->toDayDateTimeString();
                    $activity->amount = $bonusAmount;
                    $activity->descp = "Credited $firstPecentage% - $$bonusAmount as referral bonus";
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
                            $bonusAmount_stage2 = $amount * $packageData->level2_bonus;

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
                            $activity->date = Carbon::now()->toDayDateTimeString();
                            $activity->amount = $bonusAmount_stage2;
                            $activity->descp = "Credited $secPecentage% - $$bonusAmount_stage2 as referral bonus";
                            $activity->save();
                            // $referredUser_stage2->email

                            try {
                                Mail::to($referredUser_stage2->email)->send(new UserRegisteredMail([
                                    'subject' => 'Members Benefit Commissions',
                                    'title' => "Hi $referredUser_stage2->name $referredUser_stage2->last_name ",
                                    'url' => "{$req->getSchemeAndHttpHost()}/user/referred-users",
                                    'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
                                    'action-text' => 'Client Access',
                                    'img' => 'assets/images/emails/first-referal-banner.jpg',
                                ]));
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
                                    $bonusAmount_stage3 = $amount * $packageData->level3_bonus;

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
                                    $activity->date = Carbon::now()->toDayDateTimeString();
                                    $activity->amount = $bonusAmount_stage3;
                                    $activity->descp = "Credited $thirdPecentage% - $$bonusAmount_stage3 as referral bonus";
                                    $activity->save();
                                    // $referredUser_stage2->email

                                    try {
                                        Mail::to($referredUser_stage3->email)->send(new UserRegisteredMail([
                                            'subject' => 'Members Benefit Commissions',
                                            'title' => "Hi $referredUser_stage3->name $referredUser_stage3->last_name ",
                                            'url' => "{$req->getSchemeAndHttpHost()}/user/referred-users",
                                            'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@palmalliance.com",
                                            'action-text' => 'Client Access',
                                            'img' => 'assets/images/emails/first-referal-banner.jpg',
                                        ]));
                                    } catch (\Exception$e) {

                                    }
                                }
                            }
                        }
                    }

                }
            }
            $thisInvestment->update();
            $req->session()->flash('success', "$user->name $user->last_name, Portfolio investment of $$amount has been activated");
        }

        return redirect('admin/users-investments');

    }

    public function destroy(Request $request, $id)
    {
        $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($userAdmin->last_name == "subadmin") {
            return redirect("admin/users");
        }
        UsersInvestments::destroy($id);

        $request->session()->flash('success', 'Investment deleted!');
        return redirect("admin/users-investments?user_id={$request->user_id}");
    }
}
