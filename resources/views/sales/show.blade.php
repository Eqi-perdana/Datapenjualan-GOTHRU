@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Penjualan</h3>

    <p><strong>Pengguna:</strong> {{ $sale->user->name ?? 'Unknown' }}</p>
    <p><strong>Product:</strong> {{ $sale->product->name_product ?? 'Unknown' }}</p>
    <p><strong>Tanggal Penjualan:</strong> {{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</p>
    <p><strong>Jumlah Total:</strong> Rp {{ number_format($sale->total_amount, 2, ',', '.') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($sale->payment_method) }}</p>

    <a href="{{ route('sales.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
