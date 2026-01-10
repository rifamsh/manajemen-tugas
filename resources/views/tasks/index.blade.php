@extends('layouts.app')
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Task Board</h4>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary rounded-pill"><i class="fas fa-plus me-2"></i>New Task</a>
</div>

<div class="row g-3">
    @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Completed'] as $status => $label)
    <div class="col-md-4">
        <div class="bg-light p-3 rounded-4 border-top border-4 {{ $status == 'todo' ? 'border-secondary' : ($status == 'in_progress' ? 'border-primary' : 'border-success') }}">
            <h6 class="fw-bold mb-3 d-flex justify-content-between">
                {{ $label }} <span class="badge bg-white text-dark shadow-sm">{{ $tasks->get($status, collect())->count() }}</span>
            </h6>
            @php $items = $tasks->get($status, collect()); @endphp
            @forelse($items as $task)
            <div class="card border-0 shadow-sm rounded-3 mb-3 p-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge bg-{{ $task->priority_color }} bg-opacity-10 text-{{ $task->priority_color }}" style="font-size: 0.7rem;">{{ $task->priority }} Priority</span>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-h text-muted small"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ auth()->user() ? route('tasks.edit', $task) : '#' }}">Edit</a></li>
                            <li>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete task?')">
                                    @csrf @method('DELETE')
                                    <button class="dropdown-item text-danger">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <h6 class="fw-bold small mb-2">{{ $task->title }}</h6>
                <p class="text-muted mb-3" style="font-size: 0.75rem;">{{ \Illuminate\Support\Str::limit($task->description, 120) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="avatar-group">
                        @if(isset($task->assignee) && $task->assignee)
                            @include('components.avatar', ['user' => $task->assignee, 'size' => 30])
                        @else
                            @include('components.avatar', ['name' => 'User', 'size' => 30])
                        @endif
                    </div>
                    <small class="text-muted"><i class="far fa-clock me-1"></i> {{ $task->deadline? $task->deadline->format('d M') : '-' }}</small>
                </div>
            </div>
            @empty
                <div class="text-muted small">No tasks</div>
            @endforelse
        </div>
    </div>
    @endforeach
</div>
@endsection