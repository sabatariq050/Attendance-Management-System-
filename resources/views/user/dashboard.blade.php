@extends('layouts.user')
@section('title', 'Edit Profile-Student Portal')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Mark Attendance Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Mark Attendance</h4>
                </div>
                <div class="card-body">
                    <p><strong>Today's Date:</strong> {{ date('Y-m-d') }}</p>
                    <form action="{{ route('attendance.mark') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block">Mark Attendance</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Request Leave Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Request Leave</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('leave.request') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="leave_date">Leave Date</label>
                            <input 
                                type="date" 
                                name="leave_date" 
                                class="form-control" 
                                id="leave_date" 
                                required
                            >
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason for Leave</label>
                            <textarea 
                                name="reason" 
                                class="form-control" 
                                id="reason" 
                                rows="3" 
                                required
                            ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Request Leave</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!--<a href="{{ route('attendance.view') }}" class="btn btn-info">View Attendance</a>
<a href="{{ route('user.profile') }}" class="btn btn-secondary">Edit Profile</a>
