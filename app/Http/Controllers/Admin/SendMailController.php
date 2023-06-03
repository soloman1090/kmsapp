<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manage_Emails;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Mail\CustomMail;
use App\Mail\UserRegisteredMail;
use Carbon\Carbon;
 
use Mailgun\Mailgun;
use Mail;
use Illuminate\Pagination\LengthAwarePaginator;

class SendMailController extends Controller
{
    public function index(){
         $priviledge = "admin";
        $user=UserInfo::where('user_id', auth()->id())->firstOrFail();
        if($user->last_name=="subadmin"){
            return  redirect("admin/users");
        }
        $users =  DB::table('users')->join('user_infos','users.id',"=", 'user_infos.user_id')->orderBy('users.id','DESC')->get();
        $mails = Manage_Emails::orderBy('manage_emails.id','DESC')->get();
        

        foreach ($mails as $key => $mail) {
            $user = DB::table('users')
            ->join('user_infos','users.id',"=", 'user_infos.user_id')
            ->where('user_infos.user_id', $mail->user_id)
            ->get()->first();
            $mail->uesrEmail=$user->email;
            $mail->name="$user->name $user->last_name";
        }

        return view('admin.send-mails',
        [ 'users'=>$users, 'page_title'=>"Send Mails", "priviledge" => $priviledge, 'allMails'=>$mails]);
    }

    public function store(Request $req){
        

               if($req["bulk"]){
                $mgClient = Mailgun::create(env('REST_EM_KEY'));
                $domain = "m.palmalliance.com";
                $params = array(
                  'from'    => 'Palm Alliance Management <noreplys@m.palmalliance.com>',
                  'to'      => 'noreply@m.palmalliance.com',
                  'subject' => "{$req['subject']}",
                  'template'    => "customer",
                  'h:X-Mailgun-Variables'    => '{"test": "test"}'
                );
                
                # Make the call to the client.
                $mgClient->messages()->send($domain, $params);
               }else{
    try {
        $saveMail=new Manage_Emails();
        $imgLink=null;
        $imgEventLink=null;

        if ($req->file('img')!=null) {
            $imageName=time().'.'.$req->img->extension();
            $path= $req->img->move(public_path('uploads'), $imageName);
            $saveMail->img=$imageName;
            $imgLink=$imageName;
        } else {
            $saveMail->img="http://palmalliance.com/assets/images/emails/verification-banner.jpg";
            $imgLink="http://palmalliance.com/assets/images/emails/verification-banner.jpg";
        }

        if ($req->file('img_event')!=null) {
            $imageEvent=time().'event.'.$req->img_event->extension();
            $path2= $req->img_event->move(public_path('uploads'), $imageEvent);
            $saveMail->img_event=$imageEvent;
            $imgEventLink=$imageEvent;
        } else {
            $saveMail->img_event="";
            $imgEventLink="";
        }

        if ($req['user_id']=="all") {
            $users =  DB::table('users')->join('user_infos', 'users.id', "=", 'user_infos.user_id')->orderBy('users.id', 'DESC')->get();
            //dd($users);
            foreach ($users as $key => $user) {
                //Send Mails $user->email
                $saveMail=new Manage_Emails();
                $saveMail->title=$req['title'];
                $saveMail->user_id=$user->user_id;
                $saveMail->subject=$req['subject'];
                $saveMail->action_text=$req['action_text'];
                $saveMail->action_url=$req['action_url'];
                $saveMail->descp=$req['descp'];
                $saveMail->descp2=$req['descp2'];
                $saveMail->descp3=$req['descp3'];
                $saveMail->img=$imgLink;
                $saveMail->img_event=$imgEventLink;
                $saveMail->end_text=$req['end_text'];
                $saveMail->sent_status="pending";
                $saveMail->save();
            }
            $req->session()->flash('success', "Email Sent to every user successfully,  refresh for delivery confirmation");
        } else {
            $user = DB::table('users')
            ->join('user_infos', 'users.id', "=", 'user_infos.user_id')
            ->where('user_infos.user_id', $req['user_id'])
            ->get()->first();

            //Save Mails $user->email

            $saveMail->title=$req['title'];
            $saveMail->user_id=$req['user_id'];
            $saveMail->subject=$req['subject'];
            $saveMail->action_text=$req['action_text'];
            $saveMail->action_url=$req['action_url'];
            $saveMail->descp=$req['descp'];
            $saveMail->descp2=$req['descp2'];
            $saveMail->descp3=$req['descp3'];
            $saveMail->end_text=$req['end_text'];
            $saveMail->sent_status="pending";
            $saveMail->save();
            $req->session()->flash('success', "Email Sent to {$user->name} {$user->last_name}---($user->email) successfully, refresh for delivery confirmation");
        }
    } catch (\Exception $e) {
        dd($e);
        $req->session()->flash('error', "An error occured while sending the email <br> $e ");
    }
}


        return  redirect('admin/sendmail');

    }

    public function destroy(Request $request,$id)
    {
        Messages::destroy($id);
        $request->session()->flash('success','You have deleted this mail');
        return  redirect('admin/sendmail');
    }
}
