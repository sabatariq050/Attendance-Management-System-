@extends('layouts.admin')
@section('title', 'Edit Attendance-Admin Portal')

@section('content')
<div class="container">
    <h1>Edit Attendance</h1>
    <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="attendance_date">Date</label>
            <input type="date" class="form-control" id="attendance_date" name="attendance_date" value="{{ $attendance->attendance_date }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="present" {{ $attendance->status === 'present' ? 'selected' : '' }}>Present</option>
                <option value="absent" {{ $attendance->status === 'absent' ? 'selected' : '' }}>Absent</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
