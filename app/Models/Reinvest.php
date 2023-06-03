<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reinvest extends Model
{
    use HasFactory;
    protected $table = 'reinvest';
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'user_investments_id',
        'date',
        'amount',
        'topup_amount',
        'status',
        'returns',
        'txn_id',
        'wallet_id',
        'currency',
        'invoice_url',
        'active'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }

    public function usersinvestments()
    {
        return $this->belongsTo('App\Models\UsersInvestments');
    }
}
