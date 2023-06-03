<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\Activities;
use Carbon\Carbon;
use \Datetime;
use Illuminate\Support\Facades\DB;

class LoadInvestments extends Controller
{
    public function index()
    {
        $path = public_path('investments.json');

        $investments = json_decode(file_get_contents($path));

        foreach ($investments as $key => $invest) {
            if($invest->status=="completed"){
                try{
                    $userInfo=UserInfo::where('user_id', $invest->user_id)->firstOrFail();
                    $user=User::where('id', $invest->user_id)->firstOrFail();
                    if ( $user->email == "marindamundey@gmail.com" ||$user->email == "morgaine29@gmail.com" ||$invest->user_id == 77) {

                        echo "Removed for ".$user->email;
                    }else{

                        $thisInvestment=UsersInvestments::where('id', $invest->id)->firstOrFail();
                        $amountAdded=0;
                        if($thisInvestment->amount > 49 && $thisInvestment->amount <=499 ){
                            $thisInvestment->amount=$thisInvestment->amount+10;
                            $amountAdded=10;
                        }else if($thisInvestment->amount >= 500 && $thisInvestment->amount <=999){
                            $thisInvestment->amount=$thisInvestment->amount+25;
                            $amountAdded=25;
                        }else if($thisInvestment->amount >= 1000 && $thisInvestment->amount <=1999){
                            $thisInvestment->amount=$thisInvestment->amount+40;
                            $amountAdded=40;
                        }else if($thisInvestment->amount >= 2000 && $thisInvestment->amount <=9999){
                            $thisInvestment->amount=$thisInvestment->amount+50;
                            $amountAdded=50;
                        }


                        $activity=new Activities;
                        $activity->title="Esg Disbursement";
                        $activity->user_id=$thisInvestment->user_id;
                        $activity->user_investments_id=$thisInvestment->id;
                        $activity->investment_packages_id=$thisInvestment->investment_packages_id;
                        $activity->category="bonus";
                        $activity->date=Carbon::now()->toDayDateTimeString();
                        $activity->amount=$amountAdded;
                        $activity->descp="Esg consideration disbursement of $$amountAdded ";

                        $activity->save();
                       $thisInvestment->update();
                    }
                }catch(\Exception $e){
                    echo "error";
                }

            }




           // $userInfo->update();


        }

        return  ["response"=>"Bonus Added Done"];





        // $path=public_path('user_infos.json');
        // // $news = Storage::get($path);
        // $usersData = json_decode(file_get_contents($path));

        // foreach ($usersData as $key => $user) {

        //         $userInfo=UserInfo::where('user_id', $user->user_id)->firstOrFail();

        //         $userInfo->main_wallet=$user->main_wallet;
        //         $userInfo->compound_wallet=$user->compound_wallet;
        //         $userInfo->update();

        // }


    }
}
