@extends('layouts.app')

@section('title', 'Edit Stock Log')

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

                    <h4 class="mb-4 text-center">Edit Stock Log</h4>

                    <form action="{{ route('stocklogs.update', $stockLog->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Product -->
                        <div class="mb-3">
                        <label for="product_id" class="form-label fw-bold">Product</label>
                        <select name="product_id" class="form-control" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ $stockLog->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name_product }}
                                </option>
                            @endforeach
                        </select>
                </div>

                <!-- Change Type -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Perubahan</label>
                    <select name="change_type" class="form-select @error('change_type') is-invalid @enderror" required>
                        <option value="in" {{ old('change_type', $stockLog->change_type) == 'in' ? 'selected' : '' }}>IN
                            (Masuk)</option>
                        <option value="out" {{ old('change_type', $stockLog->change_type) == 'out' ? 'selected' : '' }}>
                            OUT (Keluar)</option>
                    </select>
                    @error('change_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Quantity -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $stockLog->quantity) }}"
                        class="form-control @error('quantity') is-invalid @enderror" placeholder="Masukkan Jumlah" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan</label>
                    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Masukkan Keterangan">{{ old('description', $stockLog->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('stocklogs.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                </form>

            </div>
        </div>

    </div>
    </div>
@endsection
