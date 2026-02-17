<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\RiwayatPelanggaran;

class RiwayatPelanggaranController extends Controller
{
    public function create()
    {
        $kelas = Kelas::all();

        $kategori = Pelanggaran::select('kategori_pelanggaran')
                        ->distinct()
                        ->get();

        return view('gurubk.riwayatpelanggaran.create', compact(
            'kelas',
            'kategori'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_pelanggaran' => 'required',
            'tanggal' => 'required|date'
        ]);

        $pelanggaran = Pelanggaran::findOrFail($request->id_pelanggaran);

        RiwayatPelanggaran::create([
            'id_siswa' => $request->id_siswa,
            'id_pelanggaran' => $request->id_pelanggaran,
            'poin' => $pelanggaran->poin_pelanggaran,
            'status' => $pelanggaran->tingkatan, 
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function getSiswa($id_kelas)
    {
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();
        return response()->json($siswa);
    }

    public function getJenis($kategori)
    {
        $jenis = Pelanggaran::where('kategori_pelanggaran', $kategori)->get();
        return response()->json($jenis);
    }

    public function getDetail($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        return response()->json($pelanggaran);
    }
}
