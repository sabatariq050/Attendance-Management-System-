@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Generate Overall Report</h2>

    <form action="{{ route('attendance.generateSystemReport') }}" method="POST">
        @csrf

        <!-- Date Range -->
        <div class="mb-3">
            <label for="from_date" class="form-label">From Date</label>
            <input type="date" name="from_date" id="from_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="to_date" class="form-label">To Date</label>
            <input type="date" name="to_date" id="to_date" class="form-control"  value="{{ old('to_date', $toDate) }}"required>
        </div>

        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
</div>
@endsection
