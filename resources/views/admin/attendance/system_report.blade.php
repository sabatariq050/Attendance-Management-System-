@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Attendance Report from {{ $request->from_date }} to {{ $request->to_date }}</h2>

    @if(count($reportData) > 0)
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Present Days</th>
                    <th>Absent Days</th>
                    <th>Leave Days</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportData as $data)
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['present_count'] }}</td>
                        <td>{{ $data['absent_count'] }}</td>
                        <td>{{ $data['leave_count'] }}</td>
                        <td>{{ $data['grade'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info mt-4">No data available for the selected date range.</div>
    @endif
</div>
@endsection
