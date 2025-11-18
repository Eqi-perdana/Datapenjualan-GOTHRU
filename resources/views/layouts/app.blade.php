<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Penjualan</title>
    <link rel="icon" href="{{ asset('shop.png') }}">

    {{-- AdminLTE & Dependencies (CDN) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link font-weight-bold">
                        @auth
                            {{ auth()->user()->role === 'admin' ? 'Dashboard Admin' : 'Dashboard Karyawan' }}
                        @else
                            Dashboard
                        @endauth
                    </a>
                </li>
            </ul>

            <!-- Right Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="fa fa-user"></i> {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                        </span>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="button" id="logout-button" class="btn btn-danger btn-sm">
                                <i class="fa fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>

        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link text-center">
                <span class="brand-text font-weight-bold">Aplikasi Penjualan</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                        @if (auth()->check() && auth()->user()->role === 'admin')
                            <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link"><i class="nav-icon fa fa-list"></i><p>Kategori</p></a></li>
                            <li class="nav-item"><a href="{{ route('suppliers.index') }}"  class="nav-link"><i class="nav-icon fa fa-truck"></i><p>Pemasok</p></a></li>
                            <li class="nav-item"><a href="{{ route('products.index') }}"    class="nav-link"><i class="nav-icon fa fa-box"></i><p>Produk</p></a></li>
                            <li class="nav-item"><a href="{{ route('purchases.index') }}"   class="nav-link"><i class="nav-icon fa fa-cart-plus"></i><p>Pembelian</p></a></li>
                            <li class="nav-item"><a href="{{ route('sales.index') }}"       class="nav-link"><i class="nav-icon fa fa-cash-register"></i><p>Penjualan</p></a></li>
                            <li class="nav-item"><a href="{{ route('product_price_history.index') }}" class="nav-link"><i class="nav-icon fa fa-history"></i><p>Histori Harga</p></a></li>
                            <li class="nav-item"><a href="{{ route('stocklogs.index') }}"   class="nav-link"><i class="nav-icon fa fa-database"></i><p>Stocklog</p></a></li>
                        @elseif(auth()->check() && auth()->user()->role === 'karyawan')
                            <li class="nav-item"><a href="{{ route('products.index') }}"    class="nav-link"><i class="nav-icon fa fa-box"></i><p>Produk</p></a></li>
                            <li class="nav-item"><a href="{{ route('sales.index') }}"       class="nav-link"><i class="nav-icon fa fa-cash-register"></i><p>Penjualan</p></a></li>
                            <li class="nav-item"><a href="{{ route('purchases.index') }}"   class="nav-link"><i class="nav-icon fa fa-cart-plus"></i><p>Pembelian</p></a></li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        {{-- Content --}}
        <div class="content-wrapper p-3">
            @yield('content')
        </div>

        {{-- Footer --}}
        <footer class="main-footer text-center">
            <small>© 2025 Aplikasi Penjualan</small>
        </footer>
    </div>

    {{-- JS Dependencies --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        // Konfirmasi Logout
        document.getElementById('logout-button')?.addEventListener('click', function () {
            Swal.fire({
                title: 'Yakin logout?',
                text: "Anda akan keluar dari aplikasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>

    @yield('scripts')

</body>
</html>
