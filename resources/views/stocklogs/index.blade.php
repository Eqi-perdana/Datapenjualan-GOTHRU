@extends('layouts.app')

@section('title', 'Data Stock Logs')

@section('content')
<div class="row">
    <div class="col-md-12">

        <h3 class="text-center my-4">Keluar Masuk Barang</h3>
        <hr>

        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">

                <a href="{{ route('stocklogs.create') }}" class="btn btn-success mb-3">TAMBAHKAN</a>

                <table class="table table-bordered">
                    <thead style="background-color:plum" class="text-center">
                        <tr>
                            <th scope="col">PRODUCT</th>
                            <th scope="col">JENIS TYPE</th>
                            <th scope="col">JUMLAH</th>
                            <th scope="col">DESKRIPSI</th>
                            <th scope="col">DIBUAT</th>
                            <th scope="col" style="width: 20%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockLogs as $stockLog)
                            <tr class="text-center">
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
                                        <a href="{{ route('stocklogs.show', $stockLog->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                        <a href="{{ route('stocklogs.edit', $stockLog->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
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

                <div class="mt-3">
                    {{ $stockLogs->links() }}
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
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
@endsection
