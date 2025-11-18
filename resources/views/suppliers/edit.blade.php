@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<style>
    /* Modern UI Style */
    .modern-card {
        border-radius: 18px;
        border: none;
        padding: 25px;
        backdrop-filter: blur(8px);
        background: #ffffffdb;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .modern-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
    .modern-label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        color: #444;
    }
    .modern-input {
        border-radius: 10px;
        border: 1px solid #ddd;
        transition: 0.2s;
    }
    .modern-input:focus {
        border-color: #4b7bec;
        box-shadow: 0 0 8px rgba(75, 123, 236, 0.3);
    }
    .btn-modern-primary {
        background: #4b7bec;
        border: none;
        border-radius: 25px;
        padding: 10px 25px;
    }
    .btn-modern-warning {
        border-radius: 25px;
        padding: 10px 25px;
    }
    .btn-modern-secondary {
        border-radius: 25px;
        padding: 10px 25px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="modern-card">

            <h3 class="text-center mb-4" style="font-weight:700;">
                ✏️ Edit Supplier
            </h3>

            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Supplier --}}
                <div class="mb-4">
                    <label class="modern-label">Nama Supplier</label>
                    <input type="text" 
                           class="form-control modern-input @error('name_suppliers') is-invalid @enderror" 
                           name="name_suppliers" 
                           value="{{ old('name_suppliers', $supplier->name_suppliers) }}" 
                           placeholder="Masukkan nama supplier">

                    @error('name_suppliers')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Kontak --}}
                <div class="mb-4">
                    <label class="modern-label">Kontak Supplier</label>
                    <input type="text" 
                           class="form-control modern-input @error('contact') is-invalid @enderror" 
                           name="contact" 
                           value="{{ old('contact', $supplier->contact) }}" 
                           placeholder="Masukkan kontak (opsional)">
                    @error('contact')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label class="modern-label">Alamat Supplier</label>
                    <textarea class="form-control modern-input @error('address') is-invalid @enderror"
                              name="address"
                              rows="5"
                              placeholder="Masukkan alamat supplier (opsional)">{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between align-items-center mt-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-modern-primary text-white fw-bold">
                            Update
                        </button>

                        <button type="reset" class="btn btn-modern-warning btn-warning fw-bold">
                            Reset
                        </button>
                    </div>

                    <a href="{{ route('suppliers.index') }}" class="btn btn-modern-secondary btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
