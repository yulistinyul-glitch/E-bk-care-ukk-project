<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $unggulan = Article::where('is_featured', true)->latest()->get();
        $semua_artikel = Article::where('is_featured', false)->latest()->get();
        return view('admin.data.artikel', compact('unggulan', 'semua_artikel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'section' => 'required|in:unggulan,biasa' // Tambahkan validasi in:unggulan,biasa
        ]);

        $isFeatured = ($request->section === 'unggulan');

        // Proteksi maksimal: Jika unggulan, cek limit
        if ($isFeatured) {
            if (Article::where('is_featured', true)->count() >= 4) {
                return back()->with('error', 'Artikel unggulan sudah penuh (maksimal 4)!');
            }
        }

        $data = $request->except(['image', 'section', '_token']);
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $isFeatured; // Wajib set explicit ke true/false
        $data['category'] = $request->category ?? 'Umum'; 
        $data['author']   = 'Admin';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);
        return back()->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image) Storage::disk('public')->delete($article->image);
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['slug'] = Str::slug($request->title);
        $article->update($data);
        
        return back()->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->image) Storage::disk('public')->delete($article->image);
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }
}