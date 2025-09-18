@extends('layouts.app')

@section('title', 'Histori Harga Produk')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <div class="text-center mb-4">
                <h3>Histori Harga Produk</h3>
                <p class="text-muted">Riwayat perubahan harga produk</p>
                <hr>
            </div>

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('product_price_history.create') }}" class="btn btn-success btn-sm mb-3">
                        Tambah Histori Harga
                    </a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="text-center" style="background-color:teal; color:white;">
                                <tr>
                                    <th>ID</th>
                                    <th>PRODUK</th>
                                    <th>JENIS HARGA</th>
                                    <th>HARGA</th>
                                    <th>DIUBAH OLEH</th>
                                    <th>ALASAN PERUBAHAN</th>
                                    <th>TANGGAL DIUBAH</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}</td>
                                        <td>{{ $history->product?->name_product ?? '-' }}</td>
                                        <td>{{ ucfirst($history->price_type) }}</td>
                                        <td>{{ 'Rp ' . number_format($history->price, 2, ',', '.') }}</td>
                                        <td>{{ $history->changedBy?->name ?? '-' }}</td>
                                        <td>{{ $history->change_reason }}</td>
                                        <td>{{ $history->changed_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');"
                                                action="{{ route('product_price_history.destroy', $history->id) }}"
                                                method="POST" class="d-inline">
                                                <a href="{{ route('product_price_history.show', $history->id) }}"
                                                    class="btn btn-sm btn-secondary">Lihat</a>
                                                <a href="{{ route('product_price_history.edit', $history->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-danger">
                                            Belum ada data histori harga.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
