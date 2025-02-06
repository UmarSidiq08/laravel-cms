<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Menampilkan daftar semua kategori
    public function index()
    {
        $categories = Category::all(); // Mengambil semua data kategori
        return view('categories.index', compact('categories')); // Mengirim data ke view
    }

    // Menampilkan formulir untuk membuat kategori baru
    public function create()
    {
        return view('categories.create'); // Mengembalikan view untuk membuat kategori
    }

    // Menyimpan kategori baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Membuat instance baru dari model Category
        $category = new Category();
        $category->name = $request->name; // Mengisi nama kategori
        $category->save(); // Menyimpan kategori ke database

        return redirect()->route('categories.index')->with('success', 'Category created successfully.'); // Redirect dengan pesan sukses
    }

    // Menampilkan formulir untuk mengedit kategori yang ada
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category')); // Mengembalikan view untuk mengedit kategori
    }

    // Memperbarui kategori yang ada di database
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Mengupdate data kategori
        $category->name = $request->name; // Mengupdate nama kategori
        $category->save(); // Menyimpan perubahan ke database

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.'); // Redirect dengan pesan sukses
    }

    // Menghapus kategori dari database
    public function destroy(Category $category)
    {
        $category->delete(); // Menghapus kategori dari database
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.'); // Redirect dengan pesan sukses
    }
}