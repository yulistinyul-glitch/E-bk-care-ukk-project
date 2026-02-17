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
        $kelas = Kelas::findOrFail($id);

        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'id_kelas' => 'required|unique:kelas,id_kelas,' . $id,
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

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return back()->with('success', 'Data kelas berhasil dihapus');
    }
}

   