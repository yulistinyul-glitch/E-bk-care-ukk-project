<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gurubk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GurubkController extends Controller
{
    public function index()
    {
        $gurubk = Gurubk::latest()->paginate(10);
        return view('admin.gurubk.index', compact('gurubk'));
    }

    public function create()
    {
        // Mencari ID terakhir untuk ditampilkan otomatis di form
        $lastGuru = Gurubk::orderBy('id_gurubk', 'desc')->first();
        $lastGuruNum = $lastGuru ? (int) substr($lastGuru->id_gurubk, 2) : 0;
        $nextID = 'GB' . str_pad($lastGuruNum + 1, 3, '0', STR_PAD_LEFT);

        return view('admin.gurubk.create', compact('nextID'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // digits_between:1,18 memastikan NIP tidak lebih dari 18 angka (mencegah error database)
            'NIP' => 'required|numeric|digits_between:1,18|unique:gurubks,NIP',
            'nama_gurubk' => 'required',
            'JK' => 'required|in:L,P',
            'no_telp' => 'required',
            'email' => 'required|email|unique:gurubks,email',
            'alamat' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Generate ID Pengguna (USRxxx)
            $lastUser = User::orderBy('id_pengguna', 'desc')->first();
            $lastNumber = $lastUser ? (int) substr($lastUser->id_pengguna, 3) : 0;
            $id_pengguna = 'USR' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            // 2. Simpan ke tabel User (Login menggunakan NIP)
            User::create([
                'id_pengguna' => $id_pengguna,  
                'username'    => $request->NIP,
                'password'    => Hash::make($request->NIP), 
                'role'        => 'GuruBK'
            ]);

            // 3. Generate ID Guru BK (GBxxx)
            $lastGuru = Gurubk::orderBy('id_gurubk', 'desc')->first();
            $lastGuruNum = $lastGuru ? (int) substr($lastGuru->id_gurubk, 2) : 0;
            $id_gurubk = 'GB' . str_pad($lastGuruNum + 1, 3, '0', STR_PAD_LEFT);

            // 4. Simpan ke tabel Gurubk
            Gurubk::create([
                'id_gurubk'   => $id_gurubk,
                'id_pengguna' => $id_pengguna, 
                'NIP'         => $request->NIP,
                'nama_gurubk' => $request->nama_gurubk,
                'JK'          => $request->JK,
                'no_telp'     => $request->no_telp,
                'email'       => $request->email,
                'alamat'      => $request->alamat,
            ]);
        });

        return redirect()->route('admin.gurubk.index')
                         ->with('success', 'Data Guru BK berhasil ditambahkan. Username & Password: NIP');
    }

    public function edit($id)
    {
        $gurubk = Gurubk::findOrFail($id); 
        return view('admin.gurubk.edit', compact('gurubk'));
    }

    public function update(Request $request, $id)
    {
        $gurubk = Gurubk::findOrFail($id);

        $request->validate([
            'NIP' => 'required|numeric|digits_between:1,18|unique:gurubks,NIP,' . $id . ',id_gurubk',
            'nama_gurubk' => 'required',
            'JK' => 'required|in:L,P',
            'no_telp' => 'required',
            'email' => 'required|email|unique:gurubks,email,' . $id . ',id_gurubk',
            'alamat' => 'required',
        ]);

        $gurubk->update([
            'NIP' => $request->NIP,
            'nama_gurubk' => $request->nama_gurubk,
            'JK' => $request->JK,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        // Sinkronisasi username jika NIP berubah
        User::where('id_pengguna', $gurubk->id_pengguna)->update([
            'username' => $request->NIP
        ]);

        return redirect()->route('admin.gurubk.index')->with('success', 'Data Guru BK berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $guru = Gurubk::findOrFail($id);

        DB::transaction(function () use ($guru) {
            // Menghapus User terkait terlebih dahulu
            User::where('id_pengguna', $guru->id_pengguna)->delete();
            $guru->delete();
        });

        return redirect()->route('admin.gurubk.index')
                         ->with('success', 'Data Guru BK dan akun aksesnya berhasil dihapus.');
    }
}