<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
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
        $sales = Sale::with('user')->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    /**
     * create
     */
    public function create(): View
    {
        $users = User::all();
        return view('sales.create', compact('users'));
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'sale_date'      => 'required|date',
            'total_amount'   => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,qris',
        ]);

        Sale::create($request->only('user_id', 'sale_date', 'total_amount', 'payment_method'));

        return redirect()->route('sales.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     */
    public function show(string $id): View
    {
        $sale = Sale::with('user')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    /**
     * edit
     */
    public function edit(string $id): View
    {
        $sale = Sale::findOrFail($id);
        $users = User::all();
        return view('sales.edit', compact('sale', 'users'));
    }

    /**
     * update
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'sale_date'      => 'required|date',
            'total_amount'   => 'required|numeric',
            'payment_method' => 'required|in:cash,transfer,qris',
        ]);

        $sale = Sale::findOrFail($id);

        $sale->update($request->only('user_id', 'sale_date', 'total_amount', 'payment_method'));

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