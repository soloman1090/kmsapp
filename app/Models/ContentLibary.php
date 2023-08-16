<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentLibary extends Model
{
    use HasFactory;
    protected $fillable = [
        'resource_link',
        'status',
        'category',
        'gallery_category',
        'extention',
        'description',
        'slug',
    ];
}
