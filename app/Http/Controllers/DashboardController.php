<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\ProductPriceHistory;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data masing-masing tabel
        $categories = Category::count();
        $suppliers  = Supplier::count();
        $products   = Product::count();
        $purchases  = Purchase::count();
        $sales      = Sale::count();
        $histories  = ProductPriceHistory::count();

        // === Waktu untuk filter ===
        $today        = Carbon::today();
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        // === Rekap Harian, Mingguan, Bulanan ===
        $rekap = [
            'daily' => [
                'purchases' => Purchase::whereDate('created_at', $today)->count(),
                'sales'     => Sale::whereDate('created_at', $today)->count(),
                'histories' => ProductPriceHistory::whereDate('created_at', $today)->count(),
            ],
            'weekly' => [
                'purchases' => Purchase::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'sales'     => Sale::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
                'histories' => ProductPriceHistory::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count(),
            ],
            'monthly' => [
                'purchases' => Purchase::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
                'sales'     => Sale::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
                'histories' => ProductPriceHistory::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            ],
        ];

        // Kirim ke view
        return view('penjualan.dashboard', compact(
            'categories',
            'suppliers',
            'products',
            'purchases',
            'sales',
            'histories',
            'rekap'
        ));
    }
}
