<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\Activities;
use App\Models\Wallet_Payments;
use \Datetime;
use App\Mail\UserRegisteredMail;
use Mail;
use Carbon\Carbon;

class MakeInvestment extends Controller
{
    public function index()
    {
        $packages = Investment_Packages::where("active_status", "active")->get();
        function getAmountAttribute($value)
        {
            return number_format($value);
        }

        foreach ($packages as $key => $pack) {
            $pack->formatted_min = getAmountAttribute($pack->min_amt);
            $pack->formatted_max = getAmountAttribute($pack->max_amt);
        }
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();


        //Change Payout
        function getPayout($data)
        {
            switch ($data) {
                case 'daily_payout':
                    return "Daily Payout";
                    break;
                case 'monthly_payout':
                    return "Monthly Payout";
                    break;
                case '6_months_compounding':
                    return "6 Months Compounding";
                    break;
                case '7_months_compounding':
                    return "7 Months Compounding";
                    break;
                case '8_months_compounding':
                    return "8 Months Compounding";
                    break;
                case '9_months_compounding':
                    return "9 Months Compounding";
                    break;
                case '10_months_compounding':
                    return "10 Months Compounding";
                    break;
            }
        }



        $userActivities = User::join('activities', 'activities.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'activities.investment_packages_id')
            ->where('users.id', $id)
            ->orderBy('activities.id', 'DESC')
            ->get();




        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('users.id', $id)
            ->orderBy('user_investments.id', 'DESC')
            ->get([
                'users.name as username', 'users.email', 'investment_packages.name as packagename',  'investment_packages.id as package_id', 'user_investments.date', 'user_investments.id as investment_id', 'user_investments.end_date', 'investment_packages.category_name',
                'user_investments.amount', 'user_investments.returns', 'investment_packages.duration', 'user_investments.payout', 'user_investments.active', 'user_investments.status', 'user_investments.txn_id', 'user_investments.compounding_amount'
            ]);


        $usersInvestments = [];
        $totalInvested = 0;
        $totalReturns = 0;
        $totalActive = 0;
        $totalPending = 0;
        $totalCompouding = 0;
        $pendingId = null;

        for ($i = 0; $i < count($investments); $i++) {
            //$investments[$i]['end_date']
            $totalInvested = $totalInvested + $investments[$i]['amount'];
            $totalReturns = $totalReturns + $investments[$i]['returns'];
            if ($investments[$i]['status'] == "completed") {
                $totalActive = $totalActive + 1;
                $totalCompouding = $totalCompouding + $investments[$i]['compounding_amount'];
            } else if ($investments[$i]['status'] == "pending") {
                $totalPending = $totalPending + 1;
                $pendingId = $investments[$i]["investment_id"];
            }

            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
            $d2 = strtotime($investments[$i]['end_date']);
            $totalSecondsDiff = abs($d1 - $d2);
            $totalDaysDiff  = intval(round($totalSecondsDiff / 60 / 60 / 24));
            if ($d1 < $d2) {
                $dayLeft = 100;
                if ($totalDaysDiff < 100) {
                    $dayLeft = $totalDaysDiff;
                }
                $data = [
                    'days' => $totalDaysDiff, 'daysLeft' => $dayLeft, 'username' => $investments[$i]['username'], 'email' => $investments[$i]['email'], 'packagename' => $investments[$i]['packagename'], 'category_name' => $investments[$i]['category_name'], 'date' => $investments[$i]['date'], 'amount' => $investments[$i]['amount'], 'returns' => $investments[$i]['returns'], 'duration' => $investments[$i]['duration'],
                    'payout' => getPayout($investments[$i]['payout']), 'active' => $investments[$i]['active'], 'investment_id' => $investments[$i]['investment_id'], 'package_id' => $investments[$i]['package_id'], 'status' => $investments[$i]['status'], 'txn_id' => $investments[$i]['txn_id'], "compounding_amount" => $investments[$i]['compounding_amount']
                ];
                array_push($usersInvestments, (object)$data);
            }
        }

        return view('user.make-investments', [

            'user' => $user,
            'user_id' => $id,
            'page_title' => " ",
            'activities' => $userActivities,
            'investments' => $usersInvestments,
            'packages' => $packages,
            'username' => $user->name,
            "totalInvested" => getAmountAttribute($totalInvested),
            "totalReturns" => getAmountAttribute($totalReturns),
            "totalActive" => $totalActive,
            "pendingId" => $pendingId,
            "totalPending" => $totalPending,
            "totalCompouding" => getAmountAttribute($totalCompouding)

        ],);
    }

    public function create(Request $req)
    {
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
        $id = auth()->id();
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();
        $package = Investment_Packages::findOrFail($req['package_id']);

        if ($req['amount'] < $package->min_amt) {
            $req->session()->flash('error', "Insufficient Amount ... Minimum Investment amount is $$package->min_amt");
            return redirect($req['page_url']);
        }

        if (
            $req['payout'] == "6_months_compounding"
        ) {
            $percentage = $package->compound_percent / 100;
        } else {
            $percentage = $package->min_percent / 100;
        }

        $receipt_no = secure_random_string(12);
        return view('user.investment-receipt', ["receipt_no" => $receipt_no, 'user' => $user, 'user_id' => $id, "package" => $package, 'username' => $user->name, 'page_title' => " "]);
    }


    public function show($pack_id)
    {
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $package = Investment_Packages::findOrFail($pack_id);

        return view('user.investment-view', ['user' => $user, 'user_id' => $id, "package" => $package, 'username' => $user->name, 'page_title' => " "]);
    }


    public function edit(Request $req, $pack_id)
    {
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $user->formated_referral_wallet = number_format($user->referral_wallet);

        $package = Investment_Packages::findOrFail($pack_id);

        $investments = UsersInvestments::where("user_id", $id)->get();

        foreach ($investments as $key => $value) {
            $value->package = Investment_Packages::findOrFail($value->investment_packages_id);
            $value->formatted_available_fund_balance = number_format($value->available_fund_balance);
            $value->formatted_active_interest_balance = number_format($value->active_interest_balance);
        }


        return view('user.investment-payment', ['user' => $user, "investments" => $investments, 'user_id' => $id, "package" => $package, 'username' => $user->name,   'page_title' => " "]);
    }
}
