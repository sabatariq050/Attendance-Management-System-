<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\GradingSystem;
class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $attendanceStats = [
            'total_students' => User::where('role', 'user')->count(), // Count only students
            'total_attendance' => Attendance::count(),
            'total_leaves' => LeaveRequest::count(),
        ];


        return view('admin.dashboard', compact('users', 'attendanceStats'));
    }
    public function viewAttendance()
    {
        $attendances = Attendance::with('user')->get();
        return view('admin.attendance.index', compact('attendances'));
    }

    public function editAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendance.edit', compact('attendance'));
    }

    public function updateAttendance(Request $request, $id)
    {
        $request->validate([
            'attendance_date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        return redirect()->route('admin.attendance')->with('success', 'Attendance updated successfully.');
    }

    public function deleteAttendance($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->route('admin.attendance')->with('success', 'Attendance deleted successfully.');
    }

    public function addAttendance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);

        Attendance::create($request->all());
        return redirect()->route('admin.attendance')->with('success', 'Attendance added successfully.');
    }

    public function generateReport()
    {
        // Fetch only users with 'user' role (students)
        $users = User::where('role', 'user')->get(); // Assuming 'role' is a column that stores the role name
        $user = null; // No user selected initially
        $toDate = now()->toDateString();
        return view('admin.attendance.report', compact('users', 'user', 'toDate'));
    }

    // Filter attendance report based on role
    public function filterReport(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);
        $students = User::where('role', 'user')->get();
        // Fetch attendance based on user and date range
        $attendances = Attendance::where('user_id', $request->user_id)
            ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
            ->get();

        // Calculate leaves, presents, and absents
        $presentCount = Attendance::where('user_id', $request->user_id)
            ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
            ->where('status', 'Present')
            ->count();

        $absentCount = Attendance::where('user_id', $request->user_id)
            ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
            ->where('status', 'Absent')
            ->count();
        $leaveCount = LeaveRequest::where('user_id', $request->user_id)
            ->where('status', 'approved') // Ensure leave is approved
            ->whereBetween('leave_date', [$request->from_date, $request->to_date])
            ->count();

        // Fetch user details (ensure this user is not an admin)
        $user = User::find($request->user_id);

        // Make sure to only return students
        if ($user && $user->role !== 'user') {
            return redirect()->route('admin.dashboard')->with('error', 'You can only view reports for students.');
        }

        return view('admin.attendance.generated_report', compact('attendances', 'presentCount', 'absentCount', 'leaveCount', 'user', 'request'));
    }

    public function showSystemReportForm()
    {
        $toDate = now()->toDateString();
        return view('admin.attendance.system_report_form', compact('toDate'));
    }

    // Generate the system report
    public function generateSystemReport(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);
        $toDate = now()->toDateString();
        // Fetch all students
        $students = User::where('role', 'user')->get();
        $gradingSystem = GradingSystem::orderBy('min_days')->get();
        $reportData = [];

        foreach ($students as $student) {
            // Fetch attendance data for the student between the specified dates
            $attendances = Attendance::where('user_id', $student->id)
                ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
                ->get();

            // Calculate present, absent, and leave counts
            $presentCount = Attendance::where('user_id', $student->id)
                ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
                ->where('status', 'Present')
                ->count();

            $absentCount = Attendance::where('user_id', $student->id)
                ->whereBetween('attendance_date', [$request->from_date, $request->to_date])
                ->where('status', 'Absent')
                ->count();

            // For leave requests, we need to count approved leaves
            $leaveCount = LeaveRequest::where('user_id', $student->id)
                ->whereBetween('leave_date', [$request->from_date, $request->to_date])
                ->where('status', 'approved')
                ->count();
            $grade = 'F'; // Default grade
            foreach ($gradingSystem as $gradeRule) {
                if ($presentCount >= $gradeRule->min_days) {
                    $grade = $gradeRule->grade;
                }
            }

            // Prepare the report data
            $reportData[] = [
                'name' => $student->name,
                'present_count' => $presentCount,
                'absent_count' => $absentCount,
                'leave_count' => $leaveCount,
                'grade' => $grade
            ];
        }

        // Pass the data to the view
        return view('admin.attendance.system_report', compact('reportData', 'request', 'toDate'));
    }
    public function viewLeaves()
    {
        $leaves = LeaveRequest::with('user')->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    public function approveLeave($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->status = 'approved';
        $leave->save();

        return redirect()->route('admin.leaves')->with('success', 'Leave approved.');
    }

    public function rejectLeave($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->status = 'rejected';
        $leave->save();

        return redirect()->route('admin.leaves')->with('success', 'Leave rejected.');
    }

}
