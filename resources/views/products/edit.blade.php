@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Category --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">CATEGORY</label>
                            <select name="id_category" class="form-control @error('id_category') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Name Product --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA PRODUCT</label>
                            <input type="text" class="form-control @error('name_product') is-invalid @enderror" 
                                   name="name_product" value="{{ old('name_product', $product->name_product) }}" placeholder="Masukkan Nama Produk">
                            @error('name_product')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">DESCRIPTION</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      name="description" rows="5" placeholder="Masukkan Deskripsi Produk">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Unit Items --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">UNIT ITEMS</label>
                            <input type="text" class="form-control @error('unit_items') is-invalid @enderror" 
                                   name="unit_items" value="{{ old('unit_items', $product->unit_items) }}" placeholder="Masukkan Satuan Barang">
                            @error('unit_items')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Purchase Price & Selling Price --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">PURCHASE PRICE</label>
                                    <input type="number" step="0.01" class="form-control @error('purchase_price') is-invalid @enderror" 
                                           name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" placeholder="Masukkan Harga Beli">
                                    @error('purchase_price')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">SELLING PRICE</label>
                                    <input type="number" step="0.01" class="form-control @error('selling_price') is-invalid @enderror" 
                                           name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" placeholder="Masukkan Harga Jual">
                                    @error('selling_price')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">STOK</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                   name="stok" value="{{ old('stok', $product->stok) }}" placeholder="Masukkan Stok Produk">
                            @error('stok')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-start gap-2">
                            <a href="{{ route('products.index') }}" class="btn btn-md btn-secondary">
                                ⬅ Kembali
                            </a>
                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endpush
