<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyager extends Model
{
    use HasFactory;
    protected $table = 'voyager';
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'activation_key',
        'status',
        'amount',
        'daily_return',
        'total_amount',
        'date',

    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
