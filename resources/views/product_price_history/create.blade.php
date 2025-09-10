@extends('layouts.app')

@section('title', 'Tambah Histori Harga Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h4 class="mb-4 text-center">Tambah Histori Harga Produk</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('product_price_history.store') }}" method="POST">
                    @csrf

                    {{-- Pilih Produk --}}
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Produk</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name_product }} (Stok: {{ $product->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jenis Harga --}}
                    <div class="mb-3">
                        <label for="price_type" class="form-label">Jenis Harga</label>
                        <select name="price_type" id="price_type" class="form-select" required>
                            <option value="">-- Pilih Jenis Harga --</option>
                            <option value="purchase">Harga Beli</option>
                            <option value="selling">Harga Jual</option>
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" required placeholder="Masukkan harga">
                    </div>

                    {{-- Alasan Perubahan --}}
                    <div class="mb-3">
                        <label for="change_reason" class="form-label">Alasan Perubahan</label>
                        <textarea name="change_reason" id="change_reason" rows="3" class="form-control" required placeholder="Masukkan alasan perubahan harga"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success me-2">SIMPAN</button>
                        <a href="{{ route('product_price_history.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
