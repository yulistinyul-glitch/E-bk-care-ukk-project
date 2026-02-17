<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ESurat;
use App\Models\Siswa;
use App\Models\Gurubk;
use App\Models\TemplateSurat;

class E_SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = ESurat::with(['siswa','gurubk','template']);

        // Search berdasarkan nama siswa
        if ($request->search) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%');
            });
        }

        $surat = $query->latest()->paginate(5);

        $siswa = Siswa::all();
        $gurubk = Gurubk::all();
        $template = TemplateSurat::all();

        return view('gurubk.e_surat.index',
            compact('surat','siswa','gurubk','template'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_template' => 'required',
            'id_gurubk' => 'required',
            'tanggal_terbit' => 'required|date',
            'keterangan_tambahan' => 'required'
        ]);

        ESurat::create([
            'id_siswa' => $request->id_siswa,
            'id_template' => $request->id_template,
            'id_gurubk' => $request->id_gurubk,
            'tanggal_terbit' => $request->tanggal_terbit,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'status' => 'draft'
        ]);

        return back()->with('success','E-SP berhasil dibuat');
    }

    public function export($id)
    {
        $surat = ESurat::findOrFail($id);
        $surat->status = 'pdf';
        $surat->save();

        return back()->with('success','PDF berhasil dibuat');
    }

    public function sendEmail($id)
    {
        $surat = ESurat::findOrFail($id);
        $surat->status = 'emailed';
        $surat->save();

        return back()->with('success','Email berhasil dikirim');
    }

    public function selesai($id)
    {
        $surat = ESurat::findOrFail($id);
        $surat->status = 'selesai';
        $surat->save();

        return back()->with('success','Surat selesai');
    }
}
