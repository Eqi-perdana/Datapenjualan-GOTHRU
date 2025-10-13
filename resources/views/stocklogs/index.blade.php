@extends('layouts.app')

@section('title', 'Data Stock Logs')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12">

            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-">📦 Keluar Masuk Barang</h2>
                <p class="text-muted">Riwayat log pergerakan stok produk</p>
            </div>

            <!-- Card Container -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #ea00ffff, #ff00eaff);">
                    <div class="d-flex justify-content-between align-items-center flex-wrap text-white">
                        <h5 class="fw-semibold mb-0">Daftar Log Stok</h5>
                        <a href="{{ route('stocklogs.create') }}" 
                           class="btn btn-light fw-semibold rounded-pill px-4 py-2 shadow-sm"
                           style="transition: 0.3s;">
                            + Tambah Log
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 bg-light">
                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 15px;">
                            <thead style="background-color: #f1f5f9;">
                                <tr class="text-uppercase text-muted" style="font-size: 0.9rem;">
                                    <th>Produk</th>
                                    <th>Jenis Type</th>
                                    <th>Jumlah</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stockLogs as $stockLog)
                                    <tr>
                                        <td class="fw-semibold text-dark">{{ $stockLog->product->name_product ?? '-' }}</td>
                                        <td>
                                            @if ($stockLog->change_type === 'in')
                                                <span class="badge bg-success px-3 py-2">IN</span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">OUT</span>
                                            @endif
                                        </td>
                                        <td class="fw-bold text-primary">{{ $stockLog->quantity }}</td>
                                        <td>{{ $stockLog->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($stockLog->stocklog_date)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                                <a href="{{ route('stocklogs.show', $stockLog->id) }}" 
                                                   class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1">Lihat</a>
                                                <a href="{{ route('stocklogs.edit', $stockLog->id) }}" 
                                                   class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">Edit</a>
                                                <form onsubmit="return confirm('Yakin ingin hapus log ini?');"
                                                      action="{{ route('stocklogs.destroy', $stockLog->id) }}" 
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger fw-semibold py-4">
                                            Belum ada data log stok tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($stockLogs->hasPages())
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $stockLogs->links() }}
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
