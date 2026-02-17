<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('kelas.walikelas')->paginate(10);
        return view('gurubk.siswa.index', compact('siswa'));
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