<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <!-- Kategori -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">CATEGORY</label>
                                <select name="id_category" class="form-control @error('id_category') is-invalid @enderror">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Produk -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PRODUCT NAME</label>
                                <input type="text" name="name_product" class="form-control @error('name_product') is-invalid @enderror"
                                    value="{{ old('name_product') }}" placeholder="Enter Product Name">
                                @error('name_product')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESCRIPTION</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Stok -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">STOCK</label>
                                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                            value="{{ old('stok') }}" placeholder="Enter Stock Quantity">
                                        @error('stok')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Satuan -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">UNIT ITEM</label>
                                        <input type="text" name="unit_items" class="form-control @error('unit_items') is-invalid @enderror"
                                            value="{{ old('unit_items') }}" placeholder="e.g., pcs, box, kg">
                                        @error('unit_items')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Harga Beli -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">PURCHASE PRICE</label>
                                        <input type="number" step="0.01" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror"
                                            value="{{ old('purchase_price') }}" placeholder="Enter Purchase Price">
                                        @error('purchase_price')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Harga Jual -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">SELLING PRICE</label>
                                        <input type="number" step="0.01" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror"
                                            value="{{ old('selling_price') }}" placeholder="Enter Selling Price">
                                        @error('selling_price')
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
