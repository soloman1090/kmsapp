<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manage_Emails extends Model
{
    use HasFactory;
    protected $table = 'manage_emails';
    public $timestamps =false;
    protected $fillable = [
        'title',
        'user_id',
        'subject',
        'descp',
        'action_text',
        'action_url',
        'descp2',
        'descp3',
        'img',
        'img_event',
        'end_text',
        'sent_status'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }


}
