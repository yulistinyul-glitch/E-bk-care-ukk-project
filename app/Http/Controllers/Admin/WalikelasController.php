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
    public function index(Request $request)
    {
        $search = $request->get('search');

        $walikelas = Walikelas::with('kelas')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_guru', 'LIKE', "%{$search}%")
                      ->orWhere('NIP', 'LIKE', "%{$search}%");
            })
            ->orderBy('id_walikelas', 'asc')
            ->paginate(10)
            ->withQueryString();

        $kelas = Kelas::all();

        return view('admin.walikelas.index', compact('walikelas', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        
        // Auto-generate ID (GR001, GR002, dst)
        $lastWali = Walikelas::withTrashed()->orderBy('id_walikelas', 'desc')->first();
        $nextNum = $lastWali ? (int) substr($lastWali->id_walikelas, 2) + 1 : 1;
        $nextWaliID = "GR" . str_pad($nextNum, 3, "0", STR_PAD_LEFT);

        return view('admin.walikelas.create', compact('kelas', 'nextWaliID'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'NIP'       => 'required|digits:18|unique:walikelas,NIP', // Validasi 18 digit angka
            'id_kelas'  => 'required|exists:kelas,id_kelas',
            'JK'        => 'required|in:L,P',
            'email'     => 'nullable|email|unique:walikelas,email',
            'no_telp'   => 'required',
            'alamat'    => 'required',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'NIP.digits'      => 'NIP harus berupa angka dan berjumlah tepat 18 digit.',
            'NIP.unique'      => 'NIP sudah terdaftar.',
            'email.unique'    => 'Email sudah digunakan.',
            'id_kelas.exists' => 'Kelas tidak ditemukan.',
        ]);

        // Re-generate ID untuk memastikan urutan saat submit (mencegah duplikat jika 2 user input bersamaan)
        $lastWali = Walikelas::withTrashed()->orderBy('id_walikelas', 'desc')->first();
        $nextWaliID = "GR" . str_pad($lastWali ? (int) substr($lastWali->id_walikelas, 2) + 1 : 1, 3, "0", STR_PAD_LEFT);

        $data = $request->all();
        $data['id_walikelas'] = $nextWaliID;
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('walikelas', 'public');
        }

        Walikelas::create($data);

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Data walikelas berhasil ditambahkan!');
    }

    public function show($id)
    {
        $walikelas = Walikelas::with('kelas')->where('id_walikelas', $id)->firstOrFail();
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
            'nama_guru' => 'required|string|max:255',
            'NIP'       => 'required|digits:18|unique:walikelas,NIP,' . $walikelas->id_walikelas . ',id_walikelas',
            'id_kelas'  => 'required|exists:kelas,id_kelas',
            'JK'        => 'required|in:L,P',
            'email'     => 'nullable|email|unique:walikelas,email,' . $walikelas->id_walikelas . ',id_walikelas',
            'no_telp'   => 'required',
            'alamat'    => 'required',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'NIP.digits'   => 'NIP harus berupa angka dan berjumlah tepat 18 digit.',
            'NIP.unique'   => 'NIP sudah digunakan oleh guru lain.',
        ]);

        $data = $request->only(['nama_guru', 'NIP', 'id_kelas', 'JK', 'email', 'no_telp', 'alamat']);

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
        $walikelas->delete(); // Ini akan masuk ke history karena menggunakan SoftDeletes

        return redirect()->route('admin.walikelas.history')
            ->with('success', 'Data ' . $walikelas->nama_guru . ' berhasil dipindahkan ke history');
    }

    public function history()
    {
        $walikelas = Walikelas::onlyTrashed()->with('kelas')->paginate(10);
        return view('admin.walikelas.history', compact('walikelas'));
    }

    public function restore($id)
    {
        $walikelas = Walikelas::withTrashed()->where('id_walikelas', $id)->firstOrFail();
        $walikelas->restore();

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Data berhasil dikembalikan dari history.');
    }

    public function forceDelete($id)
    {
        $walikelas = Walikelas::onlyTrashed()->where('id_walikelas', $id)->firstOrFail();

        if ($walikelas->foto) {
            Storage::disk('public')->delete($walikelas->foto);
        }

        $walikelas->forceDelete();

        return redirect()->route('admin.walikelas.history')->with('success', 'Data dihapus secara permanen');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        if (!$file) return back()->withErrors(['file' => 'File tidak ditemukan']);

        $rows = array_map('str_getcsv', file($file->getRealPath()));

        foreach ($rows as $i => $row) {
            if ($i == 0) continue; // Skip header

            $id_walikelas = trim($row[0] ?? null);
            $id_kelas     = trim($row[1] ?? null);
            $nip          = trim($row[2] ?? null);
            $nama_guru    = trim($row[3] ?? null);
            $jk           = strtoupper(trim($row[4] ?? 'L'));
            $no_telp      = trim($row[5] ?? '-');
            $email        = trim($row[6] ?? null);
            $alamat       = trim($row[7] ?? '-');

            // Validasi data penting sebelum save
            if (!$id_walikelas || strlen($nip) != 18) continue;

            Walikelas::withTrashed()->updateOrCreate(
                ['id_walikelas' => $id_walikelas],
                [
                    'id_kelas'  => $id_kelas,
                    'NIP'       => $nip,
                    'nama_guru' => $nama_guru,
                    'JK'        => in_array($jk, ['L', 'P']) ? $jk : 'L',
                    'no_telp'   => $no_telp,
                    'email'     => $email,
                    'alamat'    => $alamat,
                ]
            );
        }

        return back()->with('success', 'Import Data Walikelas Berhasil!');
    }

    public function cetakSemua()
    {
        $walikelas = Walikelas::with('kelas')->orderBy('id_walikelas')->get();
        $pdf = Pdf::loadView('admin.walikelas.pdf-semua', compact('walikelas'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('daftar_walikelas.pdf');
    }
}