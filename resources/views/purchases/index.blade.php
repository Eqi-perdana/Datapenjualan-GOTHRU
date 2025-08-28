@extends('layouts.app')

@section('title', 'Data Purchases - SantriKoding.com')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">DATA PURCHASES</h3>
                <hr>
            </div>
            <div class="card border-10 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('purchases.create') }}" class="btn btn-md btn-success mb-3">TAMBAHKAN </a>
                    <table class="table table-bordered text-center">
                        <thead style="background-color:grey">
                            <tr>
                                <th scope="col">PEMASOK</th>
                                <th scope="col">PENGGUNA</th>
                                <th scope="col">TANGGAL PEMBELIAN</th>
                                <th scope="col">JUMLAH TOTAL</th>
                                <th scope="col" style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->supplier->name_suppliers ?? '-' }}</td>
                                    <td>{{ $purchase->user->name ?? '-' }}</td>
                                    {{-- hanya tanggal saja --}}
                                    <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</td>
                                    <td>{{ 'Rp ' . number_format($purchase->total_amount, 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                                            <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-sm btn-dark">LIHAT</a>
                                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">Data Purchases belum ada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $purchases->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
