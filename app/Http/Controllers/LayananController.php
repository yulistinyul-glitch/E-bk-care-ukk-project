<?php

namespace App\Http\Controllers;

use App\Models\Service; // Menggunakan Model Service (Bahasa Inggris)
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Menampilkan halaman utama layanan
     */
    public function index()
    {
        // Mengambil semua data layanan
        $semua_layanan = Service::all();

        // Mengirim data ke resources/views/layanan.blade.php
        return view('layanan', compact('semua_layanan'));
    }

    /**
     * Menampilkan detail layanan berdasarkan slug
     */
    public function show($slug)
    {
        // Mencari layanan berdasarkan slug
        $layanan = Service::where('slug', $slug)->firstOrFail();

        return view('layanan_detail', compact('layanan'));
    }
}