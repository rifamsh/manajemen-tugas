@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="mb-5">
    <h2 class="login-heading mb-2">Welcome Back! </h2>
    <p class="text-muted">Silakan masuk untuk mengelola tugas Anda.</p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login.process') }}" method="POST">
    @csrf <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
        <label for="email">Email Address</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label small" for="remember">Ingat Saya</label>
        </div>
        <a href="#" class="text-decoration-none small text-primary">Lupa Password?</a>
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">Masuk Sekarang</button>

    <div class="text-center mb-3">
        <span class="text-muted small">atau masuk dengan</span>
    </div>

    <div class="d-flex gap-2 mb-4">
        <button type="button" class="btn btn-outline-secondary w-50 small">
            <i class="fab fa-google me-1"></i> Google
        </button>
        <button type="button" class="btn btn-outline-secondary w-50 small">
            <i class="fab fa-github me-1"></i> GitHub
        </button>
    </div>
    
    <div class="text-center">
        <small class="text-muted">Belum punya akun? <a href="{{ url('/register') }}" class="fw-bold text-primary text-decoration-none">Daftar di sini</a></small>
    </div>
</form>
@endsection