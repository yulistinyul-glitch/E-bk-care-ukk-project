<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;
    $filter_kelas = $request->id_kelas;

    // Ambil semua data kelas untuk isi dropdown
    $list_kelas = \App\Models\Kelas::all();

    $siswa = \App\Models\Siswa::with(['kelas.walikelas'])
        ->withSum('riwayatPelanggaran as total_poin', 'poin')
        ->when($search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_siswa', 'like', "%$search%")
                  ->orWhere('NIPD', 'like', "%$search%");
            });
        })
        ->when($filter_kelas, function($query, $filter_kelas) {
            $query->where('id_kelas', $filter_kelas);
        })
        ->paginate(15);

    return view('gurubk.siswa.index', compact('siswa', 'list_kelas'));
}
    public function show($id)
    {
        $siswa = Siswa::with('kelas.walikelas')->findOrFail($id);
        return view('gurubk.siswa.show', compact('siswa'));
    }

public function cetakSemua()
{
    $kelasList = \App\Models\Kelas::with(['siswa', 'walikelas'])->get();

    return view('gurubk.siswa.cetak', compact('kelasList'));
}

}