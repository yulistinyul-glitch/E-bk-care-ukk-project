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
        $lastGuru = Gurubk::orderBy('id_gurubk', 'desc')->first();
        $lastGuruNum = $lastGuru ? (int) substr($lastGuru->id_gurubk, 2) : 0;
        $nextID = 'GB' . str_pad($lastGuruNum + 1, 3, '0', STR_PAD_LEFT);

        return view('admin.gurubk.create', compact('nextID'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIP' => 'required|numeric|digits_between:1,18|unique:gurubks,NIP',
            'nama_gurubk' => 'required',
            'JK' => 'required|in:L,P',
            'no_telp' => 'required',
            'email' => 'required|email|unique:gurubks,email',
            'alamat' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Generate ID Pengguna
            $lastUser = User::orderBy('id_pengguna', 'desc')->first();
            $lastNumber = $lastUser ? (int) substr($lastUser->id_pengguna, 3) : 0;
            $id_pengguna = 'USR' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            User::create([
                'id_pengguna' => $id_pengguna,  
                'username'    => $request->NIP,
                'password'    => Hash::make($request->NIP), 
                'role'        => 'GuruBK'
            ]);

            // 2. Generate ID Guru BK
            $lastGuru = Gurubk::orderBy('id_gurubk', 'desc')->first();
            $lastGuruNum = $lastGuru ? (int) substr($lastGuru->id_gurubk, 2) : 0;
            $id_gurubk = 'GB' . str_pad($lastGuruNum + 1, 3, '0', STR_PAD_LEFT);

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
                         ->with('success', 'Data Guru BK berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Cari menggunakan kolom id_gurubk secara eksplisit
        $gurubk = Gurubk::where('id_gurubk', $id)->firstOrFail(); 
        return view('admin.gurubk.edit', compact('gurubk'));
    }

    public function update(Request $request, $id)
    {
        $gurubk = Gurubk::where('id_gurubk', $id)->firstOrFail();

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

        User::where('id_pengguna', $gurubk->id_pengguna)->update([
            'username' => $request->NIP
        ]);

        return redirect()->route('admin.gurubk.index')->with('success', 'Data Guru BK berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $guru = Gurubk::findOrFail($id);

        $guru->delete(); 

        return redirect()->route('admin.gurubk.index')
                         ->with('success', 'Data Guru BK dan akun aksesnya berhasil dihapus permanen.');
    }
}