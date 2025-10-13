@extends('layouts.app')

@section('title', 'Tambah Kategori Barang')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
            
            <!-- Kartu Utama -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-center text-white py-4" 
                     style="background: linear-gradient(135deg, #00c853, #00e676);">
                    <h4 class="mb-0 fw-bold">🗂️ Tambah Kategori Barang</h4>
                    <small class="text-white-50">Isi detail kategori dengan lengkap dan jelas</small>
                </div>

                <div class="card-body bg-light p-4">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <!-- Nama Kategori -->
                        <div class="mb-3">
                            <label class="fw-semibold text-dark mb-2">Nama Kategori</label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" 
                                   placeholder="Contoh: Elektronik, Peralatan Kantor, dll">
                            @error('name')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="fw-semibold text-dark mb-2">Deskripsi</label>
                            <textarea name="description" 
                                      class="form-control form-control-lg rounded-3 @error('description') is-invalid @enderror"
                                      rows="4" 
                                      placeholder="Tuliskan deskripsi singkat kategori...">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <a href="{{ route('categories.index') }}" 
                               class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                ⬅ Kembali
                            </a>

                            <div class="d-flex gap-2">
                                <button type="reset" 
                                        class="btn btn-outline-warning rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                    🔄 Reset
                                </button>
                                <button type="submit" 
                                        class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                    💾 Simpan
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>

        </div>
    </div>
</div>

<!-- STYLE TAMBAHAN -->
<style>
body {
    background-color: #f8fafc !important;
}

/* Efek hover untuk tombol */
.btn:hover {
    transform: scale(1.05);
    transition: all 0.2s ease-in-out;
}

/* Bayangan lembut pada input */
.form-control {
    border: 1px solid #dee2e6;
    transition: all 0.2s ease-in-out;
    box-shadow: none;
}
.form-control:focus {
    border-color: #00c853;
    box-shadow: 0 0 5px rgba(0, 200, 83, 0.4);
}

/* Efek hover kartu */
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-4px);
}

/* Responsif */
@media (max-width: 576px) {
    .btn {
        font-size: 0.85rem !important;
        padding: 8px 14px !important;
    }
    .form-control {
        font-size: 0.9rem !important;
    }
}
</style>
@endsection
    