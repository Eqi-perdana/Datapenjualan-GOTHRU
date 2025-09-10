@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Penjualan</h3>

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id">Pengguna</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sale_date">Tanggal Penjualan</label>
            <input type="date" name="sale_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_amount">Jumlah Total</label>
            <input type="number" name="total_amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
                <option value="qris">QRIS</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
