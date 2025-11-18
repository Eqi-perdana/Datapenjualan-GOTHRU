@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">✏ Edit Product</h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Category --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="id_category" class="form-select @error('id_category') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Name Product --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input 
                                type="text" 
                                class="form-control @error('name_product') is-invalid @enderror" 
                                name="name_product" 
                                value="{{ old('name_product', $product->name_product) }}" 
                                placeholder="Masukkan nama produk">
                            @error('name_product')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea 
                                class="form-control @error('description') is-invalid @enderror"
                                name="description" rows="5"
                                placeholder="Masukkan deskripsi produk">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Unit --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Satuan Barang</label>
                            <input 
                                type="text" 
                                class="form-control @error('unit_items') is-invalid @enderror"
                                name="unit_items" 
                                value="{{ old('unit_items', $product->unit_items) }}"
                                placeholder="Contoh: pcs, box, kg">
                            @error('unit_items')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Price Row --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Harga Beli</label>
                                <input 
                                    type="number" step="0.01"
                                    class="form-control @error('purchase_price') is-invalid @enderror" 
                                    name="purchase_price" 
                                    value="{{ old('purchase_price', $product->purchase_price) }}" 
                                    placeholder="Masukkan harga beli">
                                @error('purchase_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Harga Jual</label>
                                <input 
                                    type="number" step="0.01"
                                    class="form-control @error('selling_price') is-invalid @enderror" 
                                    name="selling_price" 
                                    value="{{ old('selling_price', $product->selling_price) }}" 
                                    placeholder="Masukkan harga jual">
                                @error('selling_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input 
                                type="number"
                                class="form-control @error('stok') is-invalid @enderror"
                                name="stok" 
                                value="{{ old('stok', $product->stok) }}" 
                                placeholder="Masukkan stok produk">
                            @error('stok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">
                                ← Kembali
                            </a>

                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-warning px-4">Reset</button>
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
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
