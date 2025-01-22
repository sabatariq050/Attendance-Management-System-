<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AdminGradingSystemController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('main');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User routes
// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard'); // User's dashboard
    Route::get('/user/profile', [UserController::class, 'edit'])->name('user.profile');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');

    // Attendance routes for users
    Route::post('/attendance', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/attendance', [AttendanceController::class, 'viewAttendance'])->name('attendance.view'); // For users only

    // Leave Request
    Route::post('/leave', [LeaveRequestController::class, 'requestLeave'])->name('leave.request');
    Route::get('/leave', [LeaveRequestController::class, 'viewUserLeaves'])->name('leave.status');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard'); // Admin Dashboard

    // Attendance routes for admin
    Route::get('/attendance', [AdminController::class, 'viewAttendance'])->name('admin.attendance');
    Route::get('/attendance/report', [AdminController::class, 'generateReport'])->name('attendance.report');
    Route::post('/attendance/report', [AdminController::class, 'filterReport'])->name('attendance.filterReport');

    Route::resource('grading-system', AdminGradingSystemController::class);
    Route::get('/attendance/system-report', [AdminController::class, 'showSystemReportForm'])->name('attendance.systemReportForm');
    Route::post('/attendance/system-report', [AdminController::class, 'generateSystemReport'])->name('attendance.generateSystemReport');

    // CRUD Attendance
    Route::get('/attendance/edit/{id}', [AdminController::class, 'editAttendance'])->name('admin.attendance.edit');
    Route::post('/attendance/update/{id}', [AdminController::class, 'updateAttendance'])->name('admin.attendance.update');
    Route::delete('/attendance/delete/{id}', [AdminController::class, 'deleteAttendance'])->name('admin.attendance.delete');
    Route::post('/attendance/add', [AdminController::class, 'addAttendance'])->name('admin.attendance.add');

    Route::get('/grading-system', [AdminGradingSystemController::class, 'index'])->name('grading-system.index');

    // Leave Approval
    Route::get('/leaves', [AdminController::class, 'viewLeaves'])->name('admin.leaves');
    Route::post('/leaves/approve/{id}', [AdminController::class, 'approveLeave'])->name('admin.leaves.approve');
    Route::post('/leaves/reject/{id}', [AdminController::class, 'rejectLeave'])->name('admin.leaves.reject');
});
