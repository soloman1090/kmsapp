<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\UsersInvestments;
use App\Models\Activities;

class ConfirmPayment extends Controller
{
    public function index(Request $request)
    {

        $id=$request->query('transaction_id');
        $key=env('PLISIO_SECRET_KEY');
        try {
            $client=new Client(['verify' => false]);
            $request=$client->get("https://plisio.net/api/v1/operations/$id?api_key=$key");
            $response = json_decode($request->getBody());
            if($response->status=="success"){
                $transact=$response->data;
                if($transact->status=="completed"){
                    $req->session()->flash('success',"Portfolio Purchased");
                    return  redirect('user/user-investments');
                }else if($transact->status=="pending"){
                    $req->session()->flash('success',"Transaction Pending");
                    return  redirect('user/user-investments');
                }else if($transact->status=="error"){
                    $req->session()->flash('error',"Transaction Error... Try Again");
                    return  redirect('user/user-investments');
                }else {
                   
                    return  redirect('user/user-investments');
                }

            }else if($response->status=="error"){
                $transact=$response->data;
                $req->session()->flash('error',"$transact->message");
                return  redirect('user/user-investments');
            }

            $req->session()->flash('error','An error occured');
            return  redirect('user/user-investments');
          } catch (\Exception $e) {
            $req->session()->flash('error','An error occured');
            return  redirect('user/user-investments');
          }
    }
}
