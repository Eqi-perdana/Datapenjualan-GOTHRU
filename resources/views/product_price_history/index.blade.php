@extends('layouts.app')

@section('title', 'Histori Harga Produk')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12">

            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-">💰 Histori Harga Produk</h2>
                <p class="text-muted">Riwayat perubahan harga produk</p>
            </div>

            <!-- Card Container -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #056e7cff, #058ccaff);">
                    <div class="d-flex justify-content-between align-items-center flex-wrap text-white">
                        <h5 class="fw-semibold mb-0">Daftar Histori Harga</h5>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('product_price_history.create') }}" 
                               class="btn btn-light fw-semibold rounded-pill px-4 py-2 shadow-sm"
                               style="transition: 0.3s;">
                                + Tambah Data
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4 bg-light">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 price-history-table" style="font-size: 15px;">
                            <thead style="background-color: #f1f5f9;">
                                <tr class="text-uppercase text-muted" style="font-size: 0.9rem;">
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Jenis Harga</th>
                                    <th>Harga</th>
                                    <th>Diubah Oleh</th>
                                    <th>Alasan Perubahan</th>
                                    <th>Tanggal Diubah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    @php
                                        // raw value dari DB
                                        $rawType = $history->price_type ?? '';

                                        // bersihkan dan normalisasi sederhana
                                        $clean = strtolower(trim((string) $rawType));
                                        // hapus karakter non-alphanumeric supaya lebih robust
                                        $cleanAlnum = preg_replace('/[^a-z0-9]/', '', $clean);

                                        // deteksi jual / beli dari beberapa kemungkinan variasi
                                        $isJual = false;
                                        $isBeli = false;

                                        if ($cleanAlnum === '1' || strpos($cleanAlnum, 'jual') !== false || strpos($cleanAlnum, 'sale') !== false || strpos($cleanAlnum, 'selling') !== false) {
                                            $isJual = true;
                                        }
                                        if ($cleanAlnum === '2' || strpos($cleanAlnum, 'beli') !== false || strpos($cleanAlnum, 'purchase') !== false || strpos($cleanAlnum, 'buy') !== false || strpos($cleanAlnum, 'purchase') !== false) {
                                            $isBeli = true;
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}</td>
                                        <td class="fw-semibold text-dark">{{ $history->product?->name_product ?? '-' }}</td>

                                        {{-- Jenis Harga --}}
                                        <td>
                                            @if($isJual)
                                                <span class="badge bg-primary px-3 py-2" title="{{ $rawType }}">Harga Jual</span>
                                            @elseif($isBeli)
                                                <span class="badge bg-success px-3 py-2" title="{{ $rawType }}">Harga Beli</span>
                                            @else
                                                {{-- tampilkan nilai mentah sebagai tooltip supaya gampang debug --}}
                                                <span class="badge bg-secondary px-3 py-2" title="{{ $rawType ?: 'NULL' }}">Tidak Diketahui</span>
                                            @endif
                                        </td>

                                        <td class="fw-semibold text-dark">
                                            {{ 'Rp ' . number_format($history->price ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $history->changedBy?->name ?? '-' }}</td>
                                        <td>{{ $history->change_reason ?? '-' }}</td>
                                        <td>{{ $history->changed_at ? $history->changed_at->format('d-m-Y H:i') : '-' }}</td>

                                        {{-- Aksi: tombol berjejer rapi (nowrap) --}}
                                        <td class="text-center align-middle">
                                            <div class="action-btns d-inline-flex align-items-center">
                                                <a href="{{ route('product_price_history.show', $history->id) }}" 
                                                   class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                                    Lihat
                                                </a>

                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('product_price_history.edit', $history->id) }}" 
                                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-semibold">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('product_price_history.destroy', $history->id) }}" 
                                                          method="POST" class="m-0 p-0 swal-delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 fw-semibold btn-delete">
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
                                            Belum ada data histori harga.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($histories->hasPages())
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $histories->links() }}
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

/* Card + hover sama persis dengan product */
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

/* --- Aksi: buat tombol selalu berjejer (nowrap) --- */
.price-history-table .action-btns {
    gap: 0.5rem;
    white-space: nowrap;
    display: inline-flex;
    flex-wrap: nowrap; /* jangan ter-wrap */
    align-items: center;
}
.price-history-table .action-btns form { display: inline-block; margin: 0; }
.price-history-table .action-btns .btn { min-width: 64px; }

/* Jika layar sangat kecil: wrap agar tidak meluber */
@media (max-width: 420px) {
    .price-history-table .action-btns { flex-wrap: wrap; justify-content: center; gap: 0.35rem; }
}

/* jaga vertical align */
.table td, .table th { vertical-align: middle !important; }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Konfirmasi hapus dengan SweetAlert untuk form yang punya class .swal-delete-form
    document.querySelectorAll('.swal-delete-form').forEach(function(form){
        const btn = form.querySelector('.btn-delete');
        if (!btn) return;
        btn.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Hapus data?',
                text: 'Data akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
