{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Data Products')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="text-center mb-4"">
                <h3>Daftar Produk</h3>
                <p class="text-muted">Isi Tabel Product</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Tambah Produk</a>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center"  style="background-color:lightblue">
                                <th>ID</th>
                                <th>KATEGORI</th>
                                <th>NAMA PRODUK</th>
                                <th>STOK</th>
                                <th>SATUAN</th>
                                <th>HARGA BELI</th>
                                <th>HARGA JUAL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td>
                                        @if($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            <span class="text-muted">{{ $product->id_category }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name_product }}</td>
                                    <td class="text-center">{{ $product->stok }}</td>
                                    <td class="text-center">{{ $product->unit_items }}</td>
                                    <td>{{ "Rp " . number_format($product->purchase_price, 2, ',', '.') }}</td>
                                    <td>{{ "Rp " . number_format($product->selling_price, 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Yakin ingin hapus?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-secondary">Show</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">Data produk belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $products->links() }}
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
