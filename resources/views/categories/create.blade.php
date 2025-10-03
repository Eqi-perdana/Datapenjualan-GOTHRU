@extends('layouts.app')

@section('title', 'Add Category Barang')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <!-- Nama Kategori -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">NAMA KATEGORI</label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" 
                               placeholder="Enter Category Name">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">DESKRIPSI</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="4" 
                                  placeholder="Enter Description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-start gap-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-md btn-secondary">
                            ⬅ Kembali
                        </a>
                        <button type="submit" class="btn btn-md btn-primary">SAVE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
