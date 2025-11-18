@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<style>
    .modern-card {
        border-radius: 18px !important;
        background: #ffffffd9;
        backdrop-filter: blur(8px);
        border: none !important;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: 0.25s ease-in-out;
    }
    .modern-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }
    .modern-label {
        font-weight: 600;
        font-size: 14px;
        color: #333;
        margin-bottom: 6px;
    }
    .modern-input {
        border-radius: 12px !important;
        border: 1px solid #d6d6d6;
        transition: .2s;
    }
    .modern-input:focus {
        border-color: #4b7bec !important;
        box-shadow: 0 0 8px rgba(75, 123, 236, 0.35);
    }
    .btn-modern-primary {
        background: #4b7bec;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 600;
        border: none;
    }
    .btn-modern-warning,
    .btn-modern-secondary {
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 600;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="modern-card">

                <h3 class="text-center mb-4" style="font-weight:700;">
                    Add New Product
                </h3>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="modern-label">Kategori</label>
                        <select name="id_category" class="form-control modern-input @error('id_category') is-invalid @enderror">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Product Name --}}
                    <div class="mb-4">
                        <label class="modern-label">Nama Product</label>
                        <input type="text" name="name_product" 
                               class="form-control modern-input @error('name_product') is-invalid @enderror"
                               value="{{ old('name_product') }}" 
                               placeholder="Enter Product Name">
                        @error('name_product')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="modern-label">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="form-control modern-input @error('description') is-invalid @enderror"
                                  placeholder="Enter Description">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- Stock --}}
                        <div class="col-md-6 mb-4">
                            <label class="modern-label">Stok</label>
                            <input type="number" name="stok"
                                   class="form-control modern-input @error('stok') is-invalid @enderror"
                                   value="{{ old('stok') }}"
                                   placeholder="Enter Stock Quantity">
                            @error('stok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Unit Items --}}
                        <div class="col-md-6 mb-4">
                            <label class="modern-label">Satuan Barang</label>
                            <input type="text" name="unit_items"
                                   class="form-control modern-input @error('unit_items') is-invalid @enderror"
                                   value="{{ old('unit_items') }}"
                                   placeholder="e.g. pcs, box, kg">
                            @error('unit_items')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Purchase Price --}}
                        <div class="col-md-6 mb-4">
                            <label class="modern-label">Harga Beli</label>
                            <input type="number" step="0.01" name="purchase_price"
                                   class="form-control modern-input @error('purchase_price') is-invalid @enderror"
                                   value="{{ old('purchase_price') }}"
                                   placeholder="Enter Purchase Price">
                            @error('purchase_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Selling Price --}}
                        <div class="col-md-6 mb-4">
                            <label class="modern-label">Harga Jual</label>
                            <input type="number" step="0.01" name="selling_price"
                                   class="form-control modern-input @error('selling_price') is-invalid @enderror"
                                   value="{{ old('selling_price') }}"
                                   placeholder="Enter Selling Price">
                            @error('selling_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between align-items-center mt-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-modern-primary text-white">
                                Save
                            </button>

                            <button type="reset" class="btn btn-modern-warning btn-warning">
                                Reset
                            </button>
                        </div>

                        <a href="{{ route('products.index') }}" class="btn btn-modern-secondary btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
