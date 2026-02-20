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
    public function index()
    {
        $siswa = Siswa::with('kelas.walikelas')
            ->orderBy('id_siswa', 'asc')
            ->paginate(10);

        $kelas = Kelas::all();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();

        $lastSiswa = Siswa::latest('id_siswa')->first();
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
            'NIPD' => 'required|unique:siswas',
            'NISN' => 'required',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        $lastSiswa = Siswa::latest('id_siswa')->first();
        $nextSiswaNumber = $lastSiswa ? (int) substr($lastSiswa->id_siswa, 3) + 1 : 1;
        $nextSiswaID = 'SIS' . str_pad($nextSiswaNumber, 3, '0', STR_PAD_LEFT);

        $lastPenggunaNumber = User::all()->map(function ($user) {
            return (int) substr($user->id_pengguna, 2);
        })->max();

        $nextPenggunaNumber = $lastPenggunaNumber ? $lastPenggunaNumber + 1 : 1;
        $nextPenggunaID = 'PS' . str_pad($nextPenggunaNumber, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'id_pengguna' => $nextPenggunaID,
            'name'        => $request->nama_siswa,
            'username'    => $request->NIPD ?? Str::slug($request->nama_siswa),
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

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $kelas = Kelas::all();

        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'id_siswa' => 'required|unique:siswas,id_siswa,' . $id . ',id_siswa',
            'id_pengguna' => 'required|unique:siswas,id_pengguna,' . $id . ',id_siswa',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'nama_siswa' => 'required',
            'NIPD' => 'required|unique:siswas,NIPD,' . $id . ',id_siswa',
            'NISN' => 'required',
            'JK' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);

        $siswa->update($request->all());

        User::updateOrCreate(
            ['id_pengguna' => $request->id_pengguna],
            [
                'username' => $request->id_pengguna,
                'role' => 'Siswa'
            ]
        );

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        User::where('id_pengguna', $siswa->id_pengguna)->delete();
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil dihapus');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        if (!$file) {
            return back()->withErrors(['file' => 'File tidak ditemukan']);
        }

        $rows = array_map('str_getcsv', file($file->getRealPath()));

        foreach ($rows as $i => $row) {
            if ($i == 0) continue;

            $id_siswa      = trim($row[0] ?? null);
            $id_kelas      = trim($row[1] ?? null);
            $nama_siswa    = trim($row[2] ?? 'Unknown');
            $nipd          = trim($row[3] ?? null);
            $nisn          = trim($row[4] ?? '-');
            $jk            = trim($row[5] ?? 'L');
            $tempat_lahir  = trim($row[6] ?? 'Unknown');
            $tanggal_lahir = trim($row[7] ?? '2008-01-01');
            $no_telp       = trim($row[8] ?? '-');
            $alamat        = trim($row[9] ?? '-');

            if (!$id_siswa || !$nipd || !$id_kelas) continue;
            if (!Kelas::find($id_kelas)) continue;

            $id_pengguna = 'SW' . substr($id_siswa, 3);

            User::firstOrCreate(
                ['id_pengguna' => $id_pengguna],
                [
                    'username' => $id_pengguna,
                    'password' => Hash::make($nipd),
                    'role' => 'Siswa'
                ]
            );

            Siswa::updateOrCreate(
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

        return back()->with('success', 'Import siswa berhasil & akun otomatis dibuat.');
    }

    public function cetakSemua()
    {
        $kelasList = Kelas::with('siswa')->orderBy('nama_kelas')->get();

        $pdf = Pdf::loadView('admin.siswa.pdf-semua', compact('kelasList'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('data_siswa_perkelas.pdf');
    }
}
