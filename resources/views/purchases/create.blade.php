@extends('layouts.app')

@section('title', 'Add New Pembelian')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3 class="mb-4">Tambah Pembelian Baru</h3>
                    <hr>

                    <form action="{{ route('purchases.store') }}" method="POST">
                        @csrf

                        {{-- Supplier --}}
                        <div class="form-group mb-3">
                            <label for="supplier_id" class="form-label fw-bold">Supplier</label>
                            <select name="supplier_id" id="supplier_id"
                                class="form-select @error('supplier_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name_suppliers }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User --}}
                        <div class="form-group mb-3">
                            <label for="user_id" class="form-label fw-bold">User</label>
                            <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Purchase Date --}}
                        <div class="form-group mb-3">
                            <label for="purchase_date" class="form-label fw-bold">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" id="purchase_date"
                                class="form-control @error('purchase_date') is-invalid @enderror"
                                value="{{ old('purchase_date') }}" required>
                            @error('purchase_date')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Total Amount --}}
                        <div class="form-group mb-3">
                            <label for="total_amount" class="form-label fw-bold">Total Amount</label>
                            <input type="number" name="total_amount" id="total_amount"
                                class="form-control @error('total_amount') is-invalid @enderror"
                                placeholder="Masukkan Total Pembelian" value="{{ old('total_amount') }}" min="0"
                                required>
                            @error('total_amount')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('purchases.index') }}" class="btn btn-secondary me-2">Kembali</a>
                            <button type="reset" class="btn btn-warning me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk set datetime-local default ke waktu sekarang --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let inputDate = document.getElementById("purchase_date");
            if (inputDate && !inputDate.value) {
                let now = new Date();
                now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                inputDate.value = now.toISOString().slice(0, 16);
            }
        });
    </script>
@endsection
