@extends('layouts.auth')

@section('title', 'Reset Password - Task Manager')

@section('content')
<div class="container-fluid p-0">
    <div class="row min-vh-100 g-0">
        
        <div class="col-lg-4 col-md-5 login-left d-flex align-items-center justify-content-center p-4">
            <div style="width: 100%; max-width: 380px;">
                
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="200" class="me-2">
                </div>

                <div class="mb-4">
                    <h2 class="fw-bold text-dark">Reset Password</h2>
                    <p class="text-muted small">Please enter your new password below.</p>
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

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">EMAIL</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">NEW PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="New Password" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">CONFIRM PASSWORD</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary shadow-sm">Reset Password</button>
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