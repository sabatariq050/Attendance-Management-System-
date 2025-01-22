@extends('layouts.admin')
@section('title', 'Grade-Admin Portal')

@section('content')
<h2>Add Grade</h2>
<form action="{{ route('grading-system.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="min_days">Min Days</label>
        <input type="number" name="min_days" id="min_days" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="grade">Grade</label>
        <input type="text" name="grade" id="grade" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Save</button>
</form>
@endsection
