<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Orders extends Model
{
    use HasFactory;
    protected $table = 'payment_orders';
    public $timestamps =false;
    protected $fillable = [
        'name',
        'user_id',
        'investment_packages_id',
        'amount',
        'returns',
        'payout',
        'status',
    ];

public function users()
{
    return $this->belongsTo('App\Models\Users');
}
}
