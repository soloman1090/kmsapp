<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;
    protected $table = 'verification';
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'code',
        'exp_time',
        'date',

    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
