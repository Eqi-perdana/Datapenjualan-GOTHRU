@extends('layouts.app')

@section('title', 'Detail Pembelian')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3 class="mb-3">Detail Pembelian</h3>
                    <hr />
                    <div class="mb-3">
                        <strong>PEMASOK:</strong>
                        <p>{{ $purchase->supplier->name_suppliers ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Pengguna (User):</strong>
                        <p>{{ $purchase->user->name ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Tanggal Pembelian:</strong>
                        <p>{{ \Carbon\Carbon::parse($purchase->purchase_date)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Total Pembelian:</strong>
                        <p>{{ 'Rp ' . number_format($purchase->total_amount, 2, ',', '.') }}</p>
                    </div>
                    <hr>
                    <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
