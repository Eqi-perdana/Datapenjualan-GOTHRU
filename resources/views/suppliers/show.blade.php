{{-- resources/views/suppliers/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>{{ $supplier->name_suppliers }}</h3>
                    <hr />
                    <p><strong>Kontak:</strong> {{ $supplier->contact }}</p>
                    <p><strong>Alamat:</strong></p>
                    <p>{{ $supplier->address }}</p>
                    <p><strong>Dibuat:</strong> {{ $supplier->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Diperbarui:</strong> {{ $supplier->updated_at->format('d M Y H:i') }}</p>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
