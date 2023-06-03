<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payment_Method extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';
    public $timestamps =false;
    protected $fillable = [
        'name',
        'address',
        'image',
        'active'
    ];


    public function withdrawal_methods()
    {
        return $this->belongsTo('App\Models\Withdrawal_Methods');
    }
}
