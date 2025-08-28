<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi Penjualan') }}</title>
    {{-- Bootstrap CSS --}}
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('penjualan.dashboard') }}">Penjualan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="{{ url('categories') }}" class="nav-link">Categories</a></li>
                <li class="nav-item"><a href="{{ url('suppliers') }}" class="nav-link">Suppliers</a></li>
                <li class="nav-item"><a href="{{ url('products') }}" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="{{ url('purchases') }}" class="nav-link">Purchases</a></li>
                <li class="nav-item"><a href="{{ url('sales') }}" class="nav-link">Sales</a></li>
                <li class="nav-item"><a href="{{ url('product_price_history') }}" class="nav-link">Product History</a></li>
            </ul>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

{{-- Konten Halaman --}}
<div class="container mt-4">
    @yield('content')
</div>

{{-- Bootstrap Bundle JS --}}
<script src="{{ asset('asset/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- Chart.js CDN ditaruh di layout agar semua halaman bisa akses --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Tempat untuk script tambahan tiap halaman --}}
@yield('scripts')

</body>
</html>
