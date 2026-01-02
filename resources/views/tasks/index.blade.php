@extends('layouts.app')

@section('title', 'Kanban Board')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Project: Web Programming</h3>
    <div>
        <div class="btn-group me-2">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Filter Priority
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">High</a></li>
                <li><a class="dropdown-item" href="#">Medium</a></li>
            </ul>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
            <i class="fas fa-plus"></i> New Task
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="p-2 mb-2 bg-secondary text-white rounded d-flex justify-content-between">
            <span class="fw-bold">To Do</span>
            <span class="badge bg-light text-dark">3</span>
        </div>
        <div class="kanban-col" id="todo">
            <div class="task-card">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-danger">High</span>
                    <small class="text-muted"><i class="fas fa-paperclip"></i> 2</small>
                </div>
                <h6 class="fw-bold">Buat Database Schema</h6>
                <p class="text-muted small mb-2">Desain ERD untuk user dan task table.</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="avatars">
                        <img src="https://via.placeholder.com/24" class="rounded-circle" title="Budi">
                    </div>
                    <small class="text-danger fw-bold"><i class="far fa-clock"></i> 25 Dec</small>
                </div>
            </div>
            <button class="btn btn-light w-100 text-muted mt-2 btn-sm">+ Add Task</button>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-2 mb-2 bg-primary text-white rounded d-flex justify-content-between">
            <span class="fw-bold">In Progress</span>
            <span class="badge bg-light text-dark">1</span>
        </div>
        <div class="kanban-col" id="inprogress">
            <div class="task-card">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-warning text-dark">Medium</span>
                </div>
                <h6 class="fw-bold">Coding Login Page</h6>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="avatars">
                        <img src="https://via.placeholder.com/24" class="rounded-circle">
                    </div>
                    <small class="text-muted"><i class="far fa-clock"></i> 28 Dec</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-2 mb-2 bg-info text-dark rounded d-flex justify-content-between">
            <span class="fw-bold">Review</span>
            <span class="badge bg-light text-dark">0</span>
        </div>
        <div class="kanban-col" id="review">
            </div>
    </div>

    <div class="col-md-3">
        <div class="p-2 mb-2 bg-success text-white rounded d-flex justify-content-between">
            <span class="fw-bold">Done</span>
            <span class="badge bg-light text-dark">5</span>
        </div>
        <div class="kanban-col" id="done">
            <div class="task-card opacity-75">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-secondary">Low</span>
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <h6 class="fw-bold text-decoration-line-through">Setup Laravel Project</h6>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tugas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Prioritas</label>
                            <select class="form-select">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign ke Anggota</label>
                        <select class="form-select" multiple>
                            <option>Anggota A</option>
                            <option>Anggota B</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan Tugas</button>
            </div>
        </div>
    </div>
</div>
@endsection