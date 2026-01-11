@extends('layouts.auth')

@section('title', 'Verify Email - Task Manager')

@section('content')
<div class="container-fluid p-0">
    <div class="row min-vh-100 g-0">
        
        <div class="col-lg-4 col-md-5 login-left d-flex align-items-center justify-content-center p-4">
            <div style="width: 100%; max-width: 380px;">
                
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="200" class="me-2">
                </div>

                <div class="mb-4">
                    <h2 class="fw-bold text-dark">Verify Email</h2>
                    <p class="text-muted small">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success py-2 small mb-4">
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                @endif

                <div class="d-grid gap-2 mb-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary shadow-sm w-100">Resend Verification Email</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary w-100">Log Out</button>
                    </form>
                </div>
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