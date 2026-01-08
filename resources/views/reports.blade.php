@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Project Analytics</h4>
        <p class="text-muted small">Monitor your team performance and project health.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-white border rounded-pill px-3 shadow-sm btn-sm">
            <i class="fas fa-download me-2"></i>Export PDF
        </button>
        <select class="form-select form-select-sm rounded-pill shadow-sm" style="width: 150px;">
            <option>Last 30 Days</option>
            <option>Last 6 Months</option>
            <option>This Year</option>
        </select>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-primary text-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="bg-white bg-opacity-25 p-2 rounded-3">
                    <i class="fas fa-check-double text-white"></i>
                </div>
                <span class="small text-white-50">+12%</span>
            </div>
            <h3 class="fw-bold mb-0">48</h3>
            <small class="opacity-75">Tasks Completed</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                    <i class="fas fa-clock"></i>
                </div>
                <span class="small text-success fw-bold">+5.2%</span>
            </div>
            <h3 class="fw-bold mb-0 text-dark">85%</h3>
            <small class="text-muted">Efficiency Rate</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="bg-warning bg-opacity-10 p-2 rounded-3 text-warning">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-0 text-dark">6</h3>
            <small class="text-muted">Active Projects</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="bg-danger bg-opacity-10 p-2 rounded-3 text-danger">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-0 text-dark">3</h3>
            <small class="text-muted">Overdue Tasks</small>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0">Task Productivity Trend</h6>
                <div class="dropdown">
                    <i class="fas fa-ellipsis-v text-muted cursor-pointer" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu border-0 shadow">
                        <li><a class="dropdown-item" href="#">Refresh</a></li>
                        <li><a class="dropdown-item" href="#">Full Report</a></li>
                    </ul>
                </div>
            </div>
            <canvas id="productivityChart" style="max-height: 300px;"></canvas>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 text-center">
            <h6 class="fw-bold mb-4 text-start">Task Status</h6>
            <div class="position-relative d-flex justify-content-center align-items-center">
                <canvas id="statusChart" style="max-height: 220px;"></canvas>
            </div>
            <div class="mt-4 row g-2">
                <div class="col-6 text-start"><small class="text-muted d-block"><i class="fas fa-circle text-primary me-1"></i> Done</small><h6 class="fw-bold">65%</h6></div>
                <div class="col-6 text-start"><small class="text-muted d-block"><i class="fas fa-circle text-info me-1"></i> In Progress</small><h6 class="fw-bold">25%</h6></div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white p-4 border-0">
        <h6 class="fw-bold mb-0">Projects Health</h6>
    </div>
    <div class="table-responsive px-4 pb-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="border-0 small text-muted px-3">PROJECT NAME</th>
                    <th class="border-0 small text-muted">PROGRESS</th>
                    <th class="border-0 small text-muted">STATUS</th>
                    <th class="border-0 small text-muted">DUE DATE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-3 fw-bold">Website Redesign</td>
                    <td style="width: 30%;">
                        <div class="progress rounded-pill" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">On Track</span></td>
                    <td class="text-muted small">20 Mar 2026</td>
                </tr>
                <tr>
                    <td class="px-3 fw-bold">Mobile App API</td>
                    <td>
                        <div class="progress rounded-pill" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 30%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">At Risk</span></td>
                    <td class="text-muted small">05 Apr 2026</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Productivity Line Chart
    const ctxProd = document.getElementById('productivityChart').getContext('2d');
    new Chart(ctxProd, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Completed Tasks',
                data: [12, 19, 15, 25],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#0d6efd',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // 2. Status Doughnut Chart
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Done', 'In Progress', 'Todo'],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: ['#0d6efd', '#0dcaf0', '#f8f9fa'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            cutout: '80%',
            plugins: { legend: { display: false } }
        }
    });
</script>

<style>
    .progress-bar { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .table th { font-size: 0.75rem; letter-spacing: 0.5px; }
    .cursor-pointer { cursor: pointer; }
</style>
@endsection