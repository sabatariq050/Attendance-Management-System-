<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function markAttendance(Request $request)
    {
        $today = now()->toDateString();
        
        // Check if the student has already marked attendance for today
        $existingAttendance = Attendance::where('user_id', Auth::id())
                                        ->where('attendance_date', $today)
                                        ->first();
        if ($existingAttendance) {
            return back()->with('error', 'You have already marked attendance today.');
        }

        // Create new attendance record
        Attendance::create([
            'user_id' => Auth::id(),
            'attendance_date' => $today,
            'status' => 'present',
        ]);

        return back()->with('success', 'Attendance marked as present!');
    }

    public function viewAttendance()
    {
        $attendances = Attendance::where('user_id', Auth::id())->get();
        return view('user.attendance', compact('attendances'));
    }
    public function generateReport()
    {
        return view('admin.attendance.report');
    }

    public function filterReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $attendances = Attendance::with('user')
            ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
            ->get();

        return view('admin.attendance.report', compact('attendances'));
    }
    public function viewGrades()
    {
        // Add logic to fetch grade thresholds from config or database
        return view('admin.grades.index');
    }

    public function updateGrades(Request $request)
    {
        // Add logic to update grade thresholds
        return redirect()->route('admin.grades')->with('success', 'Grades updated successfully.');
    }
}
