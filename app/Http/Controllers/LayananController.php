<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $semua_layanan = Service::all();
        return view('layanan', compact('semua_layanan'));
    }

    public function show($slug)
    {
        $layanan = Service::where('slug', $slug)->firstOrFail();
        return view('layanan_detail', compact('layanan'));
    }
}