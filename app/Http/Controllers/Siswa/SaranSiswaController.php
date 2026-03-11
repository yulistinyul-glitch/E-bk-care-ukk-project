<?php

namespace App\Http\Controllers\Siswa; 

use App\Http\Controllers\Controller;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class SaranSiswaController extends Controller
{
    public function show()
    {
        return view('siswa.saran.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'target' => 'required',
            'message' => 'required|min:5',
        ]);

        $user = Auth::user();
        $siswa = $user->siswa; 

        Saran::create([
            'id_siswa'     => $siswa ? $siswa->id_siswa : null,
            'target'       => $request->target,
            'message'      => $request->message,
            'is_anonymous' => $request->has('is_anonymous') && $request->is_anonymous == 'Tidak' ? 1 : 0,
        ]);

        return back()->with('success', 'Saran berhasil dikirim!');
    }
}