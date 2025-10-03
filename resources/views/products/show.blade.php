@extends('layouts.app')

@section('title', 'Show Product')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3 class="mb-3">{{ $product->name }}</h3>
                    <hr/>
                    <p><strong>Kode Produk:</strong> {{ $product->code }}</p>
                    <p><strong>Kategori:</strong> {{ $product->category?->name ?? '-' }}</p>
                    <p><strong>Harga Beli:</strong> {{ 'Rp ' . number_format($product->purchase_price, 2, ',', '.') }}</p>
                    <p><strong>Harga Jual:</strong> {{ 'Rp ' . number_format($product->selling_price, 2, ',', '.') }}</p>
                    <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    <hr/>
                    <p><strong>Deskripsi:</strong></p>
                    <div class="bg-light p-3 rounded">
                        {!! $product->description !!}
                    </div>
                    <hr/>
                    <p><small>Dibuat: {{ $product->created_at->format('d M Y H:i') }}</small></p>
                    <p><small>Diubah: {{ $product->updated_at->format('d M Y H:i') }}</small></p>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
