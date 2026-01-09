@extends('layouts.app')

@section('content')


    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <div class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control search-bar ps-5" placeholder="Search for tasks, groups, or files...">
            </div>
        </div>
        <div class="col-md-4 text-end d-block d-xl-none">
            <button class="btn btn-primary"><i class="fas fa-bars"></i></button>
        </div>
    </div>

    <div class="card welcome-card mb-5 shadow-lg">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
            <div>
                <h2 class="fw-bold mb-1">Welcome, {{ auth()->user()->name }}</h2>
                <p class="text-white-50 mb-4">Here's what's happex`ning with your projects today.</p>
                
                <button class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-plus me-2"></i> Create New Group
                </button>
            </div>
            <div class="d-none d-md-block">
                <i class="fas fa-rocket text-white opacity-25" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <h5 class="fw-bold mb-0">Active Groups</h5>
        <a href="#" class="text-decoration-none small fw-bold text-primary">See All</a>
    </div>

    <div class="row g-4 mb-5">
        @forelse($projects as $project)
            <div class="col-md-4">
                <div class="card-custom h-100 position-relative">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="badge bg-light text-secondary">{{ $project->category ?? 'General' }}</span>
                        <i class="fas fa-ellipsis-v text-muted cursor-pointer"></i>
                    </div>
                    <h6 class="fw-bold mb-1">{{ $project->name }}</h6>
                    <small class="text-muted d-block mb-3">Deadline: {{ $project->deadline ? $project->deadline->format('j M') : '-' }}</small>
                    
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="fw-bold text-primary">{{ $project->progress ?? 0 }}%</small>
                    </div>
                    <div class="progress progress-slim mb-3">
                        <div class="progress-bar {{ $project->progress >= 75 ? 'bg-success' : ($project->progress >= 45 ? 'bg-warning' : 'bg-primary') }}" style="width: {{ $project->progress ?? 0 }}%"></div>
                    </div>

                    <div class="avatar-group">
                        @foreach($project->members->take(3) as $member)
                            <x-avatar :user="$member" :size="40" />
                        @endforeach
                        @if($project->members->count() > 3)
                            <span class="small ms-2 text-muted fw-bold">+{{ $project->members->count() - 3 }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card-custom text-center py-5">
                    <div class="text-muted">You have no active groups yet. Create one to get started.</div>
                </div>
            </div>
        @endforelse
    </div>

    <h5 class="fw-bold mb-3">My Tasks</h5>
    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="kanban-col">
                <div class="kanban-header">
                    <span>To Do <span class="badge bg-white text-dark ms-1 shadow-sm">{{ $tasks_todo->count() }}</span></span>
                    <i class="fas fa-plus text-muted"></i>
                </div>

                @forelse($tasks_todo as $task)
                    <div class="kanban-item">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge {{ $task->priority == 'High' ? 'bg-danger bg-opacity-10 text-danger' : ($task->priority == 'Medium' ? 'bg-primary bg-opacity-10 text-primary' : 'bg-secondary bg-opacity-10 text-secondary') }}" style="font-size:0.65rem;">{{ $task->priority }}</span>
                            <i class="fas fa-ellipsis-h text-muted small"></i>
                        </div>
                        <h6 class="fs-6 fw-bold mb-2">{{ $task->title }}</h6>
                        <div class="d-flex align-items-center text-muted small">
                            <i class="far fa-clock me-1"></i>
                            @if($task->deadline)
                                {{ \Carbon\Carbon::parse($task->deadline)->diffForHumans() }}
                            @else
                                No deadline
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-muted">No tasks in To Do.</div>
                @endforelse
            </div>
        </div>

        <div class="col-md-4">
            <div class="kanban-col">
                <div class="kanban-header">
                    <span>In Progress <span class="badge bg-white text-dark ms-1 shadow-sm">{{ $tasks_in_progress->count() }}</span></span>
                    <i class="fas fa-plus text-muted"></i>
                </div>

                @forelse($tasks_in_progress as $task)
                    <div class="kanban-item border-start border-3 border-primary">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:0.65rem;">{{ $task->priority }}</span>
                            <i class="fas fa-ellipsis-h text-muted small"></i>
                        </div>
                        <h6 class="fs-6 fw-bold mb-2">{{ $task->title }}</h6>
                        <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($task->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="avatar-group" style="transform: scale(0.8); transform-origin: left;">
                                   <x-avatar :user="$task->assignee" :size="40" />
                               </div>
                               <i class="fas fa-paperclip text-muted small"> {{ $task->files->count() ?? 0 }}</i>
                        </div>
                    </div>
                @empty
                    <div class="text-muted">No tasks in progress.</div>
                @endforelse
            </div>
        </div>

        <div class="col-md-4">
            <div class="kanban-col">
                <div class="kanban-header">
                    <span>Done <span class="badge bg-white text-dark ms-1 shadow-sm">{{ $tasks_done->count() }}</span></span>
                    <i class="fas fa-plus text-muted"></i>
                </div>

                @forelse($tasks_done as $task)
                    <div class="kanban-item opacity-75">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success" style="font-size:0.65rem;">Completed</span>
                            <i class="fas fa-check-circle text-success small"></i>
                        </div>
                        <h6 class="fs-6 fw-bold mb-2 text-decoration-line-through text-muted">{{ $task->title }}</h6>
                    </div>
                @empty
                    <div class="text-muted">No completed tasks.</div>
                @endforelse
            </div>
        </div>

    </div>

@endsection