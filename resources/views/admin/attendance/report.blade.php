@extends('layouts.admin')
@section('title', 'Attendance Report-Admin Portal')

@section('content')
<div class="container mt-4">
<div class="d-flex align-items-center justify-center">
    <h2 class="mb-0">Generate Attendance Report</h2>
    <a href="{{ route('attendance.generateSystemReport') }}" class="ms-5">Overall Report</a>
</div>

    <form action="{{ route('attendance.filterReport') }}" method="POST">
        @csrf

        <!-- User Selection -->
        <div class="mb-3">
    <label for="user_id" class="form-label">Select User</label>
    <select name="user_id" id="user_id" class="form-select" required>
        <option value="" disabled selected>Choose User</option>
        @foreach ($users as $userOption)
            <option value="{{ $userOption->id }}">{{ $userOption->name }}</option>
        @endforeach
    </select>
</div>

        <!-- Date Range -->
        <div class="mb-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" name="from_date" id="from_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ old('to_date', $toDate) }}"  required>
        </div>

        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
</div>
@endsection
