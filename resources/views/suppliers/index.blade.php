<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data Suppliers</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('suppliers.create') }}" class="btn btn-md btn-success mb-3">Tambahkan</a>
                        <table class="table table-bordered table-hover table-striped align-middle text-start">
                            <thead class="text-center">
                                <tr>
                                    <th>Nama</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->name_suppliers }}</td>
                                        <td>{{ $supplier->contact }}</td>
                                        <td class="text-center">
                                            <span class="secondary">{{ $supplier->address }}</span>
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                                <a href="{{ route('suppliers.show', $supplier->id) }}"
                                                    class="btn btn-sm btn-dark me-1">
                                                    <i class="bi bi-eye"></i> LIHAT
                                                </a>
                                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                    class="btn btn-sm btn-primary me-1">
                                                    <i class="bi bi-pencil"></i> EDIT
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> HAPUS
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">
                                            Data Suppliers belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
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
