@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Edit Task</h4>
    <a href="{{ route('tasks') }}" class="btn btn-outline-secondary">Back</a>
</div>

<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf @method('PUT')
    <div class="card p-4">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ $task->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <div class="row g-2">
            <div class="col-md-4 mb-3">
                <label class="form-label">Priority</label>
                <select name="priority" class="form-select">
                    <option {{ $task->priority=='High' ? 'selected' : '' }}>High</option>
                    <option {{ $task->priority=='Medium' ? 'selected' : '' }}>Medium</option>
                    <option {{ $task->priority=='Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="todo" {{ $task->status=='todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ $task->status=='in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $task->status=='done' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ $task->deadline? $task->deadline->format('Y-m-d') : '' }}">
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary">Update Task</button>
        </div>
    </div>
</form>

@endsection
