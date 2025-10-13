@extends('layouts.app')

@section('title', 'Data Pembelian')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12">

            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-">🛒 Data Pembelian</h2>
                <p class="text-muted">Kelola seluruh data transaksi pembelian dengan mudah</p>
            </div>

            <!-- Card Container -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #5b5d5fff, #7d8283ff);">
                    <div class="d-flex justify-content-between align-items-center flex-wrap text-white">
                        <h5 class="fw-semibold mb-0">Daftar Pembelian</h5>
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'karyawan')
                            <a href="{{ route('purchases.create') }}" 
                               class="btn btn-light fw-semibold rounded-pill px-4 py-2 shadow-sm"
                               style="transition: 0.3s;">
                                + Tambah Pembelian
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
                                    <th>Pemasok</th>
                                    <th>Pengguna</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Jumlah Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                    <tr>
                                        <td class="fw-semibold">{{ $purchase->supplier->name_suppliers ?? '-' }}</td>
                                        <td>{{ $purchase->user->name ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                                        <td class="fw-semibold text-dark">
                                            {{ 'Rp ' . number_format($purchase->total_amount, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <a href="{{ route('purchases.show', $purchase->id) }}" 
                                                   class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1">Lihat</a>
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('purchases.edit', $purchase->id) }}" 
                                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">Edit</a>
                                                    <form onsubmit="return confirm('Yakin ingin hapus data ini?');"
                                                          action="{{ route('purchases.destroy', $purchase->id) }}" 
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
                                        <td colspan="5" class="text-center text-danger fw-semibold py-4">
                                            Belum ada data pembelian tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($purchases->hasPages())
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $purchases->links() }}
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
