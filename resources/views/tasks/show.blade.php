@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <span class="badge bg-danger mb-2">High Priority</span>
            <span class="badge bg-secondary mb-2">In Progress</span>
            <h2 class="fw-bold">Buat Database Schema</h2>
            <p class="text-muted">Project: Web Programming</p>
        </div>
        <div>
            <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
            <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
            <a href="{{ url('/tasks') }}" class="btn btn-light btn-sm">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><i class="fas fa-align-left me-2"></i>Deskripsi</h5>
                    <p class="card-text">
                        Merancang ERD (Entity Relationship Diagram) untuk sistem Task Manager. 
                        Tabel yang dibutuhkan: Users, Teams, Tasks, Comments, dan Attachments.
                        Pastikan relasi One-to-Many sudah benar.
                    </p>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title fw-bold"><i class="fas fa-check-square me-2"></i>Checklist</h5>
                        <button class="btn btn-sm btn-light">Hide Completed</button>
                    </div>
                    
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: 66%"></div>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" checked id="sub1">
                        <label class="form-check-label text-decoration-line-through text-muted" for="sub1">Desain Tabel User</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" checked id="sub2">
                        <label class="form-check-label text-decoration-line-through text-muted" for="sub2">Desain Tabel Task</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="sub3">
                        <label class="form-check-label" for="sub3">Review Relasi Foreign Key</label>
                    </div>
                    <button class="btn btn-sm btn-light mt-2">+ Tambah Item</button>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3"><i class="fas fa-paperclip me-2"></i>Lampiran</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center border p-2 rounded bg-light">
                                <div class="me-3 display-6 text-danger"><i class="fas fa-file-pdf"></i></div>
                                <div class="overflow-hidden">
                                    <h6 class="mb-0 text-truncate">Mockup_Design.pdf</h6>
                                    <small class="text-muted">2.4 MB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center border p-2 rounded bg-light">
                                <div class="me-3 display-6 text-primary"><i class="fas fa-file-image"></i></div>
                                <div class="overflow-hidden">
                                    <h6 class="mb-0 text-truncate">erd_draft_v1.png</h6>
                                    <small class="text-muted">1.1 MB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-secondary w-100 h-100 border-dashed">
                                <i class="fas fa-plus"></i> Upload File
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4"><i class="fas fa-comments me-2"></i>Komentar</h5>
                    
                    <div class="d-flex mb-3">
                        <img src="https://via.placeholder.com/32" class="rounded-circle me-2" width="32" height="32">
                        <div class="bg-white p-3 rounded shadow-sm w-100">
                            <div class="d-flex justify-content-between">
                                <strong>Ketua Tim</strong>
                                <small class="text-muted">2 jam lalu</small>
                            </div>
                            <p class="mb-0 small">Tolong perhatikan relasi di tabel Comments ya, jangan sampai salah foreign key.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <img src="https://via.placeholder.com/32" class="rounded-circle me-2" width="32" height="32">
                        <div class="bg-white p-3 rounded shadow-sm w-100">
                            <div class="d-flex justify-content-between">
                                <strong>Saya</strong>
                                <small class="text-muted">Baru saja</small>
                            </div>
                            <p class="mb-0 small">Siap, nanti saya cek ulang.</p>
                        </div>
                    </div>

                    <div class="d-flex mt-4">
                        <img src="https://via.placeholder.com/32" class="rounded-circle me-2" width="32" height="32">
                        <div class="w-100">
                            <textarea class="form-control mb-2" rows="2" placeholder="Tulis komentar..."></textarea>
                            <button class="btn btn-primary btn-sm">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-muted text-uppercase small fw-bold">Assigned To</h6>
                        <div class="d-flex mt-2">
                            <img src="https://via.placeholder.com/32" class="rounded-circle me-1 border border-white" title="Budi">
                            <img src="https://via.placeholder.com/32" class="rounded-circle me-1 border border-white" title="Siti">
                            <button class="btn btn-sm btn-light rounded-circle" style="width:32px; height:32px;">+</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted text-uppercase small fw-bold">Deadline</h6>
                        <div class="d-flex align-items-center mt-2 text-danger">
                            <i class="far fa-clock me-2"></i>
                            <span class="fw-bold">25 Des 2024</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted text-uppercase small fw-bold">Labels</h6>
                        <div class="mt-2">
                            <span class="badge bg-info text-dark">Database</span>
                            <span class="badge bg-warning text-dark">Backend</span>
                            <button class="btn btn-sm btn-light py-0 px-1">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection