<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup_Data extends Model
{
    use HasFactory;
    protected $table = 'popup_data';
    public $timestamps =false;
    protected $fillable = [
        'title',
        'status',
        'image',
        'descp',
        'link', 
    ];
}
