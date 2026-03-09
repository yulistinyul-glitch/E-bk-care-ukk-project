<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $unggulan = \App\Models\Article::where('is_featured', true)->latest()->first();
        $sidebar = \App\Models\Article::where('id', '!=', $unggulan->id ?? 0)
                                    ->latest()->take(3)->get();
        $semua_artikel = \App\Models\Article::latest()->get();
        return view('blog', compact('unggulan', 'sidebar', 'semua_artikel'));
    }
}
