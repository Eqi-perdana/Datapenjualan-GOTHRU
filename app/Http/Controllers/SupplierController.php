<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Menampilkan daftar supplier
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function indexKaryawan()
{
    $suppliers = Supplier::all();
    return view('karyawan.pemasok.index', compact('suppliers'));
}


    // Menampilkan form untuk create supplier
    public function create()
    {
        return view('suppliers.create');
    }

    // Menyimpan data supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'name_suppliers' => 'required|string|max:255',
            'contact'        => 'nullable|string|max:255',
            'address'        => 'nullable|string',
        ]);

        Supplier::create([
            'name_suppliers' => $request->name_suppliers,
            'contact'        => $request->contact,
            'address'        => $request->address,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    // Menampilkan detail 1 supplier
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    // Menampilkan form edit supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    // Menyimpan update data supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_suppliers' => 'required|string|max:255',
            'contact'        => 'nullable|string|max:255',
            'address'        => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name_suppliers' => $request->name_suppliers,
            'contact'        => $request->contact,
            'address'        => $request->address,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    // Menghapus data supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
