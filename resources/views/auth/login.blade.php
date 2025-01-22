@extends('layouts.user')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-4">
        <h2 class="text-center mb-4">Login</h2>

        <form action="{{ url('/login') }}" method="POST">
            @csrf

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
                    value="{{ old('email') }}">

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

            <!-- Login Button -->
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
            <!-- Forgot Password Link (optional) -->
           
        </form>
    </div>
</div>


