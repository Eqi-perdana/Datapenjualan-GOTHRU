<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: #fff;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 600;
        }
        .navbar .btn {
            transition: all 0.5s ease;
        }
        .navbar .btn:hover {
            background-color: #2563eb;
            color: #fff;
        }
        .hero {
            flex: 1;
        }
        .hero h1 {
            font-size: 3rem;
            animation: fadeInDown 1s ease-in-out;
        }
        .hero p {
            font-size: 1.2rem;
            animation: fadeInUp 1.5s ease-in-out;
        }
        .hero .btn {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .hero .btn:hover {
            transform: scale(1.1);
            background-color: #eef0f5ff;
            border-color: #2563eb;
        }
        footer {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Animasi sederhana */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-none px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand">Aplikasi Penjualan</a>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-light btn-sm px-4">Login</a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container d-flex flex-column justify-content-center align-items-center text-center hero">
        <h1 class="fw-bold mb-3">Selamat Datang di <span class="text-warning">Aplikasi Penjualan</span></h1>
        <p class="mb-4">Kelola data Anda dengan lebih mudah, cepat, dan aman bersama aplikasi ini.</p>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">Mulai Sekarang</a>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        <h6 class="mb-0">© 2025 Aplikasi Penjualan</h6>
    </footer>

</body>
</html>
