@extends('layouts.admin')

@section('title', 'Attendance-Admin Portal')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Attendance Records</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ ucfirst($attendance->status) }}</td>
                    <td>
                        <a href="{{ route('admin.attendance.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.attendance.delete', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

  
</div>
@endsection
