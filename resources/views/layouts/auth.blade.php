<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login - Task Manager')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            overflow: hidden; /* Hilangkan scrollbar */
        }

        .container-fluid {
            height: 100vh;
            padding: 0;
        }

        /* BAGIAN KIRI (FORM) - Warna Putih */
        .login-left {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 10;
            padding: 10px; /* Padding sedikit dikecilkan agar muat di area sempit */
        }

        /* BAGIAN KANAN (GAMBAR) */
        .login-right {
            background-image: url('{{ asset("img/login_bg.jpg") }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        /* --- WAVE CONNECTOR (PENGHUBUNG) --- */
        .wave-connector {
            position: absolute;
            top: 0;
            left: -1px; /* Nempel ke kiri container gambar */
            bottom: 0;
            width: 1px; /* Lebar gelombang */
            z-index: 1;
            pointer-events: none;
        }
        
        .wave-connector svg {
            height: 100%;
            width: 100%;
            fill: #ffffff; /* Warna putih sama dengan background form */
            preserveAspectRatio: none; 
            filter: drop-shadow(5px 0 10px rgba(0,0,0,0.05)); /* Bayangan tipis di batas */
        }

        /* Responsive: Gambar hilang di HP */
        @media (max-width: 992px) {
            .login-right { display: none; }
            .login-left { width: 100%; padding: 40px; }
            .wave-connector { display: none; }
        }

        /* Input Styling */
        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #eee;
            padding: 12px;
            border-radius: 8px;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }
        .btn-primary {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>