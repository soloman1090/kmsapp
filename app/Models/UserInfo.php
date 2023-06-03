<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'address',
        'last_name',
        'phone',
        'city',
        'state',
        'zip_code',
        'kyc',
        'image',
        'verified',
        'main_wallet',
        'compound_wallet',
        'referred_by',
        'withdrawal_limit',
        'invested',
        'referalcode',
        'code_2fa'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
