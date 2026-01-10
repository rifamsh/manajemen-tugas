@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">My Groups</h4>
    <a href="{{ route('groups.create') }}" class="btn btn-primary rounded-pill"><i class="fas fa-plus me-2"></i>New Group</a>
</div>

<div class="row g-4">
    @forelse($projects as $project)
        <div class="col-md-6 col-lg-4">
            <div class="card-custom h-100 position-relative">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-light text-secondary">{{ $project->status ?? 'Active' }}</span>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('projects.show', $project) }}"><i class="fas fa-eye me-2"></i>View</a></li>
                            <li><a class="dropdown-item" href="{{ route('projects.edit', $project) }}"><i class="fas fa-edit me-2"></i>Edit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash me-2"></i>Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <h6 class="fw-bold mb-1">{{ $project->name }}</h6>
                <p class="text-muted small mb-2">{{ $project->description ?? 'No description' }}</p>
                <small class="text-muted d-block mb-3">
                    <i class="far fa-calendar me-1"></i>
                    Deadline: {{ $project->deadline ? $project->deadline->format('j M Y') : 'No deadline' }}
                </small>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="fw-bold text-primary">{{ $project->progress ?? 0 }}% Complete</small>
                </div>
                <div class="progress progress-slim mb-3">
                    <div class="progress-bar {{ $project->progress >= 75 ? 'bg-success' : ($project->progress >= 45 ? 'bg-warning' : 'bg-primary') }}" style="width: {{ $project->progress ?? 0 }}%"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="avatar-group">
                        @foreach($project->members->take(3) as $member)
                            <x-avatar :user="$member" :size="32" />
                        @endforeach
                        @if($project->members->count() > 3)
                            <span class="small ms-2 text-muted fw-bold">+{{ $project->members->count() - 3 }}</span>
                        @endif
                    </div>
                    <small class="text-muted">{{ $project->members->count() }} members</small>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card-custom text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No groups yet</h5>
                <p class="text-muted">Create your first group to get started with collaboration.</p>
                <a href="{{ route('groups.create') }}" class="btn btn-primary rounded-pill">
                    <i class="fas fa-plus me-2"></i>Create New Group
                </a>
            </div>
        </div>
    @endforelse
</div>

@endsection
