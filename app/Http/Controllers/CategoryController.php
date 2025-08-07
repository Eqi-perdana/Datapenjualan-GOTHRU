<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan satu kategori (DETAIL)
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Menampilkan form edit
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Menyimpan update kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    // Menghapus kategori dan reset ulang ID agar berurutan
    public function destroy(Category $category)
    {
        // Hapus kategori
        $category->delete();

        // Ambil semua kategori yang tersisa dan urutkan ulang ID
        $categories = Category::orderBy('id')->get();
        $newId = 1;

        foreach ($categories as $cat) {
            DB::table('categories')->where('id', $cat->id)->update(['id' => $newId]);
            $newId++;
        }

        // Reset ulang AUTO_INCREMENT
        $maxId = DB::table('categories')->max('id') ?? 0;
        DB::statement("ALTER TABLE categories AUTO_INCREMENT = " . ($maxId + 1));

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus dan ID diperbarui.');
    }
}
