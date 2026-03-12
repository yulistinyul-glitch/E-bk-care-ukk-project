<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion; 

class KotakSaranController extends Controller
{
    public function index()
    {
        // Pastikan variabel di sini sama dengan yang digunakan di View (Blade)
        // Saya sesuaikan nama variabelnya agar lebih mudah diingat
        $features = Suggestion::where('section', 'teaser')->get();
        $steps = Suggestion::where('section', 'how_it_works')->orderBy('order', 'asc')->get();

        // Mengirim data ke view
        return view('kotaksaran', compact('features', 'steps'));
    }
}