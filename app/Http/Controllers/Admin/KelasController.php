<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{

    public function index(Request $request)
    {
        $query = Kelas::query();

        if ($request->search) {
            $query->where('jurusan', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_kelas', 'like', '%' . $request->search . '%');
        }

        $kelas = $query->orderBy('id_kelas','asc')->paginate(10);

        return view('admin.kelas.index', compact('kelas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|unique:kelas,id_kelas',
            'id_walikelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
            'nomor_ruang' => 'required'
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')
            ->with('success','Data kelas berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required',
            'jurusan' => 'required',
            'nomor_ruang' => 'required'
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jurusan' => $request->jurusan,
            'nomor_ruang' => $request->nomor_ruang
        ]);

        return redirect()->route('admin.kelas.index')
            ->with('success','Data kelas berhasil diupdate');
    }


    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete(); // HAPUS PERMANEN

        return redirect()->route('admin.kelas.index')
            ->with('success','Data kelas berhasil dihapus permanen');
    }

}