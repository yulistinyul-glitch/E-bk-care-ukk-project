<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Walikelas;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf; 
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

        // LOGIK UNTUK GENERATE ID OTOMATIS (Melanjutkan GR001, GR002, dst)
        $lastWali = Walikelas::orderBy('id_walikelas', 'desc')->first();
        if ($lastWali) {
            // Mengambil angka saja dari ID terakhir (misal GR040 diambil 40)
            $lastNum = (int) substr($lastWali->id_walikelas, 2);
            $nextNum = $lastNum + 1;
        } else {
            $nextNum = 1;
        }
        
        // Format menjadi GR + 3 digit angka (Contoh: GR041)
        $nextWaliID = "GR" . str_pad($nextNum, 3, "0", STR_PAD_LEFT);

        return view('admin.walikelas.create', compact('kelas', 'nextWaliID'));
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

        $file = fopen($request->file('file')->getRealPath(), 'r');
        $header = true;

        while (($row = fgetcsv($file, 1000, ",")) !== false) {
            if ($header) {
                $header = false;
                continue;
            }

            Walikelas::updateOrCreate(
                ['NIP' => $row[1]], 
                [
                    'id_walikelas' => $row[0],
                    'id_kelas'     => $row[2], // Tadi $row[1] (double), diperbaiki ke index 2
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

    public function cetakSemua()
    {
        $walikelas = Walikelas::with('kelas')->orderBy('id_walikelas')->get();

        $pdf = Pdf::loadView('admin.walikelas.pdf-semua', compact('walikelas'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('daftar_walikelas.pdf');
    }
}