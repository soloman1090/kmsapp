<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WithdrawalRequests;
use App\Models\Withdrawal_Methods;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;

class WithdrawalRequest extends Controller
{
    public function index(Request $request)
    {

        $id = auth()->id();

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
                $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();
                $userInfo->code_2fa = $code;
                $userInfo->update();

                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => '2FA Authentication Code',
                    'title' => "The 2FA code is:\n $code",
                    'url' => "{$request->getSchemeAndHttpHost()}/user/withdrawal-request",
                    'descp' => "The verification code will be valid for 30 minutes. Please do not share your code with anyone.\n Protecting your account is our top priority. Please confirm your withdrawal by entering this code above on the withdrawal form.",
                    'action-text' => 'Back To Withdrawal',
                    'img' => 'assets/images/emails/withdrawal-banner.jpg',
                ]));
                $request->session()->flash('success', '2FA CODE has been sent to your email');
            }
        } catch (\Exception$e) {

        }

        $methods = Withdrawal_Methods::all();

        return view('user.withdrawal-request', ['user' => $user, 'user_id' => $id, 'page_title' => "Withdrawal Request", 'methods' => $methods, 'username' => $user->name]);
    }

    public function store(Request $req)
    {
        if ($req['amount_paid'] < 10) {
             $req->session()->flash('error', 'Invalid Operation.... You cannot make a withdrawal below $10');
            return redirect('user/withdrawal-history');
        }

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
            if($user->verified==null){
                $req->session()->flash('success', 'For security reasons. Please reset your password');
                return redirect('user/change-password');
            }
           //$req['2fa'] != $user->code_2fa
        if ($req['2fa'] != $user->code_2fa) {
            $req->session()->flash('error', 'Unauthorized Request,...Please this is a wrong 2FA CODE, get the code sent to your email and make the request again. ');
            return redirect('user/withdrawal-history');
        } else
        if ($user->email_verified_at == null) {
            $req->session()->flash('error', 'Please your account is not verified, you cannot make any withdrawals');
            return redirect('user/withdrawal-history');
        } else {
            $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();
            if ($req['wallet_type'] == "main_wallet") {
                if ($req['amount_paid'] >= $user->main_wallet) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Main Wallet.');
                    return redirect('user/withdrawal-history');
                }else{
                    $userInfo->main_wallet=$userInfo->main_wallet-$req['amount_paid'];
                }
            }

            if ($req['wallet_type'] == "compound_wallet") {
                if ($req['amount_paid'] >= $user->compound_wallet) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Compount Wallet.');
                    return redirect('user/withdrawal-history');
                }else{
                    $userInfo->compound_wallet=$userInfo->compound_wallet-$req['amount_paid'];
                }
            }

            // $requests = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
            //     ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
            //     ->where('users.id', $id)->where('withdrawal_requests.approved', false)->get();

            // if (count($requests) > 0) {
            //     $req->session()->flash('error', 'Please you already have a pending withdrawal request on your wallet, wait for approval or delete the previous request and try again');
            //     return redirect('user/withdrawal-history');
            // } 


                $userInfo->update();
                $approval_key=secure_random_string(12);
                $percentage = $req['charge'] / 100;

                $charges = $req['amount_paid'] * $percentage;
                $credited = $req['amount_paid'] - $charges;

                $request = new WithdrawalRequests();
                $request->user_id = $req['user_id'];
                $request->withdrawal_methods_id = $req['withdrawal_methods_id'];
                $request->amount_paid = $req['amount_paid'];
                $request->charge = $req['charge'];
                $request->wallet_type = $req['wallet_type'];
                $request->created_at = Carbon::now();
                $request->wallet_address = $req['wallet_address'];
                $request->amount_credited = $credited;
                $request->approved = false;
                $request->approval_key=$approval_key;
                $request->save();

                

                $userInfo = UserInfo::where('user_id', auth()->id())->firstOrFail();
                $userInfo->code_2fa = null;
                $userInfo->update();

                //Send Mail
                $date = Carbon::now()->toDayDateTimeString();
                try {
                    Mail::to($user->email)->send(new UserRegisteredMail([
                        'subject' => 'Withdrawal Notification',
                        'title' => "Hello {$user->name}",
                        'url' => "{$req->getSchemeAndHttpHost()}/user/withdrawal-history",
                        'descp' => "A recent withdrawal of {$req['amount_paid']} made on {$date} to the Wallet Address:...... {$req['wallet_address']} ......
                has been initiated from your account. Incase of a security issue this APPROVAL KEY-{$approval_key} will be requested from you for approval. Your withdrawal request will be processed automatically in less than 5 minutes.
                If you didn’t make this withdrawal and believe this is unauthorised, Kindly log into your account and cancel it or contact the customer fulfilment centre.",
                        'action-text' => 'Client Access',
                        'img' => 'assets/images/emails/withdrawal-banner.jpg',
                    ]));

                    //Send Admin Mail
                    Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
                        'subject' => 'Withdrawal Request',
                        'title' => "Hi Admin",
                        'url' => "{$req->getSchemeAndHttpHost()}/admin/withdrawal-request",
                        'descp' => "A user just requested for withdrawal on Palm-Alliance. These are the user details.... NAME: {$user->name} {$user->last_name}, APPROVAL-KEY:{$approval_key}
                 EMAIL: {$user->email}, PHONE: {$user->phone}, AMOUNT: $$credited,  WALLET-ADDRESS:...... {$req['wallet_address']} .......{$req['wallet_type']}...... Please Login to approve the transaction",
                        'action-text' => 'Approve Withdrawal',
                        'img' => 'assets/images/emails/Palm-Alliance-Management-Building.jpg',
                    ]));
                } catch (\Exception$e) {
                }

                $req->session()->flash('success', 'Withdrawal request made, ... Please wait for approval');
                return redirect('user/withdrawal-history');
            }
        

    }

}
