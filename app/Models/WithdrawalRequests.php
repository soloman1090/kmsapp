<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequests extends Model
{
    use HasFactory;
    protected $table = 'withdrawal_requests';
    public $timestamps =false;
    protected $fillable = [
        'withdrawal_methods_id',
        'user_id',
        'user_investments_id',
        'amount_paid',
        'amount_credited',
        'wallet_address',
        'wallet_type',
        'charge',
        'approved',
        "approval_key"
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }

    public function method()
    {
        return $this->belongsTo('App\Models\Withdrawal_Methods');
    }
}
