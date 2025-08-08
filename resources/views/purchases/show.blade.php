<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Purchase - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="mb-3">Detail Pembelian</h3>
                        <hr/>
                        <div class="mb-3">
                            <strong>Supplier:</strong>
                            <p>{{ $purchase->supplier->name ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Pengguna (User):</strong>
                            <p>{{ $purchase->user->name ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Tanggal Pembelian:</strong>
                            <p>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Total Pembelian:</strong>
                            <p>{{ 'Rp ' . number_format($purchase->total_amount, 2, ',', '.') }}</p>
                        </div>
                        <hr>
                        <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-secondary">Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>