<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Investment_Packages;
use App\Models\Reinvest;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Coinremitter\Coinremitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReinvestContoller extends Controller
{
    public function store(Request $req)
    {
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $userInfo = UserInfo::where("user_id", $id)->get()->first();

        $callBackUrl = $req->getSchemeAndHttpHost() . "/payment";

        $withdrawalRequests = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
            ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
            ->where('users.id', $id)->where('withdrawal_requests.approved', false)->get();

        if ($req['amount'] < 100) {
            $req->session()->flash('error', 'Insufficient Amount ... Minimum reinvestment amount is $100');
            return redirect('user/user-investments');
        }
        //Create Order

        // $secretKey = env('PLISIO_SECRET_KEY');
        // $paymentData = [
        //     'amount' => $req['amount'], // required Invoice amount in selected currency OR amount_usd can be used instead
        //     'amount_usd' => $req['amount'], // required Invoice amoint in USD
        //     'currency' => $req['currency'], // required (ETH, BTC, LTC, TZEC, DOGE, BCH, ...)
        //     'order_number' => Carbon::now()->timestamp, // required Client's internal ID
        //     'order_name' => $user->name, // required Client's internal name
        //     'email' => $user->email,
        //     'description' => "Wants to make payment", // optional any description
        //     'callback_url' => $callBackUrl,
        //     'success_url' => $callBackUrl, // optional Absolute URL of the final (success) invoice link
        // ];

        $coinRemitter = new Coinremitter($req['currency']);
        $paymentData = [
            'amount' => $req['amount'], // required Invoice amount in selected currency OR amount_usd can be used instead
            'currency' => "USD", // required (ETH, BTC, LTC, TZEC, DOGE, BCH, ...)
            'name' => str_replace(" ","-",$user->name),
            'expire_time' => '240',
            'description' => "Wants to make payment", // optional any description
        ];
        $userInvestment = UsersInvestments::where("id", $req['investment_id'])->get()->first();

        $package = Investment_Packages::findOrFail($userInvestment->investment_packages_id);
        if ($userInvestment->payout == "6_months_compounding" ||
            $userInvestment->payout == "7_months_compounding" ||
            $userInvestment->payout == "8_months_compounding" ||
            $userInvestment->payout == "9_months_compounding" ||
            $userInvestment->payout == "10_months_compounding") {
            $percentage = $package->compound_percent / 100;
        } else {
            $percentage = $package->max_percent / 100;
        }
        $reinvestmentAmount = $req['amount'] + $userInvestment->amount;
        $creditAmount = $percentage * $reinvestmentAmount;
        $userInvestment->status = "pending_reinvest";

         if ($req['payment_method'] == "direct_deposit") {

            //$plisio = new \Plisio\ClientAPI($secretKey);
            try {
                $invoice = $coinRemitter->create_invoice($paymentData);
                if ($invoice && isset($invoice['data']) && $invoice['data']['status'] == 'Pending') {
                    $invest = new Reinvest;
                    $invest->user_id = $id;
                    $invest->user_investments_id = $req['investment_id'];
                    $invest->date = Carbon::now()->toDayDateTimeString();
                    $invest->amount = $reinvestmentAmount; 
                    $invest->topup_amount = $req['amount'];
                    $invest->returns = $creditAmount;
                    $invest->txn_id = $invoice['data']['invoice_id'];
                    $invest->wallet_id = $invoice['data']['address'];
                    $invest->invoice_url=$invoice['data']['url']; 
                    $invest->currency=$req['currency'];
                    $invest->active = false;
                    $invest->status = "pending";
                    $invest->save();
                    
                    $userInvestment->invoice_url = $invoice['data']['url'];
                    $userInvestment->currency=$req['currency'];
                    $userInvestment->txn_id = $invoice['data']['invoice_id'];
                    $userInvestment->update();
                    $invoice['data']["confirm_url"] = "user-investments";

                    //return view('user.payment', ['invoice' => $invoice['data'], 'amount' => $req['amount'], 'time_left' => $invoice['data']['expire_utc']]);
                    //return view('user.remitter-pay', ['invoice' => $invoice['data']["url"]]);

                    return redirect("user/user-investments/".$req['investment_id']);
                } 
                    else {
                        $req->session()->flash('error', $invoice['msg']);
                    return redirect('user/user-investments');
                }
            } catch (\Exception$e) {
                $req->session()->flash('error', 'An error occured');
                return redirect('user/user-investments');
            }

        } else if ($req['payment_method'] == "main_wallet") {
            // if (count($withdrawalRequests) > 0) {
            //     $req->session()->flash('error', 'Please you already have a pending withdrawal request on your wallet, wait for approval or delete the previous request and try again');
            //     return redirect('user/withdrawal-history');
            // }
            if ($userInfo->main_wallet > $req['amount']) {
                $userInfo->main_wallet = $userInfo->main_wallet - $req['amount'];
                $userInfo->update();
                $userInvestment->update();
                $invest = new Reinvest;
                $invest->user_id = $id;
                $invest->user_investments_id = $req['investment_id'];
                $invest->date = Carbon::now()->toDayDateTimeString();
                $invest->amount = $reinvestmentAmount;
                $invest->returns = $creditAmount;
                $invest->topup_amount = $req['amount'];
                $invest->txn_id = null;
                $invest->active = false;
                $invest->status = "pending";
                $invest->save();

                $req->session()->flash('success', 'Pending Purchase ... Awaiting payment confirmation, Please reload to confirm!');
                return redirect('user/user-investments');
            } else {
                $req->session()->flash('error', 'You dont not have enough funds in your Portfolio Balance to make this purchase ');
                return redirect('user/user-investments');
            }

        } else if ($req['payment_method'] == "compound_wallet") {
            // if (count($withdrawalRequests) > 0) {
            //     $req->session()->flash('error', 'Please you already have a pending withdrawal request on your wallet, wait for approval or delete the previous request and try again');
            //     return redirect('user/user-investments');
            // }

            if ($userInvestment->payout == "daily_payout" || $userInvestment->payout == "monthly_payout") {
                $req->session()->flash('error', 'Sorry you cannot reinvest with a daily plan investment');
                return redirect('user/user-investments');
            }
            if ($userInfo->compound_wallet > $req['amount']) {
                $userInfo->compound_wallet = $userInfo->compound_wallet - $req['amount'];
                $userInfo->update();
                $userInvestment->update();
                $invest = new Reinvest;
                $invest->user_id = $id;
                $invest->user_investments_id = $req['investment_id'];
                $invest->date = Carbon::now()->toDayDateTimeString();
                $invest->amount = $reinvestmentAmount;
                $invest->returns = $creditAmount;
                $invest->topup_amount = $req['amount'];
                $invest->txn_id = null;
                $invest->active = false;
                $invest->status = "pending";
                $invest->save();

                $req->session()->flash('success', 'Pending Purchase ... Awaiting payment confirmation, Please reload to confirm!');
                return redirect('user/user-investments');
            } else {
                $req->session()->flash('error', 'You dont not have enough funds in your Compound Dividend to make this purchase ');
                return redirect('user/user-investments');
            }

        }

    }
}
