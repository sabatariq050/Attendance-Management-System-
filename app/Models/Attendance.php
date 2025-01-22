<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //


    // Add user_id to the fillable array
    protected $fillable = [
        'user_id',  // Add this line
        'attendance_date',
        'status',   // other fields...
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
