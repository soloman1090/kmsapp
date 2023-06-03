<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInvestments extends Model
{
    use HasFactory;

    protected $table = 'user_investments';
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'investment_packages_id',
        'date',
        'end_date',
        'amount',
        'duration',
        'returns',
        'payout',
        'status',
        'wallet_id',
        'txn_id',
        'currency',
        'invoice_url',
        'active'
    ];


    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }

    public function investment_packages()
    {
        return $this->belongsTo('App\Models\Investment_Packages');
    }
}
