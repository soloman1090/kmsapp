<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WithdrawalRequests;
use App\Models\Withdrawal_Methods;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class ApiWithdrawalRequest extends Controller
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
                        'url' => "",
                        'descp' => "The verification code will be valid for 30 minutes. Please do not share your code with anyone.\n Protecting your account is our top priority. Please confirm your withdrawal by entering this code above on the withdrawal form.",
                        'action-text' => 'Back To Withdrawal',
                        'img' => 'assets/images/emails/withdrawal-banner.jpg',
                    ]));

                    return ['success' => "2FA CODE has been sent to your email"];
                }
            } catch (\Exception$e) {
                return ['error' => true, "msg" => "An error occured", "type" => "INVALID_CREDENTIAL"];

            }

            $methods = Withdrawal_Methods::all();
            return ['user' => $user, 'methods' => $methods];
        } else {
            return ['error' => true, "msg" => "An error occured", "type" => "INVALID_CREDENTIAL"];
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
        if ($req['amount_paid'] < 100) {
            return ['error' => true, "msg" => "Invalid Operation.... You cannot make a withdrawal below $100", "type" => "INVALID_CREDENTIAL"];
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

        $id = $req['user_id'];
        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        if ($user) {
            try {
                if ($req['2fa'] != $user->code_2fa) {
                    return ["error" => true, "msg" => "Unauthorized Request,...Please this is a wrong 2FA CODE, get the code sent to your email and make the request again.", "type" => "INVALID_CREDENTIAL"];
                } else {
                    $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
                    if ($req['wallet_type'] == "main_wallet") {
                        if ($req['amount_paid'] >= $user->main_wallet) {
                            return ['error' => true, "msg" => "Insufficient amount,...sorry you do not enough amount in your Main Wallet.", "type" => "INVALID_CREDENTIAL"];
                        } else {
                            $userInfo->main_wallet = $userInfo->main_wallet - $req['amount_paid'];
                        }
                    }

                    if ($req['wallet_type'] == "compound_wallet") {
                        if ($req['amount_paid'] >= $user->compound_wallet) {
                            return ['error' => true, "msg" => "Insufficient amount,...sorry you do not enough amount in your Active Interest Funds.", "type" => "INVALID_CREDENTIAL"];
                        } else {
                            $userInfo->compound_wallet = $userInfo->compound_wallet - $req['amount_paid'];
                        }
                    }

                    $requests = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
                        ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
                        ->where('users.id', $id)->where('withdrawal_requests.approved', false)->get();

                    if (count($requests) > 0) {
                        return ['error' => true, "msg" => "Please you already have a pending withdrawal request on your wallet, wait for approval or delete the previous request and try again", "type" => "INVALID_CREDENTIAL"];
                    } elseif ($user->email_verified_at == null) {
                        return ['error' => true, "msg" => "Please your account is not verified, you cannot make any withdrawals", "type" => "INVALID_CREDENTIAL"];
                    } else {

                        $userInfo->update();
                        $percentage = $req['charge'] / 100;
                        $approval_key = secure_random_string(12);

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
                        $request->approval_key = $approval_key;
                        $request->save();

                        $userInfo = UserInfo::where('user_id', $id)->firstOrFail();
                        $userInfo->code_2fa = null;
                        $userInfo->update();

                        //Send Mail
                        $date = Carbon::now()->toDayDateTimeString();

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
                    }
                }
            } catch (\Exception$e) {

                return ['error' => true, "msg" => "An error occured", "type" => "INVALID_CREDENTIAL"];
            }

            return ["success" => true, "msg" => "Withdrawal request made, ... Please wait for approval"];
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
