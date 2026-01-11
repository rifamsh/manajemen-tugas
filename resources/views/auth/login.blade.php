@extends('layouts.auth')

@section('title', 'Login - Task Manager')

@section('content')
<div class="container-fluid p-0">
    <div class="row min-vh-100 g-0">
        
        <div class="col-lg-4 col-md-5 login-left d-flex align-items-center justify-content-center p-4">
            <div style="width: 100%; max-width: 380px;"> 
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="200" class="me-2">
                </div>

                <div class="mb-4">
                    <h2 class="fw-bold text-dark">Welcome Back</h2>
                    <p class="text-muted small">Please login to your account to continue.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 small mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">EMAIL</label>
                        <input type="email" name="email" class="form-control" placeholder="user@example.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small text-muted" for="remember">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none">Forgot Password?</a>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary shadow-sm">Login</button>
                    </div>

                    <div class="text-center small">
                        <span class="text-muted">New here?</span>
                        <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none ms-1">Create Account</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8 col-md-7 d-none d-md-block login-right position-relative">
            <div class="wave-connector">
                <svg viewBox="0 0 500 1500" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                    <path d="M0,0 L0,1500 L50,1500 C400,1000 50,500 350,0 Z"></path>
                </svg>
            </div>
        </div>

    </div>
</div>
@endsection