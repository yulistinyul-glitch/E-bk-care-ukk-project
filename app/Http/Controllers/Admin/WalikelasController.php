<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Walikelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WalikelasController extends Controller
{
    public function index()
    {
        $walikelas = Walikelas::with('kelas')
            ->orderBy('id_walikelas', 'asc')
            ->paginate(10);

        $kelas = Kelas::all();

        return view('admin.walikelas.index', compact('walikelas', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.walikelas.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_walikelas' => 'required|unique:walikelas,id_walikelas',
            'NIP'          => 'required|unique:walikelas,NIP',
            'nama_guru'    => 'required',
            'id_kelas'     => 'required',
            'JK'           => 'required',
            'email'        => 'nullable|email',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('walikelas', 'public');
        }

        Walikelas::create($data);

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Data walikelas berhasil ditambahkan');
    }

    public function show($id)
    {
        $walikelas = Walikelas::with('kelas')
            ->where('id_walikelas', $id)
            ->firstOrFail();

        return view('admin.walikelas.show', compact('walikelas'));
    }

    public function edit($id)
    {
        $walikelas = Walikelas::where('id_walikelas', $id)->firstOrFail();
        $kelas = Kelas::all();

        return view('admin.walikelas.edit', compact('walikelas', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $walikelas = Walikelas::where('id_walikelas', $id)->firstOrFail();

        $request->validate([
            'NIP'       => 'required|unique:walikelas,NIP,' . $walikelas->id_walikelas . ',id_walikelas',
            'nama_guru' => 'required',
            'id_kelas'  => 'required',
            'JK'        => 'required',
            'email'     => 'nullable|email',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {

            if ($walikelas->foto) {
                Storage::disk('public')->delete($walikelas->foto);
            }

            $data['foto'] = $request->file('foto')->store('walikelas', 'public');
        }

        $walikelas->update($data);

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Data walikelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $walikelas = Walikelas::where('id_walikelas', $id)->firstOrFail();

        if ($walikelas->foto) {
            Storage::disk('public')->delete($walikelas->foto);
        }

        $walikelas->delete();

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Walikelas berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('file'), 'r');
        $header = true;

        while (($row = fgetcsv($file, 1000, ",")) !== false) {

            if ($header) {
                $header = false;
                continue;
            }

            Walikelas::updateOrCreate(
                ['NIP' => $row[2]],
                [
                    'id_walikelas' => $row[0],
                    'id_kelas'     => $row[1],
                    'nama_guru'    => $row[3],
                    'JK'           => $row[4],
                    'no_telp'      => $row[5],
                    'email'        => $row[6],
                    'alamat'       => $row[7],
                ]
            );
        }

        fclose($file);

        return back()->with('success', 'Import berhasil!');
    }
}
