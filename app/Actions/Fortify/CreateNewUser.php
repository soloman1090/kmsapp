<?php

namespace App\Actions\Fortify;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use App\Models\UserInfo;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Mail\UserRegisteredMail;
use Mail;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'string', 'email', 'max:255', Rule::unique(User::class), ],
            'password' => ['required', 'string', ],
        ])->validate();

        $user=User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->roles()->attach("2");

        UserInfo::create([
            'user_id'=>$user->id,
        ]);
        return $user;
    }
}
