@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-md-12">

                <!-- Header -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-gradient">🏢 Data Supplier</h2>
                    <p class="text-muted">Kelola seluruh data pemasok dengan mudah</p>
                </div>

                <!-- Card Container -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header py-3" style="background: linear-gradient(135deg, #15ff00ff, #00ff88ff);">
                        <div class="d-flex justify-content-between align-items-center flex-wrap text-white">
                            <h5 class="fw-semibold mb-2">Daftar Supplier</h5>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('suppliers.create') }}"
                                    class="btn btn-light fw-semibold rounded-pill px-4 py-2 shadow-sm"
                                    style="transition: 0.3s;">
                                    + Tambah Supplier
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4 bg-light">
                        <!-- Tabel -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center table-bordered"
                                style="font-size: 15px;">
                                <thead style="background-color: #f1f5f9;">
                                    <tr class="text-uppercase text-muted" style="font-size: 0.9rem;">
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-center align-middle">Nama</th>
                                        <th class="text-center align-middle">Kontak</th>
                                        <th class="text-center align-middle">Alamat</th>
                                        <th class="text-center align-middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($suppliers as $index => $supplier)
                                        <tr>
                                            <td class="align-middle">{{ $index + 1 }}</td>
                                            <td class="fw-semibold text-dark align-middle">{{ $supplier->name_suppliers }}
                                            </td>
                                            <td class="align-middle">{{ $supplier->contact }}</td>
                                            <td class="align-middle">{{ $supplier->address ?? '-' }}</td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                                    <a href="{{ route('suppliers.show', $supplier->id) }}"
                                                        class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1">Lihat</a>
                                                    <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                        class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">Edit</a>
                                                    <form
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');"
                                                        action="{{ route('suppliers.destroy', $supplier->id) }}"
                                                        method="POST" class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger fw-semibold py-4">
                                                Belum ada data supplier tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($suppliers->hasPages())
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $suppliers->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STYLE TAMBAHAN -->
    <style>
        .text-gradient {
            background: linear-gradient(135deg, #00ff37ff, #00ff4cff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Animasi dan bayangan kartu */
        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Hover efek baris tabel */
        .table-hover tbody tr:hover {
            background-color: #eef7ff !important;
        }

        /* Semua teks & isi tabel rata tengah */
        th,
        td {
            text-align: center !important;
            vertical-align: middle !important;
        }

        /* Tombol efek hover */
        .btn-light:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
        }

        /* Responsif tampilan di HP */
        @media (max-width: 576px) {
            .btn {
                font-size: 0.8rem !important;
            }

            .table {
                font-size: 14px !important;
            }

            .card-body {
                padding: 1rem !important;
            }

            .btn-light {
                font-size: 14px;
                padding: 6px 12px !important;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endpush
