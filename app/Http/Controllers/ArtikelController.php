<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
public function index()
{
    // Ambil 4 artikel terbaru sebagai Unggulan
    $unggulanList = Article::where('is_featured', true)->latest()->take(4)->get();
    
    // Pecah: 1 untuk Hero, 3 untuk Sidebar
    $hero = $unggulanList->first(); // 1 Besar
    $sidebar = $unggulanList->skip(1); // 3 Kecil

    // Ambil semua artikel yang TIDAK unggulan untuk bagian Grid
    $semua_artikel = Article::where('is_featured', false)->latest()->get();

    return view('artikel', compact('hero', 'sidebar', 'semua_artikel'));
}
}