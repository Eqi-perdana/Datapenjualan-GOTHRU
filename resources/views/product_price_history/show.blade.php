@extends('layouts.app')

@section('title', 'Detail Histori Harga Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h4 class="mb-4 text-center">Detail Histori Harga Produk</h4>

                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $nomorUrut }}</td>
                        </tr>
                        <tr>
                            <th>Produk</th>
                            <td>{{ $history->product?->name_product ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Harga</th>
                            <td>
                                @if ($history->price_type === 'purchase')
                                    <span class="badge bg-info">Harga Beli</span>
                                @else
                                    <span class="badge bg-success">Harga Jual</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ 'Rp ' . number_format($history->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Alasan Perubahan</th>
                            <td>{{ $history->change_reason }}</td>
                        </tr>
                        <tr>
                            <th>Diubah Oleh</th>
                            <td>{{ $history->changedBy?->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Diubah</th>
                            <td>
                                {{ $history->changed_at ? $history->changed_at->format('d-m-Y H:i') : $history->created_at->format('d-m-Y H:i') }}
                            </td>
                        </tr>
                    </table>

                    <div class="text-center mt-3">
                        <a href="{{ route('product_price_history.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
