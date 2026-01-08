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
                <div class="p-3 d-flex align-items-center bg-primary bg-opacity-10 border-start border-4 border-primary cursor-pointer">
                    <div class="position-relative">
                        <img src="https://ui-avatars.com/api/?name=Website+Redesign&background=0D6EFD&color=fff" class="rounded-circle me-3" width="45">
                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle ms-3"></span>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0 small">Website Redesign</h6>
                            <span class="text-muted" style="font-size: 0.7rem;">10:25 AM</span>
                        </div>
                        <small class="text-primary fw-bold d-block text-truncate" style="max-width: 150px;">Sumbul: I've updated the file...</small>
                    </div>
                </div>

                <div class="p-3 d-flex align-items-center border-bottom cursor-pointer hover-bg-light">
                    <img src="https://ui-avatars.com/api/?name=Mobile+App&background=FFC107&color=fff" class="rounded-circle me-3" width="45">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold mb-0 small text-dark">Mobile App API</h6>
                            <span class="text-muted" style="font-size: 0.7rem;">Yesterday</span>
                        </div>
                        <small class="text-muted d-block text-truncate" style="max-width: 150px;">The API is ready for testing.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 d-flex flex-column bg-light h-100">
            <div class="p-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=Website+Redesign&background=0D6EFD&color=fff" class="rounded-circle me-3" width="40">
                    <div>
                        <h6 class="fw-bold mb-0">Website Redesign</h6>
                        <small class="text-success small"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> 5 Members Online</small>
                    </div>
                </div>
                <div class="text-muted">
                    <i class="fas fa-phone-alt me-3 cursor-pointer"></i>
                    <i class="fas fa-video me-3 cursor-pointer"></i>
                    <i class="fas fa-info-circle cursor-pointer"></i>
                </div>
            </div>

            <div class="flex-grow-1 overflow-auto p-4 d-flex flex-column gap-3">
                
                <div class="d-flex align-items-start" style="max-width: 80%;">
                    @include('components.avatar', ['name' => 'Chat User', 'size' => 30])
                    <div>
                        <div class="bg-white p-3 rounded-4 shadow-sm border">
                            <small class="fw-bold text-primary d-block mb-1">Budi Setiawan</small>
                            <span class="text-dark small">Halo tim, bagaimana progress untuk halaman login? Apakah sudah sesuai dengan database migrations yang baru?</span>
                        </div>
                        <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">09:41 AM</small>
                    </div>
                </div>

                <div class="d-flex align-items-start flex-row-reverse ms-auto" style="max-width: 80%;">
                    <div class="text-end">
                        <div class="bg-primary p-3 rounded-4 shadow-sm text-white">
                            <span class="small">Sudah Budi! Saya baru saja push update untuk tabel `comments` dan `tasks`. Bisa tolong dicek di File Manager?</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-1">
                            <small class="text-muted me-2" style="font-size: 0.65rem;">09:45 AM</small>
                            <i class="fas fa-check-double text-primary" style="font-size: 0.65rem;"></i>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-start" style="max-width: 80%;">
                    @include('components.avatar', ['name' => 'Chat User', 'size' => 30])
                    <div>
                        <div class="bg-white p-3 rounded-4 shadow-sm border">
                            <div class="d-flex align-items-center p-2 bg-light rounded-3 mb-2 border">
                                <i class="fas fa-file-pdf text-danger fa-2x me-2"></i>
                                <div class="overflow-hidden">
                                    <div class="fw-bold small text-truncate">New_Database_Schema.pdf</div>
                                    <small class="text-muted" style="font-size: 0.7rem;">2.4 MB</small>
                                </div>
                                <i class="fas fa-download ms-3 text-muted cursor-pointer"></i>
                            </div>
                            <span class="text-dark small">Ini file skema terbarunya ya.</span>
                        </div>
                        <small class="text-muted mt-1 d-block" style="font-size: 0.65rem;">10:02 AM</small>
                    </div>
                </div>

            </div>

            <div class="p-3 bg-white border-top">
                <form action="#" class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-light rounded-circle text-muted"><i class="fas fa-plus"></i></button>
                    <div class="input-group">
                        <input type="text" class="form-control border-0 bg-light rounded-pill px-4" placeholder="Type your message here...">
                    </div>
                    <button type="button" class="btn btn-light rounded-circle text-muted"><i class="far fa-smile"></i></button>
                    <button type="submit" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px;">
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
@endsection