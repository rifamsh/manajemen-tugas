@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('dashboard') }}" class="btn btn-white border rounded-circle me-3 shadow-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left text-muted"></i>
    </a>
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill" style="font-size: 0.7rem;">{{ $project->category }}</span>
            <span class="text-muted small">•</span>
            <span class="text-muted small">Created by You</span>
        </div>
        <h4 class="fw-bold mb-0">{{ $project->name }}</h4>
    </div>
    <div class="ms-auto d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="fas fa-share-alt me-2"></i>Share</button>
        <button class="btn btn-primary btn-sm rounded-pill px-3"><i class="fas fa-plus me-2"></i>Add Task</button>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h6 class="fw-bold text-secondary small text-uppercase mb-3">Project Description</h6>
                    <p class="text-muted small mb-0">{{ $project->description ?? 'No description provided for this project.' }}</p>
                </div>
                <div class="col-md-5 border-start ps-md-4 mt-3 mt-md-0 text-center text-md-start">
                    <h6 class="fw-bold text-secondary small text-uppercase mb-3">Overall Completion</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-grow-1">
                            <div class="progress rounded-pill" style="height: 10px;">
                                <div class="progress-bar bg-primary shadow-sm" style="width: {{ $project->progress }}%"></div>
                            </div>
                        </div>
                        <span class="fw-bold text-primary">{{ $project->progress }}%</span>
                    </div>
                    <small class="text-muted mt-2 d-block"><i class="far fa-calendar-check me-1"></i> Deadline: <strong>{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</strong></small>
                </div>
            </div>
        </div>

        <ul class="nav nav-pills mb-4 gap-2" id="pills-tab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 fw-bold" data-bs-toggle="pill" data-bs-target="#tasks">Tasks</button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 fw-bold text-muted" data-bs-toggle="pill" data-bs-target="#files">Shared Files</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tasks">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="list-group list-group-flush">
                        @foreach($project->tasks as $task)
                        <div class="list-group-item p-3 border-0 border-bottom task-item">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input rounded-circle p-2" type="checkbox" {{ $task->status == 'done' ? 'checked' : '' }}>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1 {{ $task->status == 'done' ? 'text-decoration-line-through text-muted' : '' }}">{{ $task->title }}</h6>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge {{ $task->priority == 'High' ? 'bg-danger' : ($task->priority == 'Medium' ? 'bg-warning' : 'bg-info') }} bg-opacity-10 {{ $task->priority == 'High' ? 'text-danger' : ($task->priority == 'Medium' ? 'text-warning' : 'text-info') }}" style="font-size: 0.6rem;">{{ $task->priority }}</span>
                                        <small class="text-muted" style="font-size: 0.7rem;"><i class="far fa-calendar me-1"></i> {{ $task->deadline }}</small>
                                        <small class="text-muted" style="font-size: 0.7rem;"><i class="far fa-comment me-1"></i> {{ $task->comments_count ?? 0 }}</small>
                                    </div>
                                </div>
                                <div class="avatar-group ms-3">
                                    <img src="https://ui-avatars.com/api/?name={{ $task->user->name }}" class="rounded-circle border border-2 border-white" width="30" title="{{ $task->user->name }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="files">
                <div class="row g-3">
                    @foreach($project->files as $file)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 p-3 d-flex flex-row align-items-center gap-3">
                            <div class="bg-light p-3 rounded-3 text-primary">
                                <i class="fas {{ $file->file_type == 'pdf' ? 'fa-file-pdf text-danger' : 'fa-file-image' }} fa-2x"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-truncate">{{ $file->file_name }}</h6>
                                <small class="text-muted">Uploaded by {{ $file->user->name }}</small>
                            </div>
                            <button class="btn btn-light btn-sm ms-auto rounded-circle"><i class="fas fa-download"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Team Members</h6>
                <button class="btn btn-light btn-sm rounded-circle"><i class="fas fa-user-plus text-primary"></i></button>
            </div>
            <div class="d-flex flex-column gap-3">
                @foreach($project->teams as $member)
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ $member->user->name }}" class="rounded-circle" width="35">
                        <div>
                            <h6 class="fw-bold mb-0 small">{{ $member->user->name }}</h6>
                            <small class="text-muted" style="font-size: 0.65rem;">{{ $member->role }}</small>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-circle p-1" style="width: 8px; height: 8px;"></span>
                </div>
                @endforeach
            </div>
            <hr class="my-4 opacity-50">
            <div class="d-grid">
                <button class="btn btn-light text-primary fw-bold btn-sm rounded-pill">View All Discussion</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-4">Recent Activity</h6>
            <div class="timeline-small small">
                <div class="d-flex gap-3 mb-4">
                    <div class="text-primary mt-1"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="mb-0 fw-bold">Task Completed</p>
                        <p class="text-muted mb-0">Sumbul finished "UI Login Design"</p>
                        <small class="text-muted opacity-75">2 hours ago</small>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-0">
                    <div class="text-warning mt-1"><i class="fas fa-file-upload"></i></div>
                    <div>
                        <p class="mb-0 fw-bold">New File Uploaded</p>
                        <p class="text-muted mb-0">Budi uploaded "brief_final.pdf"</p>
                        <small class="text-muted opacity-75">5 hours ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .task-item:hover { background-color: #f8f9ff !important; transition: 0.3s; }
    .nav-pills .nav-link.active { background-color: #0d6efd; box-shadow: 0 4px 10px rgba(13,110,253,0.25); }
    .nav-pills .nav-link:not(.active) { background-color: #f1f3f5; }
</style>
@endsection