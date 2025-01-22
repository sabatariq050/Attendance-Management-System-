@extends('layouts.user')
@section('title', 'Edit Profile-Student Portal')

@section('content')

<div class="container mt-4">
    <h2>Update Profile Picture</h2>

    <!-- Profile Picture Update Form -->
    <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf
        @method('PUT')

        <!-- File Input (First Column) -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" name="profile_picture" class="form-control" id="profile_picture">
            </div>

            <!-- Save Button (Below Input) -->
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        <!-- Display Current Profile Picture (Second Column) -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            @if (Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="150" height="150">
            @else
                <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle" width="150" height="150">
            @endif
        </div>
    </form>
</div>

@endsection
