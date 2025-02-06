<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan daftar semua postingan
    public function index()
    {
        $posts = Post::all(); // Mengambil semua data postingan
        return view('posts.index', compact('posts')); // Mengirim data ke view
    }

    // Menampilkan formulir untuk membuat postingan baru
    public function create()
    {
        return view('posts.create'); // Mengembalikan view untuk membuat postingan
    }

    // Menyimpan postingan baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Membuat instance baru dari model Post
        $post = new Post();
        $post->title = $request->title; // Mengisi judul
        $post->body = $request->body; // Mengisi konten

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public'); // Menyimpan gambar ke storage
        }

        $post->save(); // Menyimpan postingan ke database
        return redirect()->route('posts.index')->with('success', 'Post created successfully.'); // Redirect dengan pesan sukses
    }

    // Menampilkan formulir untuk mengedit postingan yang ada
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post')); // Mengembalikan view untuk mengedit postingan
    }

    // Memperbarui postingan yang ada di database
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengupdate data postingan
        $post->title = $request->title; // Mengupdate judul
        $post->body = $request->body; // Mengupdate konten

        // Menyimpan gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image); // Menghapus gambar lama dari storage
            }
            $post->image = $request->file('image')->store('images', 'public'); // Menyimpan gambar baru
        }

        $post->save(); // Menyimpan perubahan ke database
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.'); // Redirect dengan pesan sukses
    }

    // Menghapus postingan dari database
    public function destroy(Post $post)
    {
        // Hapus gambar jika ada
        if ($post->image) {
            Storage::disk('public')->delete($post->image); // Menghapus gambar dari storage
        }
        $post->delete(); // Menghapus postingan dari database
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.'); // Redirect dengan pesan sukses
    }
}