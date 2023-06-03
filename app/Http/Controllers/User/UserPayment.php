<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\Withdrawal_Methods;
use App\Models\WithdrawalRequests;
use App\Mail\UserRegisteredMail;
use Mail;
use Carbon\Carbon;
use App\Models\Activities;

class UserPayment extends Controller
{
    public function index(Request $req)
    {
      

        $id = auth()->id();

        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();

        $package = Investment_Packages::findOrFail($req['investment_packages_id']);
        if($req["amount"] < $package->min_amt){
            $req->session()->flash('error', "Invalid Purchase... you have insifficient amount to purchase this package");
            return redirect('user/view-investments-portfolio');
        }

        return view('user.user-payment', [
        'user'=>$user, 'user_id'=>$id,
        'page_title'=>"Purchase Summary",
        'username'=>$user->name,
        "main_wallet" => $user->main_wallet,
        "amount"=> $req["amount"] ,
        "compound_wallet" => $user->compound_wallet,
        "package"=>$package,
        "packageName" => $package->name,
        "min_percent" => $package->min_percent,
        "max_percent" => $package->max_percent,
        "compound_percent" => $package->compound_percent,
        "duration" => $package->duration,
        "user_id" => $id,
        "investment_packages_id" => $req["investment_packages_id"],
        "min_amt" => $package->min_amt,
        "max_amt" => $package->max_amt,
        "payment_method" => $req["payment_method"],
        "currency" => $req["currency"],
        "payout" => $req["payout"]]);

    }

    public function create(Request $req)
    {
        //dd($req);

        $id = auth()->id();

        $user = DB::table('users')
        ->join('user_infos','users.id',"=", 'user_infos.user_id')
        ->where('users.id',$id)
        ->get()->first();

        $package = Investment_Packages::findOrFail($req['investment_packages_id']);

        return view('user.receipt', [
        'user'=>$user, 'user_id'=>$id, 'page_title'=>"Purchase Summary",  'username'=>$user->name,
        "main_wallet" => $user->main_wallet,
        "amount"=> $req["amount"],
        "compound_wallet" => $user->compound_wallet,
        "packageName" => $package->name,
        "min_percent" => $package->min_percent,
        "max_percent" => $package->max_percent,
        "compound_percent" => $package->compound_percent,
        "duration" => $package->duration,
        "date"=>Carbon::now()->toDayDateTimeString(),
        "user_id" => $id,
        "investment_packages_id" => $req["investment_packages_id"],
        "min_amt" => $package->min_amt,
        "max_amt" => $package->max_amt,
        "payment_method" => $req["payment_method"],
        "currency" => $req["currency"],
        "payout" => $req["payout"]]);
        
    }

    public function store(Request $req)
    {
        if ($req['status'] == "completed" || $req['status'] == "mismatch" || $req['status'] == "expired") {
            $order = Payment_Orders::findOrFail($req['order_number']);

            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $order->user_id)
                ->get()->first();

            $invest = new UsersInvestments;
            $invest->user_id = $order->user_id;
            $invest->investment_packages_id = $order->investment_packages_id;
            $invest->date = Carbon::now()->toDayDateTimeString();
            $invest->end_date = date('Y-m-d', strtotime("+9 months", strtotime(Carbon::now()->toDayDateTimeString())));
            $invest->amount = $order->amount;
            $invest->duration = 9;
            $invest->returns = $order->returns;
            $invest->payout = $order->payout;
            $invest->active = true;
            $invest->save();

            //Save Activity
            $activity = new Activities;
            $activity->title = "Investment initialised";
            $activity->user_id = $order->user_id;
            $activity->user_investments_id = $invest->id;
            $activity->investment_packages_id = $order->investment_packages_id;
            $activity->category = "deposit";
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->amount = $order->amount;
            $activity->descp = "Deposit of {$order->amount} made for investment";
            $activity->save();

            //Send Mails
            //Send mail
            Mail::to($user->email)->send(new UserRegisteredMail([
                'subject' => 'Congratulations on your Portfolio Purchase',
                'title' => "Congratulations {$user->name} {$user->last_name}",
                'url' => "{$req->getSchemeAndHttpHost()}/user/user-investments",
                'descp' => 'We are delighted to inform you that your portfolio purchase has been received successfully. Your Investor account will be activated shortly. This is the best step you could possibly take toward regaining control of your financial life. Our key Goal is providing efficient and reliable financial services to our clients. We very much admire your shrewdness in taking this decisive action now. There is every reason to believe you are on your way to the top!',
                'action-text' => 'Client Access',
                'img' => 'assets/images/emails/investment-banner.jpg',
            ]));

            

            //return  ["res"=>"Investment made successful"];

        }
        //return  ["res"=>"An error occured'"];
    }
}
