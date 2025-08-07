<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Purchases - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f2f2f2">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Tutorial Laravel 12 untuk Pemula</h3>
                    <h5><a href="https://santrikoding.com" target="_blank">www.santrikoding.com</a></h5>
                    <hr>
                </div>

                <!-- Card Wrapper -->
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- Tombol Tambah Data -->
                        <a href="{{ route('purchases.create') }}" class="btn btn-success mb-3">+ ADD PURCHASE</a>

                        <!-- Tabel Data Purchase -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>SUPPLIER</th>
                                        <th>USER</th>
                                        <th>PURCHASE DATE</th>
                                        <th>TOTAL AMOUNT</th>
                                        <th style="width: 20%">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->supplier->name ?? '-' }}</td>
                                            <td>{{ $purchase->user->name ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                                            <td>{{ 'Rp ' . number_format($purchase->total_amount, 2, ',', '.') }}</td>
                                            <td>
                                                <form 
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" 
                                                    action="{{ route('purchases.destroy', $purchase->id) }}" 
                                                    method="POST"
                                                    class="d-inline"
                                                >
                                                    <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                    <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">Data Purchases belum tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-3">
                            {{ $purchases->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap dan SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flash Message (Success & Error) -->
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
                title: "GAGAL",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>
</html>
