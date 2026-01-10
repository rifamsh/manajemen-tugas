<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CollaboTask</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F4F7FE; /* Background abu-abu kebiruan sangat muda */
            overflow-x: hidden;
        }

        /* --- SIDEBAR KIRI --- */
        .sidebar-left {
            background: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            width: 250px;
            padding: 30px 20px;
            border-right: 1px solid #eef2f6;
            overflow-y: auto;
            z-index: 1050;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .sidebar-left.show {
            transform: translateX(0);
        }

        @media (min-width: 992px) {
            .sidebar-left {
                transform: translateX(0);
            }
        }

        .nav-link {
            color: #7D8592;
            font-weight: 500;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: 0.3s;
            display: flex;
            align-items: center;
        }
        .nav-link i { width: 25px; font-size: 1.1rem; }
        .nav-link:hover, .nav-link.active {
            background-color: #EBF3FF; /* Biru muda */
            color: #0d6efd; /* Biru Primary */
            font-weight: 600;
        }
        
        .section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #b0b7c3;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        /* --- KONTEN TENGAH --- */
        .main-content {
            margin-left: 0;
            margin-right: 0;
            padding: 30px 20px;
            min-height: 100vh;
        }

        @media (min-width: 992px) {
            .main-content {
                margin-left: 250px;
                margin-right: 320px;
                padding: 30px 40px;
            }
        }

        @media (min-width: 1200px) {
            .main-content {
                margin-right: 320px;
            }
        }

        /* --- SIDEBAR KANAN --- */
        .sidebar-right {
            background: #ffffff;
            height: 100vh;
            position: fixed;
            top: 0; right: 0;
            width: 320px;
            padding: 30px 25px;
            border-left: 1px solid #eef2f6;
            overflow-y: auto;
            z-index: 1040;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        .sidebar-right.show {
            transform: translateX(0);
        }

        @media (min-width: 1200px) {
            .sidebar-right {
                transform: translateX(0);
            }
        }

        /* --- CUSTOM CARDS & ELEMENTS --- */
        .search-bar {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            width: 100%;
        }

        .welcome-card {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            border-radius: 20px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: none;
        }
        /* Hiasan lingkaran di background welcome card */
        .welcome-card::before {
            content: ''; position: absolute; top: -50px; right: -50px;
            width: 200px; height: 200px; background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .card-custom {
            background: #fff;
            border: none;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            transition: 0.3s;
        }
        .card-custom:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.05); }

        .progress-slim { height: 8px; border-radius: 10px; background-color: #f0f2f5; }

        .avatar-group img {
            width: 35px; height: 35px; border-radius: 50%; border: 2px solid #fff;
            margin-left: -12px; object-fit: cover;
        }
        .sidebar-right img {
            object-fit: cover;
            display: block;
        }
        .avatar-group img:first-child { margin-left: 0; }

        /* KANBAN BOARD */
        .kanban-col { background: #F4F7FE; border-radius: 16px; padding: 15px; height: 100%; }
        .kanban-header { font-weight: 600; color: #4A5568; margin-bottom: 15px; display: flex; justify-content: space-between; }
        .kanban-item { background: #fff; padding: 15px; border-radius: 12px; margin-bottom: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.03); }

        /* CALENDAR MINI */
        .calendar-day { 
            text-align: center; padding: 10px 5px; border-radius: 12px; cursor: pointer; 
            min-width: 45px;
        }
        .calendar-day.active { background: #0d6efd; color: #fff; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); }
        .calendar-day:hover:not(.active) { background: #f0f2f5; }
        .day-name { font-size: 0.7rem; margin-bottom: 5px; opacity: 0.7; }
        .day-date { font-weight: 700; font-size: 1rem; }

        /* TIMELINE */
        .timeline-item { display: flex; margin-bottom: 20px; align-items: flex-start; }
        .time-label { width: 60px; font-size: 0.85rem; color: #7D8592; font-weight: 500; padding-top: 10px; }
        .task-box { 
            flex: 1; padding: 15px; border-radius: 12px; position: relative; 
            border-left: 4px solid #0d6efd; background: #EBF3FF; /* Biru muda default */
        }
        .task-box.orange { border-left-color: #fd7e14; background: #fff5eb; }

    </style>
</head>
<body>
    <!-- Mobile Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom d-lg-none fixed-top">
        <div class="container-fluid">
            <button class="btn btn-outline-secondary me-2" type="button" onclick="toggleSidebar('left')">
                <i class="fas fa-bars"></i>
            </button>
            <span class="navbar-brand mb-0 h1">CollaboTask</span>
            <button class="btn btn-outline-secondary" type="button" onclick="toggleSidebar('right')">
                <i class="fas fa-user"></i>
            </button>
        </div>
    </nav>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="d-lg-none" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1030;" onclick="closeSidebars()"></div>

    <nav class="sidebar-left d-lg-block">
        <div class="d-flex align-items-center mb-5 ps-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="35" class="me-2">
            <span class="fw-bold fs-5 text-primary">CollaboTask</span>
            <button class="btn btn-sm btn-outline-secondary ms-auto d-lg-none" onclick="closeSidebars()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <p class="section-title ps-2">MENU</p>
        <ul class="nav flex-column">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" 
           class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('chat') }}" class="nav-link {{ Route::is('chat') ? 'active' : '' }}">
            <i class="fas fa-comment-dots"></i> Chats
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('tasks.index') }}" 
           class="nav-link {{ Route::is('tasks*') ? 'active' : '' }}">
            <i class="fas fa-clipboard-list"></i> Task Board
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('timeline') }}" class="nav-link {{ Route::is('timeline') ? 'active' : '' }}">
            <i class="fas fa-stream"></i> Timeline
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('reports') }}" class="nav-link {{ Route::is('reports.*') ? 'active' : '' }}">
            <i class="fas fa-chart-pie"></i> Reports
        </a>
    </li>
</ul>
        <p class="section-title ps-2 mt-4">FILE MANAGER</p>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-folder text-warning"></i> Folder Group A</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-file-pdf text-danger"></i> Brief.pdf</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-file-image text-primary"></i> Design.png</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-folder text-warning"></i> Folder Group B</a></li>
        </ul>
    </nav>

    <div class="d-flex">
        
        <main class="main-content flex-grow-1">
            @yield('content')
        </main>

        <aside class="sidebar-right d-xl-block">
            <div class="d-flex align-items-center mb-5">
                <a href="{{ route('profile.edit') }}" class="d-flex align-items-center text-decoration-none text-dark">
                    <x-avatar :user="auth()->user()" :size="50" />
                    <div class="ms-3">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                        <small class="text-muted d-block">Mahasiswa</small>
                    </div>
                </a>
                <div class="ms-auto">
                    <button class="btn btn-light btn-sm rounded-circle"><i class="fas fa-bell text-muted"></i></button>
                    <button class="btn btn-sm btn-outline-secondary ms-2 d-xl-none" onclick="closeSidebars()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">{{ \Carbon\Carbon::now()->format('F Y') }}</h6>
                    <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 text-white"><i class="font-size: 0.7rem;"></i>+ New Task</a>
                </div>
                <div class="d-flex justify-content-between">
                    @php
                        $today = \Carbon\Carbon::now();
                        $startOfWeek = $today->copy()->startOfWeek(); // Monday
                        for ($i = 0; $i < 5; $i++) {
                            $date = $startOfWeek->copy()->addDays($i);
                            $isToday = $date->isToday();
                    @endphp
                    <div class="calendar-day {{ $isToday ? 'active' : '' }}">
                        <div class="day-name">{{ $date->format('D') }}</div>
                        <div class="day-date">{{ $date->format('j') }}</div>
                    </div>
                    @php } @endphp
                </div>
            </div>

            <div>
                @php
                    $hasTodayTasks = $todayTasks->where('deadline', \Carbon\Carbon::today())->count() > 0;
                @endphp
                <h6 class="fw-bold mb-4">{{ $hasTodayTasks ? "Today's Schedule" : "Upcoming Tasks" }}</h6>

                @if($todayTasks->isEmpty())
                    <div class="text-muted small mb-3">No tasks scheduled for today.</div>

                    <div class="timeline-item">
                        <div class="time-label">09:00</div>
                        <div class="task-box">
                            <h6 class="fw-bold fs-6 mb-1">Example: UI Design Review</h6>
                            <small class="text-muted">Review wireframe with team</small>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="time-label">12:00</div>
                        <div class="task-box orange">
                            <h6 class="fw-bold fs-6 mb-1">Example: Database Config</h6>
                            <small class="text-muted">Setup MySQL for project</small>
                        </div>
                    </div>

                @else
                    @if(!$hasTodayTasks)
                        <div class="text-muted small mb-3">No tasks due today. Here are your upcoming tasks:</div>
                    @endif

                    @foreach($todayTasks as $task)
                        <div class="timeline-item">
                            <div class="time-label">
                                @if($task->due_time)
                                    {{ \Carbon\Carbon::parse($task->due_time)->format('H:i') }}
                                @else
                                    {{ \Carbon\Carbon::parse($task->deadline)->format('M j') }}
                                @endif
                            </div>
                            <div class="task-box {{ $task->priority == 'High' ? 'red' : ($task->priority == 'Medium' ? 'orange' : '') }}">
                                <h6 class="fw-bold fs-6 mb-1">{{ $task->title }}</h6>
                                <small class="text-muted">{{ \Illuminate\Support\Str::limit($task->description, 80) }}</small>
                                @if($task->project)
                                    <small class="text-primary d-block mt-1">{{ $task->project->name }}</small>
                                @endif
                                <i class="fas fa-ellipsis-h position-absolute top-0 end-0 m-3 text-muted"></i>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </aside>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar(side) {
            const sidebar = side === 'left' ? document.querySelector('.sidebar-left') : document.querySelector('.sidebar-right');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('show')) {
                closeSidebars();
            } else {
                sidebar.classList.add('show');
                overlay.style.display = 'block';
            }
        }

        function closeSidebars() {
            document.querySelector('.sidebar-left').classList.remove('show');
            document.querySelector('.sidebar-right').classList.remove('show');
            document.getElementById('sidebar-overlay').style.display = 'none';
        }
    </script>
</body>
</html>
