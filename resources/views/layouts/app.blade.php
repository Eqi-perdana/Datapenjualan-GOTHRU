<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
    <link rel="icon" href="./shop.png">
    {{-- Bootstrap CSS --}}
    <link href="{{ asset('asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            {{-- Logo / Brand --}}
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                @if (auth()->check() && auth()->user()->role === 'admin')
                    Dashboard Admin
                @elseif(auth()->check() && auth()->user()->role === 'karyawan')
                    Dashboard Karyawan
                @else
                    Dashboard
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Menu kiri --}}
                <ul class="navbar-nav me-auto">
                    {{-- Menu khusus admin --}}
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link">Kategori</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('suppliers.index') }}" class="nav-link">Pemasok</a></li>
                        <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Produk</a></li>
                        <li class="nav-item"><a href="{{ route('purchases.index') }}" class="nav-link">Pembelian</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('sales.index') }}" class="nav-link">Penjualan</a></li>
                        <li class="nav-item"><a href="{{ route('product_price_history.index') }}"
                                class="nav-link">Histori Harga</a></li>
                        <li class="nav-item"><a href="{{ route('stocklogs.index') }}" class="nav-link">Stocklog</a></li>
                    @endif

                    {{-- Menu khusus karyawan --}}
                    @if (auth()->check() && auth()->user()->role === 'karyawan')
                        <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Produk</a></li>
                        <li class="nav-item"><a href="{{ route('sales.index') }}" class="nav-link">Penjualan</a></li>
                        <li class="nav-item"><a href="{{ route('purchases.index') }}" class="nav-link">Pembelian</a>
                        </li>
                    @endif
                </ul>

                {{-- Menu kanan (User & Logout) --}}
                @auth
                    <span class="navbar-text text-light me-3">
                        {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Bootstrap Bundle JS --}}
    <script src="{{ asset('asset/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Tempat untuk script tambahan tiap halaman --}}
    @yield('scripts')

</body>

</html>
