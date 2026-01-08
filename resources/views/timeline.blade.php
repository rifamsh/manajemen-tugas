<div class="card border-0 shadow-sm rounded-4 p-4">
    <h5 class="fw-bold mb-4">Project Timeline</h5>
    <div class="position-relative ps-4 border-start border-primary" style="margin-left: 10px;">
        @foreach($tasks as $task)
        <div class="mb-5 position-relative">
            <div class="position-absolute bg-primary rounded-circle shadow-sm" style="width: 15px; height: 15px; left: -32px; top: 5px; border: 3px solid white;"></div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div>
                    <span class="text-primary fw-bold small text-uppercase">{{ $task->due_time }}</span>
                    <h6 class="fw-bold mt-1">{{ $task->title }}</h6>
                </div>
                <span class="badge bg-light text-muted rounded-pill px-3">{{ $task->deadline }}</span>
            </div>
            <p class="text-muted small mt-2 mb-0">{{ $task->description }}</p>
        </div>
        @endforeach
    </div>
</div>