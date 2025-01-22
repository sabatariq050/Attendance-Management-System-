@extends('layouts.admin')
@section('content')

<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <p>{{ $attendanceStats['total_students'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Attendances</h5>
                    <p>{{ $attendanceStats['total_attendance'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Leave Requests</h5>
                    <p>{{ $attendanceStats['total_leaves'] }}</p>
                </div>
            </div>
        </div>
        
    </div>
    <a  href="{{ route('grading-system.index') }}" class="mt-5">Edit Grades</a>
</div>
@endsection
