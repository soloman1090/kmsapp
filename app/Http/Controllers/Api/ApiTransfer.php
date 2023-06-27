<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class ApiTransfer extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('user_id')) {
            $id =$request->input("user_id");

            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $id)
                ->get()->first();

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
                    $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
                    $userInfo->code_2fa = $code;
                    $userInfo->update();
                    
                

                    Mail::to($user->email)->send(new UserRegisteredMail([
                        'subject' => '2FA Authentication Code',
                        'title' => "The 2FA code is:\n $code",
                        'url' => "{$request->getSchemeAndHttpHost()}/user/dashboard",
                        'descp' => "The verification code will be valid for 30 minutes. Please do not share your code with anyone.\n Protecting your account is our top priority. Please confirm your withdrawal by entering this code above on the withdrawal form.",
                        'action-text' => 'Back To Transfer',
                        'img' => 'assets/images/emails/withdrawal-banner.jpg',
                    ]));
                    return ['success' => true, "msg" => "2FA CODE has been sent to your email", ];
                }
            } catch (\Exception $e) {
return ['error' => true, "msg" => "Error sending OTP", "type" => "INVALID_CREDENTIAL"];
            }

        } else {
            return ['error' => true, "msg" => "user not found", "type" => "INVALID_CREDENTIAL"];
        }
    }

    public function store(Request $req)
    {

        function getWalletType($data)
        {
            switch ($data) {
                case 'main_wallet':
                    return "Portfolio Balance";
                    break;
                case 'compound_wallet':
                    return "Compounding Dividends";
                    break;

            }
        }

        $wallet_type = getWalletType($req['wallet_type']);

        $id = auth()->id();
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $re_user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.email', $req['email'])
            ->get()->first();

        if ($re_user == null) {
             
            return ['error' => true, "msg" => "Invalid Email Address,...Sorry this is not a registered account on Dell Group ", "type" => "INVALID_CREDENTIAL"];
            
        }

        if ($user->email == $req['email']) {
             
            return ['error' => true, "msg" => "Invalid Operation,...Sorry you cannot transfer to your account.", "type" => "INVALID_CREDENTIAL"];
            
        }

        $userNum1 = UserInfo::where('user_id', auth()->id())->firstOrFail();

        $userNum2 = UserInfo::where('user_id', $re_user->user_id)->firstOrFail();
        //dd($req);

        if ($req['2fa'] != $user->code_2fa) { 
            return ['error' => true, "msg" => "Unauthorized Request,...Please this is a wrong 2FA CODE, get the code sent to your email and make the request again.", "type" => "INVALID_CREDENTIAL"];

        }

        if ($req['wallet_type'] == "main_wallet") {
            if ($req['amount_paid'] > $user->main_wallet) {
                 
                return ['error' => true, "msg" => "Insufficient amount,...sorry you do not enough amount in your Main Wallet.", "type" => "INVALID_CREDENTIAL"];

            } else {
                $userNum1->main_wallet = $userNum1->main_wallet - $req['amount_paid'];
                $userNum2->main_wallet = $userNum2->main_wallet + $req['amount_paid'];
            }
        }

        if ($req['wallet_type'] == "compound_wallet") {
            if ($req['amount_paid'] > $user->compound_wallet) {
                return ['error' => true, "msg" => "Insufficient amount,...sorry you do not enough amount in your Compound Wallet.", "type" => "INVALID_CREDENTIAL"];
            } else {
                $userNum1->compound_wallet = $userNum1->compound_wallet - $req['amount_paid'];
                $userNum2->compound_wallet = $userNum2->compound_wallet + $req['amount_paid'];
            }
        }

        //Save Activity user 1
        $activity = new Activities;
        $activity->title = "Inter Account Transfer";
        $activity->user_id = auth()->id();
        $activity->category = "withdrawals";
        $activity->date = Carbon::now()->toDayDateTimeString();
        $activity->amount = $req['amount_paid'];
        $activity->descp = "Tranfer from your $wallet_type to {$req['email']} was successful";
        $activity->save();

        //Save Activity user 2
        $activity = new Activities;
        $activity->title = "Deposit";
        $activity->user_id = $userNum2->user_id;
        $activity->category = "deposit";
        $activity->date = Carbon::now()->toDayDateTimeString();
        $activity->amount = $req['amount_paid'];
        $activity->descp = "Deposit from {$user->email} to your $wallet_type was successful";
        $activity->save();

        $userNum1->code_2fa = null;
        $userNum1->update();
        $userNum2->update();

        //Send Mail
        $date = Carbon::now()->toDayDateTimeString();
        try {
            Mail::to($user->email)->send(new UserRegisteredMail([
                'subject' => 'Inter Account Transfer',
                'title' => "Hello {$user->name}",
                'url' => "{$req->getSchemeAndHttpHost()}/user/withdrawal-history",
                'descp' => "A recent transfer of $ {$req['amount_paid']} was made on {$date} to the Account Address:...... {$req['email']} ",
                'action-text' => 'Client Access',
                'img' => 'assets/images/emails/withdrawal-banner.jpg',
            ]));

            //Send User 2 Mail
            Mail::to($re_user->email)->send(new UserRegisteredMail([
                'subject' => 'Deposit',
                'title' => "Hello {$re_user->name}",
                'url' => "{$req->getSchemeAndHttpHost()}/admin/dashboard",
                'descp' => "Deposit from {$user->email} to your $wallet_type was successful...... Please Login to view the transaction",
                'action-text' => 'Client Access',
                'img' => 'assets/images/emails/investment-banner.jpg',
            ]));
        } catch (\Exception$e) {

        }

         return ["success" => true, "msg" => "Inter Account Transfer was successful"];
 
    }

}
