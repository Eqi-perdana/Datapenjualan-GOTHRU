<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <div class="text-center mb-4">
                    <h3>Daftar Produk</h3>
                    <p class="text-muted">Tabel produk dari database</p>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Tambah Produk</a>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>GAMBAR</th>
                                    <th>JUDUL</th>
                                    <th>DESKRIPSI</th>
                                    <th>HARGA</th>
                                    <th>STOK</th>
                                    <th>DIBUAT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            @if($product->image)
                                                <img src="{{ asset('/storage/products/'.$product->image) }}" alt="image" class="rounded" width="100">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ Str::limit($product->description, 50) }}</td>
                                        <td>{{ "Rp " . number_format($product->price, 2, ',', '.') }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->created_at->format('d-m-Y') }}</td>
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
                                        <td colspan="7" class="text-center text-danger">Data produk belum tersedia.</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,--
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

</body>
</html>

