@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="height: calc(100vh - 150px);">
    <div class="row g-0 h-100">
        
        <div class="col-12 col-md-4 border-end bg-white h-100 d-flex flex-column {{ request('project_id') ? 'd-none d-md-flex' : '' }}">
            <div class="p-3 border-bottom">
                <h5 class="fw-bold mb-3">Messages</h5>
                <div class="position-relative">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
                    <input type="text" class="form-control form-control-sm ps-5 rounded-pill bg-light border-0" placeholder="Search conversations...">
                </div>
            </div>
            
            <div class="overflow-auto flex-grow-1">
                @if($projects->count() > 0)
                <div class="px-3 py-2 text-muted small fw-bold text-uppercase">Groups</div>
                @foreach($projects as $group)
                <a href="{{ route('chat', ['project_id' => $group->id]) }}" class="text-decoration-none">
                    <div class="p-3 d-flex align-items-center border-bottom cursor-pointer hover-bg-light {{ (isset($project) && $project->id == $group->id) ? 'bg-light' : '' }}">
                        <div class="position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($group->name) }}&background=0D6EFD&color=fff" class="rounded-circle" width="45">
                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle" style="width: 12px; height: 12px;"></span>
                        </div>
                        <div class="flex-grow-1 ms-3">
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

                <div class="px-3 py-2 text-muted small fw-bold text-uppercase">Direct Messages</div>
                @forelse($users as $user)
                <div class="p-3 d-flex align-items-center border-bottom cursor-pointer hover-bg-light">
                    <div class="position-relative">
                        <x-avatar :user="$user" :size="45" />
                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle ms-3"></span>
                    </div>
                    <div class="flex-grow-1 ms-3">
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
                    <p>No users available</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-12 col-md-8 d-flex flex-column bg-light h-100 {{ !request('project_id') ? 'd-none d-md-flex' : '' }}">
            <div class="p-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ route('chat') }}" class="btn btn-sm btn-light border rounded-circle me-3 d-md-none">
                        <i class="fas fa-arrow-left"></i>
                    </a>

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

            <div id="chatMessages" class="flex-grow-1 overflow-auto p-4 d-flex flex-column gap-3">
                @if($project)
                    @forelse($project->comments as $comment)
                        <div class="d-flex align-items-start {{ $comment->user_id == auth()->id() ? 'flex-row-reverse ms-auto' : '' }} mb-3" style="max-width: 80%;">
                            <div>
                                <div class="p-3 rounded-4 shadow-sm {{ $comment->user_id == auth()->id() ? 'bg-primary text-white' : 'bg-white border' }}">
                                    <small class="fw-bold d-block mb-1 {{ $comment->user_id == auth()->id() ? 'text-white-50' : 'text-primary' }}">
                                        {{ $comment->user->name }}
                                    </small>
                                    <span class="small">{{ $comment->comment_text }}</span>
                                </div>
                                <small class="text-muted mt-1 d-block {{ $comment->user_id == auth()->id() ? 'text-end' : '' }}" style="font-size: 0.65rem;">
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center my-auto text-muted">
                            <i class="fas fa-comments fa-3x mb-3 opacity-25"></i>
                            <p>No messages yet. Start the conversation!</p>
                        </div>
                    @endforelse
                @else
                    <div class="text-center my-auto text-muted p-5">
                        <i class="fas fa-envelope-open-text fa-4x mb-4 opacity-25"></i>
                        <h5>Welcome to Chat</h5>
                        <p>Select a project or user from the list to start messaging.</p>
                    </div>
                @endif
            </div>

            @if($project)
            <div class="p-3 bg-white border-top">
                <form id="messageForm" class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-light rounded-circle text-muted"><i class="fas fa-plus"></i></button>
                    <div class="input-group">
                        <input type="text" id="messageInput" class="form-control border-0 bg-light rounded-pill px-4" placeholder="Type your message here..." autocomplete="off">
                    </div>
                    <button type="button" class="btn btn-light rounded-circle text-muted"><i class="far fa-smile"></i></button>
                    <button type="button" id="sendButton" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px;">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .hover-bg-light:hover { background-color: #f8f9fa; }
    .cursor-pointer { cursor: pointer; }
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #dee2e6; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #adb5bd; }

    /* CSS Tambahan agar di HP benar-benar rapi */
    @media (max-width: 767.98px) {
        .card { height: 100vh !important; border-radius: 0 !important; margin: -1rem; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const chatMessages = document.getElementById('chatMessages');

    // Scroll otomatis ke bawah
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }

    if (messageInput) {
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    function sendMessage() {
        const message = messageInput.value.trim();
        const projectId = "{{ $project->id ?? '' }}";

        if (message === '' || projectId === '') return;

        fetch("{{ route('comments.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                comment_text: message,
                project_id: projectId
            })
        })
        .then(async response => {
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || 'Gagal mengirim');
            return data;
        })
        .then(result => {
            renderMessage(result.data); 
            messageInput.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        });
    }

    function renderMessage(data) {
        const isMe = data.user_id == "{{ auth()->id() }}";
        const messageHtml = `
            <div class="d-flex align-items-start ${isMe ? 'flex-row-reverse ms-auto' : ''} mb-3" style="max-width: 80%;">
                <div>
                    <div class="p-3 rounded-4 shadow-sm ${isMe ? 'bg-primary text-white' : 'bg-white border text-dark'}">
                        <small class="fw-bold d-block mb-1 ${isMe ? 'text-white-50' : 'text-primary'}">
                            ${data.user.name}
                        </small>
                        <span class="small">${data.comment_text}</span>
                    </div>
                    <small class="text-muted mt-1 d-block ${isMe ? 'text-end' : ''}" style="font-size: 0.65rem;">
                        Just now
                    </small>
                </div>
            </div>
        `;
        chatMessages.insertAdjacentHTML('beforeend', messageHtml);
        // Hapus teks "No messages yet" jika ada
        const emptyMsg = chatMessages.querySelector('.text-center.my-auto');
        if (emptyMsg) emptyMsg.remove();
    }
});
</script>
@endsection