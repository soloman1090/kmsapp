<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppPaginator;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiPortfolios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if ($request->has('user_id')) {
            $id = $request->input("user_id");
            $user = User::where('users.id', $id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();
            $packages = Investment_Packages::all();
            $AppPaginator = new AppPaginator;
            $myCollectionObj1 = collect($packages);
            $packages = $AppPaginator->paginate($myCollectionObj1, "api/portfolios?user_id=$id");

            return ['user' => $user, 'packages' => $packages];
        } else {
            return ['error' => true, "msg" => "user not found", "type" => "INVALID_CREDENTIAL"];
        }
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
        //
        return ['error' => true, "msg" =>"Investment Purchases through MOBILE devices are closed temporarily... Please use your WEB to make purchases and reinvestments  ", "type" => "INVALID_CREDENTIAL"];

        $id = $req->user_id;
        $callBackUrl = $req->getSchemeAndHttpHost() . "/payment";

        $user = User::where('users.id', $id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();
        $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
        $package = Investment_Packages::findOrFail($req['investment_packages_id']);
        $investAmount=$req['amount'];

        if($req["amount"] < $package->min_amt){
            return ['error' => true, "msg" =>"Invalid Purchase... you have insifficient amount to purchase this package", "type" => "INVALID_CREDENTIAL"];
        }

        
        if($package->bonus_percentage!=null && $package->bonus_percentage>0){
            $bonus_amount=$req["amount"]*$package->bonus_percentage;
            if($investAmount>=5000){
                $investAmount=$investAmount+$bonus_amount;
            }
        }

         

        if ($user) {
            

            if ($req['payout'] == "6_months_compounding" ||
                $req['payout'] == "7_months_compounding" ||
                $req['payout'] == "8_months_compounding" ||
                $req['payout'] == "9_months_compounding" ||
                $req['payout'] == "10_months_compounding") {
                $percentage = $package->compound_percent / 100;
            } else {
                $percentage = $package->min_percent / 100;
            }
            $creditAmount = $percentage * $investAmount;

           

            //20 Percentage Added
            $order_name = "$package->name-" . Carbon::now()->timestamp;

            $secretKey = env('PLISIO_SECRET_KEY');
            $paymentData = [
                'amount' => $investAmount, // required Invoice amount in selected currency OR amount_usd can be used instead
                'amount_usd' => $investAmount, // required Invoice amoint in USD
                'currency' => $req['currency'], // required (ETH, BTC, LTC, TZEC, DOGE, BCH, ...)
                'order_number' => $order_name, // required Client's internal ID
                'order_name' => $order_name, // required Client's internal name
                'email' => $user->email,
                'description' => "Wants to make payment", // optional any description
                'callback_url' => $callBackUrl,
                'success_url' => $callBackUrl, // optional Absolute URL of the final (success) invoice link
            ];
            if ($req['payment_method'] == "direct_deposit") {
                $plisio = new \Plisio\ClientAPI($secretKey);
                    try {
                        $invoice = $plisio->createTransaction($paymentData);
                        if ($invoice && isset($invoice['status']) && $invoice['status'] == 'success') {

                            $invest = new UsersInvestments;
                            $invest->user_id = $user->user_id;
                            $invest->investment_packages_id = $req['investment_packages_id'];
                            $invest->date = Carbon::now()->toDayDateTimeString();
                            $invest->end_date = date('Y-m-d', strtotime("+{$req['duration']} months", strtotime(Carbon::now()->toDayDateTimeString())));
                            $invest->amount = $investAmount;
                            $invest->duration = $package->duration;
                            $invest->returns = $creditAmount;
                            $invest->txn_id = $invoice['data']['txn_id'];
                            $invest->wallet_id=$invoice['data']['wallet_hash'];
                            $invest->payout = $req['payout'];
                            $invest->active = false;
                            $invest->status = "pending";
                            $invest->save();

                            return ['invoice' => $invoice['data'], 'amount' => $investAmount, 'time_left' => $invoice['data']['expire_utc']];
                        } else {

                            return ['error' => true, "msg" => $invoice['data']['message'], "type" => "INVALID_CREDENTIAL"];
                        }
                    } catch (\Exception$e) {

                        return ['error' => true, "msg" => "An error occured, while purchasing portfolio", "type" => "INVALID_CREDENTIAL"];
                    }
                // if ($req['currency'] == "TRX" || $req['currency'] == "Erc20" || $req['currency'] == "Trc20" || $req['currency'] == "ETH") {

                //     $invest = new UsersInvestments;
                //     $invest->user_id = $user->user_id;
                //     $invest->investment_packages_id = $req['investment_packages_id'];
                //     $invest->date = Carbon::now()->toDayDateTimeString();
                //     $invest->end_date = date('Y-m-d', strtotime("+{$req['duration']} months", strtotime(Carbon::now()->toDayDateTimeString())));
                //     $invest->amount = $investAmount;
                //     $invest->duration = $package->duration;
                //     $invest->returns = $creditAmount;
                //     $invest->txn_id = $req['currency'];
                //     $invest->payout = $req['payout'];
                //     $invest->active = false;
                //     $invest->status = "pending";
                //     $invest->save();
                    //Send Admin Mail
                    // Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                    //     'subject' => 'Pending Investment',
                    //     'title' => "Hi Admin",
                    //     'url' => "{$req->getSchemeAndHttpHost()}/admin/users-investments",
                    //     'descp' => "A user just made an investment of {$investAmount} with {$req['currency']}  Please Login to activate portfolio",
                    //     'action-text' => 'Approve Portfolio',
                    //     'img' => 'assets/images/emails/Dell Group--Management-Building.jpg',
                    // ]));
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

                //     return ["invoice" => $invoice, 'amount' => $investAmount, 'time_left' => Carbon::now()->addMinutes(30)->timestamp, 'currency' => $req['currency']];

                // } else {
                    
                // }
            } else {
                $success = false;
                if ($req['payment_method'] == "main_wallet") {
                    if ($user->main_wallet >= $investAmount) {
                        $userInfo->main_wallet = $userInfo->main_wallet - $investAmount;
                        $userInfo->update();
                        $success = true;
                    } else {
                        return ['error' => true, "msg" => "You dont not have enough funds in your Portfolio Balance to make this purchase", "type" => "INVALID_CREDENTIAL"];
                    }

                }

                if ($req['payment_method'] == "compound_wallet") {
                    if( $req['payout']=="daily_payout" ||  $req['payout']=="monthly_payout"){
    
                        return ['error' => true, "msg" => "Sorry you cannot make a daily plan investment with your Active Interest Funds", "type" => "INVALID_CREDENTIAL"];
                    }else{
                        if ($user->compound_wallet >= $investAmount) {
                            $userInfo->compound_wallet = $userInfo->compound_wallet - $investAmount;
                            $userInfo->update();
                            $success = true;
                        } else {
                            return ['error' => true, "msg" => "You dont not have enough funds in your Compound Balance to make this purchase", "type" => "INVALID_CREDENTIAL"];
                        }
                    }

                   

                }

                if ($success == true) {
                    $invest = new UsersInvestments;
                    $invest->user_id = $user->user_id;
                    $invest->investment_packages_id = $req['investment_packages_id'];
                    $invest->date = Carbon::now()->toDayDateTimeString();
                    
                    $invest->end_date = date('Y-m-d', strtotime("+{$package->duration} months", strtotime(Carbon::now()->toDayDateTimeString())));
                    $invest->amount = $investAmount;
                    $invest->duration = $package->duration;
                    $invest->returns = $creditAmount;
                    $invest->txn_id = $req['currency'];
                    $invest->payout = $req['payout'];
                    $invest->active = true;
                    $invest->status = "completed";
                    $invest->save();

                    $activity = new Activities;
                    $activity->title = "Investment initialized";
                    $activity->user_id = $user->user_id;
                    $activity->user_investments_id = $invest->id;
                    $activity->investment_packages_id = $req['investment_packages_id'];
                    $activity->category = "deposit";
                    $activity->date = Carbon::now()->toDayDateTimeString();
                    $activity->amount = $investAmount;
                    $activity->descp = "Deposit of $ {$investAmount} made for {$package->name} from {$req['payment_method']}";
                    //dd($activity);
                    $activity->save();

                    return ["success" => true, "msg" => "Portfolio purchased successfully"];
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
