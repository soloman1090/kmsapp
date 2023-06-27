<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investment_Packages;
use App\Models\Reinvest;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use App\Models\WithdrawalRequests;
use App\Models\Withdrawal_Methods;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiReinvestment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        return ['error' => true, "msg" =>"Reinvestments through MOBILE devices are closed temporarily... Please use your WEB to make purchases and reinvestments  ", "type" => "INVALID_CREDENTIAL"];

        $id = $req->user_id;
        $user = User::where('users.id', $id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();
        if ($user) {

            $userInfo = UserInfo::where("user_id", $id)->get()->first();
            $withdrawalRequests = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
                ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
                ->where('users.id', $id)->where('withdrawal_requests.approved', false)->get();

            $callBackUrl = $req->getSchemeAndHttpHost() . "/payment";
            $localQrcode = "";
            //Create Order

            if($req['amount'] < 100){ 
                return ['error' => true, "msg" => "Insifficient Amount ... Minimum reinvestment amount is $100", "type" => "INVALID_CREDENTIAL"];
            }

            $secretKey = env('PLISIO_SECRET_KEY');
            $paymentData = [
                'amount' => $req['amount'], // required Invoice amount in selected currency OR amount_usd can be used instead
                'amount_usd' => $req['amount'], // required Invoice amoint in USD
                'currency' => $req['currency'], // required (ETH, BTC, LTC, TZEC, DOGE, BCH, ...)
                'order_number' => Carbon::now()->timestamp, // required Client's internal ID
                'order_name' => $user->name, // required Client's internal name
                'email' => $user->email,
                'description' => "Wants to make payment", // optional any description
                'callback_url' => $callBackUrl,
                'success_url' => $callBackUrl, // optional Absolute URL of the final (success) invoice link
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

                $plisio = new \Plisio\ClientAPI($secretKey);
                try {
                    $invoice = $plisio->createTransaction($paymentData);
                    if ($invoice && isset($invoice['status']) && $invoice['status'] == 'success') {
                        $invest = new Reinvest;
                        $invest->user_id = $id;
                        $invest->user_investments_id = $req['investment_id'];
                        $invest->date = Carbon::now()->toDayDateTimeString();
                        $invest->amount = $reinvestmentAmount;
                        $invest->topup_amount = $req['amount'];
                        $invest->returns = $creditAmount;
                        $invest->txn_id = $invoice['data']['txn_id'];
                        $invest->wallet_id=$invoice['data']['wallet_hash'];
                        $invest->active = false;
                        $invest->status = "pending";
                        $invest->save();
                        $userInvestment->update();

                        return ['invoice' => $invoice['data'], 'amount' => $req['amount'], 'time_left' => $invoice['data']['expire_utc'], 'currency' => $req['currency']];
                    } else {

                        return ['error' => true, "msg" => $invoice['data']['message'], "type" => "INVALID_CREDENTIAL"];
                    }
                } catch (\Exception$e) {

                    return ['error' => true, "msg" => "An error occured", "type" => "INVALID_CREDENTIAL"];
                }

                // if ($req['currency'] == "TRX" || $req['currency'] == "Erc20" || $req['currency'] == "Trc20" || $req['currency'] == "ETH") {
                //     $invest = new Reinvest;
                //     $invest->user_id = $id;
                //     $invest->user_investments_id = $req['investment_id'];
                //     $invest->date = Carbon::now()->toDayDateTimeString();
                //     $invest->amount = $reinvestmentAmount;
                //     $invest->topup_amount = $req['amount'];
                //     $invest->returns = $creditAmount;
                //     $invest->txn_id = $req['currency'];
                //     $invest->active = false;
                //     $invest->status = "pending";
                //     $invest->save();
                //     $userInvestment->update();

                //     $invoice;
                //     $currency = $req['currency'];
                //     if ($currency == "TRX") {
                //         $invoice = ["status" => "new", "pending_amount" => "", "currency" => "TRX", "source_currency" => "USD", "wallet_hash" => "TPQGQEim5DPuhsYdwRKRuLVYQK8Pkc4JQU", "qr_code" => asset('user-assets/images/trx-img.PNG')];
                //     }

                //     if ($currency == "Erc20") {
                //         $invoice = ["status" => "new", "pending_amount" => "", "currency" => "Erc20", "source_currency" => "USD", "wallet_hash" => "0x91f9dD104b8f7504252BeF0587D1722e82aE4A0c", "qr_code" => asset('user-assets/images/erc-20.jpg')];
                //     }

                //     if ($currency == "Trc20") {
                //         $invoice = ["status" => "new", "pending_amount" => "", "currency" => "Trc20", "source_currency" => "USD", "wallet_hash" => "TM6SiNJxaT6PVCfa4rQEyhKBHbJrcDNuXD", "qr_code" => asset('user-assets/images/trc-20.jpg')];
                //     }

                //     if ($currency == "ETH") {
                //         $invoice = ["status" => "new", "pending_amount" => "", "currency" => "ETH", "source_currency" => "USD", "wallet_hash" => "0x3beF7338feafD3383a910d81b317627f118178A0", "qr_code" => asset('user-assets/images/etherum.jpg')];
                //     }

                //     Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                //         'subject' => 'Pending Investment',
                //         'title' => "Hi Admin",
                //         'url' => "{$req->getSchemeAndHttpHost()}/admin/users-investments",
                //         'descp' => "A user just made a Reinvestment of {$req['amount']} with {$req['currency']}  Please Login to activate portfolio",
                //         'action-text' => 'Approve Reinvestment',
                //         'img' => 'assets/images/emails/Dell Group--Management-Building.jpg',
                //     ]));
                //     return ["invoice" => $invoice, 'amount' => $req['amount'], 'time_left' => Carbon::now()->addMinutes(30)->timestamp, 'currency' => $req['currency']];

                // } else {

                // }

            } else if ($req['payment_method'] == "main_wallet") {

                // if (count($withdrawalRequests) > 0) {
                //     return ['error' => true, "msg" => "Please you already have a pending withdrawal request on your wallet, wait for approval or delete the previous request and try again", "type" => "INVALID_CREDENTIAL"];
                // }else 
                
                if ($userInfo->main_wallet >= $req['amount']) {
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

                    return ["success" => true, "msg" => "Capital has been withdrawn to your wallet.....! Start a new investment or withdraw from your wallet"];
                } else {
                    return ['error' => true, "msg" => "You dont not have enough funds in your Portfolio Balance to make this purchase", "type" => "INVALID_CREDENTIAL"];
                }

            } else if ($req['payment_method'] == "compound_wallet") {
                // if (count($withdrawalRequests) > 0) {
                //     return ['error' => true, "msg" => "Please you already have a pending withdrawal request on your wallet, wait for approval or delete the previous request and try again", "type" => "INVALID_CREDENTIAL"];
                // }else  
                
                if( $req['payout']=="daily_payout" ||  $req['payout']=="monthly_payout"){
    
                    return ['error' => true, "msg" => "Sorry you cannot make a daily plan investment with your compound wallet", "type" => "INVALID_CREDENTIAL"];
                }else
                if ($userInfo->compound_wallet >= $req['amount']) {
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
                    return ["success" => true, "msg" => "Pending Purchase ... Awaiting payment confirmation, Please reload to confirm!"];
                } else {

                    return ['error' => true, "msg" => "You dont not have enough funds in your Compound Dividend to make this purchase", "type" => "INVALID_CREDENTIAL"];
                }
            }
        } else {
            return ['error' => true, "msg" => "user not found", "type" => "INVALID_CREDENTIAL"];
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
