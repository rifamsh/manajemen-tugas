@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h3 class="mb-4">Dashboard: Kelompok Web Programming</h3>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <h6 class="text-uppercase mb-2">Total Tugas</h6>
                <h2 class="fw-bold">24</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body">
                <h6 class="text-uppercase mb-2">In Progress</h6>
                <h2 class="fw-bold">8</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-danger text-white">
            <div class="card-body">
                <h6 class="text-uppercase mb-2">Overdue / Telat</h6>
                <h2 class="fw-bold">2</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <h6 class="text-uppercase mb-2">Selesai</h6>
                <h2 class="fw-bold">14</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Aktivitas Terbaru</div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-info me-2">Comment</span>
                            <strong>Budi</strong> berkomentar di task "Desain UI"
                        </div>
                        <small class="text-muted">5 menit lalu</small>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-success me-2">Done</span>
                            <strong>Siti</strong> menyelesaikan task "Setup Laravel"
                        </div>
                        <small class="text-muted">1 jam lalu</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Anggota Tim</div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3">
                    <div>
                        <h6 class="mb-0">Ketua Tim (Admin)</h6>
                        <small class="text-success">Online</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3">
                    <div>
                        <h6 class="mb-0">Anggota 1</h6>
                        <small class="text-muted">Offline</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection