<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminArticleController extends Controller
{

public function index()
{
    $articles = Article::latest()->get();
    return view('admin.articles.index', compact('articles'));
}
    // Gunakan validasi agar data yang masuk aman
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'content'     => 'required',
            'category'    => 'required',
            'author'      => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        // Buat data array dari hasil validasi
        $data = $validatedData;
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->has('is_featured') ? true : false;

        // Handle File Upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat!');
    }
}