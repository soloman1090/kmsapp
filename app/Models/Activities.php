<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;
    protected $table = 'activities';
    public $timestamps =false;
    protected $fillable = [
        'title',
        'user_id',
        'user_investments_id',
        'investment_packages_id',
        'category',
        'descp',
        'amount',
        'date'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\Users');
    }

    public function user_investments()
    {
        return $this->belongsTo('App\Models\UsersInvestments');
    }

    public function investment_packages()
    {
        return $this->belongsTo('App\Models\Investment_Packages');
    }
}
