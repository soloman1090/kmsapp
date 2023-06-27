<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use App\Models\Referrals;
use Carbon\Carbon;
use App\Models\Activities;
use Laravel\Fortify\Fortify;
use App\Models\UserInfo;
use File;
use App\Mail\UserRegisteredMail;
use Mail;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function toResponse($request)
    {

        function secure_random_string($length) {
            $random_string = '';
            for($i = 0; $i < $length; $i++) {
                $number = random_int(0, 36);
                $character = base_convert($number, 10, 36);
                $random_string .= $character;
            }

            return $random_string;
        }

        $userInfo=UserInfo::where('user_id',auth()->id())->firstOrFail();
        $userInfo->last_name=$request->lastName;
        $userInfo->phone=$request->phone;
        $userInfo->main_wallet=0;
        $userInfo->compound_wallet=0;
        $userInfo->referalcode=secure_random_string(6);


        if($request->file('image')!=null){
            $imageName=time().'.'.$request->image->extension();
            $path = $request->image->move(public_path('uploads'), $imageName);
            $userInfo->kyc=$imageName;
        }


        $refere=new Referrals;
        $referalUserId=null;
        if($request->referral_id!=null){
            if(strlen("{$request->referral_id}") < 6){
                $refere->user_id=$request->referral_id;
                $referalUserId=$request->referral_id;
            }else if(strlen($request->referral_id) >= 6){
                $refereUserInfo=UserInfo::where('referalcode', $request->referral_id)->firstOrFail();

                $refere->user_id=$refereUserInfo->user_id;
                $referalUserId=$refereUserInfo->user_id;

            }

            $refere->referred_user_id=auth()->id();
            $refere->date=Carbon::now()->toDayDateTimeString();
            $refere->invested=false;
            $refere->save();

            $referredUser = DB::table('users')
            ->join('user_infos','users.id',"=", 'user_infos.user_id')
            ->where('users.id', $referalUserId)
            ->get()->first();


            $userInfo->referred_by= $referalUserId;

            Mail::to($referredUser->email)->send(new UserRegisteredMail([
                'subject'=>'Members Benefit Programme',
                'title' => "Hi $referredUser->name $referredUser->last_name ",
                'url' => "{$request->getSchemeAndHttpHost()}/user/referred-users",
                'descp' => 'We are pleased to inform you that your referral has successfully registered through your members benefit programme. All commissions and referral bonuses will be processed accordingly. Our different levels are as follows; ( 10%- 1ST LEVEL, 5%- 2ND LEVEL, 2.5%- 3RD LEVEL ). All registered partners must have an active investment portfolio before commissions are disbursed to the various referee respectively.
                Kindly confirm all wallet address before transactions are being carried out. Thank your for choosing Dell Group  Management. For more information visit our Customer fulfilment Centre or leave us a message at support@Dell Group.com',
                'action-text'=>'Client Access',
                'img'=>'assets/images/emails/first-referal-banner.jpg'
            ]));
        }
        $userInfo->update();

        //Send Admin Mail
        Mail::to(env('APP_EMAIL'))->send(new UserRegisteredMail([
            'subject'=>'New user registration',
            'title' => "Hi Admin",
            'url' => "{$request->getSchemeAndHttpHost()}/admin/users",
            'descp' => "A new user just registered on Dell Group. These are the few information about the user.... NAME: {$request->name} {$request->lastName}, EMAIL: {$request->email}, PHONE: {$request->phone}..... Please Login to approve the account",
            'action-text'=>'Login Here',
            'img'=>'assets/images/emails/Dell Group--Management-Building.jpg'
        ]));

        return $request->wantsJson()
        ? new JsonResponse('', 201)
        : redirect('user/dashboard');

    }
}
