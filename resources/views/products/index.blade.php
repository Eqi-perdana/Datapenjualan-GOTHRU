@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12">

            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-">📦 Data Produk</h2>
                <p class="text-muted">Kelola seluruh data produk dan stok barang dengan mudah</p>
            </div>

            <!-- Card Container -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #007bff, #00c6ff);">
                    <div class="d-flex justify-content-between align-items-center flex-wrap text-white">
                        <h5 class="fw-semibold mb-0">Daftar Produk</h5>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('products.create') }}" 
                               class="btn btn-light fw-semibold rounded-pill px-4 py-2 shadow-sm"
                               style="transition: 0.3s;">
                                + Tambah Produk
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4 bg-light">
                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 15px;">
                            <thead style="background-color: #f1f5f9;">
                                <tr class="text-uppercase text-muted" style="font-size: 0.9rem;">
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="fw-semibold">{{ $product->id }}</td>
                                        <td>{{ $product->category->name ?? '-' }}</td>
                                        <td class="fw-semibold text-dark">{{ $product->name_product }}</td>
                                        <td>
                                            @if($product->stok < 10)
                                                <span class="badge bg-danger">{{ $product->stok }}</span>
                                            @elseif($product->stok < 30)
                                                <span class="badge bg-warning text-dark ">{{ $product->stok }}</span>
                                            @else
                                                <span class="badge bg-success ">{{ $product->stok }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->unit_items }}</td>
                                        <td>{{ "Rp " . number_format($product->purchase_price, 0, ',', '.') }}</td>
                                        <td>{{ "Rp " . number_format($product->selling_price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <a href="{{ route('products.show', $product->id) }}" 
                                                   class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1">Lihat</a>
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('products.edit', $product->id) }}" 
                                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">Edit</a>
                                                    <form onsubmit="return confirm('Yakin ingin hapus produk ini?');"
                                                          action="{{ route('products.destroy', $product->id) }}" 
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-danger fw-semibold py-4">
                                            Belum ada data produk tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STYLE TAMBAHAN -->
<style>
.text-gradient {
    background: linear-gradient(135deg, #007bff, #00c6ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card {
    transition: all 0.3s ease-in-out;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.table-hover tbody tr:hover {
    background-color: #eef7ff !important;
}

.btn-light:hover {
    background-color: #f8f9fa;
    transform: scale(1.05);
}

@media (max-width: 576px) {
    .btn {
        font-size: 0.8rem !important;
    }
    .table {
        font-size: 14px !important;
    }
    .card-body {
        padding: 1rem !important;
    }
    .btn-light {
        font-size: 14px;
        padding: 6px 12px !important;
    }
}
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endpush
