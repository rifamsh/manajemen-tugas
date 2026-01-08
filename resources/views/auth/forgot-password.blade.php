@extends('layouts.auth')

@section('title', 'Forgot Password - Task Manager')

@section('content')
<div class="container-fluid">
    <div class="row h-100 g-0">
        
        <div class="col-lg-4 col-md-5 login-left">
            <div style="width: 100%; max-width: 380px;">
                
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="200" class="me-2">
                </div>

                <div class="mb-4">
                    <h2 class="fw-bold text-dark">Forgot Password?</h2>
                    <p class="text-muted small">No worries! Enter your email and we'll send you reset instructions.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success py-2 small mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger py-2 small mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control" placeholder="user@example.com" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary shadow-sm">Send Reset Link</button>
                    </div>

                    <div class="text-center small">
                        <a href="{{ route('login') }}" class="fw-bold text-secondary text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8 col-md-7 d-none d-md-block login-right">
            <div class="wave-connector">
                <svg viewBox="0 0 500 1500" preserveAspectRatio="none">
                    <path d="M0,0 L0,1500 L50,1500 C400,1000 50,500 350,0 Z"></path>
                </svg>
            </div>
        </div>

    </div>
</div>
@endsection