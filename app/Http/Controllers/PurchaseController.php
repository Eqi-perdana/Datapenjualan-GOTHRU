<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    public function index(): View
    {
        $purchases = Purchase::with(['supplier', 'user'])->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create(): View
    {
        $suppliers = Supplier::orderBy('name_suppliers', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        return view('purchases.create', compact('suppliers', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'user_id'       => 'required|exists:users,id',
            'purchase_date' => 'required|date',
            'total_amount'  => 'required|numeric|min:0',
        ]);

        Purchase::create([
            'supplier_id'   => $request->supplier_id,
            'user_id'       => $request->user_id,
            'purchase_date' => $request->purchase_date,
            'total_amount'  => $request->total_amount,
        ]);

        return redirect()->route('purchases.index')->with('success', 'Data Purchase berhasil ditambahkan!');
    }
    public function show($id): View
    {
        $purchase = Purchase::with(['supplier', 'user'])->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    public function edit($id): View
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::orderBy('name_suppliers', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        return view('purchases.edit', compact('purchase', 'suppliers', 'users'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'user_id'       => 'required|exists:users,id',
            'purchase_date' => 'required|date',
            'total_amount'  => 'required|numeric',
        ]);

        // Simpan perubahan
        $purchase->update([
            'supplier_id'   => $request->supplier_id,
            'user_id'       => $request->user_id,
            // hanya simpan tanggal saja (tanpa jam)
            'purchase_date' => \Carbon\Carbon::parse($request->purchase_date)->format('Y-m-d'),
            'total_amount'  => $request->total_amount,
        ]);

        return redirect()->route('purchases.index')->with('success', 'Data berhasil diupdate!');
    }
    public function destroy(string $id): RedirectResponse
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Data Pembelian Berhasil Dihapus!');
    }
}
