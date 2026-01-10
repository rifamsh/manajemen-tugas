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
            <span class="text-muted small">Created by {{ $project->user->name ?? 'You' }}</span>
        </div>
        <h4 class="fw-bold mb-0">{{ $project->name }}</h4>
    </div>
    <div class="ms-auto d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="fas fa-share-alt me-2"></i>Share</button>
        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn btn-primary btn-sm rounded-pill px-3"><i class="fas fa-plus me-2"></i>Add Task</a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card-custom text-center p-3">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <i class="fas fa-tasks fa-2x text-primary me-3"></i>
                <div>
                    <h4 class="fw-bold mb-0">{{ $totalTasks }}</h4>
                    <small class="text-muted">Total Tasks</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-custom text-center p-3">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <i class="fas fa-spinner fa-2x text-warning me-3"></i>
                <div>
                    <h4 class="fw-bold mb-0">{{ $inProgressTasks }}</h4>
                    <small class="text-muted">In Progress</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-custom text-center p-3">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <i class="fas fa-clock fa-2x text-danger me-3"></i>
                <div>
                    <h4 class="fw-bold mb-0">{{ $overdueTasks }}</h4>
                    <small class="text-muted">Overdue</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-custom text-center p-3">
            <div class="d-flex align-items-center justify-content-center mb-2">
                <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                <div>
                    <h4 class="fw-bold mb-0">{{ $completedTasks }}</h4>
                    <small class="text-muted">Completed</small>
                </div>
            </div>
        </div>
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
                    <small class="text-muted mt-2 d-block">
                        <i class="far fa-calendar-check me-1"></i>
                        Deadline: <strong>{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('d M Y') : 'No deadline' }}</strong>
                    </small>
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
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 fw-bold text-muted" data-bs-toggle="pill" data-bs-target="#discussion">Discussion</button>
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
                                    <img src="https://ui-avatars.com/api/?name={{ $task->assignee->name }}" class="rounded-circle border border-2 border-white" width="30" title="{{ $task->assignee->name }}">
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

            <div class="tab-pane fade" id="discussion">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="height: 600px;">
                    <div class="card-header bg-white border-bottom p-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-comments text-primary me-2"></i>
                            <h6 class="fw-bold mb-0">Group Discussion</h6>
                            <small class="text-muted ms-2">{{ $project->members->count() + 1 }} members</small>
                        </div>
                    </div>
                    
                    <div class="card-body p-0 flex-grow-1 overflow-auto" id="chatMessages" style="height: 450px;">
                        <div class="p-4">
                            <!-- Welcome message -->
                            <div class="text-center text-muted mb-4">
                                <i class="fas fa-comments fa-2x mb-3 text-primary"></i>
                                <h6>Welcome to {{ $project->name }} Discussion</h6>
                                <p class="small">Start a conversation with your team members</p>
                            </div>

                            <!-- Sample messages -->
                            <div class="d-flex align-items-start mb-4" style="max-width: 80%;">
                                <div class="position-relative me-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&background=0D6EFD&color=fff" class="rounded-circle" width="35">
                                </div>
                                <div>
                                    <div class="bg-white p-3 rounded-4 shadow-sm border">
                                        <small class="fw-bold text-primary d-block mb-1">{{ $project->user->name }} (Project Owner)</small>
                                        <span class="text-dark small">Welcome to the {{ $project->name }} project! Let's collaborate and get things done.</span>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">Project Created</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top p-3">
                        <form id="groupMessageForm" class="d-flex align-items-center gap-2">
                            <div class="input-group">
                                <input type="text" id="groupMessageInput" class="form-control border-0 bg-light rounded-pill px-4" placeholder="Type your message here...">
                            </div>
                            <button type="button" id="groupSendButton" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Team Members ({{ $project->members->count() + 1 }})</h6>
                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#addMemberModal"><i class="fas fa-user-plus text-primary"></i></button>
            </div>
            <div class="d-flex flex-column gap-3">
                <!-- Project Owner -->
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <x-avatar :user="$project->user" :size="35" />
                        <div>
                            <h6 class="fw-bold mb-0 small">{{ $project->user->name }}</h6>
                            <small class="text-muted" style="font-size: 0.65rem;">Project Owner</small>
                        </div>
                    </div>
                    <span class="badge bg-success rounded-circle p-1" style="width: 8px; height: 8px;" title="Online"></span>
                </div>

                <!-- Team Members -->
                @foreach($project->members as $member)
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <x-avatar :user="$member" :size="35" />
                        <div>
                            <h6 class="fw-bold mb-0 small">{{ $member->name }}</h6>
                            <small class="text-muted" style="font-size: 0.65rem;">Team Member</small>
                        </div>
                    </div>
                    <span class="badge {{ rand(0,1) ? 'bg-success' : 'bg-secondary' }} rounded-circle p-1" style="width: 8px; height: 8px;" title="{{ rand(0,1) ? 'Online' : 'Offline' }}"></span>
                </div>
                @endforeach
            </div>
            <div class="d-grid">
                <a href="{{ route('chat', ['project_id' => $project->id]) }}" class="btn btn-primary ext-primary fw-bold btn-sm rounded-pill">Open Discussion</a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-4">Recent Activity</h6>
            <div class="timeline-small small">
                @foreach($recentActivities as $activity)
                <div class="d-flex gap-3 mb-4">
                    <div class="text-primary mt-1">
                        <i class="fas {{ str_contains($activity['action'], 'completed') ? 'fa-check-circle' : (str_contains($activity['action'], 'uploaded') ? 'fa-file-upload' : 'fa-plus-circle') }}"></i>
                    </div>
                    <div>
                        <p class="mb-0 fw-bold">{{ $activity['user'] }}</p>
                        <p class="text-muted mb-0">{{ $activity['action'] }}</p>
                        <small class="text-muted opacity-75">{{ $activity['time'] }}</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .task-item:hover { background-color: #f8f9ff !important; transition: 0.3s; }
    .nav-pills .nav-link.active { background-color: #0d6efd; box-shadow: 0 4px 10px rgba(13,110,253,0.25); }
    .nav-pills .nav-link:not(.active) { background-color: #f1f3f5; }
</style>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('groups.add-member', $project) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Member Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter member email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Share Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Group Link</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="shareLink" value="{{ url('/groups/' . $project->id) }}" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('shareLink')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <small class="text-muted">Share this link to invite others to view the group</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Group Code</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="shareCode" value="GRP{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('shareCode')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <small class="text-muted">Use this code to quickly share the group</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    element.setSelectionRange(0, 99999); // For mobile devices

    navigator.clipboard.writeText(element.value).then(function() {
        // Show success message
        const button = element.nextElementSibling;
        const originalIcon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');

        setTimeout(function() {
            button.innerHTML = originalIcon;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-secondary');
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}

// Group Chat Functionality
document.addEventListener('DOMContentLoaded', function() {
    const groupMessageForm = document.getElementById('groupMessageForm');
    const groupMessageInput = document.getElementById('groupMessageInput');
    const groupSendButton = document.getElementById('groupSendButton');
    const chatMessages = document.getElementById('chatMessages');

    if (groupSendButton && groupMessageInput) {
        // Handle send button click
        groupSendButton.addEventListener('click', function() {
            sendGroupMessage();
        });

        // Handle Enter key press
        groupMessageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendGroupMessage();
            }
        });
    }

    function sendGroupMessage() {
        const message = groupMessageInput.value.trim();
        if (message === '') return;

        // Create new message element
        const messageContainer = chatMessages.querySelector('.p-4');
        const messageElement = document.createElement('div');
        messageElement.className = 'd-flex align-items-start flex-row-reverse ms-auto mb-4';
        messageElement.style.maxWidth = '80%';
        messageElement.innerHTML = `
            <div class="text-end">
                <div class="bg-primary p-3 rounded-4 shadow-sm text-white">
                    <span class="small">${message}</span>
                </div>
                <div class="d-flex align-items-center justify-content-end mt-1">
                    <small class="text-muted me-2" style="font-size: 0.65rem;">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</small>
                    <i class="fas fa-check text-primary" style="font-size: 0.65rem;"></i>
                </div>
            </div>
        `;

        // Add message to chat
        messageContainer.appendChild(messageElement);

        // Clear input
        groupMessageInput.value = '';

        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Simulate reply after 2 seconds
        setTimeout(function() {
            const replyElement = document.createElement('div');
            replyElement.className = 'd-flex align-items-start mb-4';
            replyElement.style.maxWidth = '80%';
            replyElement.innerHTML = `
                <div class="position-relative me-2">
                    <img src="https://ui-avatars.com/api/?name=Team&background=6C757D&color=fff" class="rounded-circle" width="35">
                </div>
                <div>
                    <div class="bg-white p-3 rounded-4 shadow-sm border">
                        <small class="fw-bold text-primary d-block mb-1">Team Bot</small>
                        <span class="text-dark small">Message sent to all team members! (Demo chat)</span>
                    </div>
                    <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</small>
                </div>
            `;
            messageContainer.appendChild(replyElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 2000);
    }
});
</script>

@endsection