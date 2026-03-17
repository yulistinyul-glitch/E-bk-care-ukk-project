<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\RiwayatPelanggaran;
use App\Models\LogAktivitas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 

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
        $tingkatan_list = Kelas::select('nama_kelas')->distinct()->orderBy('nama_kelas', 'asc')->get();
        $jurusan_list = Kelas::select('jurusan')->distinct()->orderBy('jurusan', 'asc')->get();
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
            'kelas', 'kategori', 'siswa', 'jenis_pelanggaran', 'detail', 'tingkatan_list', 'jurusan_list'
        ));
    }

    public function store(Request $request)
    {
       $request->validate([
        'id_siswa' => 'required',
        'id_pelanggaran' => 'required',
        'tanggal' => 'required|date',
        'file_bukti' => 'required|file|mimes:jpg,png,mp4|max:10240', 
        ]);

        DB::beginTransaction();
        try {
            $pelanggaran = Pelanggaran::findOrFail($request->id_pelanggaran);

            $fileName = '-';
            if ($request->hasFile('file_bukti')) {
                $file = $request->file('file_bukti');
                $fileName = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/pelanggaran'), $fileName);
            }

                $riwayat = RiwayatPelanggaran::create([
                'id_riwayat' => 'RW' . strtoupper(Str::random(6)),
                'id_siswa' => $request->id_siswa,
                'id_pelanggaran' => $request->id_pelanggaran,
                'id_gurubk' => 'BK001',
                'poin' => $pelanggaran->poin_pelanggaran,
                'status' => $pelanggaran->tingkatan,
                'tanggal_kejadian' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'bukti' => $request->bukti,
                'file' => $fileName,
            ]);

            $siswa = Siswa::find($request->id_siswa);
            $totalPoinSekarang = $siswa->total_poin;

            LogAktivitas::catat('input data', 'Mencatat pelanggaran siswa');

            DB::commit();
            return redirect()->route('gurubk.riwayatpelanggaran.index')->with('success', 'Data berhasil dicatat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function getKelasByJurusan(Request $request)
    {
        $kelas = Kelas::where('nama_kelas', $request->tingkatan)
                      ->where('jurusan', $request->jurusan)
                      ->get();
        return response()->json($kelas);
    }

    public function getSiswaByKelas($id_kelas)
    {
        $siswa = Siswa::where('id_kelas', $id_kelas)->orderBy('nama_siswa', 'asc')->get();
        return response()->json($siswa);
    }

    // AKUMULASI POIN
    public function akumulasi(Request $request)
    {
        $kelas = Kelas::all();
        $query = Siswa::with(['kelas', 'riwayatPelanggaran']);
        
        if ($request->id_kelas) {
            $query->where('id_kelas', $request->id_kelas);
        }

        if ($request->search) {
            $query->where('nama_siswa', 'like', '%' . $request->search . '%');
        }
        $siswaList = $query->get();
        $totalSiswaMelanggar = $siswaList->filter(fn($s) => $s->total_poin >0)->count();
        $siswaSp3 = $siswaList->filter(fn($s) => $s->total_poin >= 76 )->count();

        return view('gurubk.akumulasipoin.index', compact('siswaList', 'kelas', 'totalSiswaMelanggar', 'siswaSp3'));
    }
}    