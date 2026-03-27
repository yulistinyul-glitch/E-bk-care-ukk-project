<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kelas = Kelas::when($search, function ($query) use ($search) {
                $query->where('id_kelas', 'like', "%{$search}%")
                      ->orWhere('jurusan', 'like', "%{$search}%")
                      ->orWhere('nomor_ruang', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(20);

        return view('admin.kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|unique:kelas,id_kelas',
            'nama_kelas' => 'required|integer',
            'jurusan' => 'required',
            'nomor_ruang' => 'required|integer',
            'id_walikelas' => 'required',
        ]);

        Kelas::create($request->all());

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Menggunakan where karena ID adalah string (KLS001)
        $kelas = Kelas::where('id_kelas', $id)->firstOrFail();

        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        // Cari berdasarkan kolom id_kelas agar tepat sasaran
        $kelas = Kelas::where('id_kelas', $id)->firstOrFail();

        $request->validate([
            'id_kelas' => 'required|unique:kelas,id_kelas,' . $id . ',id_kelas',
            'nama_kelas' => 'required|integer',
            'jurusan' => 'required',
            'nomor_ruang' => 'required|integer',
            'id_walikelas' => 'required',
        ]);

        $kelas->update($request->all());

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diupdate');
    }

public function destroy($kelas)
{
    try {
        // 1. Cari data berdasarkan id_kelas yang dikirim dari route
        // Kita gunakan where secara eksplisit agar lebih aman
        $data = \App\Models\Kelas::where('id_kelas', $kelas)->firstOrFail();

        // 2. Eksekusi Hapus Permanen
        $data->delete();

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus permanen!');
        
    } catch (\Exception $e) {
        // Jika gagal (misal karena ada data siswa yang terhubung/foreign key)
        return back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
    }
}
}