<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $purchases = Purchase::with(['supplier', 'user'])->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $suppliers = Supplier::all();
        $users = User::all();
        return view('purchases.create', compact('suppliers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'user_id'       => 'required|exists:users,id',
            'purchase_date' => 'required|date',
            'total_amount'  => 'required|numeric',
        ]);

        Purchase::create([
            'supplier_id'   => $request->supplier_id,
            'user_id'       => $request->user_id,
            'purchase_date' => $request->purchase_date,
            'total_amount'  => $request->total_amount,
        ]);

        return redirect()->route('purchases.index')->with(['success' => 'Data Pembelian Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $purchase = Purchase::with(['supplier', 'user'])->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::all();
        $users = User::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'user_id'       => 'required|exists:users,id',
            'purchase_date' => 'required|date',
            'total_amount'  => 'required|numeric',
        ]);

        $purchase = Purchase::findOrFail($id);

        $purchase->update([
            'supplier_id'   => $request->supplier_id,
            'user_id'       => $request->user_id,
            'purchase_date' => $request->purchase_date,
            'total_amount'  => $request->total_amount,
        ]);

        return redirect()->route('purchases.index')->with(['success' => 'Data Pembelian Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()->route('purchases.index')->with(['success' => 'Data Pembelian Berhasil Dihapus!']);
    }
}
