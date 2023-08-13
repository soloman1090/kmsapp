<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Investment_Packages;
use App\Models\Withdrawal_Methods;
use App\Models\WithdrawalRequests;


class WithdrawalHistory extends Controller
{
    public function index()
    {

        $id = auth()->id();

        $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('users.id', $id)
            ->get()->first();

        $requests = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
            ->leftJoin('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
            ->where('users.id', $id)
            ->orderBy('withdrawal_requests.id', 'DESC')
            ->get([
                'users.name as username', 'users.email', 'withdrawal_methods.name as methodname', 'withdrawal_requests.id as request_id', 'withdrawal_requests.amount_paid',
                'withdrawal_requests.amount_credited', 'withdrawal_requests.charge', 'withdrawal_requests.created_at as date',
                'withdrawal_requests.wallet_address', 'withdrawal_requests.wallet_type', 'withdrawal_requests.approved',
            ]);




        $usersInvestments = User::join('user_investments', 'user_investments.user_id', '=', 'users.id')
            ->join('investment_packages', 'investment_packages.id', '=', 'user_investments.investment_packages_id')
            ->where('users.id', $id)
            ->orderBy('user_investments.id', 'DESC')
            ->get([
                'users.name as username', 'users.email', 'investment_packages.name as packagename', 'user_investments.date',
                'user_investments.id as investment_id',
                'user_investments.amount', 'user_investments.returns', 'user_investments.duration', 'user_investments.payout', 'user_investments.active',
            ]);
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
        foreach ($requests as $key => $value) {

            $value->formatted_wallet_type = getWalletType($value->wallet_type);
        }
        return view('user.withdrawal-history', ['user' => $user, 'user_id' => $id, 'investments' => $usersInvestments, 'page_title' => "All Requests History", 'requests' => $requests, 'username' => $user->name]);
    }

    public function destroy(Request $request, $id)
    {
        WithdrawalRequests::destroy($id);
        $request->session()->flash('success', 'Withdrawal request deleted!');
        return  redirect('user/withdrawal-history');
    }
}
