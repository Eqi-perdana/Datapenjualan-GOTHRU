@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="text-center mb-4">
                <h3>Data Penjualan</h3>
                <p class="text-muted">Riwayat transaksi penjualan barang</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('sales.create') }}" class="btn btn-success btn-sm mb-3">
                        Tambahkan
                    </a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead style="background-color:goldenrod; color:white;">
                                <tr>
                                    <th>PENGGUNA</th>
                                    <th>PRODUK</th>
                                    <th>TANGGAL PENJUALAN</th>
                                    <th>JUMLAH TOTAL</th>
                                    <th>METODE PEMBAYARAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->user->name ?? '-' }}</td>
                                        <td>{{ $sale->product->name_product ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                                        <td>{{ 'Rp ' . number_format($sale->total_amount, 2, ',', '.') }}</td>
                                        <td>{{ ucfirst($sale->payment_method) }}</td>
                                        <td>
                                            <form action="{{ route('sales.destroy', $sale->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                                <a href="{{ route('sales.show', $sale->id) }}" 
                                                   class="btn btn-sm btn-secondary">Lihat</a>
                                                <a href="{{ route('sales.edit', $sale->id) }}" 
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
                                            Belum ada data penjualan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($sales->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $sales->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
