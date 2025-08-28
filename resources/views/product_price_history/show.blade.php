@extends('layouts.app')

@section('title', 'Detail Histori Harga Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h4 class="mb-4 text-center">Detail Histori Harga Produk</h4>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $history->id }}</td>
                        </tr>
                        <tr>
                            <th>Produk</th>
                            <td>{{ $history->product?->title ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Harga</th>
                            <td>{{ ucfirst($history->price_type) }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ "Rp " . number_format($history->price,2,',','.') }}</td>
                        </tr>
                        <tr>
                            <th>Diubah Oleh</th>
                            <td>{{ $history->changedBy?->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alasan Perubahan</th>
                            <td>{{ $history->change_reason }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Diubah</th>
                            <td>{{ $history->changed_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center mt-3">
                    <a href="{{ route('product_price_history.index') }}" class="btn btn-secondary">KEMBALI</a>
                    <a href="{{ route('product_price_history.edit', $history->id) }}" class="btn btn-primary">EDIT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
