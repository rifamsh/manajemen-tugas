@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Project Timeline</h4>
        <p class="text-muted small">Track every milestone and task deadline chronologically.</p>
    </div>
    <div class="d-flex gap-2">
        <div class="btn-group shadow-sm">
            <button class="btn btn-white border btn-sm active">List View</button>
            <button class="btn btn-white border btn-sm">Gantt Chart</button>
        </div>
        <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
            <i class="fas fa-calendar-plus me-2"></i>Schedule Task
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 overflow-hidden">
    <div class="timeline-container position-relative">
        
        <div class="timeline-group mb-5">
            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-primary rounded-pill px-3 py-2 me-3">TODAY</span>
                <hr class="flex-grow-1 opacity-10">
            </div>

            <div class="ms-md-5 ps-4 border-start border-2 border-primary border-opacity-25 position-relative">
                @foreach($tasks->where('deadline', date('Y-m-d')) as $task)
                <div class="timeline-item mb-4 position-relative">
                    <div class="position-absolute rounded-circle bg-primary shadow" style="width: 14px; height: 14px; left: -32px; top: 12px; border: 3px solid white;"></div>
                    
                    <div class="card border-0 shadow-sm rounded-4 hover-lift">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="bg-light rounded-3 p-2 text-center" style="width: 60px;">
                                        <span class="d-block fw-bold text-primary mb-0" style="font-size: 1.1rem;">{{ \Carbon\Carbon::parse($task->due_time)->format('H:i') }}</span>
                                        <small class="text-muted text-uppercase" style="font-size: 0.6rem;">WIB</small>
                                    </div>
                                </div>
                                <div class="col px-md-4">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h6 class="fw-bold mb-0">{{ $task->title }}</h6>
                                        <span class="badge {{ $task->priority == 'High' ? 'bg-danger' : 'bg-warning' }} bg-opacity-10 {{ $task->priority == 'High' ? 'text-danger' : 'text-warning' }}" style="font-size: 0.6rem;">{{ $task->priority }}</span>
                                    </div>
                                    <p class="text-muted small mb-0 text-truncate" style="max-width: 400px;">{{ $task->description }}</p>
                                </div>
                                <div class="col-auto text-end">
                                    <div class="avatar-group mb-2">
                                        <img src="https://ui-avatars.com/api/?name={{ $task->user->name }}" class="rounded-circle border border-2 border-white" width="30" title="{{ $task->user->name }}">
                                    </div>
                                    <span class="badge bg-light text-muted rounded-pill px-3 small border" style="font-size: 0.7rem;">{{ $task->status }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="timeline-group">
            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-light text-muted border rounded-pill px-3 py-2 me-3">UPCOMING</span>
                <hr class="flex-grow-1 opacity-10">
            </div>

            <div class="ms-md-5 ps-4 border-start border-2 border-dashed border-secondary border-opacity-25 position-relative">
                @foreach($tasks->where('deadline', '>', date('Y-m-d')) as $task)
                <div class="timeline-item mb-4 position-relative">
                    <div class="position-absolute rounded-circle bg-secondary shadow-sm" style="width: 12px; height: 12px; left: -31px; top: 12px; border: 2px solid white;"></div>
                    
                    <div class="card border-0 bg-light bg-opacity-50 shadow-none border-start border-4 border-warning rounded-3">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-warning fw-bold d-block mb-1"><i class="far fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</small>
                                    <h6 class="fw-bold mb-1">{{ $task->title }}</h6>
                                    <small class="text-muted">{{ $task->description }}</small>
                                </div>
                                <div class="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted cursor-pointer" data-bs-toggle="dropdown"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<style>
    /* Efek melayang saat card disentuh mouse */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    /* Garis putus-putus untuk masa depan */
    .border-dashed {
        border-style: dashed !important;
    }

    /* Avatar bertumpuk */
    .avatar-group img {
        margin-left: -10px;
        transition: 0.2s;
    }
    .avatar-group img:hover {
        margin-top: -5px;
        z-index: 10;
    }
</style>
@endsection