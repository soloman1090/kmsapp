<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WithdrawalRequests;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
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
            if ($request->auth == "yes") {
                //dd("heee");
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
        } catch (\Exception $e) {
            dd($e);
        }

        $user->formated_referral_wallet = number_format($user->referral_wallet);

        //$package = Investment_Packages::findOrFail($request->package_id);
        $methods = Withdrawal_Methods::all();

        $investment = UsersInvestments::findOrFail($request->investment_id);
        $investment->package = Investment_Packages::findOrFail($investment->investment_packages_id);
        $investment->formatted_available_fund_balance = number_format($investment->available_fund_balance);
        $investment->formatted_active_interest_balance = number_format($investment->active_interest_balance);



        return view('user.withdrawal-request', ['user' => $user, 'user_id' => $id, 'page_title' => "Withdrawal Request", 'withdrawMethods' => $methods, "investment" => $investment,  'username' => $user->name]);
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
                case 'available_funds':
                    return "Active Funds Balance";
                    break;
                case 'active_interest':
                    return "Active Interest Balance";
                    break;
                case 'referral_commission':
                    return "Referral Commission";
                    break;
            }
        }


        $wallet_type = getWalletType($req['wallet_type']);

        $id = auth()->id();
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();
            
        if ($user->verified == null) {
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
            $investment = null;

            if ($req['wallet_type'] == "available_funds") {
                $investment = UsersInvestments::where('id', $req['investment_id'])->firstOrFail();
                if ($req['amount_paid'] > $investment->available_fund_balance) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Active Funds.');
                    return redirect($req['page_url']);
                } else {
                    $investment->available_fund_balance = $investment->available_fund_balance - $req['amount_paid'];
                    $investment->update();
                }
            }

            if ($req['wallet_type'] == "active_interest") {
                $investment = UsersInvestments::where('id', $req['investment_id'])->firstOrFail();
                if ($req['amount_paid'] > $investment->active_interest_balance) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Active Interest Funds.');
                    return redirect($req['page_url']);
                } else {
                    $investment->active_interest_balance = $investment->active_interest_balance - $req['amount_paid'];
                    $investment->update();
                }
            }

            if ($req['wallet_type'] == "referral_commission") {
                if ($req['amount_paid'] > $userInfo->referral_wallet) {
                    $req->session()->flash('error', 'Insufficient amount,...sorry you do not enough amount in your Community Wallet.');
                    return redirect($req['page_url']);
                } else {
                    $userInfo->referral_wallet = $userInfo->referral_wallet - $req['amount_paid'];
                    $userInfo->update();
                }
            }

            


            
            $approval_key = secure_random_string(12);
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
            $request->user_investments_id=$req['investment_id'];
            $request->amount_credited = $credited;
            $request->approved = false;
            $request->approval_key = $approval_key;
            
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
                    'descp' => "A user just requested for withdrawal on Dell Group-. These are the user details.... NAME: {$user->name} {$user->last_name}, APPROVAL-KEY:{$approval_key}
                 EMAIL: {$user->email}, PHONE: {$user->phone}, AMOUNT: $$credited,  WALLET-ADDRESS:...... {$req['wallet_address']} .......{$req['wallet_type']}...... Please Login to approve the transaction",
                    'action-text' => 'Approve Withdrawal',
                    'img' => 'assets/images/emails/Dell Group--Management-Building.jpg',
                ]));
            } catch (\Exception $e) {
            }

            $req->session()->flash('success', 'Withdrawal request made, ... Please wait for approval');
            return redirect('user/withdrawal-history');
        }
    }
}
