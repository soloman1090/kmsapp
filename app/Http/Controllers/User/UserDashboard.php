<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Investment_Packages;
use App\Models\Messages;
use App\Models\Popup_Data;
use App\Models\Survey;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Voyager;
use App\Models\WithdrawalRequests;
use App\Models\Withdrawal_Methods;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class UserDashboard extends Controller
{

    public function index(Request $request)
    {


        function getDateDifference($endDate)
        {
            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($endDate);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 < $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                    return $dayLeft;
                } else {
                    return $totalDaysDiff;
                }
            } else {
                return 0;
            }
        }

        $news = null;
        try {
            $client = new Client(['verify' => false]);
            //$request=$client->get('https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=15a89f301f0145f8bca1b3241d320faa');
            $articles = json_decode($request->getBody());
            $news = $articles->articles;

        } catch (\Exception$e) {
            $path = public_path('news.json');
            // $news = Storage::get($path);
            $news = json_decode(file_get_contents($path));
            $news = $news->articles;
        }

        $id = auth()->id();
        //Join user table and userinfos table together
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        // if($user->verified==null){
        //     $request->session()->flash('success', 'For security reasons. Please reset your password');
        //     return redirect('user/change-password');
        // }

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

                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => '2FA Authentication Code',
                    'title' => "The 2FA code is: $code",
                    'url' => "{$request->getSchemeAndHttpHost()}/user/withdrawal-request",
                    'descp' => "The verification code will be valid for 30 minutes. Please do not share your code with anyone.\n Protecting your account is our top priority. Please confirm your withdrawal by entering this code above on the withdrawal form.",
                    'action-text' => 'Back To Withdrawal',
                    'img' => 'assets/images/emails/withdrawal-banner.jpg',
                ]));
                $request->session()->flash('success', '2FA CODE has been sent to your email');
            }
        } catch (\Exception$e) {

        }

        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('users.id', $id)
            ->where('user_investments.status', "completed")
            ->orderBy('user_investments.id', 'DESC')
            ->get(['users.name as username', 'users.email', 'investment_packages.name as packagename', 'investment_packages.id as package_id', 'user_investments.date', 'user_investments.id as user_investments_id', 'user_investments.end_date', 'investment_packages.category_name',
                'user_investments.amount', 'user_investments.returns', 'user_investments.duration', 'user_investments.payout', 'user_investments.active', 'user_investments.status', 'user_investments.txn_id']);

        $usersInvestments = [];
        for ($i = 0; $i < count($investments); $i++) {
            //$investments[$i]['end_date']

            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($investments[$i]['end_date']);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 < $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                }
                $data = ['days' => $totalDaysDiff, 'daysLeft' => $dayLeft, 'username' => $investments[$i]['username'], 'email' => $investments[$i]['email'], 'packagename' => $investments[$i]['packagename'], 'category_name' => $investments[$i]['category_name'], 'date' => $investments[$i]['date'], 'amount' => $investments[$i]['amount'], 'returns' => $investments[$i]['returns'], 'duration' => $investments[$i]['duration'], 'active' => $investments[$i]['active'], 'user_investments_id' => $investments[$i]['user_investments_id'], 'package_id' => $investments[$i]['package_id'], 'status' => $investments[$i]['status'], 'txn_id' => $investments[$i]['txn_id']];
                array_push($usersInvestments, (object) $data);
            }
        }

        $totalCapital = 0;
        foreach ($usersInvestments as $invest) {
            $totalCapital = $totalCapital + $invest->amount;
        }
        $messages = Messages::where('owner', "0")->orWhere('user_id', $id)->orderBy('id', 'DESC')->get();

        $activities = DB::table('users')
            ->join('activities', 'users.id', "=", 'activities.user_id')
            ->where('activities.user_id', $id)
            ->orderBy('activities.id', 'DESC')
            ->get();

        // Recent Messages
        $recentMessages = [];
        if (count($messages) <= 6) {
            for ($i = 0; $i < count($messages); $i++) {
                array_push($recentMessages, (object) $messages[$i]);
            }
        } else if (count($messages) > 6) {
            for ($i = 0; $i < 6; $i++) {
                array_push($recentMessages, (object) $messages[$i]);
            }
        }

        // Recent Investments
        $recentInvestments = [];
        if (count($usersInvestments) <= 4) {
            for ($i = 0; $i < count($usersInvestments); $i++) {
                array_push($recentInvestments, (object) $usersInvestments[$i]);
            }
        } else if (count($usersInvestments) > 4) {
            for ($i = 0; $i < 4; $i++) {
                array_push($recentInvestments, (object) $usersInvestments[$i]);
            }
        }

        // Recent Activities
        $recentActivities = [];
        if (count($activities) <= 5) {
            for ($i = 0; $i < count($activities); $i++) {
                array_push($recentActivities, (object) $activities[$i]);
            }
        } else if (count($activities) > 5) {
            for ($i = 0; $i < 5; $i++) {
                array_push($recentActivities, (object) $activities[$i]);
            }
        }

        //Get Accumulated Dividends
        $userEarnings = DB::table('users')
            ->join('activities', 'users.id', "=", 'activities.user_id')
            ->where('activities.user_id', $id)
            ->where('category', 'LIKE', '%earning%')
            ->get();

        $userBonus = DB::table('users')
            ->join('activities', 'users.id', "=", 'activities.user_id')
            ->where('activities.user_id', $id)
            ->where('category', 'LIKE', '%bonus%')
            ->get();

        $userTransfers = DB::table('users')
            ->join('activities', 'users.id', "=", 'activities.user_id')
            ->where('activities.user_id', $id)
            ->where('category', 'LIKE', '%transfer%')
            ->get();

        $userWitdrawals = WithdrawalRequests::where("user_id", $id)->where("approved", true)->get();

        $accumulatedDevidends = 0;
        $accumulatedEarnings = 0;

        foreach ($userEarnings as $key => $earned) {
            $accumulatedDevidends = $accumulatedDevidends + $earned->amount;
            $accumulatedEarnings = $accumulatedEarnings + $earned->amount;
        }

        $accumulatedBonus = 0;
        foreach ($userBonus as $key => $bonus) {
            $accumulatedBonus = $accumulatedBonus + $bonus->amount;
        }

        $accumulatedTransfer = 0;
        foreach ($userTransfers as $key => $trans) {
            $accumulatedTransfer = $accumulatedTransfer + $trans->amount;
        }

        $accumulatedWithdrawals = 0;
        foreach ($userWitdrawals as $key => $with) {
            $accumulatedWithdrawals = $accumulatedWithdrawals + $with->amount_credited;
        }

        $accumulatedDevidends = $accumulatedDevidends + $accumulatedBonus + $accumulatedTransfer;

        // dd($accumulatedDevidends,   $accumulatedEarnings);

        $withdrawMethods = Withdrawal_Methods::all();
        $referrals = UserInfo::all()->where('referred_by', $id);

        $dailyCredited = [];

        $day = date("D", strtotime(Carbon::now()->toDayDateTimeString()));

        function getActivityDate($investID)
        {
            $activities = DB::table('users')
                ->join('activities', 'users.id', "=", 'activities.user_id')
                ->where('activities.user_id', auth()->id())
                ->where('activities.user_investments_id', $investID)
                ->get();

            $dates = [];
            $hasData = false;
            foreach ($activities as $key => $active) {

                array_push($dates, (object) ['day' => Carbon::parse($active->date)->day, 'month' => Carbon::parse($active->date)->month]);

                if (Carbon::parse($active->date)->month == Carbon::now()->month && Carbon::parse($active->date)->day == Carbon::now()->day) {

                    $hasData = true;
                }

            }
            return $hasData;
        }

        function getDays($allDays, $return, $id)
        {

            $activeDate = [];
            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
            for ($i = 0; $i < $allDays; $i++) {
                array_push($activeDate, (object) ['day' => $days[$i], 'amount' => $return, 'status' => getActivityDate($id)]);
            }
            return $activeDate;
        }

        switch ($day) {
            case 'Mon':
                $dailyCredited = [];
                foreach ($recentInvestments as $key => $recInv) {
                    array_push($dailyCredited, (object) ['invest_id' => $recInv->user_investments_id, 'invest_name' => "$recInv->packagename ($$recInv->amount)",
                        "dailys" => getDays(1, $recInv->returns, $recInv->user_investments_id)]);
                }

                break;
            case 'Tue':
                $dailyCredited = [];
                foreach ($recentInvestments as $key => $recInv) {
                    array_push($dailyCredited, (object) ['invest_id' => $recInv->user_investments_id, 'invest_name' => "$recInv->packagename ($$recInv->amount)",
                        "dailys" => getDays(2, $recInv->returns, $recInv->user_investments_id)]);
                }
                break;
            case 'Wed':
                foreach ($recentInvestments as $key => $recInv) {

                    $dailyCredited = [];

                    array_push($dailyCredited, (object) ['invest_id' => $recInv->user_investments_id, 'invest_name' => "$recInv->packagename ($$recInv->amount)",
                        "dailys" => getDays(3, $recInv->returns, $recInv->user_investments_id)]);

                }
                break;
            case 'Thu':
                $dailyCredited = [];
                foreach ($recentInvestments as $key => $recInv) {
                    // dd(Carbon::now()->day);
                    //dd( Carbon::parse($recInv->date)->day);
                    array_push($dailyCredited, (object) ['invest_id' => $recInv->user_investments_id, 'invest_name' => "$recInv->packagename ($$recInv->amount)",
                        "dailys" => getDays(4, $recInv->returns, $recInv->user_investments_id)]);
                }
                break;
            case 'Fri':
                $dailyCredited = [];
                foreach ($recentInvestments as $key => $recInv) {

                    array_push($dailyCredited, (object) ['invest_id' => $recInv->user_investments_id, 'invest_name' => "$recInv->packagename ($$recInv->amount)",
                        "dailys" => getDays(5, $recInv->returns, $recInv->user_investments_id)]);

                }
                break;
            default:
                $dailyCredited = [];
                foreach ($recentInvestments as $key => $recInv) {

                    $days = [];
                    array_push($days, (object) ['day' => "Monday", 'amount' => 0.00, 'status' => false]);
                    array_push($days, (object) ['day' => "Tuesday", 'amount' => 0.00, 'status' => false]);
                    array_push($days, (object) ['day' => "Wednesday", 'amount' => 0.00, 'status' => false]);
                    array_push($days, (object) ['day' => "Thursday", 'amount' => 0.00, 'status' => false]);
                    array_push($days, (object) ['day' => "Friday", 'amount' => 0.00, 'status' => false]);

                    array_push($dailyCredited, (object) ['invest_id' => $recInv->user_investments_id, 'invest_name' => "$recInv->packagename ($$recInv->amount)",
                        "dailys" => $days]);
                }
                break;
        }
        //dd($recentInvestments);
        //DUMMY DIVIDENDS

        $user_id=$id;
        if ($user_id==75)
        $accumulatedDevidends+47345.53;
        elseif ($user_id==77)
        $accumulatedDevidends+18530.56;
        elseif ($user_id==84)
        $accumulatedDevidends+15426110.92;

        //DUMMRY BONUS
        if ($user_id==75)
        $accumulatedBonus+13400.82;
        elseif($user_id==77)
        $accumulatedBonus+2450.23;
        elseif($user_id==84)
        $accumulatedBonus+1429310.56;
        

        //DUMMY EARNING
        if ($user_id==75)
        $accumulatedEarnings+47345.53;
        elseif ($user_id==77)
        $accumulatedEarnings+18530.56;
        elseif ($user_id==84)
        $accumulatedEarnings+15426110.92;




        $Popup_Datas = Popup_Data::all();
        $popData = null;
        if (count($Popup_Datas) > 0) {
            foreach ($Popup_Datas as $key => $data) {
                if ($data->status == "main") {
                    $popData = $data;
                }
            }
        }
        // dd($Popup_Data);

        function getAmountAttribute($value)
        {
            return number_format($value);
        }

        $hasSurvey = DB::table('survey')->where('user_id', $id)->get()->first();
        $packages = Investment_Packages::all();
        $voyager = Voyager::where('user_id', $id)->get()->first();
         
        if($voyager!=null){
            $voyager->amount=getAmountAttribute($voyager->amount);
        }

        $totalDaysDiff = 0;
        $dayLeft = 0;
        if ($voyager != null) {
            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($voyager->date);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 < $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                }
            }
        }

        return view('user.dashboard', [
            'page_title' => "Dashboard",
            'user' => $user,
            'v_days' => $totalDaysDiff, 'v_daysLeft' => $dayLeft,
            'user_id' => $id,
            'activities' => $recentActivities,
            'accumulatedDevidends' =>  getAmountAttribute($accumulatedDevidends),
            'wallet_balance' =>  getAmountAttribute($user->main_wallet),
            'messages' => $recentMessages,
            'main_wallet' => $user->main_wallet,
            'compound_wallet' =>   getAmountAttribute($user->compound_wallet),
            'username' => $user->name,
            'accumulatedBonus' =>  getAmountAttribute($accumulatedBonus),
            'withdrawMethods' => $withdrawMethods,
            'invested_capital' =>  getAmountAttribute($totalCapital),
            'investment_count' => count($usersInvestments),
            'recent_investments' => $recentInvestments,
            'all_investments' => $usersInvestments,
            'dailyCredited' => $dailyCredited,
            'referrals' => $referrals,
            "voyager" => $voyager,
            "Popup_Data" => $popData,
            "Popup_Datas" => $Popup_Datas,
            "packages" => $packages,
            'hasSurvey' => $hasSurvey,
            'site_host' => "https://verify.Dell Group.com",//$request->getSchemeAndHttpHost()
            "accumulatedTransfer" =>  getAmountAttribute($accumulatedTransfer),
            "accumulatedWithdrawals" =>  getAmountAttribute($accumulatedWithdrawals),
            "accumulatedEarnings" =>    getAmountAttribute($accumulatedEarnings),
            "bonusDays" => getDateDifference("2022-12-31"),
            "surveyInfo" =>  Survey::where('id', 1)->get()->first(),
            'news' => $news]);

    }

    public function store(Request $request)
    {
        $survey = new Survey();
        $survey->support = "none";
        $survey->withdrawals = "none";
        $survey->deposits = "none";
        $survey->functions = "none";
        $survey->comments = "none";
        

        if ($request["choice"] == "yes") {
            $survey->support = "Yes";
        }

        if ($request["choice"] == "on") {
            $survey->withdrawals = "No";
        }

        if ($request["choice"] == "maybe") {
            $survey->deposits = "Maybe";
        }

        // if ($request["functions"] == "on") {
        //     $survey->functions = "Yes";
        // }

        if ($request["comments"] != "") {
            $survey->comments = $request["comments"];
        }
        $survey->user_id = auth()->id();

        $survey->save();

        $request->session()->flash('success', 'Your feedback has been sent successfully, Please talk to Support if you have any issues with Dell Group System');
        return redirect('user/dashboard');

    }
}
