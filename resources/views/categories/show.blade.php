<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Category </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="text-center mb-4">
                    <h3>Detail Kategori</h3>
                    <p class="text-muted">Menampilkan detail lengkap dari kategori</p>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                        <h4 class="mb-3">{{ $category->name }}</h4>

                        <div class="mb-3">
                            <h6 class="text-muted">Deskripsi:</h6>
                            <p>{{ $category->description ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Dibuat pada:</h6>
                            <p>
                                {{ $category->created_at ? $category->created_at->format('d M Y - H:i') : '-' }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Diperbarui terakhir:</h6>
                            <p>
                                {{ $category->updated_at ? $category->updated_at->format('d M Y - H:i') : '-' }}
                            </p>
                        </div>

                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-secondary mt-3">
                            ← Kembali ke daftar kategori
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
