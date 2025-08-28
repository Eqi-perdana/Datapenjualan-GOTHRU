@extends('layouts.app')

@section('title', 'Data Sales - SantriKoding.com')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">DATA SALES</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('sales.create') }}" class="btn btn-md btn-success mb-3">TAMBAHKAN</a>
                    <table class="table table-bordered text-center">
                        <thead  style="background-color:gold">
                            <tr>
                                <th scope="col">PENGGUNA</th>
                                <th scope="col">TANGGAL PENJUALAN</th>
                                <th scope="col">JUMLAH TOTAL</th>
                                <th scope="col">METODE PEMBAYARAN</th>
                                <th scope="col" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td>{{ $sale->user->name ?? 'Unknown' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d-m-Y') }}</td>
                                    <td>{{ 'Rp ' . number_format($sale->total_amount, 2, ',', '.') }}</td>
                                    <td>{{ ucfirst($sale->payment_method) }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">Data Sales belum ada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
