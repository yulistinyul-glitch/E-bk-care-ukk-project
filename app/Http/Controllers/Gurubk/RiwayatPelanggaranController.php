<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\RiwayatPelanggaran;
use App\Models\LogAktivitas; // Tambahkan ini agar bisa mencatat log
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk database transaksi (aman)

class RiwayatPelanggaranController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatPelanggaran::with(['siswa.kelas', 'pelanggaran'])
                    ->latest('tanggal_kejadian')
                    ->get();
        
        $kelas = Kelas::all();

        return view('gurubk.riwayatpelanggaran.index', compact('riwayat', 'kelas'));
    }

    public function create(Request $request)
    {
        $kelas = Kelas::all();
        $kategori = Pelanggaran::select('kategori_pelanggaran')->distinct()->get();

        $siswa = [];
        if ($request->id_kelas) {
            $siswa = Siswa::where('id_kelas', $request->id_kelas)->orderBy('nama_siswa', 'asc')->get();
        }

        $jenis_pelanggaran = [];
        if ($request->kategori_pilih) {
            $jenis_pelanggaran = Pelanggaran::where('kategori_pelanggaran', $request->kategori_pilih)->get();
        }

        $detail = null;
        if ($request->id_pelanggaran) {
            $detail = Pelanggaran::where('id_pelanggaran', $request->id_pelanggaran)->first();
        }

        return view('gurubk.riwayatpelanggaran.create', compact(
            'kelas', 'kategori', 'siswa', 'jenis_pelanggaran', 'detail'
        ));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'id_siswa' => 'required|exists:siswas,id_siswa', 
            'id_pelanggaran' => 'required|exists:pelanggarans,id_pelanggaran',
            'tanggal' => 'required|date'
        ]);

        // Gunakan DB Transaction agar jika log gagal, data pelanggaran juga batal (aman)
        DB::beginTransaction();

        try {
            // 2. Ambil data master untuk snapshot
            $pelanggaran = Pelanggaran::where('id_pelanggaran', $request->id_pelanggaran)->firstOrFail();

            // 3. Simpan data Pelanggaran
            RiwayatPelanggaran::create([
                'id_riwayat' => 'RW' . strtoupper(Str::random(6)), 
                'id_siswa' => $request->id_siswa,
                'id_pelanggaran' => $request->id_pelanggaran,
                'id_gurubk' => 'BK001', 
                'poin' => $pelanggaran->poin_pelanggaran,
                'status' => $pelanggaran->tingkatan, 
                'tanggal_kejadian' => $request->tanggal,
                'keterangan' => $request->keterangan ?? '-',
                'bukti' => 'foto',
                'file' => '-',
            ]);

            // 4. CATAT LOG AKTIVITAS (Penting!)
            // Karena ini di controller Guru BK, keterangannya spesifik "Input Pelanggaran"
            LogAktivitas::catat('input data', 'Input Pelanggaran');

            DB::commit();
            return redirect()->route('gurubk.riwayatpelanggaran.index')
                             ->with('success', 'Data pelanggaran berhasil dicatat.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}