{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Products')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div>
                <h3 class="text-center my-4">DATA PRODUK</h3>
                <p class="text-center text-muted">Isi Tabel Produk</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">

                    {{-- Hanya admin yang bisa tambah produk --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">+ Tambah Produk</a>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <thead style="background-color:lightblue">
                                <tr>
                                    <th>ID</th>
                                    <th>KATEGORI</th>
                                    <th>NAMA PRODUK</th>
                                    <th>STOK</th>
                                    <th>SATUAN</th>
                                    <th>HARGA BELI</th>
                                    <th>HARGA JUAL</th>
                                    <th style="width: 25%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if($product->category)
                                                {{ $product->category->name }}
                                            @else
                                                <span class="text-muted">{{ $product->id_category }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name_product }}</td>
                                        <td>{{ $product->stok }}</td>
                                        <td>{{ $product->unit_items }}</td>
                                        <td>{{ "Rp " . number_format($product->purchase_price, 2, ',', '.') }}</td>
                                        <td>{{ "Rp " . number_format($product->selling_price, 2, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                {{-- Tombol Show selalu tampil --}}
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">LIHAT</a>

                                                {{-- Tombol Edit & Hapus hanya untuk admin --}}
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    <form onsubmit="return confirm('Yakin ingin hapus?');" 
                                                          action="{{ route('products.destroy', $product->id) }}" 
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-danger">Data produk belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($products->hasPages())
                        <div class="mt-3 d-flex justify-content-end">
                            {{ $products->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endpush
