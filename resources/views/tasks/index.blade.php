@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Task Board - Website Redesign</h4>
    <button class="btn btn-primary rounded-pill"><i class="fas fa-plus me-2"></i>New Task</button>
</div>

<div class="row g-3">
    @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Completed'] as $status => $label)
    <div class="col-md-4">
        <div class="bg-light p-3 rounded-4 border-top border-4 {{ $status == 'todo' ? 'border-secondary' : ($status == 'in_progress' ? 'border-primary' : 'border-success') }}">
            <h6 class="fw-bold mb-3 d-flex justify-content-between">
                {{ $label }} <span class="badge bg-white text-dark shadow-sm">3</span>
            </h6>
            
            <div class="card border-0 shadow-sm rounded-3 mb-3 p-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-danger bg-opacity-10 text-danger" style="font-size: 0.7rem;">High Priority</span>
                    <i class="fas fa-ellipsis-h text-muted small"></i>
                </div>
                <h6 class="fw-bold small mb-2">Design UI for Login Page</h6>
                <p class="text-muted mb-3" style="font-size: 0.75rem;">Create a clean and modern login interface.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="avatar-group">
                        <img src="https://i.pravatar.cc/100" class="rounded-circle border border-2 border-white" width="25">
                    </div>
                    <small class="text-muted"><i class="far fa-clock me-1"></i> 20 Mar</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection