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
use Carbon\Carbon;
use Coinremitter\Coinremitter;
use Mail;
use GuzzleHttp\Client;

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






        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('users.id', $id)
            ->where('user_investments.status', "finished")
            ->orderBy('user_investments.id', 'DESC')
            ->get([
                'users.name as username', 'users.email', 'investment_packages.name as packagename','investment_packages.image',  'investment_packages.id as package_id', 'user_investments.date', 'user_investments.id as investment_id', 'user_investments.end_date', 'investment_packages.category_name',
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
            'investments' => $investments,
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
        function get_payout($data)
        {
            if ($data == "bi_weekly") {
                return "Regular Bi Weekly";
            } else if ($data == "stacking_interest") {
                return "Fixed Stacking Interest";
            } else if ($data == "diverse_stacking_interest") {
                return "Diverse Stacking Interest";
            }
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
        $package->investment_end_date = date('Y-m-d', strtotime("+{$package->duration} months", strtotime(Carbon::now()->toDayDateTimeString())));
        $receipt_no = secure_random_string(12);
        $receipt_date = date("Y-m-d", strtotime(Carbon::now()->toDayDateTimeString()));
        $req['formatted_amount'] = number_format($req['amount']);
        $req['formatted_payout'] = get_payout($req['payout']);

        return view('user.investment-receipt', ["req" => $req, "receipt_date" => $receipt_date, "receipt_no" => $receipt_no, 'user' => $user, 'user_id' => $id, "package" => $package, 'username' => $user->name, 'page_title' => " "]);
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


    public function store(Request $req)
    {
        $id = auth()->id();
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();
        $package = Investment_Packages::findOrFail($req['investment_packages_id']);
        $main_amount = $req['amount'];
        $percentage = 0.0;
        $stacking_end_month = null;
        $next_bi_weekly = Carbon::now()->addDays(3)->format('Y-m-d');

        //GET INVESTMENT PERCENTAGE START
        if ($req['payout'] == "bi_weekly") {
            $percentage = $package->min_percent / 100;
        } else if ($req['payout'] == "stacking_interest" || $req['payout'] == "diverse_stacking_interest") {
            $percentage = $package->compound_percent / 100;
            $stacking_end_month = date('Y-m-d', strtotime("+{$req['stacking_months']} months", strtotime(Carbon::now()->toDayDateTimeString())));
        } else {
            $percentage = $package->min_percent / 100;
        }
        $creditAmount = $percentage * $main_amount;

        //GET INVESTMENT PERCENTAGE END

        if ($req['payment_method'] == "direct_deposit") {
            $coinRemitter = new Coinremitter($req['currency']);

            $paymentData = [
                'amount' => $req['amount'], // required Invoice amount in selected currency OR amount_usd can be used instead
                'currency' => "USD", // required (ETH, BTC, LTC, TZEC, DOGE, BCH, ...)
                'name' =>  str_replace(" ", "-", $user->name),
                'expire_time' => '240',
                'description' => "Wants to make payment", // optional any description
            ];
            try {
                $invoice  = $coinRemitter->create_invoice($paymentData);

                if ($invoice && isset($invoice['data']) && $invoice['data']['status'] == 'Pending') {
                    $invest = new UsersInvestments();
                    $invest->user_id = $user->user_id;
                    $invest->investment_packages_id = $req['investment_packages_id'];
                    $invest->date = Carbon::now()->toDayDateTimeString();
                    $invest->end_date = date('Y-m-d', strtotime("+{$req['duration']} months", strtotime(Carbon::now()->toDayDateTimeString())));
                    $invest->amount = $main_amount;
                    $invest->duration = $req['duration'];
                    $invest->returns = $creditAmount;
                    $invest->txn_id = $invoice['data']['invoice_id'];
                    $invest->wallet_id = $invoice['data']['address'];
                    $invest->invoice_url = $invoice['data']['url'];
                    $invest->currency = $req['currency'];
                    $invest->payout = $req['payout'];
                    if ($stacking_end_month != null) {
                        $invest->compound_end_date = $stacking_end_month;
                        $invest->compound_status = "on-going";
                        $invest->compound_precentage = $req['compound_precentage'];
                        $invest->compounding_amount = 0.0;
                    }
                    $invest->available_fund_balance = 0.0;
                    $invest->active_interest_balance = 0.0;
                    $invest->active = false;
                    $invest->status = "pending";
                    $invest->save();

                    return redirect("user/user-investments/" . $invest->id);
                } else {
                    $req->session()->flash('error', $invoice['msg']);
                    return redirect($req['page_url']);
                }
            } catch (\Exception $e) {
                $req->session()->flash('error', 'An error occured');
                return redirect($req['page_url']);
            }
        } elseif ($req['payment_method'] == "available_funds"  || $req['payment_method'] == "active_interest" ||  $req['payment_method'] == "referral_commission") {
            try {

                $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();
                $investment = null;

                if ($req['payment_method'] == "available_funds") {
                    $investment = UsersInvestments::where('id', $req['funding_source'])->firstOrFail();
                    if ($req['amount'] > $investment->available_fund_balance) {
                        $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Active Funds.');
                        return redirect($req['page_url']);
                    } else {
                        $investment->available_fund_balance = $investment->available_fund_balance - $req['amount'];
                        $investment->update();
                    }
                }

                if ($req['payment_method'] == "active_interest") {
                    $investment = UsersInvestments::where('id', $req['funding_source'])->firstOrFail();
                    if ($req['amount'] > $investment->active_interest_balance) {
                        $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Active Interest Funds.');
                        return redirect($req['page_url']);
                    } else {
                        $investment->active_interest_balance = $investment->active_interest_balance - $req['amount'];
                        $investment->update();
                    }
                }

                if ($req['payment_method'] == "referral_commission") {
                    if ($req['amount'] > $userInfo->referral_wallet) {
                        $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Community Wallet.');
                        return redirect($req['page_url']);
                    } else {
                        $userInfo->referral_wallet = $userInfo->referral_wallet - $req['amount'];
                        $userInfo->update();
                    }
                }

                $invest = new UsersInvestments();
                $invest->user_id = $user->user_id;
                $invest->investment_packages_id = $req['investment_packages_id'];
                $invest->date = Carbon::now()->toDayDateTimeString();
                $invest->end_date = date('Y-m-d', strtotime("+{$req['duration']} months", strtotime(Carbon::now()->toDayDateTimeString())));
                $invest->amount = $main_amount;
                $invest->duration = $req['duration'];
                $invest->returns = $creditAmount;
                $invest->txn_id = "wallet";

                $invest->currency = $req['currency'];
                $invest->payout = $req['payout'];
                if ($stacking_end_month != null) {
                    $invest->compound_end_date = $stacking_end_month;
                    $invest->compound_status = "on-going";
                    $invest->compound_precentage = $req['compound_precentage'];
                    $invest->compounding_amount = 0.0;
                }
                $invest->available_fund_balance = 0.0;
                $invest->active_interest_balance = 0.0;
                $invest->active = false;
                $invest->status = "pending";
                $invest->save();

                try{
                    Mail::to($user->email)->send(new UserRegisteredMail([
                        'subject' => 'Confirmation on your Portfolio Activation',
                        'title' => "Hello {$user->name} {$user->last_name}",
                        'url' => "https://DellGroup.com/user/user-investments",
                        'descp' => "We are delighted to inform you that your portfolio purchase of {$package->name}
        has been received and activated successfully. ",
                        'action-text' => 'App Login',
                        'img' => 'assets/images/emails/investment-banner.jpg',
                    ]));
    
                }catch(\Exception $e){}

                $activity = new Activities;
                $activity->title = "Portfolio Activated";
                $activity->user_id = $user->user_id;
                $activity->user_investments_id = $invest->id;
                $activity->investment_packages_id = $package->id;
                $activity->category = "deposit";
                $activity->date = Carbon::now()->toDayDateTimeString();
                $activity->amount = $req['amount'];
                $activity->descp = "Payment of $ {$req['amount']} made for {$package->name} from your {$req['payment_method']}";
                //dd($activity);
                $activity->save();
                $req->session()->flash('success', "Payment of $ {$req['amount']} for  {$package->name} was successfully");
                return redirect('user/user-investments');

            } catch (\Exception $e) {
                dd($e);
                $req->session()->flash('error', 'An error occured');
                return redirect($req['page_url']);
            }
        }
    }
}
