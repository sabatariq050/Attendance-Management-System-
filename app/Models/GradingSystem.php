<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradingSystem extends Model
{
    protected $fillable = [
        'min_days',	'grade', // other fields...
    ];
}
