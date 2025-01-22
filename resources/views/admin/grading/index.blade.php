@extends('layouts.admin')
@section('title', 'Grade-Admin Portal')

@section('content')
<h2>Grading System</h2>
<a href="{{ route('grading-system.create') }}" class="btn btn-primary mb-3">Add New Grade</a>
<table class="table">
    <thead>
        <tr>
            <th>Min Days</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
        <tr>
            <td>{{ $grade->min_days }}</td>
            <td>{{ $grade->grade }}</td>
            <td>
                <a href="{{ route('grading-system.edit', $grade->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('grading-system.destroy', $grade->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
