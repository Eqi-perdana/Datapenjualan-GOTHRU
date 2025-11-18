@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')

<style>
    /* ==== Modern UI Custom Style ==== */

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #2d3436;
        letter-spacing: 0.5px;
    }

    .subtitle {
        color: #636e72;
        margin-top: -5px;
        margin-bottom: 25px;
        font-size: 15px;
    }

    .modern-card {
        border: none !important;
        border-radius: 15px !important;
        padding: 25px;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.07);
        transition: 0.3s;
    }

    .modern-card:hover {
        box-shadow: 0 12px 26px rgba(0,0,0,0.12);
    }

    .form-control {
        border-radius: 10px !important;
        padding: 12px 14px;
        border: 1px solid #dfe6e9;
        transition: 0.2s;
        font-size: 15px;
    }

    .form-control:focus {
        border-color: #6c5ce7;
        box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25);
    }

    .btn-modern-primary {
        background: #6c5ce7;
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-modern-primary:hover {
        background: #5a4bd1;
    }

    .btn-modern-warning {
        background: #fdcb6e;
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-modern-warning:hover {
        background: #e2b55f;
    }

    .btn-modern-secondary {
        background: #b2bec3;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-modern-secondary:hover {
        background: #a0a9ad;
    }
</style>

<section class="content">
    <div class="container-fluid">

        <h2 class="page-title">Tambah Supplier Baru</h2>
        <p class="subtitle">Isi informasi supplier dengan jelas dan lengkap</p>

        <div class="modern-card mt-3">

            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf

                {{-- NAMA SUPPLIER --}}
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Nama Supplier</label>
                    <input type="text"
                        class="form-control @error('name_suppliers') is-invalid @enderror"
                        name="name_suppliers"
                        value="{{ old('name_suppliers') }}"
                        placeholder="Contoh: PT Sinar Abadi Makmur">

                    @error('name_suppliers')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- KONTAK --}}
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Kontak Supplier</label>
                    <input type="text"
                        class="form-control @error('contact') is-invalid @enderror"
                        name="contact"
                        value="{{ old('contact') }}"
                        placeholder="Contoh: 0812 3456 7890">

                    @error('contact')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Alamat Supplier</label>
                    <textarea 
                        class="form-control @error('address') is-invalid @enderror"
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap supplier...">{{ old('address') }}</textarea>

                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <button type="submit" class="btn btn-modern-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                        <button type="reset" class="btn btn-modern-warning text-dark ms-2">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>

                    <a href="{{ route('suppliers.index') }}" class="btn btn-modern-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</section>

@endsection
