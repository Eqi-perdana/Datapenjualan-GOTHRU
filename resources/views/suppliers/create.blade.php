{{-- resources/views/suppliers/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Supplier Baru')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h4 class="mb-4 text-center">Tambah Supplier Baru</h4>

                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf

                        {{-- NAMA SUPPLIER --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">NAMA SUPPLIER</label>
                            <input type="text" 
                                class="form-control @error('name_suppliers') is-invalid @enderror" 
                                name="name_suppliers" 
                                value="{{ old('name_suppliers') }}" 
                                placeholder="Masukkan Nama Supplier">
                            
                            @error('name_suppliers')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- KONTAK --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">KONTAK</label>
                            <input type="text" 
                                class="form-control @error('contact') is-invalid @enderror" 
                                name="contact" 
                                value="{{ old('contact') }}" 
                                placeholder="Masukkan Kontak Supplier">
                            
                            @error('contact')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ALAMAT --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">ALAMAT</label>
                            <textarea 
                                class="form-control @error('address') is-invalid @enderror" 
                                name="address" rows="4" 
                                placeholder="Masukkan Alamat Supplier">{{ old('address') }}</textarea>
                            
                            @error('address')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                <button type="reset" class="btn btn-warning">RESET</button>
                            </div>
                            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">KEMBALI</a>
                        </div>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
