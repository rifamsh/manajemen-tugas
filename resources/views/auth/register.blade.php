@extends('layouts.auth')

@section('title', 'Daftar Akun Baru')

@section('content')
<div class="mb-4">
    <h2 class="login-heading mb-2">Create Account </h2>
    <p class="text-muted">Bergabunglah dengan tim dan mulai berkarya.</p>
</div>

<form action="{{ route('register.process') }}" method="POST">
    @csrf
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" required>
        <label for="name">Nama Lengkap</label>
    </div>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
        <label for="email">Email Address</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password (Min. 8 karakter)</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" required>
        <label for="password_confirmation">Ulangi Password</label>
    </div>

    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="terms" required>
        <label class="form-check-label small text-muted" for="terms">
            Saya menyetujui <a href="#" class="text-decoration-none">Syarat & Ketentuan</a> yang berlaku.
        </label>
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-4">Daftar Sekarang</button>
    
    <div class="text-center">
        <small class="text-muted">Sudah punya akun? <a href="{{ url('/login') }}" class="fw-bold text-primary text-decoration-none">Login di sini</a></small>
    </div>
</form>
@endsection