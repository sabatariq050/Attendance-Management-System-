@extends('layouts.admin')
@section('title', 'Attendance Report-Admin Portal')

@section('content')
<div class="container mt-4">
    <h3>Report for {{ $user->name }}</h3>
    <p><strong>From:</strong> {{ $request->from_date }} | <strong>To:</strong> {{ $request->to_date }}</p>

    <!-- Attendance Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary -->
    <div class="mt-3">
        <p><strong>Present:</strong> {{ $presentCount }}</p>
        <p><strong>Absent:</strong> {{ $absentCount }}</p>
        <p><strong>Leaves:</strong> {{ $leaveCount }}</p>
    </div>

    <!-- Back Button -->
    <a href="{{ route('attendance.report') }}" class="btn btn-secondary mt-3">Back to Filter</a>
</div>
@endsection
