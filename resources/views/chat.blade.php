@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="height: calc(100vh - 150px);">
    <div class="row g-0 h-100">
        
        <div class="col-md-4 border-end bg-white h-100 d-flex flex-column">
            <div class="p-3 border-bottom">
                <h5 class="fw-bold mb-3">Messages</h5>
                <div class="position-relative">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
                    <input type="text" class="form-control form-control-sm ps-5 rounded-pill bg-light border-0" placeholder="Search conversations...">
                </div>
            </div>
            
            <div class="overflow-auto flex-grow-1">
                <!-- Groups Section -->
                @if($projects->count() > 0)
                <div class="px-3 py-2 text-muted small fw-bold text-uppercase">Groups</div>
                @foreach($projects as $group)
                <a href="{{ route('chat', ['project_id' => $group->id]) }}" class="text-decoration-none">
                <div class="p-3 d-flex align-items-center border-bottom cursor-pointer hover-bg-light {{ $project && $project->id == $group->id ? 'bg-light' : '' }}">
                    <div class="position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($group->name) }}&background=0D6EFD&color=fff" class="rounded-circle" width="45">
                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle" style="width: 12px; height: 12px;"></span>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0 small text-dark">{{ $group->name }}</h6>
                            <span class="text-muted" style="font-size: 0.7rem;">{{ $group->members->count() + 1 }}</span>
                        </div>
                        <small class="text-muted d-block text-truncate" style="max-width: 150px;">{{ $group->category }} • {{ $group->progress }}% complete</small>
                    </div>
                </div>
                </a>
                @endforeach
                @endif

                <!-- Users Section -->
                <div class="px-3 py-2 text-muted small fw-bold text-uppercase">Direct Messages</div>
                @forelse($users as $user)
                <div class="p-3 d-flex align-items-center border-bottom cursor-pointer hover-bg-light">
                    <div class="position-relative">
                        <x-avatar :user="$user" :size="45" />
                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle ms-3"></span>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0 small text-dark">{{ $user->name }}</h6>
                            <span class="text-muted" style="font-size: 0.7rem;">Online</span>
                        </div>
                        <small class="text-muted d-block text-truncate" style="max-width: 150px;">Click to start chat</small>
                    </div>
                </div>
                @empty
                <div class="p-3 text-center text-muted">
                    <i class="fas fa-users fa-2x mb-3"></i>
                    <p>No users available for chat</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-md-8 d-flex flex-column bg-light h-100">
            <div class="p-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    @if($project)
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($project->name) }}&background=0D6EFD&color=fff" class="rounded-circle me-3" width="40">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $project->name }}</h6>
                            <small class="text-success small"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> {{ $project->members->count() + 1 }} Members</small>
                        </div>
                    @else
                        <img src="https://ui-avatars.com/api/?name=General+Chat&background=6C757D&color=fff" class="rounded-circle me-3" width="40">
                        <div>
                            <h6 class="fw-bold mb-0">General Chat</h6>
                            <small class="text-muted small">Select a conversation</small>
                        </div>
                    @endif
                </div>
                <div class="text-muted">
                    <i class="fas fa-phone-alt me-3 cursor-pointer"></i>
                    <i class="fas fa-video me-3 cursor-pointer"></i>
                    <i class="fas fa-info-circle cursor-pointer"></i>
                </div>
            </div>

            <div class="flex-grow-1 overflow-auto p-4 d-flex flex-column gap-3">
                @if($project)
                    <!-- Group Chat Messages -->
                    <div class="text-center text-muted mb-4">
                        <i class="fas fa-comments fa-2x mb-3"></i>
                        <h6>Welcome to {{ $project->name }} Group Chat</h6>
                        <p class="small">Start a conversation with your team members</p>
                    </div>

                    <div class="d-flex align-items-start" style="max-width: 80%;">
                        <div class="position-relative me-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&background=6C757D&color=fff" class="rounded-circle" width="30">
                        </div>
                        <div>
                            <div class="bg-white p-3 rounded-4 shadow-sm border">
                                <small class="fw-bold text-primary d-block mb-1">{{ $project->user->name }} (Project Owner)</small>
                                <span class="text-dark small">Welcome to the {{ $project->name }} project! Let's collaborate and get things done.</span>
                            </div>
                            <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">Project Created</small>
                        </div>
                    </div>
                @else
                    <!-- Direct Messages Placeholder -->
                    <div class="text-center text-muted mb-4">
                        <i class="fas fa-envelope fa-2x mb-3"></i>
                        <h6>Select a conversation</h6>
                        <p class="small">Choose a group or user from the sidebar to start chatting</p>
                    </div>

                    <div class="d-flex align-items-start" style="max-width: 80%;">
                        @include('components.avatar', ['name' => 'Chat User', 'size' => 30])
                        <div>
                            <div class="bg-white p-3 rounded-4 shadow-sm border">
                                <small class="fw-bold text-primary d-block mb-1">System</small>
                                <span class="text-dark small">Welcome to CollaboTask Chat! Select a conversation to get started.</span>
                            </div>
                            <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">Welcome Message</small>
                        </div>
                    </div>
                @endif

            </div>

            <div class="p-3 bg-white border-top">
                <form id="messageForm" class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-light rounded-circle text-muted"><i class="fas fa-plus"></i></button>
                    <div class="input-group">
                        <input type="text" id="messageInput" class="form-control border-0 bg-light rounded-pill px-4" placeholder="Type your message here...">
                    </div>
                    <button type="button" class="btn btn-light rounded-circle text-muted"><i class="far fa-smile"></i></button>
                    <button type="button" id="sendButton" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px;">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    .hover-bg-light:hover { background-color: #f8f9fa; }
    .cursor-pointer { cursor: pointer; }
    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #dee2e6; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #adb5bd; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const chatMessages = document.querySelector('.flex-grow-1.overflow-auto');

    // Handle send button click
    sendButton.addEventListener('click', function() {
        sendMessage();
    });

    // Handle Enter key press
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const message = messageInput.value.trim();
        if (message === '') return;

        // Create new message element
        const messageElement = document.createElement('div');
        messageElement.className = 'd-flex align-items-start flex-row-reverse ms-auto mb-3';
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
        chatMessages.appendChild(messageElement);

        // Clear input
        messageInput.value = '';

        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Simulate reply after 2 seconds
        setTimeout(function() {
            const replyElement = document.createElement('div');
            replyElement.className = 'd-flex align-items-start mb-3';
            replyElement.style.maxWidth = '80%';
            replyElement.innerHTML = `
                <div class="position-relative me-2">
                    <img src="https://ui-avatars.com/api/?name=Bot&background=6C757D&color=fff" class="rounded-circle" width="30">
                </div>
                <div>
                    <div class="bg-white p-3 rounded-4 shadow-sm border">
                        <small class="fw-bold text-primary d-block mb-1">System</small>
                        <span class="text-dark small">Message sent! (This is a demo chat)</span>
                    </div>
                    <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</small>
                </div>
            `;
            chatMessages.appendChild(replyElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 2000);
    }
});
</script>

@endsection