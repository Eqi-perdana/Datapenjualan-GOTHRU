<?php

namespace App\Http\Controllers;

use App\Models\StockLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockLogController extends Controller
{
    /**
     * Tampilkan daftar stock log
     */
    public function index(): View
    {
        // Ambil data stock log dengan relasi product, urutkan terbaru
        $stockLogs = StockLog::with('product')->orderByDesc('created_at')->paginate(10);

        return view('stocklogs.index', compact('stockLogs'));
    }

    /**
     * Form tambah stock log
     */
    public function create(): View
    {
        // Ambil semua produk untuk dropdown
        $products = Product::all();

        return view('stocklogs.create', compact('products'));
    }

    /**
     * Simpan stock log baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id'  => 'required|exists:products,id',
            'change_type' => 'required|in:in,out',
            'quantity'    => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        StockLog::create($validated);

        return redirect()
            ->route('stocklogs.index')
            ->with('success', 'Log stok berhasil ditambahkan!');
    }

    /**
     * Detail stock log
     */
    public function show(int $id): View
    {
        $stockLog = StockLog::with('product')->findOrFail($id);

        return view('stocklogs.show', compact('stockLog'));
    }

    /**
     * Form edit stock log
     */
    public function edit(int $id): View
    {
        $stockLog = StockLog::findOrFail($id);
        $products = Product::all();

        return view('stocklogs.edit', compact('stockLog', 'products'));
    }

    /**
     * Update stock log
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'product_id'  => 'required|exists:products,id',
            'change_type' => 'required|in:in,out',
            'quantity'    => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $stockLog = StockLog::findOrFail($id);
        $stockLog->update($validated);

        return redirect()
            ->route('stocklogs.index')
            ->with('success', 'Log stok berhasil diubah!');
    }

    /**
     * Hapus stock log
     */
    public function destroy(int $id): RedirectResponse
    {
        $stockLog = StockLog::findOrFail($id);
        $stockLog->delete();

        return redirect()
            ->route('stocklogs.index')
            ->with('success', 'Log stok berhasil dihapus!');
    }
}
