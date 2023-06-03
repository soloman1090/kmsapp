<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use App\Models\Role;
use App\Models\User;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user=User::join('user_infos', 'users.id', '=', 'user_infos.user_id')->where('email', $request['email'])->firstOrFail();
     

        if($request['email']==env('APP_ADMIN')){
            //return  redirect('admin/dashboard');
            return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect('admin/dashboard');

        }elseif($user->last_name=="subadmin"){
            //return  redirect('admin/dashboard');
            return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect('admin/users');
        }else{
            //return  redirect('user/dashboard');
            return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect('user/dashboard');
        }

    }
}
