@extends('layouts.user')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
        <h2 class="text-center mb-4">Register</h2>

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <!-- Name Field -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Enter your name" 
                    required 
                    value="">

                <!-- Error message for name -->
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Enter your email" 
                    required 
                    value="">

                <!-- Error message for email -->
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Enter your password" 
                    required>

                <!-- Error message for password -->
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Confirm your password" 
                    required>

                <!-- Error message for password confirmation -->
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>

            <!-- Redirect to Login -->
            <div class="text-center mt-3">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
