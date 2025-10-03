@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3 class="fw-bold mb-3">🛒 Detail Penjualan</h3>
                    <hr>

                    <div class="mb-3">
                        <strong>Pengguna:</strong>
                        <p class="text-muted">{{ $sale->user->name ?? 'Unknown' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Produk:</strong>
                        <p class="text-muted">{{ $sale->product->name_product ?? 'Unknown' }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Tanggal Penjualan:</strong>
                        <p class="text-muted">{{ \Carbon\Carbon::parse($sale->sale_date)->translatedFormat('d F Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Jumlah Total:</strong>
                        <p class="fw-bold text-success">
                            Rp {{ number_format($sale->total_amount, 2, ',', '.') }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <strong>Metode Pembayaran:</strong>
                        <p class="text-muted">{{ ucfirst($sale->payment_method) }}</p>
                    </div>

                    <hr>
                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-secondary">
                        ⬅️ Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
