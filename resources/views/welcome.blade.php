<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
    <link rel="icon" href="./coupon.png">
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(rgba(80, 80, 200, 0.65), rgba(59, 130, 246, 0.65)),
                url("gambar.jpg") no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }

        /* Navbar */
        .navbar {
            background: transparent !important;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .btn-login {
            background-color: rgba(255, 255, 255, 0.9);
            color: #19191aff;
            font-weight: 500;
            border-radius: 30px;
            position: absolute;
            padding: 10px 30px;
            top: 15px;
            right: 25px;
            z-index: 1050;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0e7decff;
            color: #fff;

        }

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            animation: fadeInDown 1s ease-in-out;
        }

        .hero span {
            color: #ffd700;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
            max-width: 600px;
            animation: fadeInUp 1.2s ease-in-out;
        }

        .hero .btn-start {
            margin-top: 20px;
            background-color: transparent;
            border: 2px solid #fff;
            color: #fff;
            font-size: 1.1rem;
            border-radius: 30px;
            padding: 10px 40px;
            transition: all 0.3s ease;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .hero .btn-start:hover {
            background-color: #fff;
            color: #2563eb;
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            font-size: 0.9rem;
            opacity: 0.9;
            text-align: center;
            padding: 10px 0;
        }

        /* Animasi */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero .btn-start {
                font-size: 1rem;
                padding: 8px 30px;
            }
        }
    </style>
</head>

<body>

    <!-- Tombol Login di pojok kanan atas -->
    <a href="{{ route('login') }}" class="btn btn-login px-4 login-top-btn">Login</a>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Bagian kiri -->
            <a class="navbar-brand">Aplikasi Penjualan</a>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero">
        <h1>Selamat Datang di <span>Aplikasi Penjualan</span></h1>
        <p>Kelola data Anda dengan lebih mudah, cepat, dan aman bersama aplikasi ini.</p>
        <a href="{{ route('login') }}" class="btn btn-start">Mulai Sekarang</a>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 Aplikasi Penjualan</p>
    </footer>

</body>

</html>
