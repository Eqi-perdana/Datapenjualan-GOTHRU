@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <h4 class="mb-4 text-center">Edit Supplier</h4>

                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Supplier -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">NAMA SUPPLIER</label>
                        <input type="text" 
                               class="form-control @error('name_suppliers') is-invalid @enderror" 
                               name="name_suppliers" 
                               value="{{ old('name_suppliers', $supplier->name_suppliers) }}" 
                               placeholder="Masukkan Nama Supplier" />
                        @error('name_suppliers')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">KONTAK</label>
                        <input type="text" 
                               class="form-control @error('contact') is-invalid @enderror" 
                               name="contact" 
                               value="{{ old('contact', $supplier->contact) }}" 
                               placeholder="Masukkan Kontak Supplier (opsional)" />
                        @error('contact')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">ALAMAT</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  name="address" rows="5" 
                                  placeholder="Masukkan Alamat Supplier (opsional)">{{ old('address', $supplier->address) }}</textarea>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-warning">RESET</button>
                        </div>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>

                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
