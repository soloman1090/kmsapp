<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment_Packages extends Model
{
    use HasFactory;
    protected $table = 'investment_packages';
    public $timestamps =false;
    protected $fillable = [
        'name',
        'category_name',
        'min_amt',
        'max_amt',
        'min_percent',
        'max_percent',
        'compound_percent',
        'compound_duration',
        "package_type",
        'active_status',
        "start_date",
        "expire_date",
        "level1_bonus",
        "level2_bonus",
        "level3_bonus",
        'duration',
        'info_head_1',
        'info_detail_1',
        'info_head_2',
        'info_detail_2',
        'info_head_3',
        'info_detail_3',
        'info_head_4',
        'info_detail_4',
        'info_head_5',
        'info_detail_5',
        "running_days",
        "slots",
        "bonus_percentage",
        "image"
    ];
}
