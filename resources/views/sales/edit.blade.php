{{-- resources/views/sales/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Sales')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">SALE DATE</label>
                            <input type="date" 
                                   class="form-control @error('sale_date') is-invalid @enderror" 
                                   name="sale_date" 
                                   value="{{ old('sale_date', $sale->sale_date) }}">
                            @error('sale_date')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TOTAL AMOUNT</label>
                            <input type="number" step="0.01" 
                                   class="form-control @error('total_amount') is-invalid @enderror" 
                                   name="total_amount" 
                                   value="{{ old('total_amount', $sale->total_amount) }}" 
                                   placeholder="Masukkan Total Penjualan">
                            @error('total_amount')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">PAYMENT METHOD</label>
                            <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method">
                                <option value="cash" {{ old('payment_method', $sale->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ old('payment_method', $sale->payment_method) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                <option value="qris" {{ old('payment_method', $sale->payment_method) == 'qris' ? 'selected' : '' }}>QRIS</option>
                            </select>
                            @error('payment_method')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">USER</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $sale->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary me-2">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning me-2">RESET</button>
                        <a href="{{ route('sales.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
