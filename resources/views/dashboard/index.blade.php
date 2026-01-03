@extends('layouts.app')

@section('content')

    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <div class="position-relative">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control search-bar ps-5" placeholder="Search for tasks, groups, or files...">
            </div>
        </div>
        <div class="col-md-4 text-end d-block d-xl-none">
            <button class="btn btn-primary"><i class="fas fa-bars"></i></button>
        </div>
    </div>

    <div class="card welcome-card mb-5 shadow-lg">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
            <div>
                <h2 class="fw-bold mb-1">Welcome, Muhammad Sumbul!</h2>
                <p class="text-white-50 mb-4">Here's what's happening with your projects today.</p>
                
                <button class="btn btn-light text-primary fw-bold px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-plus me-2"></i> Create New Group
                </button>
            </div>
            <div class="d-none d-md-block">
                <i class="fas fa-rocket text-white opacity-25" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-3">
        <h5 class="fw-bold mb-0">Active Groups</h5>
        <a href="#" class="text-decoration-none small fw-bold text-primary">See All</a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card-custom h-100 position-relative">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-light text-secondary">Design</span>
                    <i class="fas fa-ellipsis-v text-muted cursor-pointer"></i>
                </div>
                <h6 class="fw-bold mb-1">Website Redesign</h6>
                <small class="text-muted d-block mb-3">Deadline: 20 March</small>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="fw-bold text-primary">30%</small>
                </div>
                <div class="progress progress-slim mb-3">
                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                </div>

                <div class="avatar-group">
                    <img src="https://i.pravatar.cc/150?img=1" alt="">
                    <img src="https://i.pravatar.cc/150?img=2" alt="">
                    <img src="https://i.pravatar.cc/150?img=3" alt="">
                    <span class="small ms-2 text-muted fw-bold">+3</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom h-100">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-light text-secondary">Dev</span>
                    <i class="fas fa-ellipsis-v text-muted"></i>
                </div>
                <h6 class="fw-bold mb-1">Mobile App API</h6>
                <small class="text-muted d-block mb-3">Deadline: 25 March</small>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="fw-bold text-warning">45%</small>
                </div>
                <div class="progress progress-slim mb-3">
                    <div class="progress-bar bg-warning" style="width: 45%"></div>
                </div>

                <div class="avatar-group">
                    <img src="https://i.pravatar.cc/150?img=4" alt="">
                    <img src="https://i.pravatar.cc/150?img=5" alt="">
                    <span class="small ms-2 text-muted fw-bold">+2</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom h-100">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-light text-secondary">Marketing</span>
                    <i class="fas fa-ellipsis-v text-muted"></i>
                </div>
                <h6 class="fw-bold mb-1">Q1 Marketing</h6>
                <small class="text-muted d-block mb-3">Deadline: 30 March</small>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="fw-bold text-success">75%</small>
                </div>
                <div class="progress progress-slim mb-3">
                    <div class="progress-bar bg-success" style="width: 75%"></div>
                </div>

                <div class="avatar-group">
                    <img src="https://i.pravatar.cc/150?img=8" alt="">
                    <img src="https://i.pravatar.cc/150?img=9" alt="">
                    <img src="https://i.pravatar.cc/150?img=10" alt="">
                    <span class="small ms-2 text-muted fw-bold">+6</span>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3">My Tasks</h5>
    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="kanban-col">
                <div class="kanban-header">
                    <span>To Do <span class="badge bg-white text-dark ms-1 shadow-sm">3</span></span>
                    <i class="fas fa-plus text-muted"></i>
                </div>

                <div class="kanban-item">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-danger bg-opacity-10 text-danger" style="font-size:0.65rem;">High</span>
                        <i class="fas fa-ellipsis-h text-muted small"></i>
                    </div>
                    <h6 class="fs-6 fw-bold mb-2">Wireframe Login Page</h6>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="far fa-clock me-1"></i> 2 Days left
                    </div>
                </div>

                <div class="kanban-item">
                     <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-secondary bg-opacity-10 text-secondary" style="font-size:0.65rem;">Low</span>
                        <i class="fas fa-ellipsis-h text-muted small"></i>
                    </div>
                    <h6 class="fs-6 fw-bold mb-2">Update Asset Icons</h6>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="far fa-clock me-1"></i> 5 Days left
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kanban-col">
                <div class="kanban-header">
                    <span>In Progress <span class="badge bg-white text-dark ms-1 shadow-sm">1</span></span>
                    <i class="fas fa-plus text-muted"></i>
                </div>

                <div class="kanban-item border-start border-3 border-primary">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:0.65rem;">Medium</span>
                        <i class="fas fa-ellipsis-h text-muted small"></i>
                    </div>
                    <h6 class="fs-6 fw-bold mb-2">Dashboard Layout</h6>
                    <p class="text-muted small mb-2">Implementing CSS Grid for main layout...</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="avatar-group" style="transform: scale(0.8); transform-origin: left;">
                             <img src="https://i.pravatar.cc/150?img=11" alt="">
                        </div>
                        <i class="fas fa-paperclip text-muted small"> 2</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="kanban-col">
                <div class="kanban-header">
                    <span>Done <span class="badge bg-white text-dark ms-1 shadow-sm">2</span></span>
                    <i class="fas fa-plus text-muted"></i>
                </div>

                <div class="kanban-item opacity-75">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-success bg-opacity-10 text-success" style="font-size:0.65rem;">Completed</span>
                        <i class="fas fa-check-circle text-success small"></i>
                    </div>
                    <h6 class="fs-6 fw-bold mb-2 text-decoration-line-through text-muted">Client Meeting</h6>
                </div>
            </div>
        </div>

    </div>

@endsection