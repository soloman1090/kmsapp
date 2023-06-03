<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\Investment_Packages;
use App\Models\UserInfo;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Coinremitter\Coinremitter;
use Mail;
use GuzzleHttp\Client;

class ViewPortfolios extends Controller
{
    public function index()
    {
        $packages = Investment_Packages::all();
        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        return view('user.view-portfolio', ['user' => $user, 'user_id' => $id, 'page_title' => " ", 'packages' => $packages, 'username' => $user->name]);
    }

    public function store(Request $req)
    {
        $id = auth()->id();
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();
        $callBackUrl = $req->getSchemeAndHttpHost() . "/payment";

        //Create Order
        $package = Investment_Packages::findOrFail($req['investment_packages_id']);
        $bonus_amount=0;
        $main_amount=$req['amount'];
        if($package->bonus_percentage!=null && $package->bonus_percentage>0){
            $bonus_amount=$req["amount"]*$package->bonus_percentage;
            if($main_amount>=5000){
                $main_amount=$main_amount+$bonus_amount;
            }
        }

        if (
            $req['payout'] == "6_months_compounding" ||
            $req['payout'] == "7_months_compounding" ||
            $req['payout'] == "8_months_compounding" ||
            $req['payout'] == "9_months_compounding" ||
            $req['payout'] == "10_months_compounding"||
            $req['payout'] == "pods") {
            $percentage = $package->compound_percent / 100;
        } else {
            $percentage = $package->min_percent / 100;
        }
        $creditAmount = $percentage * $main_amount;
        $order_name = "$package->name-" . Carbon::now()->timestamp;

    
        //$secretKey = env('PLISIO_SECRET_KEY');
        // $paymentData = [
        //     'amount' => $req['amount'], 
        //     'amount_usd' => $req['amount'],  
        //     'currency' => $req['currency'],  
        //     'order_number' => $order_name,  
        //     'order_name' => $order_name,  
        //     'email' => $user->email,
        //     'description' => "Wants to make payment",  
        //     'callback_url' => $callBackUrl,
        //     'success_url' => $callBackUrl,  
        // ];

        $coinRemitter=new Coinremitter($req['currency']);
        
        $paymentData = [
            'amount' => $req['amount'], // required Invoice amount in selected currency OR amount_usd can be used instead
            'currency' => "USD", // required (ETH, BTC, LTC, TZEC, DOGE, BCH, ...)
            'name' =>  str_replace(" ","-",$user->name),
            'expire_time'=>'240',
            'description' => "Wants to make payment", // optional any description
        ];
         
        
       

        if ($req['payment_method'] == "direct_deposit") {
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
                        $invest->wallet_id=$invoice['data']['address'];
                        $invest->invoice_url=$invoice['data']['url'];
                        $invest->currency=$req['currency'];
                        $invest->payout = $req['payout'];
                        $invest->active = false;
                        $invest->status = "pending";
                        $invest->save();
                        $req['payout'] == "pods"?$invoice['data']["confirm_url"]="value-pods":$invoice['data']["confirm_url"]="user-investments"  ;
                    
                        //return view('user.payment', ['invoice' => $invoice['data'], 'amount' => $req['amount'], 'time_left' => $invoice['data']['expire_utc']]);
                        //return view('user.remitter-pay', ['invoice' => $invoice['data']["url"]]);
                        return redirect("user/user-investments/".$invest->id);
                    } else {
                        $req->session()->flash('error', $invoice['msg']);
                    return redirect('user/view-investments-portfolio');
                    }
                } catch (\Exception $e) {
                    $req->session()->flash('error', 'An error occured');
                    return redirect('user/view-investments-portfolio');
                }
           
        } elseif ($req['payment_method'] == "main_wallet" || $req['payment_method'] == "compound_wallet") {
            try {
                
                $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();

                if ($req['payment_method'] == "main_wallet") {
                    if ($req['amount'] > $user->main_wallet) {
                        $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Main Wallet.');
                        if($req["quick_purchase"]){
                            return redirect('user/dashboard');
                        }else{
                            return redirect('user/view-investments-portfolio');
                        }
                    }else {
                        $userInfo->main_wallet = $userInfo->main_wallet - $req['amount'];
                        $userInfo->update();
                    }
                } 

                if ($req['payment_method'] == "compound_wallet") {

                    if( $req['payout']=="daily_payout" ||  $req['payout']=="monthly_payout"){
                        $req->session()->flash('error', 'Sorry you cannot make a daily plan investment with your compound wallet');
                        if($req["quick_purchase"]){
                            return redirect('user/dashboard');
                        }else{
                            return redirect('user/view-investments-portfolio');
                        }
                    }
                    if ($req['amount'] > $user->compound_wallet) {
                        $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Compound Wallet.');
                        if($req["quick_purchase"]){
                            return redirect('user/dashboard');
                        }else{
                            return redirect('user/view-investments-portfolio');
                        }
                        
                    }else {
                        $userInfo->compound_wallet = $userInfo->compound_wallet - $req['amount'];
                        $userInfo->update();
                    }
                } 

 
                $invest = new UsersInvestments();
                $invest->user_id = $user->user_id;
                $invest->investment_packages_id = $req['investment_packages_id'];
                $invest->date = Carbon::now()->toDayDateTimeString();
                $invest->end_date = date('Y-m-d', strtotime("+{$package->duration} months", strtotime(Carbon::now()->toDayDateTimeString())));
                $invest->amount = $req['amount'];
                $invest->duration = $package->duration;
                $invest->returns = $creditAmount;
                $invest->txn_id = "wallet";
                $invest->payout = $req['payout'];
                $invest->active = true;
                $invest->status = "completed";
                $invest->save();

                try{
                    Mail::to($user->email)->send(new UserRegisteredMail([
                        'subject' => 'Congratulations on your Portfolio Purchase',
                        'title' => "Congratulations {$user->name} {$user->last_name}",
                        'url' => "https://palmalliance.com/user/user-investments",
                        'descp' => "We are delighted to inform you that your portfolio purchase of {$package->name}
        has been received and activated successfully. ",
                        'action-text' => 'Client Access',
                        'img' => 'assets/images/emails/investment-banner.jpg',
                    ]));
    
                }catch(\Exception $e){

                }
                
                $activity = new Activities;
                $activity->title = "Investment initialized";
                $activity->user_id = $user->user_id;
                $activity->user_investments_id = $invest->id;
                $activity->investment_packages_id = $package->id;
                $activity->category = "deposit";
                $activity->date = Carbon::now()->toDayDateTimeString();
                $activity->amount = $req['amount'];
                $activity->descp = "Deposit of $ {$req['amount']} made for {$package->name} from {$req['payment_method']}";
                //dd($activity);
                $activity->save();

                $req->session()->flash('success', "Purchased of $ {$req['amount']} {$package->name} was successfully");
                return redirect('user/user-investments');
            } catch (\Exception$e) {
                $req->session()->flash('error', 'An error occured');
                return redirect('user/view-investments-portfolio');
            }
        }
    }
}
