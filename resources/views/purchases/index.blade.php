@extends('layouts.app')

@section('title', 'Data Pembelian')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="text-center mb-4">
                <h3>Data Pembelian</h3>
                <p class="text-muted">Riwayat transaksi pembelian barang</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('purchases.create') }}" class="btn btn-success btn-sm mb-3">
                        Tambahkan
                    </a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead style="background-color:grey; color:white;">
                                <tr>
                                    <th>PEMASOK</th>
                                    <th>PENGGUNA</th>
                                    <th>TANGGAL PEMBELIAN</th>
                                    <th>JUMLAH TOTAL</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->supplier->name_suppliers ?? '-' }}</td>
                                        <td>{{ $purchase->user->name ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                                        <td>{{ 'Rp ' . number_format($purchase->total_amount, 2, ',', '.') }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                                  action="{{ route('purchases.destroy', $purchase->id) }}" 
                                                  method="POST" class="d-inline">
                                                <a href="{{ route('purchases.show', $purchase->id) }}" 
                                                   class="btn btn-sm btn-secondary">Lihat</a>
                                                <a href="{{ route('purchases.edit', $purchase->id) }}" 
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">
                                            Data pembelian belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
