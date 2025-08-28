@extends('layouts.app')

@section('title', 'Show Sales - SantriKoding.com')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>Detail Penjualan</h3>
                    <hr/>
                    <p><strong>User:</strong> {{ $sale->user->name ?? 'Unknown' }}</p>
                    <p><strong>Tanggal Penjualan:</strong> {{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</p>
                    <p><strong>Total Amount:</strong> {{ "Rp " . number_format($sale->total_amount, 2, ',', '.') }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($sale->payment_method) }}</p>
                    <p><strong>Dibuat pada:</strong> {{ $sale->created_at->format('d-m-Y H:i') }}</p>
                    <p><strong>Diperbarui pada:</strong> {{ $sale->updated_at->format('d-m-Y H:i') }}</p>

                    <a href="{{ route('sales.index') }}" class="btn btn-md btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
