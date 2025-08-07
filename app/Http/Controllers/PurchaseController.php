<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    /**
     * Menampilkan daftar data pembelian.
     */
    public function index(): View
    {
        $purchases = Purchase::with(['supplier', 'user'])
            ->latest()
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    /**
     * Menampilkan form untuk membuat data pembelian baru.
     */
    public function create(): View
    {
        $suppliers = Supplier::all();
        $users = User::all();

        return view('purchases.create', compact('suppliers', 'users'));
    }

    /**
     * Menyimpan data pembelian baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'user_id'       => 'required|exists:users,id',
            'purchase_date' => 'required|date',
            'total_amount'  => 'required|numeric|min:0',
        ]);

        Purchase::create($validated);

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Data pembelian berhasil disimpan!');
    }

    /**
     * Menampilkan detail dari data pembelian tertentu.
     */
    public function show(int $id): View
    {
        $purchase = Purchase::with(['supplier', 'user'])->findOrFail($id);

        return view('purchases.show', compact('purchase'));
    }

    /**
     * Menampilkan form untuk mengedit data pembelian.
     */
    public function edit(int $id): View
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::all();
        $users = User::all();

        return view('purchases.edit', compact('purchase', 'suppliers', 'users'));
    }

    /**
     * Memperbarui data pembelian tertentu di database.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'user_id'       => 'required|exists:users,id',
            'purchase_date' => 'required|date',
            'total_amount'  => 'required|numeric|min:0',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update($validated);

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Data pembelian berhasil diperbarui!');
    }

    /**
     * Menghapus data pembelian dari database.
     */
    public function destroy(int $id): RedirectResponse
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Data pembelian berhasil dihapus!');
    }
}
