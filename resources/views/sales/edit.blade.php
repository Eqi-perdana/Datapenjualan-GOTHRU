@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Penjualan</h3>

    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id">Pengguna</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $sale->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $sale->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name_product }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sale_date">Tanggal Penjualan</label>
            <input type="date" name="sale_date" class="form-control" value="{{ $sale->sale_date }}" required>
        </div>

        <div class="mb-3">
            <label for="total_amount">Jumlah Total</label>
            <input type="number" name="total_amount" class="form-control" value="{{ $sale->total_amount }}" required>
        </div>

        <div class="mb-3">
            <label for="payment_method">Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="cash" {{ $sale->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ $sale->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
                <option value="qris" {{ $sale->payment_method == 'qris' ? 'selected' : '' }}>QRIS</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
