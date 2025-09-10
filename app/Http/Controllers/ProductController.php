<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_category' => 'required|exists:categories,id',
            'name_product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'unit_items' => 'required|string|max:20',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        // Simpan produk baru (ID akan otomatis ikut AUTO_INCREMENT)
        Product::create($request->all());

        // Urutkan ulang ID agar rapi setelah insert
        $products = Product::orderBy('id')->get();
        $newId = 1;

        foreach ($products as $prod) {
            DB::table('products')->where('id', $prod->id)->update(['id' => $newId]);
            $newId++;
        }

        // Reset AUTO_INCREMENT
        $maxId = DB::table('products')->max('id') ?? 0;
        DB::statement("ALTER TABLE products AUTO_INCREMENT = " . ($maxId + 1));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'id_category' => 'required|exists:categories,id',
            'name_product' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'unit_items' => 'required|string|max:20',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        // Hapus produk
        $product->delete();

        // Urutkan ulang ID agar rapi
        $products = Product::orderBy('id')->get();
        $newId = 1;

        foreach ($products as $prod) {
            DB::table('products')->where('id', $prod->id)->update(['id' => $newId]);
            $newId++;
        }

        // Reset AUTO_INCREMENT
        $maxId = DB::table('products')->max('id') ?? 0;
        DB::statement("ALTER TABLE products AUTO_INCREMENT = " . ($maxId + 1));

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
