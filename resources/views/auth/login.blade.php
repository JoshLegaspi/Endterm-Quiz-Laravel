@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg rounded-4 p-4" style="max-width: 420px; width: 100%;">
        <h2 class="text-center text-primary mb-4 fw-bold">Welcome Back!</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input id="email" type="email" 
                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input id="password" type="password" 
                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                       name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg shadow-sm rounded-pill">
                    Login
                </button>
            </div>
        </form>

        <hr class="my-4">

        <p class="text-center text-muted small mb-0">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">Register here</a>
        </p>
    </div>
</div>
@endsection
