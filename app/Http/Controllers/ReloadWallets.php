<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReloadWallets extends Controller
{
    public function index()
    {
        // $path = public_path('activities.json');

        // $activities = json_decode(file_get_contents($path));
        // $bonuses=[];
        // foreach ($activities as $key => $active) {
        //     $userInfo=UserInfo::where('user_id', $active->user_id)->firstOrFail();
        //     $users=User::where('id', $active->user_id)->firstOrFail();
        //     if ( $active->category == "bonus") {

        //        // $userInfo->main_wallet=$userInfo->main_wallet-$active->amount;
        //         echo "done for activity ".$users->email;
        //         array_push($bonuses, (object)["email"=>$users->email]);
        //     }

        //    // $userInfo->update();


        // }

        // return $bonuses;

        $users=User::all();
        // foreach ($users as $key => $user) {
        //     $records = DB::table('activities')
        //       ->selectRaw(' id,user_id,date,amount ')
        //       ->where('category', "bonus" )
        //       ->where('user_id', $user->id)
        //       ->where('date', '>', 
        //       Carbon::now()->subHours(3)->toDateTimeString()
        //   ) ->get();

        //   for ($i=0; $i < count($records); $i++) { 

        //     if($i+1 < count($records) && $records[$i]->id > 161525){
                
        //          $firstRecord=Carbon::parse($records[$i]->date)->addMonth()->startOfMonth()->diffInHours(Carbon::parse($records[$i+1]->date));

        //          $secodeRecord=Carbon::parse($records[$i+1]->date)->addMonth()->startOfMonth()->diffInHours(Carbon::parse($records[$i]->date));

        //          $fAmount=$records[$i]->amount;
        //          $sAmount=$records[$i+1]->amount;

        //          if($firstRecord==$secodeRecord &&  $fAmount == $sAmount){

        //             $activity=Activities::findOrFail($records[$i+1]->id);
        //             $userInfo=UserInfo::where('user_id', $activity->user_id)->firstOrFail();
        //             if($activity->category=="earning" || $activity->category=="bonus" ){
        //                 $userInfo->main_wallet=$userInfo->main_wallet - $activity->amount;
        //                 $userInfo->update();
        //             }

        //             Activities::destroy($records[$i+1]->id);
        //             echo "====User-$user->id". ">>>".$fAmount."FM\n";
        //             echo "====User-$user->id".">>>".$sAmount."SM\n";
        //             echo "\n\n" ;
        //             echo "\n\n" ;
        //          }
                
                
        //     }
        //   }
        // }
        
        
          
        foreach ($users as $key => $user) {
              $records = DB::table('activities')
                ->selectRaw(' id,user_id,date,amount ')
                ->where('category', "earning" )
                ->where('user_id', $user->id)
                ->where('date', '=', 
                'Sat, Feb 11, 2023 5:00 AM'
            ) ->get();
  
            for ($i=0; $i < count($records); $i++) { 
  
              $activity=Activities::findOrFail($records[$i]->id);
                      $userInfo=UserInfo::where('user_id', $activity->user_id)->firstOrFail();
                      $package = Investment_Packages::where('id', $activity->user_investments_id)->get()->first();
                      if($package!=null && $activity->category=="earning"){
                          if( $package->payout=="daily_payout" ){
                            $userInfo->main_wallet=$userInfo->main_wallet - $activity->amount;
                          }else if($package->payout=="monthly_payout"){
                            
                            $userInfo->main_wallet=$userInfo->main_wallet - $activity->amount;
                          }else{
                            $userInfo->compound_wallet=$userInfo->compound_wallet - $activity->amount;
                            echo "\n Compound Wallet \n";
                          }
                          $userInfo->update();
                      }
  
                    Activities::destroy($records[$i]->id);
                      echo "====User-$user->id". ">>>".$activity->amount."FM\n";
                    
                      echo "\n\n" ;
            }
          }




      


    }
}
