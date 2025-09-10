@extends('layouts.app')

@section('title', 'Tambah Stock Log')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Alert Success/Error --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">

                    <h4 class="mb-4 text-center">Tambah Stock Log</h4>

                    <form action="{{ route('stocklogs.store') }}" method="POST">
                        @csrf

                        <!-- Product -->
                        <div class="mb-3">
                            <label for="product_id" class="form-label fw-bold">Product</label>
                            <select name="product_id" class="form-control" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Change Type -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Perubahan</label>
                            <select name="change_type" class="form-select @error('change_type') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="in" {{ old('change_type') == 'in' ? 'selected' : '' }}>IN (Masuk)
                                </option>
                                <option value="out" {{ old('change_type') == 'out' ? 'selected' : '' }}>OUT (Keluar)
                                </option>
                            </select>
                            @error('change_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                class="form-control @error('quantity') is-invalid @enderror" placeholder="Masukkan Jumlah"
                                required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Masukkan Keterangan">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success me-2">Simpan</button>
                            <a href="{{ route('stocklogs.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
