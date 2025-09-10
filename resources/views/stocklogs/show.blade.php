@extends('layouts.app')

@section('title', 'Detail Stock Log')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <h3 class="mb-3">Detail Keluar Masuk Barang</h3>
                <hr>

                <p><strong>Product:</strong> {{ $stockLog->product->name_product ?? 'Unknown' }}</p>

                <p><strong>Jenis Type :</strong>
                    <span class="badge bg-{{ $stockLog->change_type == 'in' ? 'success' : 'danger' }}">
                        {{ strtoupper($stockLog->change_type) }}
                    </span>
                </p>

                <p><strong>Jumlah Barang :</strong> {{ $stockLog->quantity }}</p>

                <p><strong>Deskripsi :</strong></p>
                <div class="p-2 bg-light rounded">
                    {!! $stockLog->description ?? '-' !!}
                </div>

                <hr>
                <p><strong>Dibuat pada :</strong> 
                    <td>{{ \Carbon\Carbon::parse($stockLog->stocklog_date)->format('d-m-Y') }}</td>
                </p>

                <div class="mt-4">
                    <a href="{{ route('stocklogs.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('stocklogs.edit', $stockLog->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
