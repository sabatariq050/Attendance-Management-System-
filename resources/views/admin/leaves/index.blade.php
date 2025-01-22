@extends('layouts.admin')
@section('title', 'Leaves-Admin Portal')

@section('content')
<div class="container">
    <h1>Leave Requests</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->id }}</td>
                    <td>{{ $leave->user->name }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ ucfirst($leave->status) }}</td>
                    <td>
                        @if ($leave->status === 'pending')
                            <form action="{{ route('admin.leaves.approve', $leave->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.leaves.reject', $leave->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <span>{{ ucfirst($leave->status) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
