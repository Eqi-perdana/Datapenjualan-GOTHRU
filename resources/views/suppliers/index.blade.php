@extends('layouts.app')

@section('title', 'Data Suppliers')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">DATA Pemasok</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('suppliers.create') }}" class="btn btn-md btn-success mb-3">+ Tambah Supplier</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead class="table-white"  style="background-color:lightgreen">
                                <tr>
                                    <th>NAMA</th>
                                    <th>KONTAK</th>
                                    <th>ALAMAT</th>
                                    <th style="width: 25%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->name_suppliers }}</td>
                                        <td>{{ $supplier->contact }}</td>
                                        <td>{{ $supplier->address ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">Data Supplier belum ada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($suppliers->hasPages())
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $suppliers->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
