<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    public function requestLeave(Request $request)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'reason' => 'required|string',
        
        ]);

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Leave request submitted!');
    }
    public function viewUserLeaves()
{
    $user = auth()->user();
    $leaveRequests = $user->leaveRequests()->orderBy('created_at', 'desc')->get();

    return view('user.leaves', compact('leaveRequests', 'user'));
}

}
