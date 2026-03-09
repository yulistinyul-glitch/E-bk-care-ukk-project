<?php
namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        // Mengambil data asli dari database
        $unggulan = Article::where('is_featured', true)->latest()->first();
        $sidebar = Article::latest()->take(3)->get();
        $semua_artikel = Article::latest()->get();

        return view('artikel', compact('unggulan', 'sidebar', 'semua_artikel'));
    }
}