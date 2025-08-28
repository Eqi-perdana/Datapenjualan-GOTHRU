<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\ProductPriceHistory;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data masing-masing tabel
        $categories = Category::count();
        $suppliers = Supplier::count();
        $products = Product::count();
        $purchases = Purchase::count();
        $sales = Sale::count();
        $histories = ProductPriceHistory::count();

        // kirim ke view
        return view('penjualan.dashboard', compact(
            'categories',
            'suppliers',
            'products',
            'purchases',
            'sales',
            'histories'
        ));
    }
}
