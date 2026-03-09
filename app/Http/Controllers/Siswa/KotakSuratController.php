<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KotakSurats;

class KotakSuratController extends Controller
{
    public function index()
    {
        $siswa = \App\Models\Siswa::where('id_pengguna', Auth::user()->id_pengguna)->first();

        if (!$siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $surat = \App\Models\KotakSurats::where('id_siswa', $siswa->id_siswa)
                    ->latest()
                    ->get();

        return view('siswa.kotaksurat.index', compact('surat'));

    }

    public function show($id)
    {
        $surat = KotakSurats::findOrFail($id);

        $surat->update(['is_read' => 1]);
        return view('siswa.kotaksurat.show', compact('surat'));
    }

    public function markAsRead($id)
    {
        $surat = KotakSurats::findOrFail($id);
        $surat->update(['is_read' =>true]);
        return response()->json(['success' => true]);
    }
}
