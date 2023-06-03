<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal_Methods extends Model
{
    use HasFactory;
    protected $table = 'withdrawal_methods';
    public $timestamps =false;
    protected $fillable = [
        'min_amt',
        'max_amt',
        'image',
        'charges',
        'active',
        'currency_code',
        'name',
    ];
}
