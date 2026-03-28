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
use Illuminate\Support\Facades\File;

class RiwayatPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter_kelas = $request->id_kelas;

        $kelas = Kelas::all();

        $riwayat = RiwayatPelanggaran::with(['siswa.kelas', 'pelanggaran'])
            ->when($search, function ($query, $search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%$search%");
                })->orWhereHas('pelanggaran', function ($q) use ($search) {
                    $q->where('jenis_kegiatan', 'like', "%$search%");
                });
            })
            ->when($filter_kelas, function ($query, $filter_kelas) {
                $query->whereHas('siswa', function ($q) use ($filter_kelas) {
                    $q->where('id_kelas', $filter_kelas);
                });
            })
            ->orderBy('tanggal_kejadian', 'desc')
            ->paginate(15);

        return view('gurubk.riwayatpelanggaran.index', compact('riwayat', 'kelas'));
    }

    public function create(Request $request)
    {
        $tingkatan_list = Kelas::select('nama_kelas')->distinct()->orderBy('nama_kelas', 'asc')->get();
        $jurusan_list = Kelas::select('jurusan')->distinct()->orderBy('jurusan', 'asc')->get();
        $kelas = Kelas::all();
        $kategori = Pelanggaran::select('kategori_pelanggaran')->distinct()->get();

        return view('gurubk.riwayatpelanggaran.create', compact(
            'kelas', 'kategori', 'tingkatan_list', 'jurusan_list'
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

            RiwayatPelanggaran::create([
                'id_riwayat' => 'RW' . strtoupper(Str::random(6)),
                'id_siswa' => $request->id_siswa,
                'id_pelanggaran' => $request->id_pelanggaran,
                'id_gurubk' => 'BK001', // Sesuaikan dengan Auth::user()->id jika sudah dinamis
                'poin' => $pelanggaran->poin_pelanggaran,
                'status' => $pelanggaran->tingkatan,
                'tanggal_kejadian' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'file' => $fileName,
            ]);

            LogAktivitas::catat('input data', 'Mencatat pelanggaran siswa ID: ' . $request->id_siswa);

            DB::commit();
            return redirect()->route('gurubk.riwayatpelanggaran.index')->with('success', 'Data berhasil dicatat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $riwayat = RiwayatPelanggaran::with(['siswa.kelas', 'pelanggaran'])->findOrFail($id);
        return view('gurubk.riwayatpelanggaran.show', compact('riwayat'));
    }

    public function edit($id)
    {
        $riwayat = RiwayatPelanggaran::findOrFail($id);
        $kelas = Kelas::all();
        $kategori_list = Pelanggaran::select('kategori_pelanggaran')->distinct()->get();
        
        // Data pendukung untuk dropdown edit
        $siswa_in_kelas = Siswa::where('id_kelas', $riwayat->siswa->id_kelas)->get();
        $pelanggaran_in_kategori = Pelanggaran::where('kategori_pelanggaran', $riwayat->pelanggaran->kategori_pelanggaran)->get();

        return view('gurubk.riwayatpelanggaran.edit', compact(
            'riwayat', 'kelas', 'kategori_list', 'siswa_in_kelas', 'pelanggaran_in_kategori'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_pelanggaran' => 'required',
            'tanggal' => 'required|date',
            'file_bukti' => 'nullable|file|mimes:jpg,png,mp4|max:10240',
        ]);

        DB::beginTransaction();
        try {
            $riwayat = RiwayatPelanggaran::findOrFail($id);
            $pelanggaran = Pelanggaran::findOrFail($request->id_pelanggaran);

            $data = [
                'id_siswa' => $request->id_siswa,
                'id_pelanggaran' => $request->id_pelanggaran,
                'poin' => $pelanggaran->poin_pelanggaran,
                'status' => $pelanggaran->tingkatan,
                'tanggal_kejadian' => $request->tanggal,
                'keterangan' => $request->keterangan,
            ];

            if ($request->hasFile('file_bukti')) {
                // Hapus file lama
                if ($riwayat->file && $riwayat->file != '-' && File::exists(public_path('uploads/pelanggaran/' . $riwayat->file))) {
                    File::delete(public_path('uploads/pelanggaran/' . $riwayat->file));
                }

                $file = $request->file('file_bukti');
                $fileName = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/pelanggaran'), $fileName);
                $data['file'] = $fileName;
            }

            $riwayat->update($data);

            LogAktivitas::catat('edit data', 'Mengupdate riwayat pelanggaran ' . $id);

            DB::commit();
            return redirect()->route('gurubk.riwayatpelanggaran.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $riwayat = RiwayatPelanggaran::findOrFail($id);

            // Hapus file fisik
            if ($riwayat->file && $riwayat->file != '-' && File::exists(public_path('uploads/pelanggaran/' . $riwayat->file))) {
                File::delete(public_path('uploads/pelanggaran/' . $riwayat->file));
            }

            $riwayat->delete();
            LogAktivitas::catat('hapus data', 'Menghapus riwayat pelanggaran ' . $id);

            return redirect()->route('gurubk.riwayatpelanggaran.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // --- AJAX METHODS ---

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
        $totalSiswaMelanggar = $siswaList->filter(fn($s) => $s->total_poin > 0)->count();
        $siswaSp3 = $siswaList->filter(fn($s) => $s->total_poin >= 75)->count();

        return view('gurubk.akumulasipoin.index', compact('siswaList', 'kelas', 'totalSiswaMelanggar', 'siswaSp3'));
    }
}