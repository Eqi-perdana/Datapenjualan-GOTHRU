@extends('layouts.app')

@section('title', 'Data Stock Logs')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="text-center mb-4">
                <h3>Keluar Masuk Barang</h3>
                <p class="text-muted">Riwayat log pergerakan stok produk</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">

                    <a href="{{ route('stocklogs.create') }}" class="btn btn-success btn-sm mb-3">+ Tambahkan</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center mb-0">
                            <thead style="background-color:plum" class="text-center">
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>JENIS TYPE</th>
                                    <th>JUMLAH</th>
                                    <th>DESKRIPSI</th>
                                    <th>DIBUAT</th>
                                    <th style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stockLogs as $stockLog)
                                    <tr>
                                        <td>{{ $stockLog->product->name_product ?? 'Unknown' }}</td>
                                        <td>
                                            @if ($stockLog->change_type === 'in')
                                                <span class="badge bg-success">IN</span>
                                            @else
                                                <span class="badge bg-danger">OUT</span>
                                            @endif
                                        </td>
                                        <td>{{ $stockLog->quantity }}</td>
                                        <td>{{ $stockLog->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($stockLog->stocklog_date)->format('d-m-Y') }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda yakin ?');" 
                                                  action="{{ route('stocklogs.destroy', $stockLog->id) }}" 
                                                  method="POST" class="d-inline">
                                                <a href="{{ route('stocklogs.show', $stockLog->id) }}" 
                                                   class="btn btn-sm btn-secondary">Lihat</a>
                                                <a href="{{ route('stocklogs.edit', $stockLog->id) }}" 
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">
                                            Data Stock Logs belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($stockLogs->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $stockLogs->links() }}
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
    // SweetAlert notifikasi
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
