<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    // Kategori didefinisikan satu kali agar mudah dikelola
    private $kategoriOrder = [
        'Keterlambatan', 'Kehadiran', 'Kelengkapan Seragam', 'Kepribadian',
        'Ketertiban', 'Merokok', 'Media Konten Negatif', 'Senjata',
        'MIRAS & NARKOBA', 'Perkelahian', 'Etika & Moral', 'Perjudian'
    ];

    public function index(Request $request)
    {
        $query = Pelanggaran::query();

        // Fitur Pencarian (Disamakan dengan SiswaController)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('jenis_kegiatan', 'like', "%{$search}%")
                  ->orWhere('kategori_pelanggaran', 'like', "%{$search}%")
                  ->orWhere('id_pelanggaran', 'like', "%{$search}%");
            });
        }

        // Sorting berdasarkan urutan kategori dan nomor ID
        $pelanggaran = $query->orderByRaw("
            FIELD(kategori_pelanggaran, '" . implode("','", $this->kategoriOrder) . "') ASC,
            CAST(SUBSTRING(id_pelanggaran, 3) AS UNSIGNED) ASC
        ")->paginate(10)->withQueryString();

        return view('admin.pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        $kategoriOptions = $this->kategoriOrder;

        // Generate ID Otomatis (Mengambil data terakhir termasuk yang di-hapus/trashed)
        $last = Pelanggaran::withTrashed()->latest('id_pelanggaran')->first();
        $lastNumber = $last ? (int) substr($last->id_pelanggaran, 2) : 0;
        $nextId = 'PL' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return view('admin.pelanggaran.create', compact('kategoriOptions', 'nextId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pelanggaran' => 'required|in:' . implode(',', $this->kategoriOrder),
            'jenis_kegiatan'       => 'required|string|max:255',
            'tingkatan'            => 'required|in:ringan,sedang,berat',
            'poin_pelanggaran'     => 'required|integer',
        ]);

        // Proteksi ID ganda saat penyimpanan
        $last = Pelanggaran::withTrashed()->latest('id_pelanggaran')->first();
        $lastNumber = $last ? (int) substr($last->id_pelanggaran, 2) : 0;
        $id_pelanggaran = 'PL' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        Pelanggaran::create([
            'id_pelanggaran'       => $id_pelanggaran,
            'kategori_pelanggaran' => $request->kategori_pelanggaran,
            'jenis_kegiatan'       => $request->jenis_kegiatan,
            'tingkatan'            => $request->tingkatan,
            'poin_pelanggaran'     => $request->poin_pelanggaran,
        ]);

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::where('id_pelanggaran', $id)->firstOrFail();
        $kategoriOptions = $this->kategoriOrder;

        return view('admin.pelanggaran.edit', compact('pelanggaran', 'kategoriOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_pelanggaran' => 'required|in:' . implode(',', $this->kategoriOrder),
            'jenis_kegiatan'       => 'required|string|max:255',
            'tingkatan'            => 'required|in:ringan,sedang,berat',
            'poin_pelanggaran'     => 'required|integer',
        ]);

        $pelanggaran = Pelanggaran::where('id_pelanggaran', $id)->firstOrFail();
        $pelanggaran->update($request->all());

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::where('id_pelanggaran', $id)->firstOrFail();
        $pelanggaran->delete(); // Akan memindahkan ke history jika Model menggunakan SoftDeletes

        return redirect()->route('admin.pelanggaran.history')
            ->with('success', 'Data berhasil dipindahkan ke history');
    }

    // =============================
    // FITUR HISTORY (Identik dengan Siswa)
    // =============================

    public function history()
    {
        $pelanggaran = Pelanggaran::onlyTrashed()->paginate(10);
        return view('admin.pelanggaran.history', compact('pelanggaran'));
    }

    public function restore($id)
    {
        $pelanggaran = Pelanggaran::withTrashed()->where('id_pelanggaran', $id)->firstOrFail();
        $pelanggaran->restore();

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $pelanggaran = Pelanggaran::onlyTrashed()->where('id_pelanggaran', $id)->firstOrFail();
        $pelanggaran->forceDelete();

        return redirect()->route('admin.pelanggaran.history')
            ->with('success', 'Data dihapus permanen');
    }

    // =============================
    // IMPORT & EXPORT PDF
    // =============================

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        
        $file = fopen($request->file('file'), 'r');
        fgetcsv($file); // Skip header

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            Pelanggaran::updateOrCreate(
                ['id_pelanggaran' => $row[0]],
                [
                    'kategori_pelanggaran' => $row[1],
                    'jenis_kegiatan'       => $row[2],
                    'tingkatan'            => $row[3],
                    'poin_pelanggaran'     => $row[4],
                ]
            );
        }
        fclose($file);

        return redirect()->back()->with('success', 'Data pelanggaran berhasil diimport');
    }

    public function cetakSemua()
    {
        $pelanggaran = Pelanggaran::orderByRaw("
            FIELD(kategori_pelanggaran, '" . implode("','", $this->kategoriOrder) . "') ASC,
            CAST(SUBSTRING(id_pelanggaran, 3) AS UNSIGNED) ASC
        ")->get();

        $pdf = Pdf::loadView('admin.pelanggaran.pdf-semua', compact('pelanggaran'))
                  ->setPaper('A4', 'portrait');

        return $pdf->stream('daftar_pelanggaran_lengkap.pdf');
    }
}