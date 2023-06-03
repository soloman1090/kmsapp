<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traders extends Model
{
    use HasFactory;
    protected $table = 'traders';
    public $timestamps =false;
    protected $fillable = [
        'name',
        'image',
        'position',
        'phone',
        'descp',
        'mail',
        'link'
    ];
}
