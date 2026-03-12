<?php

namespace App\Http\Controllers;

use App\Models\About; // Pastikan model About ada
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data pertama dari tabel 'abouts'
        $data = About::first(); 
        
        // Kirim ke view home
        return view('home', compact('data'));
    }
}