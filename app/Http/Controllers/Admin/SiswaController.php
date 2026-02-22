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
            ->paginate(15);

        $kelas = Kelas::all();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    // --- FITUR HISTORY START ---

    /**
     * Menampilkan data siswa yang telah dihapus (History)
     */
    public function history()
    {
        // Mengambil hanya data yang di-soft delete
        $siswa = Siswa::onlyTrashed()
            ->with('kelas.walikelas')
            ->orderBy('deleted_at', 'desc')
            ->paginate(15);

        return view('admin.siswa.history', compact('siswa'));
    }

    /**
     * Mengembalikan data siswa dari history (Restore)
     */
    public function restore($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);
        $siswa->restore();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dikembalikan dari history');
    }

    /**
     * Menghapus data secara permanen dari database
     */
    public function forceDelete($id)
    {
        $siswa = Siswa::onlyTrashed()->findOrFail($id);

        // Hapus Akun User secara permanen
        if ($siswa->id_pengguna) {
            User::where('id_pengguna', trim($siswa->id_pengguna))->delete();
        }

        // Hapus baris data dari database
        $siswa->forceDelete();

        return redirect()->route('admin.siswa.history')
            ->with('success', 'Data Siswa dan Akun User dihapus permanen');
    }

    // --- FITUR HISTORY END ---

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

    /**
     * Pindahkan ke History (Soft Delete)
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Soft Delete (hanya mengisi kolom deleted_at)
        // User tidak dihapus di sini agar jika di-restore akun tetap berfungsi
        $siswa->delete();

        return redirect()->route('admin.siswa.history')
            ->with('success', 'Data siswa berhasil dipindahkan ke history');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        if (!$file) return back()->withErrors(['file' => 'File tidak ditemukan']);

        $rows = array_map('str_getcsv', file($file->getRealPath()));

        foreach ($rows as $i => $row) {
            if ($i == 0) continue; // Lewati Header

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