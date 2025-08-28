<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductPriceHistory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductPriceHistoryController extends Controller
{
    /**
     * Tampilkan daftar histori harga
     */
    public function index()
    {
        $histories = ProductPriceHistory::with(['product', 'changedBy'])->paginate(10);
        return view('product_price_history.index', compact('histories'));
    }

    /**
     * Tampilkan form tambah histori harga baru
     */
    public function create()
    {
        $products = Product::all();
        return view('product_price_history.create', compact('products'));
    }

    /**
     * Simpan histori harga baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price_type' => 'required|in:purchase,selling',
            'price' => 'required|numeric',
            'change_reason' => 'required|string',
        ]);

        ProductPriceHistory::create([
            'product_id' => $request->product_id,
            'price_type' => $request->price_type,
            'price' => $request->price,
            'change_reason' => $request->change_reason,
            'changed_by' => Auth::id(),
            'changed_at' => now(),
        ]);

        return redirect()->route('product_price_history.index')
            ->with('success', 'Histori harga berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail histori harga
     */
    public function show($id)
    {
        $history = ProductPriceHistory::with(['product', 'changedBy'])->findOrFail($id);
        return view('product_price_history.show', compact('history'));
    }

    /**
     * Tampilkan form edit histori harga
     */
    public function edit($id)
    {
        $history = ProductPriceHistory::findOrFail($id);
        $products = Product::all();
        return view('product_price_history.edit', compact('history', 'products'));
    }

    /**
     * Update histori harga
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price_type' => 'required|in:purchase,selling',
            'price' => 'required|numeric',
            'change_reason' => 'required|string',
        ]);

        $history = ProductPriceHistory::findOrFail($id);
        $history->update([
            'product_id' => $request->product_id,
            'price_type' => $request->price_type,
            'price' => $request->price,
            'change_reason' => $request->change_reason,
            'changed_by' => Auth::id(),
            'changed_at' => now(),
        ]);

        return redirect()->route('product_price_history.index')
            ->with('success', 'Histori harga berhasil diupdate.');
    }

    /**
     * Hapus histori harga
     */
    public function destroy($id)
    {
        $history = ProductPriceHistory::findOrFail($id);
        $history->delete();

        return redirect()->route('product_price_history.index')
            ->with('success', 'Histori harga berhasil dihapus.');
    }
}
