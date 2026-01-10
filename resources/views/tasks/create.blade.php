@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">New Task</h4>
    @if($selectedProject)
        <a href="{{ route('groups.show', $selectedProject) }}" class="btn btn-outline-secondary">Back to {{ $selectedProject->name }}</a>
    @else
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Back</a>
    @endif
</div>

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    @if($selectedProject)
        <input type="hidden" name="project_id" value="{{ $selectedProject->id }}">
    @endif
    <div class="card p-4">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Project</label>
            @if($selectedProject)
                <input type="text" class="form-control" value="{{ $selectedProject->name }}" readonly>
            @else
                <select name="project_id" class="form-select" required>
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="row g-2">
            <div class="col-md-4 mb-3">
                <label class="form-label">Priority</label>
                <select name="priority" class="form-select">
                    <option>High</option>
                    <option selected>Medium</option>
                    <option>Low</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="todo">To Do</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Completed</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control">
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary">Create Task</button>
        </div>
    </div>
</form>

@endsection
