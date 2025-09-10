@extends('layouts.app')

@section('title', 'DASHBOARD')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Selamat Datang, {{ auth()->user()->name }}</h3>
            <p>Role: <strong>{{ auth()->user()->role }}</strong></p>
        </div>
    </div>

    {{-- Data Summary --}}
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:coral;">
                <div class="card-body">
                    <h5 class="card-title">Categori</h5>
                    <p><strong>{{ $categories }} Data</strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:lightgreen;">
                <div class="card-body">
                    <h5 class="card-title">Pemasok</h5>
                    <p><strong>{{ $suppliers }} Data</strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:lightblue;">
                <div class="card-body">
                    <h5 class="card-title">Product</h5>
                    <p><strong>{{ $products }} Data</strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:grey;">
                <div class="card-body">
                    <h5 class="card-title">Pembelian</h5>
                    <p><strong>{{ $purchases }} Data</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:gold;">
                <div class="card-body">
                    <h5 class="card-title">Penjualan</h5>
                    <p><strong>{{ $sales }} Data</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:teal;">
                <div class="card-body">
                    <h5 class="card-title">History Harga</h5>
                    <p><strong>{{ $histories }} Data</strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background-color:plum;">
                <div class="card-body">
                    <h5 class="card-title">Stocklog</h5>
                    <p><strong>{{ $stocklogs }} Data</strong></p>
                </div>
            </div>
        </div>


        
    </div>

    {{-- Filter --}}
    <div class="row mt-4">
        <div class="col-md-5">
            <form method="GET" action="{{ route('penjualan.dashboard') }}" class="form-inline mb-3">
                <label class="mr-2">Tahun:</label>
                <select name="year" class="form-control mr-2" onchange="this.form.submit()">
                    @foreach ($years as $y)
                        <option value="{{ $y }}" {{ (int) $selectedYear === (int) $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
                
                <label class="mr-2">Bulan:</label>
                <select name="month" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="">-- Semua Bulan --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ (int) $selectedMonth === $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromDate($selectedYear, $m, 1)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

                @if ($selectedMonth)
                    <label class="mr-2">Minggu:</label>
                    <select name="week" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="">-- Semua Minggu --</option>
                        @foreach ($weeks as $w)
                            <option value="{{ $w['index'] }}"
                                {{ (int) $selectedWeek === $w['index'] ? 'selected' : '' }}>
                                {{ $w['label'] }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </form>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $chartTitle ?? 'Statistik Penjualan' }}</h5>
                    <canvas id="salesChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Ringkasan --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Data</h5>
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Periode</th>
                                <th>Jumlah Transaksi</th>
                                <th>Total Omzet (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats as $row)
                                <tr>
                                    <td>{{ $row->label }}</td>
                                    <td>{{ $row->total_transaksi }}</td>
                                    <td>Rp {{ number_format($row->total_omzet, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary font-weight-bold">
                                <td>Total</td>
                                <td>{{ $stats->sum('total_transaksi') }}</td>
                                <td>Rp {{ number_format($stats->sum('total_omzet'), 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function formatRupiah(value) {
        if (value === null || value === undefined) return 'Rp 0';
        return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    const ctx = document.getElementById('salesChart').getContext('2d');
    const labels = @json($labels);
    const omzet = @json($omzet);
    const transaksiRaw = @json($transaksi);

    // pastikan jadi angka
    const transaksi = Array.isArray(transaksiRaw) ? transaksiRaw.map(v => Number(v)) : [];
    const omzetArr = Array.isArray(omzet) ? omzet.map(v => Number(v)) : [];

    const maxTrans = transaksi.length ? Math.max(...transaksi) : 0;
    const maxOmzet = omzetArr.length ? Math.max(...omzetArr) : 0;
    const minOmzet = omzetArr.length ? Math.min(...omzetArr) : 0;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Omzet (Rp)',
                    data: omzetArr,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    yAxisID: 'y1',
                }
            ]
        },
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            scales: {
                // sumbu kiri: jumlah transaksi (integer, max = nilai nyata)
                y: {
                    beginAtZero: true,
                    max: maxTrans,         // pastikan tick atas = max transaksi
                    grace: 0,              // matikan padding otomatis
                    title: { display: true, text: 'Jumlah Transaksi' },
                    ticks: {
                        precision: 0,
                        stepSize: 1         // tick per 1 unit (1,2,3,...)
                    }
                },
                // sumbu kanan: omzet (tetap sesuai data asli)
                y1: {
                    position: 'right',
                    title: { display: true, text: 'Total Omzet (Rp)' },
                    min: minOmzet,
                    max: maxOmzet,
                    ticks: {
                        callback: function(value) { return formatRupiah(value); }
                    },
                    grid: { drawOnChartArea: false }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + formatRupiah(context.parsed.y);
                        }
                    }
                },
                legend: { display: true }
            }
        }
    });
</script>
@endsection
