<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    use HasFactory;
    protected $table = 'referrals';
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'referred_user_id',
        'date',
        'invested',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
