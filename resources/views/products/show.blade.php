@extends('layouts.app')

@section('title', 'Detail Product')

@section('content')

<style>
    .modern-card {
        border-radius: 18px !important;
        background: #ffffff;
        border: none !important;
        padding: 28px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.10);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-label {
        font-size: 14px;
        font-weight: 600;
        color: #555;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 500;
        color: #222;
        word-wrap: break-word;
    }

    .badge-category {
        background: #4b7bec;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 14px;
        color: #fff;
        display: inline-block;
    }

    .description-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px 18px;
        font-size: 15px;
        line-height: 1.6;
        color: #333;
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 22px !important;
        }
        .modern-card {
            padding: 18px !important;
        }
        .btn-back {
            width: 100%;
        }
    }

    .btn-back {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">

            <div class="modern-card">

                {{-- Judul --}}
                <h2 class="text-center mb-4" style="font-weight:700;">
                    {{ $product->name_product }}
                </h2>

                {{-- Informasi dalam grid responsif --}}
                <div class="info-grid">

                    <div>
                        <div class="info-label">Kategori</div>
                        @if($product->category)
                            <span class="badge-category">{{ $product->category->name }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </div>

                    <div>
                        <div class="info-label">Stok</div>
                        <div class="info-value">{{ $product->stok }}</div>
                    </div>

                    <div>
                        <div class="info-label">Harga Beli</div>
                        <div class="info-value">
                            Rp {{ number_format($product->purchase_price, 2, ',', '.') }}
                        </div>
                    </div>

                    <div>
                        <div class="info-label">Harga Jual</div>
                        <div class="info-value">
                            Rp {{ number_format($product->selling_price, 2, ',', '.') }}
                        </div>
                    </div>

                </div>

                <hr>

                {{-- Deskripsi --}}
                <h5 class="mt-3 mb-2" style="font-weight:600;">Deskripsi Produk</h5>
                <div class="description-box">
                    {!! $product->description !!}
                </div>

                <hr>

                {{-- Tanggal --}}
                <small class="text-muted d-block">Dibuat: {{ $product->created_at->format('d M Y • H:i') }}</small>
                <small class="text-muted d-block mb-3">Diubah: {{ $product->updated_at->format('d M Y • H:i') }}</small>

                {{-- Tombol --}}
                <div class="text-end mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-back">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
