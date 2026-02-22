<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KotakSaranController extends Controller
{
    /**
     * Menampilkan halaman Kotak Saran Publik.
     */
    public function index()
    {
        // Data dummy untuk mensimulasikan aspirasi yang masuk (Front-end Only)
$contohSaran = [
        ['isi' => 'Mohon perbaikan fasilitas bangku di ruang tunggu BK agar lebih nyaman.', 'status' => 'Dirapatkan'],
        ['isi' => 'Saran untuk mengadakan sesi bimbingan karir khusus kelas 12 setiap bulan.', 'status' => 'Diterima'],
        ['isi' => 'Mohon admin mempertimbangkan alat tes minat bakat yang lebih modern.', 'status' => 'Proses'],
        ['isi' => 'Saran pengadaan kotak curhat fisik di setiap lantai gedung sekolah.', 'status' => 'Dirapatkan'],
    ];

        // Pastikan nama file di resources/views adalah kotaksaran.blade.php
        return view('kotaksaran', compact('contohSaran'));
    }
}