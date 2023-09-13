<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersInvestments;
use App\Models\Investment_Packages;
use Carbon\Carbon;
use Coinremitter\Coinremitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersInvestmentsView extends Controller
{

    public function index(Request $req)
    {

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

        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

         

        $investments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('users.id', $id)
            ->orderBy('user_investments.id', 'DESC')
            ->get(['users.name as username', 'users.email', 'investment_packages.name as packagename', 'investment_packages.id as package_id', 'user_investments.date', 'user_investments.id as investment_id', 'user_investments.end_date', 'investment_packages.category_name',
                'user_investments.amount',
                 'user_investments.returns', 
                 'investment_packages.duration', 
                 'user_investments.payout', 
                 'user_investments.available_fund_balance', 
                 'user_investments.active_interest_balance', 
                 'user_investments.invoice_url', 
                 'user_investments.active', 
                 'user_investments.status', 'user_investments.txn_id', 'user_investments.wallet_id', 'investment_packages.image',]);

        $hasPendingOnvestment=false;
        $totalPending=0;
        $totalCompleted=0;
        foreach($investments as $key => $invest) {
            if($invest->status=="pending"){
                $totalPending=$totalPending+1;
                $hasPendingOnvestment=true;
            }
            if($invest->status=="completed" || $invest->status=="pending_reinvest"){
                $totalCompleted=$totalCompleted+1;
             }
            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
                $d2 = strtotime($invest->end_date);
                $totalSecondsDiff = abs($d1 - $d2);
                $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
                if ($d1 < $d2 || $d1 > $d2) {
                    $dayLeft = 100;
                    if ($totalDaysDiff < 100) {
                        $dayLeft = $totalDaysDiff;
                    }
                    
                    $invest->days=$totalDaysDiff;
                    $invest->daysLeft=$dayLeft;

                }
             $invest->formatted_available_fund_balance = number_format($invest->available_fund_balance,2);
            $invest->formatted_active_interest_balance = number_format($invest->active_interest_balance,2);
        }

        return view('user.user-investments', ['user' => $user, "totalCompleted"=>$totalCompleted, "totalPending"=>$totalPending, "hasPendinginvestment"=> $hasPendingOnvestment, 'user_id' => $id, 'page_title' => "All Active Investment", 'investments' => $investments, 'username' => $user->name]);
    }

    public function show($id, Request $req)
    {

        $invest = UsersInvestments::findOrFail($id);
        $coins = [
            "BTC" => "https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=bitcoin:355mQbN9qvJc7YBCTteG5GmWNfSZE2CPLd",
            "LTC" => "https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=ltc1qk0z06l3wj4st337qku76uh3lyp8e40vfedxnep",
            "ETH" => "https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=ethereum:0xb385ec71af398a88afdcbb2e864c183865f900fb",
            "BCH" => "https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=qrrp5pwpt47sz8h8d5vkal2aj8j6rvd275rtk33rjd",
            "USDTTRC20" => "https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=ethereum:TMXhntAFBkqQ8YwfYMuFv8FVoGWE3dK5XN",
            "USDTERC20" => "https://chart.googleapis.com/chart?chs=200x200&chld=L|2&cht=qr&chl=ethereum:0x1eed138640e56f677bab3103c85230eae7cb8583"];

        $remitta_wallet = new Coinremitter($invest->currency);
        $param = [
            'invoice_id' => $invest->txn_id,
        ];
        //dd($param);
        try {
            $invoice = $remitta_wallet->get_invoice($param);

            if ($invoice["flag"] == 1) {

                $data = ["qr_code" => $coins[$invest->currency],
                    "wallet_hash" => $invoice['data']['address'], "pending_amount" => $invoice['data']['total_amount'][$invest->currency], "source_currency" => "USD", "currency" => $invest->currency];
                //dd($invoice['data']);
                return view('user.payment-sub', ["invoice" => $data, "time_left" => $invoice['data']['expire_on'], "amount" => $invest->amount]);

            } else {
                $req->session()->flash('error', $invoice['data']['msg']);
                return redirect('user/view-investments-portfolio');
            }
        } catch (\Exception$e) {
            $req->session()->flash('error', "Error occured while reteriving invoice");
            return redirect('user/view-investments-portfolio');
        }
    }

    public function edit($investid, Request $req)
    {

        function getDaysCount($date, $type){
            $d1 = strtotime(Carbon::now()->toDayDateTimeString());
                $d2 = strtotime($date);
                $totalSecondsDiff = abs($d1 - $d2);
                $totalDaysDiff = intval(round($totalSecondsDiff / 60 / 60 / 24));
                if ($d1 < $d2 || $d1 > $d2) {
                    $dayLeft = 100;
                    if ($totalDaysDiff < 100) {
                        $dayLeft = $totalDaysDiff;
                    }

                    if($type=="days"){
                        return $totalDaysDiff;
                    }else if($type=="daysLeft"){
                        return $dayLeft;
                    }
                    
                }
        }

        function get_payout($data)
        {
            if ($data == "bi_weekly") {
                return "Regular Bi Weekly";
            } else if ($data == "stacking_interest") {
                return "Fixed Stacking Interest";
            } else if ($data == "diverse_stacking_interest") {
                return "Diverse Stacking Interest";
            }else{
                return "Regular Bi Weekly";
            }
        }
        
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $activities = DB::table('users')
            ->join('activities', 'users.id', "=", 'activities.user_id')
            ->where('activities.user_investments_id', $investid)
            ->orderBy('activities.id', 'DESC')
            ->get();

        $total_accumulated=0.0;
        $total_withdawal=0.0;
        foreach ($activities as $key => $value) {
            if($value->category=="earning"){
                $total_accumulated=$total_accumulated+$value->amount;
            }
            if($value->category=="withdrawals"){
                $total_withdawal=$total_withdawal+$value->amount;
            }
        }


        $investment = UsersInvestments::where('id', $investid)->firstOrFail();
        $investment->days=getDaysCount($investment->end_date, "days");
        $investment->daysLeft=getDaysCount($investment->end_date, "daysLeft");
        $investment->package=Investment_Packages::where('id', $investment->investment_packages_id)->firstOrFail();
        $investment->formatted_available_fund_balance = number_format($investment->available_fund_balance,2);
        $investment->formatted_active_interest_balance = number_format($investment->active_interest_balance,2);

        $investment->formatted_amount = number_format($investment->amount,2);

        $investment->total_accumulated = $total_accumulated;
        $investment->formatted_total_accumulated = number_format($total_accumulated,2);

        $investment->total_withdawal = $total_withdawal;
        $investment->formatted_total_withdawal = number_format($total_withdawal,2);
        $investment->formatted_payout =get_payout($investment->payout);
        $investment->formatted_next_earn_date =Carbon::parse($investment->by_weekly_next_date)->toDayDateTimeString();
        $package=Investment_Packages::where('id', $investment->investment_packages_id)->firstOrFail();
        
        
        

        //dd($activities, $investid);
        return view('user.user-investment-view', ["activities"=>$activities,"package"=>$package,'user' => $user, 'user_id' => $id, 'username' => $user->name, 'page_title' => "Investment View", "investment"=>$investment] );

        
    }


}
