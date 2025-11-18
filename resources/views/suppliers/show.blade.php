@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')

<style>
    /* Modern Detail Page Style */
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #2d3436;
        letter-spacing: .5px;
    }
    .subtitle {
        color: #636e72;
        font-size: 15px;
        margin-top: -5px;
    }

    .detail-card {
        border: none !important;
        border-radius: 15px !important;
        padding: 25px;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.07);
        transition: 0.3s;
    }
    .detail-card:hover {
        box-shadow: 0 12px 26px rgba(0,0,0,0.12);
    }

    .info-row {
        padding: 12px 0;
        border-bottom: 1px solid #f1f2f6;
    }

    .info-label {
        font-weight: 700;
        color: #2d3436;
    }

    .btn-back-modern {
        background: #b2bec3;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: .2s;
    }
    .btn-back-modern:hover {
        background: #a1aab0;
    }
</style>

<section class="content">
    <div class="container-fluid">

        <h2 class="page-title">{{ $supplier->name_suppliers }}</h2>
        <p class="subtitle">Detail informasi lengkap supplier</p>

        <div class="detail-card mt-3">

            {{-- Kontak --}}
            <div class="info-row">
                <span class="info-label"><i class="fas fa-phone"></i> Kontak</span>
                <div>{{ $supplier->contact }}</div>
            </div>

            {{-- Alamat --}}
            <div class="info-row">
                <span class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</span>
                <div>{{ $supplier->address }}</div>
            </div>

            {{-- Dibuat --}}
            <div class="info-row">
                <span class="info-label"><i class="fas fa-calendar-plus"></i> Dibuat Pada</span>
                <div>{{ $supplier->created_at->format('d M Y H:i') }}</div>
            </div>

            {{-- Diperbarui --}}
            <div class="info-row" style="border-bottom: none;">
                <span class="info-label"><i class="fas fa-sync-alt"></i> Terakhir Diperbarui</span>
                <div>{{ $supplier->updated_at->format('d M Y H:i') }}</div>
            </div>

            <div class="mt-4">
                <a href="{{ route('suppliers.index') }}" class="btn btn-back-modern">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </div>

    </div>
</section>

@endsection
