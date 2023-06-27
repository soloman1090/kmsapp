<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\Reinvest;
use App\Models\Messages;
use GuzzleHttp\Client;
use App\Models\Activities;
use App\Models\Withdrawal_Methods;
use Carbon\Carbon;
use \Datetime;
use App\Models\Referrals;
use App\Mail\UserRegisteredMail;
use App\Mail\CustomMail;
use Mail;

class AddBonus extends Controller
{

     public function index()
    {
        $investments= User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
   ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
   ->where('user_investments.status', 'completed')
   ->get(['users.name as username','users.email','users.id as user_id', 'investment_packages.name as packagename',
   'investment_packages.id as package_id','user_investments.date',
   'user_investments.id as investment_id','user_investments.end_date','investment_packages.category_name',
   'user_investments.amount','user_investments.returns', 'investment_packages.duration', 'user_investments.payout',
   'user_investments.active','user_investments.status','user_investments.txn_id', ]);

        $usersInvestments=[];


        for ($i=0; $i < count($investments); $i++) {
            //$investments[$i]['end_date']

                $d1 = strtotime(Carbon::now()->toDayDateTimeString());
                $d2 = strtotime($investments[$i]['end_date']);
                $totalSecondsDiff = abs($d1-$d2);
                $totalDaysDiff  =intval(round($totalSecondsDiff/60/60/24));
                if ($d1 < $d2) {
                    $dayLeft=100;
                    if ($totalDaysDiff < 100) {
                        $dayLeft=$totalDaysDiff;
                    }
                    $data= ['days'=>$totalDaysDiff,'daysLeft'=>$dayLeft,'username'=>$investments[$i]['username'], 'user_id'=>$investments[$i]['user_id'],'email'=>$investments[$i]['email'],
               'packagename'=>$investments[$i]['packagename'],'category_name'=>$investments[$i]['category_name'],'date'=>$investments[$i]['date'],
               'amount'=>$investments[$i]['amount'],'returns'=>$investments[$i]['returns'],'duration'=>$investments[$i]['duration'],
               'payout'=>$investments[$i]['payout'],'active'=>$investments[$i]['active'],'investment_id'=>$investments[$i]['investment_id'],
               'package_id'=>$investments[$i]['package_id'],'status'=>$investments[$i]['status'],'txn_id'=>$investments[$i]['txn_id'], ];
                    array_push($usersInvestments, (object)$data);
                }




                $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $investments[$i]['user_id'])
                ->get()->first();

                //Check Payment Status
                $amount=$investments[$i]['amount'];
                $packagename=$investments[$i]['packagename'];
                $monthCount=$investments[$i]['duration'];
                $thisInvestment=UsersInvestments::findOrFail($investments[$i]['investment_id']);

                if ($investments[$i]['status']=="completed") {

               //Check Referal
                if ($user->referred_by!=null && $user->referred_by!="") {

                //Save Activity
                        $referredUser = DB::table('users')
                 ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                 ->where('users.id', $user->referred_by)
                 ->get()->first();


                        //dd($referredUser);
                        //==========================================================================================================================
                        //Check For Stage 1 user
                        //==========================================================================================================================
                        if ($referredUser!=null) {


                    //$bonusAmount=$amount*0.10;
                            //Get Wallet Balance
                            // $currentAmount=0;
                            // if ($referredUser->main_wallet==null) {
                            //     $currentAmount=0;
                            // } else {
                            //     $currentAmount=$referredUser->main_wallet;
                            // }

                            //Save Wallet
                            // $userInfo=UserInfo::where('user_id', $user->referred_by)->firstOrFail();
                            // $userInfo->main_wallet=$currentAmount + $bonusAmount;
                            // $userInfo->update();

                            //Save Activity
                            // $activity=new Activities;
                            // $activity->title="Referral Bonus";
                            // $activity->user_id=$referredUser->user_id;
                            // $activity->category="bonus";
                            // $activity->date=Carbon::now()->toDayDateTimeString();
                            // $activity->amount=$bonusAmount;
                            // $activity->descp="Credited 10% - $$bonusAmount as referral bonus";
                            // $activity->save();
                            // $referredUser->email

                            //             Mail::to($referredUser->email)->send(new UserRegisteredMail([
                            //              'subject'=>'Members Benefit Commissions',
                            //              'title' => "Hi $referredUser->name $referredUser->last_name ",
                            //              'url' => "https://Dell Group.com/user/referred-users",
                            //              'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@Dell Group.com",
                            //              'action-text'=>'Client Access',
                            //              'img'=>'assets/images/emails/first-referal-banner.jpg'
                            // ]));
                            // dd($referredUser);

                            //=======================================================================================================================================
                            //Check For Stage 2 user
                            //=======================================================================================================================================
                            $referredUser_stage2=null;
                            if ($referredUser->referred_by!=null) {
                                $referredUser_stage2 = DB::table('users')
                                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                                ->where('users.id', $referredUser->referred_by)
                                ->get()->first();

                                if ($referredUser_stage2!=null) {

                                    $bonusAmount_stage2=$amount*0.05;

                                    //Get Wallet Balance
                                    $currentAmount=0;
                                    if ($referredUser_stage2->main_wallet==null) {
                                        $currentAmount=0;
                                    } else {
                                        $currentAmount=$referredUser_stage2->main_wallet;
                                    }
                                    $newAmount=$currentAmount + $bonusAmount_stage2;
                                    //Save Wallet
                                    $userInfo_stage2=UserInfo::where('user_id', $referredUser_stage2->user_id)->firstOrFail();
                                    $userInfo_stage2->main_wallet=$newAmount;
                                    $userInfo_stage2->update();

                                    //Save Activity
                                    $activity=new Activities;
                                    $activity->title="Referral Bonus";
                                    $activity->user_id=$referredUser_stage2->user_id;
                                    $activity->category="bonus";
                                    $activity->date=Carbon::now()->toDayDateTimeString();
                                    $activity->amount=$bonusAmount_stage2;
                                    $activity->descp="Credited 5% - $$bonusAmount_stage2 as referral bonus";
                                    $activity->save();
                                    // $referredUser_stage2->email

                                    Mail::to($referredUser_stage2->email)->send(new UserRegisteredMail([
                                     'subject'=>'Members Benefit Commissions',
                                     'title' => "Hi $referredUser_stage2->name $referredUser_stage2->last_name ",
                                     'url' => "https://Dell Group.com/user/referred-users",
                                     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@Dell Group.com",
                                     'action-text'=>'Client Access',
                                     'img'=>'assets/images/emails/first-referal-banner.jpg'
                                     ]));






                                    //=======================================================================================================================================
                                    //Check For Stage 3 user
                                    //=======================================================================================================================================
                                    $referredUser_stage3=null;
                                    if ($referredUser_stage2->referred_by!=null) {
                                        $referredUser_stage3 = DB::table('users')
                                    ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                                    ->where('users.id', $referredUser_stage2->referred_by)
                                    ->get()->first();
                                        if ($referredUser_stage3!=null) {
                                            $bonusAmount_stage3=$amount*0.025;

                                            //Get Wallet Balance
                                            $currentAmount_3=0;
                                            if ($referredUser_stage3->main_wallet==null) {
                                                $currentAmount_3=0;
                                            } else {
                                                $currentAmount_3=$referredUser_stage3->main_wallet;
                                            }
                                            $newAmount=$currentAmount_3 + $bonusAmount_stage3;
                                            //Save Wallet
                                            $userInfo_stage3=UserInfo::where('user_id', $referredUser_stage3->user_id)->firstOrFail();
                                            $userInfo_stage3->main_wallet=$newAmount;
                                            $userInfo_stage3->update();

                                            //Save Activity
                                            $activity=new Activities;
                                            $activity->title="Referral Bonus";
                                            $activity->user_id=$referredUser_stage3->user_id;
                                            $activity->category="bonus";
                                            $activity->date=Carbon::now()->toDayDateTimeString();
                                            $activity->amount=$bonusAmount_stage3;
                                            $activity->descp="Credited 2.5% - $$bonusAmount_stage3 as referral bonus";
                                            $activity->save();
                                            // $referredUser_stage2->email

                                    Mail::to($referredUser_stage3->email)->send(new UserRegisteredMail([
                                     'subject'=>'Members Benefit Commissions',
                                     'title' => "Hi $referredUser_stage3->name $referredUser_stage3->last_name ",
                                     'url' => "https://Dell Group.com/user/referred-users",
                                     'descp' => "We are delighted to inform you that your partner in your members benefit programme has Purchased a portfolio successfully. Their transaction will be processed and are certainly in order. They will have their account functioning in no time! Thank you for participating in our MEMBER'S BENEFIT Programme and building your team with us!!........For more information, visit our online support page or leave us a message—support@Dell Group.com",
                                     'action-text'=>'Client Access',
                                     'img'=>'assets/images/emails/first-referal-banner.jpg'
                                     ]));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        return ["response"=>"Bonus added Successful"];
    }
}
