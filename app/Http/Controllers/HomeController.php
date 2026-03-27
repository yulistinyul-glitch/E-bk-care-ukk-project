<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article; // tambahkan ini
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = About::first(); 
        $semua_artikel = Article::latest()->take(5)->get();
        
        return view('home', compact('data', 'semua_artikel'));
    }
}