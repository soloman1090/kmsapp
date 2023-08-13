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
        if ($userInvestment->payout == "bi_weekly") {
            $percentage = $package->min_percent / 100;
        } else if ($userInvestment->payout == "stacking_interest" || $userInvestment->payout == "diverse_stacking_interest") {
            $percentage = $package->compound_percent / 100;
         } else {
            $percentage = $package->min_percent / 100;
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

                    
                    return redirect("user/user-investments/".$req['investment_id']);
                } 
                    else {
                        $req->session()->flash('error', $invoice['msg']);
                        return redirect($req['page_url']);
                }
            } catch (\Exception$e) {
                $req->session()->flash('error', 'An error occured');
                return redirect($req['page_url']);
            }

        } else if ($req['payment_method'] == "available_funds" || $req['payment_method'] == "active_interest" || $req['payment_method'] == "referral_commission") {
            
            $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();
                $investment = null;
            if ($req['payment_method'] == "available_funds") {
                $investment = UsersInvestments::where('id', $req['investment_id'])->firstOrFail();
                if ($req['amount'] > $investment->available_fund_balance) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in  Active Funds.');
                    return redirect($req['page_url']);
                } else {
                    $investment->available_fund_balance = $investment->available_fund_balance - $req['amount'];
                    $investment->update();
                }
            }

            if ($req['payment_method'] == "active_interest") {
                $investment = UsersInvestments::where('id', $req['investment_id'])->firstOrFail();
                if ($req['amount'] > $investment->active_interest_balance) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in  Active Interest Funds.');
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

           

        } 

    }
}
