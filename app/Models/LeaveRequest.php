<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id',  // Add this line
        'leave_date',
        'reason', 
        'status',  // other fields...
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
