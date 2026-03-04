<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query()->with('kelas.walikelas');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                  ->orWhere('NIPD', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }

        $siswa = $query->paginate(10)->withQueryString();
        $kelas = \App\Models\Kelas::all();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();

        $lastSiswa = Siswa::withTrashed()->latest('id_siswa')->first();
        $nextSiswaNumber = $lastSiswa ? (int) substr($lastSiswa->id_siswa, 3) + 1 : 1;
        $nextSiswaID = 'SIS' . str_pad($nextSiswaNumber, 3, '0', STR_PAD_LEFT);

        $lastPenggunaNumber = User::all()->map(function ($user) {
            return (int) substr($user->id_pengguna, 2);
        })->max();

        $nextPenggunaNumber = $lastPenggunaNumber ? $lastPenggunaNumber + 1 : 1;
        $nextPenggunaID = 'PS' . str_pad($nextPenggunaNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.siswa.create', compact('kelas', 'nextSiswaID', 'nextPenggunaID'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'NIPD' => 'required|unique:siswas,NIPD|max:9',
            'NISN' => 'required|max:10',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telp'       => 'required',
            'alamat'        => 'required',
        ], [
            'NIPD.digits'   => 'NIPD harus berjumlah 9 digit angka.',
            'NIPD.unique'   => 'NIPD sudah terdaftar.',
            'NISN.digits'   => 'NISN harus berjumlah 10 digit angka.',
        ]);

        $lastSiswa = Siswa::withTrashed()->latest('id_siswa')->first();
        $nextSiswaID = 'SIS' . str_pad($lastSiswa ? (int) substr($lastSiswa->id_siswa, 3) + 1 : 1, 3, '0', STR_PAD_LEFT);

        $lastUser = User::all()->map(fn($u) => (int) substr($u->id_pengguna, 2))->max();
        $nextPenggunaID = 'PS' . str_pad($lastUser ? $lastUser + 1 : 1, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'id_pengguna' => $nextPenggunaID,
            'nama'        => $request->nama_siswa,
            'username'    => $request->NIPD,
            'email'       => $request->NIPD . '@example.com',
            'password'    => Hash::make('12345678'),
            'role'        => 'Siswa'
        ]);

        Siswa::create([
            'id_siswa'     => $nextSiswaID,
            'id_pengguna'  => $user->id_pengguna,
            'NIPD'         => $request->NIPD,
            'NISN'         => $request->NISN,
            'nama_siswa'   => $request->nama_siswa,
            'id_kelas'     => $request->id_kelas,
            'JK'           => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'no_telp'      => $request->no_telp,
            'alamat'       => $request->alamat,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::where('id_siswa', $id)->firstOrFail();
        $kelas = Kelas::all();

        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::where('id_siswa', $id)->firstOrFail();

        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'NIPD'          => 'required|digits:9|unique:siswas,NIPD,' . $siswa->id_siswa . ',id_siswa',
            'NISN'          => 'required|digits:10',
            'id_kelas'      => 'required',
            'jk'            => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telp'       => 'required',
            'alamat'        => 'required',
        ], [
            'NIPD.digits'   => 'NIPD harus berjumlah 9 digit angka.',
            'NIPD.unique'   => 'NIPD sudah digunakan oleh siswa lain.',
            'NISN.digits'   => 'NISN harus berjumlah 10 digit angka.',
        ]);

        $siswa->update([
            'id_kelas'      => $request->id_kelas,
            'nama_siswa'    => $request->nama_siswa,
            'NIPD'          => $request->NIPD,
            'NISN'          => $request->NISN,
            'JK'            => $request->jk, 
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp'       => $request->no_telp,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::where('id_siswa', $id)->firstOrFail();
        $siswa->delete();

        return redirect()->route('admin.siswa.history')
            ->with('success', 'Data ' . $siswa->nama_siswa . ' berhasil dipindahkan ke history');
    }

    public function history()
    {
        $siswa = Siswa::onlyTrashed()->with('kelas')->paginate(10);
        return view('admin.siswa.history', compact('siswa'));
    }

    public function restore($id)
    {
        $siswa = Siswa::withTrashed()->where('id_siswa', $id)->firstOrFail();
        $siswa->restore();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $siswa = Siswa::onlyTrashed()->where('id_siswa', $id)->firstOrFail();

        if ($siswa->id_pengguna) {
            User::where('id_pengguna', $siswa->id_pengguna)->delete();
        }

        $siswa->forceDelete();

        return redirect()->route('admin.siswa.history')->with('success', 'Data dihapus permanen');
    }

    // =============================
    // IMPORT & PDF
    // =============================
    public function import(Request $request)
    {
        $file = $request->file('file');
        if (!$file) return back()->withErrors(['file' => 'File tidak ditemukan']);

        $rows = array_map('str_getcsv', file($file->getRealPath()));

        foreach ($rows as $i => $row) {
            if ($i == 0) continue; 

            $id_siswa      = trim($row[0] ?? null); 
            $id_kelas      = trim($row[2] ?? null); 
            $nama_siswa    = trim($row[3] ?? null); 
            $nipd          = trim($row[4] ?? null); 
            $nisn          = trim($row[5] ?? null); 
            $jk            = trim($row[6] ?? 'L');  
            $tempat_lahir  = trim($row[7] ?? '-');  
            $tanggal_lahir = trim($row[8] ?? null); 
            $no_telp       = trim($row[9] ?? '-');  
            $alamat        = trim($row[10] ?? '-'); 

            if (!$id_siswa || !$nipd || !$id_kelas) continue;

            $id_pengguna = 'PS' . substr($id_siswa, 3);

            \App\Models\User::updateOrCreate(
                ['id_pengguna' => $id_pengguna],
                [
                    'username' => $id_pengguna,
                    'password' => \Illuminate\Support\Facades\Hash::make($nipd),
                    'role'     => 'Siswa'
                ]
            );

            \App\Models\Siswa::updateOrCreate(
                ['id_siswa' => $id_siswa],
                [
                    'id_pengguna'   => $id_pengguna,
                    'id_kelas'      => $id_kelas,
                    'nama_siswa'    => $nama_siswa,
                    'NIPD'          => $nipd,
                    'NISN'          => $nisn,
                    'JK'            => $jk,
                    'tempat_lahir'  => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'no_telp'       => $no_telp,
                    'alamat'        => $alamat,
                ]
            );
        }

        return back()->with('success', 'Import Data Siswa Berhasil!');
    }

    public function cetakSemua()
    {
        $kelasList = Kelas::with('siswa')->orderBy('nama_kelas')->get();

        $pdf = Pdf::loadView('admin.siswa.pdf-semua', compact('kelasList'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('data_siswa_perkelas.pdf');
    }
}