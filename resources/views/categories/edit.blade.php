@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kategori -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">NAME</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name', $category->name) }}" 
                               placeholder="Masukkan Nama Kategori">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">DESCRIPTION</label>
                        <textarea id="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  name="description" 
                                  rows="5" 
                                  placeholder="Masukkan Deskripsi Kategori">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-start gap-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-md btn-secondary">
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
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        removePlugins: 'elementspath',
        resize_enabled: false
    });
</script>
@endpush
