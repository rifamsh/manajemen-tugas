<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login - Task Manager')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body, html { height: 100%; font-family: 'Segoe UI', sans-serif; }
        
        /* Gambar Background di sisi kiri */
        .bg-image {
            /* Mengambil gambar random bertema 'office' dari Unsplash */
            background-image: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        /* Overlay hitam transparan supaya tulisan terbaca */
        .bg-overlay {
            background-color: rgba(0, 0, 0, 0.4);
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        }

        /* Styling Form */
        .login-heading { font-weight: 800; color: #333; letter-spacing: -1px; }
        .form-control:focus { box-shadow: none; border-color: #0d6efd; }
        .btn-primary { padding: 10px; font-weight: 600; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-6 col-lg-7 bg-image d-none d-md-block p-0">
                <div class="bg-overlay d-flex flex-column justify-content-center px-5 text-white">
                    <h1 class="display-4 fw-bold">CollaboTask, <br>Master Productivity.</h1>
                    <p class="lead mt-3">Satu platform untuk semua kebutuhan manajemen tugas kelompok Anda.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 d-flex align-items-center justify-content-center bg-white">
                <div style="width: 80%; max-width: 400px;">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>