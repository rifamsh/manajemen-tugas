<div class="sidebar p-3 d-flex flex-column" style="width: 250px;">
    <h4 class="mb-4 text-center fw-bold">Task Manager</h4>
    
    <small class="text-uppercase text-muted mb-2">Menu</small>
    <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="fas fa-home me-2"></i> Dashboard
    </a>
    <a href="{{ url('/tasks') }}" class="{{ request()->is('tasks') ? 'active' : '' }}">
        <i class="fas fa-columns me-2"></i> Task Board
    </a>
    <a href="{{ url('/calendar') }}" class="{{ request()->is('calendar') ? 'active' : '' }}">
        <i class="fas fa-calendar-alt me-2"></i> Calendar
    </a>
    <a href="{{ url('/files') }}">
        <i class="fas fa-folder me-2"></i> Files
    </a>

    <hr>
    
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="text-uppercase text-muted">My Teams</small>
        <button class="btn btn-sm btn-outline-light py-0">+</button>
    </div>
    <a href="#"><i class="fas fa-users me-2"></i> Web Prog Team</a>
    <a href="#"><i class="fas fa-users me-2"></i> Mobile App Team</a>

    <hr class="mt-auto">
    <a href="{{ url('/profile') }}">
        <i class="fas fa-user-circle me-2"></i> My Profile
    </a>
    <a href="#" class="text-danger">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
</div>