<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ProductPriceHistory;

class KaryawanDashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $purchases = Purchase::all();
        $history = ProductPriceHistory::all();

        return view('karyawan.dashboard', compact(
            'categories', 'products', 'purchases', 'history'
        ));
    }
}
