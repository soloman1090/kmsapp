<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\AppPaginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Referrals;
use App\Models\Role;
 use App\Models\User;
use App\Models\UserInfo;
use App\Models\Voyager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('auth')) {
                function secure_random_string($length)
                {
                    $random_string = '';
                    for ($i = 0; $i < $length; $i++) {
                        $number = random_int(0, 36);
                        $character = base_convert($number, 10, 36);
                        $random_string .= $character;
                    }

                    return $random_string;
                }

                $code = secure_random_string(6);
                $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();
                $userInfo->code_2fa = $code;
                $userInfo->update();

                Mail::to(env('APP_ADMIN'))->send(new UserRegisteredMail([
                    'subject' => '2FA Authentication Code',
                    'title' => "The 2FA code is:\n $code",
                    'url' => "{$request->getSchemeAndHttpHost()}/user/withdrawal-request",
                    'descp' => "The verification code will be valid for 30 minutes. Please do not share your code with anyone.\n Protecting your account is our top priority. Please confirm your withdrawal by entering this code above on the withdrawal form.",
                    'action-text' => 'Back To Withdrawal',
                    'img' => 'assets/images/emails/withdrawal-banner.jpg',
                ]));
                $request->session()->flash('success', '2FA CODE has been sent to your email');
            }
        } catch (\Exception$e) {

        }

        function getReferredUser($id)
        {
            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $id)
                ->get()->first();
            if ($user != null) {
                return ["name" => "$user->name $user->last_name", "email" => $user->email];
            }
            return ["name" => "", "email" => ""];

        }

        function getVoyagerStatus($id)
        {
            $user = Voyager::where('user_id', $id)->get()->first();

            if ($user != null) {
                return $user->status;
            }
            return null;

        }
        if (Gate::denies('logged-in')) {
            dd('no user allowed');
        };

        if (Gate::allows('is-admin')) {
            $users = null;
            $user_Infos = null;
            $AppPaginator = new AppPaginator;

            if ($request->search) {
                $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->where('users.email', 'LIKE', "%{$request->search}%")->orWhere('users.name', 'LIKE', "%{$request->search}%")->orWhere('user_infos.phone', 'LIKE', "%{$request->search}%")->orderBy('users.id', 'DESC')->get();
                $user_Infos = $users;
            } else if ($request->downlines) {

                $users = DB::table('referrals')->where('referrals.user_id', $request->downlines)->orderBy('referrals.id', 'DESC')->get();
                foreach ($users as $key => $re_user) {

                    $aUser = DB::table('users')
                        ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                        ->where('users.id', $re_user->referred_user_id)
                        ->get()->first();

                    $re_user->name = $aUser->name ?? "";
                    $re_user->email = $aUser->email ?? "";

                    $re_user->user_id = $aUser->user_id ?? 0;
                    $re_user->last_name = $aUser->last_name ?? "";
                    $re_user->phone = $aUser->phone ?? "";
                    $re_user->address = $aUser->address ?? "";
                    $re_user->city = $aUser->city ?? "";
                    $re_user->state = $aUser->state ?? "";
                    $re_user->zip_code = $aUser->zip_code ?? "";
                    $re_user->blocked = $aUser->blocked ?? "";
                    $re_user->verified = $aUser->verified ?? "";
                    $re_user->kyc = $aUser->kyc ?? "";
                    $re_user->email_verified_at = $aUser->email_verified_at ?? "";
                    $re_user->image = $aUser->image ?? "";
                    $re_user->main_wallet = $aUser->main_wallet ?? "";
                    $re_user->compound_wallet = $aUser->compound_wallet ?? "";
                    $re_user->referred_by = $aUser->referred_by ?? "";
                    $re_user->referalcode = $aUser->referalcode ?? "";
                    $re_user->code_2fa = $aUser->code_2fa ?? "";
                    $re_user->withdrawal_status = $aUser->withdrawal_status ?? "";

                }

                $user_Infos = $users;

            } else {
                $users = DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();
                $user_Infos = $users;
            }

            $myCollectionObj = collect($users);
            $users = $AppPaginator->paginate($myCollectionObj, 'admin/users');

            foreach ($users as $key => $user) {
                $user->referred_user = getReferredUser($user->referred_by);
                $user->voyager = getVoyagerStatus($user->user_id);
            }

            $priviledge = "admin";
            $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
            if ($userAdmin->last_name == "subadmin") {
                $priviledge = "subadmin";
            }

            return view('admin.users.index',
                [
                    'users' => $users,
                    'userInfos' => $user_Infos,
                    "priviledge" => $priviledge,
                    'app_url' => env("APP_URL"),
                    'page_title' => "All Users",
                ]);
        };

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all(), 'page_title' => "Create User"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreUserRequest $request)
    {
        //$validatedData=$request->validated();
        //$user=User::create($validatedData);

        $newUser = new CreateNewUser();
        $user = $newUser->create($request->all());
        //$user=$newUser->create($request->only(['name','email','password','password_confirmation']));

        $user->roles()->sync($request->roles);
        // Password::sendResetLink($request->only(['email']));
        $request->session()->flash('success', 'You have created this user');
        return redirect(route('admin.users.index'));
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

        return view('admin.users.edit', [
            'roles' => Role::all(),
            'page_title' => "Update User",
            'user' => User::find($id),

        ]);
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

        $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($userAdmin->last_name == "subadmin") {
            return redirect("admin/users");
        }

        $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
        $user = User::findOrFail($id);

        function secure_random_string($length)
        {
            $random_string = '';
            for ($i = 0; $i < $length; $i++) {
                $number = random_int(0, 36);
                $character = base_convert($number, 10, 36);
                $random_string .= $character;
            }

            return $random_string;
        }

        if ($request['account_wallets']) {

            $adminInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();

            if ($request['2fa'] != $adminInfo->code_2fa) {
                $request->session()->flash('error', 'Unauthorized Request,...Please this is a wrong 2FA CODE, get the code sent to your email and make the request again. ');

            } else {

                $activity = new Activities;
                $activity->title = $user->email;
                $activity->user_id = 2;
                $activity->category = "account-update";
                $activity->date = Carbon::now()->toDayDateTimeString();
                $activity->amount = 0;
                $activity->descp = "User Details Updated from {$user->email} to {$request['email']} ";
                $activity->save();

                $user->name = $request['name'];
                $user->email = $request['email'];

                $userInfo->phone = $request['phone'];
                $userInfo->city = $request['city'];
                $userInfo->state = $request['state'];
                $userInfo->address = $request['address'];

                $userInfo->last_name = $request['last_name'];
                $userInfo->referalcode = $request['referalcode'];
                $userInfo->main_wallet = $request['main_wallet'];
                $userInfo->compound_wallet = $request['compound_wallet'];

                $userInfo->update();
                $user->update();
                $adminInfo->code_2fa = null;
                $adminInfo->update();

                $request->session()->flash('success', $user->name . 'User Name, Last Name, Email, Referral-Code, Main and Compound Wallets updated successfully');

            }

        }

        if ($request['voyager']) {

            if ($request['voyager'] == "assign") {
                $voyager = new Voyager();
                $voyager->user_id = $user->id;
                $voyager->activation_key = secure_random_string(15);
                $voyager->status = "pending";
                $voyager->amount = 0.0;
                $voyager->total_amount=0.00;
                $voyager->save();

                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject'=>'Voyager Client Program Approval',
                    'title' => "Hi $user->name $user->last_name",
                    'url' => "{$request->getSchemeAndHttpHost()}/user/voyager-program",
                    'descp' => "<p>We are glad to tell you that your request to become a voyager client has been received and approved successfully. You will earn extra benefits through your members’ benefit programme after crossing the set milestones. These milestones are achieved based on the total invested capital generated by partners across all three levels in your members’ benefit programme. Once the generated value of partners in your members’ benefit programme has surpassed the expected milestone, you will receive your Voyager client reward.</p><p>The Disbursement of our voyager client commission is based on the following milestones:</p><p><b>Voyager Basic - $100,000 generated in cumulative members benefit programme <br/><br/>
                    Voyager Inter - $500,000 generated in cumulative members benefit programme <br/><br/>
                    Voyager Pro - $1,000,000 generated in cumulative members benefit programme <br/><br/>
                    Voyager Silver- $2,000,000 generated in cumulative members benefit programme <br/><br/>
                    Voyager Bronze- $5,000,000 generated in cumulative members benefit programme <br/><br/>
                    Voyager Gold- $10,000,000 generated in cumulative members benefit programme </b></p> <p>For each milestone achieved, a 12% commission will be disbursed automatically to you with extra spillovers and this will unlock the next milestone to be achieved. As a voyager client, we expect these milestones to be achieved within a specified timeframe as stated before; this programme is a merit-based programme and is recently opened to small and medium-scale investors who are looking at earning more from their members’ benefit programme. </p><p>We look forward to working with you and your community and providing a dedicated support agent for you and your Community. Kindly reach out to our customer fulfilment centre if you need more help with understanding this unique programme.</p> <p>Please use the Activation key below to activate your account</p> <hr/><h2>ACTIVATION-KEY:$voyager->activation_key <hr/>",
                    'action-text'=>'Start Voyager Program',
                    'img'=>'assets/images/emails/withdrawal-banner.jpg'
                ]));
                $request->session()->flash('success', "$user->name has been made a voyager ");
                return redirect("admin/voyagers");
            } else if ($request['voyager'] == "active") {
                $voyager = Voyager::where('user_id', $id)->firstOrFail();
                $voyager->status = "active";
                $voyager->date = date('Y-m-d', strtotime("+8 months", strtotime(Carbon::now()->toDayDateTimeString())));
                $voyager->update();
                $request->session()->flash('success', "$user->name voyager account is now active ");
                return redirect("admin/voyagers");
            } else {
                $voyager = Voyager::where('user_id', $id)->firstOrFail();
                $voyager->status = "revoked";
                $voyager->update();
                $request->session()->flash('error', "$user->name has been revoked as a voyager ");
                return redirect("admin/voyagers");
            }

        }

        if ($request['sub_admin']) { 
            if($request['sub_admin']=="subadmin"){

                $userInfo->last_name="subadmin";
                $userInfo->update();
                
                DB::statement("DELETE FROM `role_user` WHERE `user_id` = $id");
                $user->roles()->attach("1");
                $user->update();
                $request->session()->flash('success', " $user->email Subadmin rights has been activated");
            }else{
               
                DB::statement("DELETE FROM `role_user` WHERE `user_id` = $id");
                $user->roles()->attach("2");
                $user->update();
                $userInfo->last_name="user";
                $userInfo->update();
                $request->session()->flash('error', " $user->email Subadmin rights has been revoked");
            }           
        }

        if ($request['remove_2fa']) {
            $user->two_factor_secret = null;
            $user->two_factor_recovery_codes = null;
            $user->remember_token = null;
            $user->update();
            $request->session()->flash('success', 'Two Factor authentication removed successfully ');
        }

        if ($request['verify']) {
            $user->email_verified_at = Carbon::now()->toDayDateTimeString();
            $user->update();
            $request->session()->flash('success', 'Account  Verified');
            $request->session()->flash('success', 'User Account verification is successfully');
        }

        if ($request['upline_update']) {

            $uplineIdUser = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.email', $request['upline_id'])
                ->get()->first();

            if ($request['upline_id'] == null) {

                $hasRefered = Referrals::where('referred_user_id', $id)->get()->first();
                if ($hasRefered != null) {
                    Referrals::destroy($hasRefered->id);
                }

                $userInfo->referred_by = null;
                $userInfo->update();
                $request->session()->flash('success', 'User Upline has been removed successfully');

            } else {
                $userInfo->referred_by = $uplineIdUser->user_id;
                $refere = new Referrals;
                $refere->referred_user_id = $id;
                $refere->user_id = $uplineIdUser->user_id;
                $refere->date = Carbon::now()->toDayDateTimeString();
                $refere->invested = false;

                $hasRefered = Referrals::where('referred_user_id', $id)->get()->first();

                if ($hasRefered != null) {
                    $hasRefered->user_id = $uplineIdUser->user_id;
                    $hasRefered->update();
                } else {
                    $refere->save();
                }

                $userInfo->update();
                $request->session()->flash('success', 'User Upline has been updated successfully');
            }

        }

        if ($request['approve']) {
            $userInfo->blocked = "approved";
            $userInfo->update();
            try {
                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => 'Welcome to Dell Group  Management!',
                    'title' => "Welcome {$user->name}",
                    'url' => "{{ $request->getSchemeAndHttpHost() }}/user/dashboard",
                    'descp' => 'We pride ourselves on serving our clients to the best of our potential and hope that this newfound relationship with you grows by the day.
                 We want to thank you for giving us the opportunity to be able to work with you. We believe that together we can achieve so much more and will continue to serve you.
                 In case of any concerns, feel free to contact us. Even if you’re not sure where to start, We’ll guide you every step of the way.  ',
                    'action-text' => 'Client Access',
                    'img' => 'assets/images/emails/welcome-banner.jpg',
                ]));
            } catch (\Exception$e) {

            }
            $request->session()->flash('success', 'User account is approved and is active');

        } else if ($request['open']) {
            $userInfo->blocked = "opened";
            $userInfo->update();
            $request->session()->flash('success', 'User account is now active');

        } else if ($request['block']) {
            $userInfo->blocked = "blocked";
            $userInfo->update();
            $request->session()->flash('success', 'You have succssfully blocked user account');
        } else {
            $user = User::findOrFail($id);
            if (!$user) {
                $request->session()->flash('error', 'Could not find user');
                return redirect(route('admin.users.index'));
            }
            $user->update($request->except(['_token', 'roles']));
            $user->roles()->sync($request->roles);
            //$request->session()->flash('success','You have updated this user');
        }

        return redirect(route('admin.users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $userAdmin = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($userAdmin->last_name == "subadmin") {
            return redirect("admin/users");
        }
        User::destroy($id);
        $request->session()->flash('success', 'You have deleted this user');
        return redirect(route('admin.users.index'));
    }
}
