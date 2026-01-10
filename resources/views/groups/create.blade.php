@extends('layouts.app')

@section('title', 'Buat atau Gabung Kelompok')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-plus-circle me-2"></i>Buat Kelompok Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Nama Kelompok</label>
                            <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Contoh: Tim Web Development A" required>
                            <div class="form-text">Nama ini akan tampil di dashboard semua anggota.</div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Deskripsi Singkat</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Jelaskan tujuan atau proyek kelompok ini..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label fw-bold">Batas Waktu (Deadline)</label>
                            <input type="date" name="deadline" id="deadline" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-bold">Category</label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="">Choose category...</option>
                                <option value="Design">Design</option>
                                <option value="Development">Development</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Research">Research</option>
                                <option value="General">General</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Undang Anggota (Email)</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="anggota1@email.com">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="anggota2@email.com">
                            </div>
                            <small class="text-muted"><i class="fas fa-info-circle"></i> Anda bisa mengundang lebih banyak anggota nanti setelah kelompok dibuat.</small>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ url('/dashboard') }}" class="btn btn-light me-2">Batal</a>
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Simpan & Buat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4 bg-light">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <span class="fa-stack fa-2x text-warning">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-key fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <h5 class="fw-bold">Punya Kode Undangan?</h5>
                    <p class="text-muted small">Masukkan kode unik atau link yang diberikan oleh ketua tim Anda untuk bergabung.</p>
                    
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control text-center text-uppercase fw-bold letter-spacing-2" placeholder="X7Y-99A" style="letter-spacing: 3px;">
                        </div>
                        <button type="submit" class="btn btn-warning w-100 text-white fw-bold">Gabung Kelompok</button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body">
                    <h6 class="fw-bold"><i class="fas fa-lightbulb me-2"></i>Tips Kerja Kelompok</h6>
                    <ul class="small ps-3 mb-0">
                        <li class="mb-1">Tentukan peran anggota (Admin/Member) dengan jelas.</li>
                        <li class="mb-1">Gunakan fitur 'Prioritas' untuk menandai tugas mendesak.</li>
                        <li>Jangan lupa update status tugas agar teman sekelompok tahu progresmu.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection