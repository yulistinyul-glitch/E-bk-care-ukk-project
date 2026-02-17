<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        $kategoriOrder = [
            'Keterlambatan',
            'Kehadiran',
            'Kelengkapan Seragam',
            'Kepribadian',
            'Ketertiban',
            'Merokok',
            'Media Konten Negatif',
            'Senjata',
            'MIRAS & NARKOBA',
            'Perkelahian',
            'Etika & Moral',
            'Perjudian'
        ];

        $pelanggaran = Pelanggaran::orderByRaw("
            FIELD(kategori_pelanggaran, '" . implode("','", $kategoriOrder) . "') ASC,
            CAST(SUBSTRING(id_pelanggaran, 3) AS UNSIGNED) ASC
        ")->paginate(10);

        return view('admin.pelanggaran.index', compact('pelanggaran'));
    }

    public function create()
    {
        $kategoriOptions = [
            'Keterlambatan',
            'Kehadiran',
            'Kelengkapan Seragam',
            'Kepribadian',
            'Ketertiban',
            'Merokok',
            'Media Konten Negatif',
            'Senjata',
            'MIRAS & NARKOBA',
            'Perkelahian',
            'Etika & Moral',
            'Perjudian'
        ];

        // Generate next ID otomatis
        $last = Pelanggaran::latest('id_pelanggaran')->first();
        $lastNumber = $last ? (int) substr($last->id_pelanggaran, 2) : 0;
        $nextId = 'PL' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return view('admin.pelanggaran.create', compact('kategoriOptions', 'nextId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pelanggaran' => 'required|in:Keterlambatan,Kehadiran,Kelengkapan Seragam,Kepribadian,Ketertiban,Merokok,Media Konten Negatif,Senjata,MIRAS & NARKOBA,Perkelahian,Etika & Moral,Perjudian',
            'jenis_kegiatan'       => 'required|string|max:255',
            'tingkatan'            => 'required|in:ringan,sedang,berat',
            'poin_pelanggaran'     => 'required|integer',
        ]);

        $last = Pelanggaran::latest('id_pelanggaran')->first();
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
            ->with('success', 'Data pelanggaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::findOrFail($id);
        $kategoriOptions = [
            'Keterlambatan',
            'Kehadiran',
            'Kelengkapan Seragam',
            'Kepribadian',
            'Ketertiban',
            'Merokok',
            'Media Konten Negatif',
            'Senjata',
            'MIRAS & NARKOBA',
            'Perkelahian',
            'Etika & Moral',
            'Perjudian'
        ];
        return view('admin.pelanggaran.edit', compact('pelanggaran', 'kategoriOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_pelanggaran' => 'required|in:Keterlambatan,Kehadiran,Kelengkapan Seragam,Kepribadian,Ketertiban,Merokok,Media Konten Negatif,Senjata,MIRAS & NARKOBA,Perkelahian,Etika & Moral,Perjudian',
            'jenis_kegiatan'       => 'required|string|max:255',
            'tingkatan'            => 'required|in:ringan,sedang,berat',
            'poin_pelanggaran'     => 'required|integer',
        ]);

        $pelanggaran = Pelanggaran::findOrFail($id);
        $pelanggaran->update($request->all());

        return redirect()->route('admin.pelanggaran.index')
            ->with('success', 'Data pelanggaran berhasil diupdate');
    }

    public function destroy($id)
    {
        Pelanggaran::findOrFail($id)->delete();
        return back()->with('success', 'Data pelanggaran berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('file'), 'r');
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            Pelanggaran::create([
                'id_pelanggaran'       => $row[0],
                'kategori_pelanggaran' => $row[1],
                'jenis_kegiatan'       => $row[2],
                'tingkatan'            => $row[3],
                'poin_pelanggaran'     => $row[4],
            ]);
        }

        fclose($file);

        return redirect()->back()->with('success', 'Data pelanggaran berhasil diimport');
    }

}
