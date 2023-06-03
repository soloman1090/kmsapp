<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    protected $table = 'messages';
    public $timestamps =false;
    protected $fillable = [
        'title',
        'user_id',
        'owner',
        'category',
        'descp',
        'date',
        'has_seen'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }


}
