@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="bg-primary" style="height: 140px; background: linear-gradient(45deg, #0d6efd, #0dcaf0);"></div>
            <div class="card-body text-center" style="margin-top: -70px;">
                <div class="position-relative d-inline-block mb-3">
                    <x-avatar :user="$user" :size="130" />
                    <span class="position-absolute bottom-0 end-0 bg-success border border-3 border-white p-2 rounded-circle" title="Online"></span>
                </div>
                
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted small mb-3"><i class="fas fa-briefcase me-1"></i> {{ $user->occupation ?? 'Project Contributor' }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-4">
                    {{-- Avatar upload form: includes hidden name/occupation to satisfy validation while allowing only avatar change --}}
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="d-inline">
                        @csrf
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="occupation" value="{{ $user->occupation }}">
                        <label class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm mb-0">
                            <i class="fas fa-edit me-1"></i> Change Avatar
                            <input type="file" name="avatar" class="d-none" onchange="this.form.submit()">
                        </label>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </form>
                </div>

                <hr class="opacity-10">

                <div class="row g-0 py-2">
                    <div class="col-6 border-end">
                        <h6 class="fw-bold mb-0">12</h6>
                        <small class="text-muted" style="font-size: 0.7rem;">TASKS DONE</small>
                    </div>
                    <div class="col-6">
                        <h6 class="fw-bold mb-0">5</h6>
                        <small class="text-muted" style="font-size: 0.7rem;">PROJECTS</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-4">Contact Information</h6>
            <div class="d-flex align-items-center mb-3">
                <div class="bg-light rounded-circle p-2 me-3 text-primary"><i class="fas fa-envelope fa-fw"></i></div>
                <div>
                    <small class="text-muted d-block">Email Address</small>
                    <span class="fw-bold small">{{ $user->email }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <div class="bg-light rounded-circle p-2 me-3 text-primary"><i class="fas fa-phone fa-fw"></i></div>
                <div>
                    <small class="text-muted d-block">Phone</small>
                    <span class="fw-bold small">+62 812 3456 7890</span>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="bg-light rounded-circle p-2 me-3 text-primary"><i class="fas fa-map-marker-alt fa-fw"></i></div>
                <div>
                    <small class="text-muted d-block">Location</small>
                    <span class="fw-bold small">Jakarta, Indonesia</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Active Groups</h6>
                <a href="#" class="text-primary small text-decoration-none fw-bold">View All</a>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 border rounded-4 hover-lift bg-light bg-opacity-50">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-primary rounded-3 p-2 text-white">
                                <i class="fas fa-laptop-code fa-lg"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-truncate">Website Redesign</h6>
                                <small class="text-muted">Lead Developer</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="flex-grow-1">
                                <div class="progress rounded-pill" style="height: 5px;">
                                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                                </div>
                            </div>
                            <span class="small fw-bold text-muted">75%</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded-4 hover-lift bg-light bg-opacity-50">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-warning rounded-3 p-2 text-white">
                                <i class="fas fa-mobile-alt fa-lg"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="fw-bold mb-0 text-truncate">Mobile App Development</h6>
                                <small class="text-muted">UI Designer</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="flex-grow-1">
                                <div class="progress rounded-pill" style="height: 5px;">
                                    <div class="progress-bar bg-warning" style="width: 40%"></div>
                                </div>
                            </div>
                            <span class="small fw-bold text-muted">40%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-4">Personal Achievements</h6>
            <div class="timeline-activity">
                <div class="d-flex gap-3 mb-4">
                    <div class="activity-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px;">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 small">Top Performer of the Month</h6>
                        <p class="text-muted mb-1 small">You have completed 15 tasks this month with 100% on-time delivery.</p>
                        <small class="text-muted opacity-75" style="font-size: 0.65rem;">Last updated: 2 days ago</small>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="activity-icon bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px;">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1 small">Project Milestone Reached</h6>
                        <p class="text-muted mb-1 small">Successfully launched the beta version of 'Website Redesign'.</p>
                        <small class="text-muted opacity-75" style="font-size: 0.65rem;">March 15, 2024</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        cursor: pointer;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        background-color: #ffffff !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important;
        border-color: #0d6efd !important;
    }
    .activity-icon {
        border: 1px solid rgba(0,0,0,0.05);
    }
</style>
@endsection
{{-- Duplicate Breeze/Jetstream profile scaffolding removed to avoid rendering twice. --}}
