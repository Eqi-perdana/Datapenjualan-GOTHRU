@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-center w-100">DATA PENJUALAN</h4>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('sales.create') }}" class="btn btn-success">TAMBAHKAN</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="bg-warning text-dark">
                        <tr>
                            <th>PENGGUNA</th>
                            <th>PRODUCT</th>
                            <th>TANGGAL PENJUALAN</th>
                            <th>JUMLAH TOTAL</th>
                            <th>METODE PEMBAYARAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->user->name ?? 'Unknown' }}</td>
                            <td>{{ $sale->product->name_product ?? 'Unknown' }}</td>
                            <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                            <td>Rp {{ number_format($sale->total_amount, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($sale->payment_method) }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-dark btn-sm">LIHAT</a>
                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-primary btn-sm">EDIT</a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data sales</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($sales->hasPages())
        <div class="card-footer d-flex justify-content-center">
            {{ $sales->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
