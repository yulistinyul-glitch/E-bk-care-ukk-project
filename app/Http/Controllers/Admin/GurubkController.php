<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gurubk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GurubkController extends Controller
{
    public function index()
    {
        $gurubk = Gurubk::oldest()->paginate(10);
        return view('admin.gurubk.index', compact('gurubk'));
    }

    public function create()
    {
        return view('admin.gurubk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NIP' => 'required|unique:gurubks,NIP',
            'nama_gurubk' => 'required',
            'JK' => 'required|in:L,P',
            'no_telp' => 'required',
            'email' => 'required|email|unique:gurubks,email',
            'alamat' => 'required',
        ]);

        $lastUser = User::latest('id_pengguna')->first();
        $lastNumber = $lastUser ? (int) substr($lastUser->id_pengguna, 3) : 0;
        $id_pengguna = 'USR' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        User::create([
            'id_pengguna' => $id_pengguna,  
            'username'    => $request->NIP,
            'password'    => Hash::make('123456'),
            'role'        => 'GuruBK'
        ]);

        $id_gurubk = 'GB' . str_pad(Gurubk::count() + 1, 4, '0', STR_PAD_LEFT);

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

        return redirect()->route('admin.gurubk.index')
                         ->with('success', 'Data Guru BK berhasil ditambahkan dan akun login dibuat.');
    }

public function edit($id)
{
    $gurubk = GuruBK::findOrFail($id); 
    return view('admin.gurubk.edit', compact('gurubk'));
}

public function update(Request $request, $id)
{
    $gurubk = GuruBK::findOrFail($id);

    $request->validate([
        'NIP' => 'required|unique:gurubks,NIP,' . $gurubk->id_guru . ',id_guru',
        'nama_gurubk' => 'required',
        'JK' => 'required',
        'no_telp' => 'nullable',
        'email' => 'nullable|email',
        'alamat' => 'nullable',
    ]);

    $gurubk->update([
        'NIP' => $request->NIP,
        'nama_gurubk' => $request->nama_gurubk,
        'JK' => $request->JK,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('admin.gurubk.index')->with('success', 'Data Guru BK berhasil diperbarui.');
}

 
    public function destroy($id)
    {
        $guru = Gurubk::findOrFail($id);

        User::where('id_pengguna', $guru->id_pengguna)->delete();

        $guru->delete();

        return redirect()->route('admin.gurubk.index')
                         ->with('success', 'Data Guru BK berhasil dihapus.');
    }
}
