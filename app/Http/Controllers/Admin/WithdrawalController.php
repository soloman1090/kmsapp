<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMail;
use App\Models\Activities;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\WithdrawalRequests;
use App\Models\UsersInvestments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Mail;

class WithdrawalController extends Controller
{
    public function index(Request $req)
    {
        $priviledge = "admin";
        $user = UserInfo::where('user_id', auth()->id())->firstOrFail();
        if ($user->last_name == "subadmin") {
            return redirect("admin/users");
        }
        $withdrawals = null;
        $singleActivities = null;
        if ($req['user_id'] == null) {
            $withdrawals = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
                ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
                ->where('withdrawal_requests.approved', false)
                ->orderBy('withdrawal_requests.id', 'DESC')
                ->get([
                    'users.name as username', 'users.email', 'users.id as user_id', 'withdrawal_requests.id as request_id', 'withdrawal_methods.name as methodname',
                    'withdrawal_methods.currency_code', 'withdrawal_requests.amount_paid', 'withdrawal_requests.created_at as date',
                    'withdrawal_requests.amount_credited', 'withdrawal_requests.charge', 'withdrawal_requests.wallet_address', 'withdrawal_requests.wallet_type', 'withdrawal_requests.approved', 'withdrawal_requests.approval_key'
                ]);
        } else {
            $singleActivities = "true";
            $withdrawals = User::join('withdrawal_requests', 'withdrawal_requests.user_id', '=', 'users.id')
                ->join('withdrawal_methods', 'withdrawal_methods.id', '=', 'withdrawal_requests.withdrawal_methods_id')
                ->where('withdrawal_requests.approved', false)
                ->where('withdrawal_requests.user_id', $req['user_id'])
                ->orderBy('withdrawal_requests.id', 'DESC')
                ->get([
                    'users.name as username', 'users.email', 'users.id as user_id', 'withdrawal_requests.id as request_id', 'withdrawal_methods.name as methodname',
                    'withdrawal_methods.currency_code', 'withdrawal_requests.amount_paid', 'withdrawal_requests.created_at as date',
                    'withdrawal_requests.amount_credited', 'withdrawal_requests.charge', 'withdrawal_requests.wallet_address', 'withdrawal_requests.wallet_type', 'withdrawal_requests.approved', 'withdrawal_requests.approval_key'
                ]);
        }
        return view(
            'admin.withdrawal.w-request',
            [
                'withdrawals' => $withdrawals, "priviledge" => $priviledge,
                'page_title' => "Pending Withdrawal",
                "single" => $singleActivities
            ]
        );
    }

    public function update(Request $req, $id)
    {
        function getWalletType($data)
        {
            switch ($data) {
                case 'main_wallet':
                    return "Portfolio Balance";
                    break;
                case 'compound_wallet':
                    return "Compounding Dividends";
                    break;
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
        try {

            $wRequest = WithdrawalRequests::findOrFail($id);
            $wRequest->approved = true;
            $wRequest->update();

            $activity = new Activities;
            $activity->title = "Withdrawal Approved";
            $activity->user_id = $req['user_id'];
            $activity->category = "withdrawals";
            $activity->withdrawal_id = $id;
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->user_investments_id = $wRequest->user_investments_id;
            $activity->amount = $req['amount_credited'];
            $activity->descp = "Your request of {$req['amount_credited']} made from  $wallet_type has been approved ";
            $activity->save();

            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('users.id', $req['user_id'])
                ->get()->first();
            $amount = $req['amount_credited'];

            Mail::to($user->email)->send(new UserRegisteredMail([
                'subject' => 'Withdrawal Successful',
                'title' => "Hi {$user->name} {$user->last_name}",
                'url' => "{$req->getSchemeAndHttpHost()}/user/withdrawal-history",
                'descp' => "You've successfully withdrawn $$amount from your  $wallet_type to the Wallet Address....... {$req['wallet_address']} ............  If you don't recognize this activity, please contact us immediately at our customer fulfilment centre. ",
                'action-text' => 'Client Access',
                'img' => 'assets/images/emails/withdrawal-banner.jpg',
            ]));

            $req->session()->flash('success', 'Withdrawal approved');
        } catch (\Exception $e) {
            //dd($e);
            $req->session()->flash('error', 'An error occured sending emails');
            return redirect('admin/withdrawal-request');
        }

        return redirect('admin/withdrawal-request');
    }

    public function destroy(Request $request, $id)
    {

        if ($request['message']) {
            function getWalletType($data)
            {
                switch ($data) {
                    case 'main_wallet':
                        return "Portfolio Balance";
                        break;
                    case 'compound_wallet':
                        return "Compounding Dividends";
                        break;
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

            $wallet_type = getWalletType($request['wallet_type']);
            $wRequest = WithdrawalRequests::findOrFail($id);

            $userInfo = UserInfo::where('user_id', $request['user_id'])->firstOrFail();
            $investment = UsersInvestments::where('id', $wRequest->user_investments_id)->firstOrFail();

          

            if ($request['wallet_type'] == "available_funds") {
                $investment->available_fund_balance = $investment->available_fund_balance + $request['amount_paid'];
            } else if ($request['wallet_type'] == "active_interest") {
                $investment->active_interest_balance = $investment->active_interest_balance + $request['amount_paid'];
            } else {
                $userInfo->referral_wallet = $userInfo->referral_wallet + $request['amount_paid'];
            }
            $investment->update();
            $userInfo->update();

            $activity = new Activities;
            $activity->title = "Withdrawal Cancelled";
            $activity->user_id = $request['user_id'];
            $activity->category = "withdrawals";
            $activity->user_investments_id = $wRequest->user_investments_id;
            $activity->date = Carbon::now()->toDayDateTimeString();
            $activity->amount = 0;
            $activity->descp = $request['message'];
            $activity->save();

            try {
                
            Mail::to($request['email'])->send(new UserRegisteredMail([
                'subject' => 'Withdrawal Cancelled',
                'title' => "Hi {$request['username']} ",
                'url' => "{$request->getSchemeAndHttpHost()}/user/withdrawal-history",
                'descp' => "Your withdrawal has been cancelled and your money returned to your $wallet_type ............ {$request['message']} ",
                'action-text' => 'Client Access',
                'img' => 'assets/images/emails/withdrawal-banner.jpg',
            ]));
            } catch (\Throwable $th) {
                
            }

        }

        WithdrawalRequests::destroy($id);
        $request->session()->flash('success', 'Request deleted!');
        return redirect('admin/withdrawal-request');
    }

    public function paginate($items, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => url('admin/users')]);
    }
}
