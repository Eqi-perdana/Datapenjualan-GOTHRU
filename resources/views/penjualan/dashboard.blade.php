@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3>Selamat Datang, {{ auth()->user()->name }}</h3>
        <p>Role: <strong>{{ auth()->user()->role }}</strong></p>
    </div>
</div>

{{-- Card Statistik --}}
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card mb-3 text-white" style="background-color:coral;">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <p class="mb-0"><strong>{{ $categories }} Data</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3 text-white" style="background-color:lightgreen;">
            <div class="card-body">
                <h5 class="card-title">Suppliers</h5>
                <p class="mb-0"><strong>{{ $suppliers }} Data</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3 text-white" style="background-color:lightblue;">
            <div class="card-body">
                <h5 class="card-title">Products</h5>
                <p class="mb-0"><strong>{{ $products }} Data</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3 text-white" style="background-color:grey;">
            <div class="card-body">
                <h5 class="card-title">Purchases</h5>
                <p class="mb-0"><strong>{{ $purchases }} Data</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-3">
        <div class="card mb-3 text-white" style="background-color:gold;">
            <div class="card-body">
                <h5 class="card-title">Sales</h5>
                <p class="mb-0"><strong>{{ $sales }} Data</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3 text-white" style="background-color:teal;">
            <div class="card-body">
                <h5 class="card-title">Product History</h5>
                <p class="mb-0"><strong>{{ $histories }} Data</strong></p>
            </div>
        </div>
    </div>
</div>

{{-- Diagram Statistik --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-center">Statistik Data</h5>
                <canvas id="dashboardChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Categories', 'Suppliers', 'Products', 'Purchases', 'Sales', 'Histories'],
            datasets: [{
                label: 'Jumlah Data',
                data: [
                    {{ $categories }},
                    {{ $suppliers }},
                    {{ $products }},
                    {{ $purchases }},
                    {{ $sales }},
                    {{ $histories }}
                ],
                backgroundColor: [
                    'coral',
                    'lightgreen',
                    'lightblue',
                    'grey',
                    'gold',
                    'teal'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
