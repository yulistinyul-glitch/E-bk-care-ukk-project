<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KotakSaranController extends Controller
{
    public function index()
    {
        $contohSaran = [
            ['isi' => 'Mohon perbaikan fasilitas bangku di ruang tunggu BK agar lebih nyaman.', 'status' => 'Dirapatkan'],
            ['isi' => 'Saran untuk mengadakan sesi bimbingan karir khusus kelas 12 setiap bulan.', 'status' => 'Diterima'],
            ['isi' => 'Mohon admin mempertimbangkan alat tes minat bakat yang lebih modern.', 'status' => 'Proses'],
            ['isi' => 'Saran pengadaan kotak curhat fisik di setiap lantai gedung sekolah.', 'status' => 'Dirapatkan'],
        ];
        
        return view('kotaksaran', compact('contohSaran'));
    }
}