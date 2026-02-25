
use App\Models\SelfReport;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


Route::post('/receive-report', function (Request $request) {
    // Simpan ke database sesuai struktur tabel mu
    SelfReport::create([
        'id_report'         => 'REP-' . strtoupper(Str::random(5)), 
        'id_gurubk'         => null, 
        'tanggal_lapor'     => now(),
        'kategori_masalah'  => $request->kategori, 
        'isi_laporan'       => $request->kronologi,
        'file'              => $request->bukti,
        'status_verifikasi' => 'menunggu', 
    ]);

    return response()->json(['status' => 'success'], 200);
});