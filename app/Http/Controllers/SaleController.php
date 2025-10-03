<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SaleController extends Controller
{
    /**
     * index
     */
    public function index(): View
    {
        $sales = Sale::with(['product', 'user'])->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    /**
     * create
     */
    public function create(): View
    {
        $users = User::all();
        $products = Product::select('id', 'name_product')->get(); // ✅ pakai name_product
        return view('sales.create', compact('products', 'users'));
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'product_id'     => 'required|exists:products,id', // ✅ ubah jadi product_id
            'sale_date'      => 'required|date',
            'total_amount'   => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,qris',
        ]);

        Sale::create([
            'user_id'        => $request->user_id,
            'product_id'     => $request->product_id, // ✅ konsisten
            'sale_date'      => $request->sale_date,
            'total_amount'   => $request->total_amount,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('sales.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     */
    public function show(string $id): View
    {
        $sale = Sale::with(['product', 'user'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    /**
     * edit
     */
    public function edit(string $id): View
    {
        $sale = Sale::findOrFail($id);
        $users = User::all();
        $products = Product::select('id', 'name_product')->get();
        return view('sales.edit', compact('sale', 'users', 'products'));
    }

    /**
     * update
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'product_id'     => 'required|exists:products,id',
            'sale_date'      => 'required|date',
            'total_amount'   => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,qris',
        ]);

        $sale = Sale::findOrFail($id);

        $sale->update([
            'user_id'        => $request->user_id,
            'product_id'     => $request->product_id,
            'sale_date'      => $request->sale_date,
            'total_amount'   => $request->total_amount,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('sales.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     */
    public function destroy(string $id): RedirectResponse
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return redirect()->route('sales.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
