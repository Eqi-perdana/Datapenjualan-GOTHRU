<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Penjualan</title>
    <link rel="icon" href="{{ asset('shop.png') }}">

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
                        <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link">Kategori</a></li>
                        <li class="nav-item"><a href="{{ route('suppliers.index') }}" class="nav-link">Pemasok</a></li>
                        <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Produk</a></li>
                        <li class="nav-item"><a href="{{ route('purchases.index') }}" class="nav-link">Pembelian</a></li>
                        <li class="nav-item"><a href="{{ route('sales.index') }}" class="nav-link">Penjualan</a></li>
                        <li class="nav-item"><a href="{{ route('product_price_history.index') }}" class="nav-link">Histori Harga</a></li>
                        <li class="nav-item"><a href="{{ route('stocklogs.index') }}" class="nav-link">Stocklog</a></li>
                    @endif

                    {{-- Menu khusus karyawan --}}
                    @if (auth()->check() && auth()->user()->role === 'karyawan')
                        <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Produk</a></li>
                        <li class="nav-item"><a href="{{ route('sales.index') }}" class="nav-link">Penjualan</a></li>
                        <li class="nav-item"><a href="{{ route('purchases.index') }}" class="nav-link">Pembelian</a></li>
                    @endif
                </ul>

                {{-- Menu kanan (User & Logout) --}}
                @auth
                    <div class="d-flex align-items-center gap-2">
                        <span class="navbar-text text-light me-2">
                            {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                        </span>

                        {{-- Logout form tetap POST (CSRF) but button is type="button" --}}
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="button" id="logout-button" class="btn btn-outline-light btn-sm">
                                Logout
                            </button>
                        </form>
                    </div>
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

    {{-- SweetAlert2 (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script konfirmasi logout --}}
    <script>
        (function () {
            const logoutBtn = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');

            if (!logoutBtn || !logoutForm) return;

            logoutBtn.addEventListener('click', function (e) {
                e.preventDefault();

                // Jika SweetAlert2 tersedia, gunakan modal yang lebih bagus
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Apakah Anda yakin ingin logout?',
                        text: "Anda akan keluar dari aplikasi.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, logout',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            logoutForm.submit();
                        }
                    });
                    return;
                }

                // Fallback sederhana jika SweetAlert2 gagal dimuat
                if (confirm('Apakah Anda yakin ingin logout?')) {
                    logoutForm.submit();
                }
            });
        })();
    </script>

    {{-- Tempat untuk script tambahan tiap halaman --}}
    @yield('scripts')

    <!-- Footer -->
    <footer class="text-center" style="margin-top: 30px; padding: 15px 0; background-color: #f8f9fa;">
        <p style="margin: 0;">© 2025 Aplikasi Penjualan</p>
    </footer>
</body>
</html>
