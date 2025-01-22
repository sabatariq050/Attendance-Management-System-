@extends('layouts.user')

@section('title', 'Leaves- Student Portal')

@section('content')
    <h1>My Leave Requests</h1>

    @if($leaveRequests->isEmpty())
        <p>You have not submitted any leave requests.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Leave Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Requested On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests as $leave)
                    <tr>
                        <td>{{ $leave->leave_date }}</td>
                        <td>{{ $leave->reason }}</td>
                        <td>
                            @if ($leave->status == 'Pending')
                                <span class="badge bg-warning">{{ $leave->status }}</span>
                            @elseif ($leave->status == 'Approved')
                                <span class="badge bg-success">{{ $leave->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $leave->status }}</span>
                            @endif
                        </td>
                        <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
