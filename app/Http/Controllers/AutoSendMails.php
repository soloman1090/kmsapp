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
use App\Models\Manage_Emails;
use Mail;

class AutoSendMails extends Controller
{

    public function index()
    {
        $mails = Manage_Emails::orderBy('manage_emails.id', 'DESC')->where('manage_emails.sent_status', 'pending')->get();
        if (count($mails)>=1) {
            $mail=$mails[0];


            $user = DB::table('users')
                ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
                ->where('user_infos.user_id', $mail->user_id)
                ->get()->first();
            if ($user->email==" " || $user->email==" ") {
                echo "Removed";
                $thisMail=Manage_Emails::findOrFail($mail->id);
                $thisMail->sent_status="removed";
                $thisMail->update();
            } else {
                Mail::to($user->email)->send(new CustomMail([
                        'title' =>$mail->title,
                        'user'=>"$user->name $user->last_name",
                        'url' => $mail->action_url,
                        'subject'=>$mail->subject,
                        'descp' => $mail->descp,
                        'action-text'=>$mail->action_text,
                        'descp2' =>$mail->descp2,
                        'descp3' =>$mail->descp3,
                        'img'=>$mail->img,
                        'img-event'=>$mail->img_event,
                        'end_text'=>$mail->end_text,
                    ]));

                $thisMail=Manage_Emails::findOrFail($mail->id);
                $thisMail->sent_status="delivered";
                $thisMail->update();
            }


            echo "All Mails sent";
        }
    }
    }
