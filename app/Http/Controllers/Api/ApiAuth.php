<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Referrals;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client; 
use App\Http\Controllers\AppPaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mail;
use App\Mail\UserRegisteredMail;

class ApiAuth extends Controller
{

   

    

    public function resendcode(Request $request){
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
       
        $user = User::where('email', $request->email)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();
        if($user){
            $userInfo = UserInfo::where('user_id', $user->user_id)->firstOrFail();
            $code2fa = secure_random_string(6);
            $userInfo->code_2fa = $code2fa;
            $userInfo->update();
            try{
                Mail::to($user->email)->send(new UserRegisteredMail([
                    'subject' => 'Verify Email Address',
                    'title' => "Verification Code: $code2fa",
                    'url' => "",
                    'descp' => "In order to transact on your behalf, we need to verify a way of communicating with you.
                            To verify your email address with us, please copy the verification code above and paste in the field on the mobile app:",
                    'action-text'=>'',
                    'img' => 'assets/images/emails/verification-banner.jpg',
                ]));
            }catch(\Exception $e){
                echo $e;
                return ["error" => true, "msg"=>"Error Sending code",  "type" => "INVALID_CREDENTIAL"];
            }

            return ["success" => true, "msg"=>"Code Sent successful", ];
        }else{
            return response(['error' => true, "msg" => "Invalid email address supplied", "type" => "INVALID_CREDENTIAL"]);
        }

    }

    public function verifyuser(Request $request){

        $user = User::where('email', $request->email)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();
        if($user){
            $userInfo = UserInfo::where('user_id', $user->user_id)->firstOrFail();

            if($request->code!=$userInfo->code_2fa){
                return response(['error' => true,  "msg" => "Invalid 2fa code supplied", "type" => "INVALID_CREDENTIAL"]);
            }else{
                $user = User::findOrFail($user->user_id);
                $user->email_verified_at= Carbon::now();
                $userInfo->code_2fa=null;
                $userInfo->update();
                $user->update();
                return ["success" => true, "msg"=>"Account verified successfully", ];
            }

        }else{
            return response(['error' => true,"msg" => "Invalid email address supplied", "type" => "INVALID_CREDENTIAL"]);
        }
       

    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => true, "msg" => "Invalid username or password", "type" => "INVALID_CREDENTIAL"]);
        }

        if($user->verified==null){
            return response(['error' => true, "msg" => "Please login using the browser, and reset your password", "type" => "INVALID_CREDENTIAL"]);
        }
        
        $user->error = false;
        $this->resendcode($request);
        $response = $user;
        return response($response, 201);
    }

    public function register(Request $request)
    {
        $newUser = User::where('email', $request->email)->get()->first();

        if ($newUser == null) {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            UserInfo::create([
                'user_id' => $user->id,
            ]);

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

            $userInfo = UserInfo::where('user_id', $user->id)->firstOrFail();
            $userInfo->last_name = $request->last_name;
            $userInfo->phone = $request->phone;
            $userInfo->address = $request->address;
            $userInfo->city = $request->city;
            $userInfo->state = $request->state;
            $userInfo->zip_code = $request->zip_code;
            $userInfo->main_wallet = 0;
            $userInfo->compound_wallet = 0;
            $userInfo->referalcode = secure_random_string(6);
            $userInfo->update();

            $this->resendcode($request);

            if ($request->file('image') != null) {
                $imageName = time() . '.' . $request->image->extension();
                $path = $request->image->move(public_path('uploads'), $imageName);
                $userInfo->kyc = $imageName;
            }

            $refere = new Referrals;
            $referalUserId = null;
            if ($request->referral_id != null) {
                if (strlen("{$request->referral_id}") < 6) {
                    $refere->user_id = $request->referral_id;
                    $referalUserId = $request->referral_id;
                } else if (strlen($request->referral_id) >= 6) {
                    $refereUserInfo = UserInfo::where('referalcode', $request->referral_id)->firstOrFail();

                    $refere->user_id = $refereUserInfo->user_id;
                    $referalUserId = $refereUserInfo->user_id;

                }

                $refere->referred_user_id = $user->id;
                $refere->date = Carbon::now()->toDayDateTimeString();
                $refere->invested = false;
                $refere->save();

                $referredUser = DB::table('users')
                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                    ->where('users.id', $referalUserId)
                    ->get()->first();

                $userInfo->referred_by = $referalUserId;

                Mail::to($referredUser->email)->send(new UserRegisteredMail([
                    'subject'=>'Members Benefit Programme',
                    'title' => "Hi $referredUser->name $referredUser->last_name ",
                    'url' => "{$request->getSchemeAndHttpHost()}/user/referred-users",
                    'descp' => 'We are pleased to inform you that your referral has successfully registered through your members benefit programme. All commissions and referral bonuses will be processed accordingly. Our different levels are as follows; ( 10%- 1ST LEVEL, 5%- 2ND LEVEL, 2.5%- 3RD LEVEL ). All registered partners must have an active investment portfolio before commissions are disbursed to the various referee respectively.
                    Kindly confirm all wallet address before transactions are being carried out. Thank your for choosing Palm Alliance Management. For more information visit our Customer fulfilment Centre or leave us a message at support@palmalliance.com',
                    'action-text'=>'Client Access',
                    'img'=>'assets/images/emails/first-referal-banner.jpg'
                ]));
            }
            $userInfo->update();

            //Send Admin Mail
            // Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
            //     'subject'=>'New user registration',
            //     'title' => "Hi Admin",
            //     'url' => "{$request->getSchemeAndHttpHost()}/admin/users",
            //     'descp' => "A new user just registered on Palmalliance. These are the few information about the user.... NAME: {$request->name} {$request->lastName}, EMAIL: {$request->email}, PHONE: {$request->phone}..... Please Login to approve the account",
            //     'action-text'=>'Login Here',
            //     'img'=>'assets/images/emails/Palm-Alliance-Management-Building.jpg'
            // ]));
            
            $registeredUser = User::where('users.id', $user->id)->join('user_infos', 'users.id', "=", 'user_infos.user_id')->first();

            return ["success" => true, "msg"=>"registration successful", "user" => $registeredUser];
        } else {
            return [
               "error"=>true,
                "type" => "EXIST",
                "msg" => "Email or phone number already exists",
            ];
        }

    } 

    public function getResources(Request $request)
    {
        
        $currency = [0 => ["name" => "Bitcoin (BTC)", "value" => "BTC"], 1 => ["name" => "Ethereum (ETH)", "value" => "ETH"], 2 => ["name" => "Litecoin (LTC)", "value" => "LTC"], 3 => ["name" => "Dash (DASH)", "value" => "DASH"], 4 => ["name" => "Zcash (TZEC)", "value" => "TZEC"], 5 => ["name" => "Dogecoin (DOGE)", "value" => "DOGE"], 6 => ["name" => "Bitcoin Cash (BCH)", "value" => "BCH"], 7 => ["name" => "Monero (XMR)", "value" => "XMR"], 8 => ["name" => "Tron (TRX)", "value" => "TRX"], 9 => ["name" => "USDT-Erc20", "value" => "Erc20"], 10 => ["name" => "USDT-Trc20", "value" => "Trc20"]];
        $durations=[0 => ["name" => "Daily Payout", "value" => "daily_payout"], 1 => ["name" => "Monthly Payout", "value" => "monthly_payout"], 2 => ["name" => "6 Months Compounding", "value" => "6_months_compounding"], 3 => ["name" => "7 Months Compounding", "value" => "7_months_compounding"], 4 => ["name" => "8 Months Compounding", "value" => "8_months_compounding"], 5 => ["name" => "9 Months Compounding", "value" => "9_months_compounding"], 6 => ["name" => "10 Months Compounding", "value" => "10_months_compounding"]];
        $app_version="1.1.0";
        
        return ["app_version"=>$app_version,"currency"=>$currency,"durations"=>$durations];
    }

  
}
