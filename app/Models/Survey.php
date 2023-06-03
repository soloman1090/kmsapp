<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory; 
    protected $table = 'survey';
    public $timestamps =false;
    protected $fillable = [
        'user_id',
        'support',
        'withdrawals',
        'deposits',
        'functions',
        'comments',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
