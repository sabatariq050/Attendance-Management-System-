@extends('layouts.user')

@section('title', 'Attendance-Student Portal')

@section('content')


<div class="container mt-5">
    <h1>Your Attendance</h1>
    <table class="table table-striped table-bordered">
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
                    <td>{{ ucfirst($attendance->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection