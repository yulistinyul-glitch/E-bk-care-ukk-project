<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Chat, CounselingRequest, Siswa, Gurubk, TemplateSurat, ESurat, KotakSurats};
use App\Mail\LaporanBKMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class E_SuratController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $siswa = Siswa::with(['kelas.walikelas'])->get();
        $gurubk = Gurubk::all(); 
        $template = TemplateSurat::all();
        
        $surat = ESurat::with(['siswa.kelas.walikelas', 'gurubk'])->latest()->paginate(15);

        // Nomor Surat Otomatis (Format: 001/BK/III/2026)
        $lastSurat = ESurat::whereYear('created_at', date('Y'))->latest()->first();
        $nextNumber = $lastSurat ? ((int)explode('/', $lastSurat->nomor_surat_resmi)[0] + 1) : 1;
        
        $romawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $nomorOtomatis = str_pad($nextNumber, 3, '0', STR_PAD_LEFT) . "/BK/" . $romawi[date('n')] . "/" . date('Y');

        return view('gurubk.e_surat.index', compact('siswa', 'gurubk', 'template', 'surat', 'nomorOtomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'id_template' => 'required',
            'nomor_surat_resmi' => 'required',
            'keterangan_tambahan' => 'required',
            'nama_walikelas_input' => 'required', 
        ]);

        Carbon::setLocale('id');
        $dataSiswa = Siswa::with(['kelas.walikelas'])->where('id_siswa', $request->id_siswa)->firstOrFail();
        $dataTemplate = TemplateSurat::where('id_template', $request->id_template)->firstOrFail();
        
        // Ambil ID Guru BK
        $idGurubk = $request->id_gurubk ?? Gurubk::first()->id_gurubk;
        $dataGuruBK = Gurubk::where('id_gurubk', $idGurubk)->first();

        $templatePath = storage_path('app/public/template_surats/' . $dataTemplate->file);
        if (!File::exists($templatePath)) {
            return redirect()->back()->with('error', 'Template tidak ditemukan.');
        }

        // 1. GENERATE WORD
        $processor = new TemplateProcessor($templatePath);
        $processor->setValue('nomor_surat_resmi', $request->nomor_surat_resmi);
        $processor->setValue('nama_siswa', $dataSiswa->nama_siswa);
        $processor->setValue('nipd', $dataSiswa->NIPD);
        $processor->setValue('kelas', $dataSiswa->kelas->nama_lengkap ?? '-');
        $processor->setValue('tanggal', Carbon::now()->translatedFormat('d F Y'));
        $processor->setValue('keterangan', $request->keterangan_tambahan);
        $processor->setValue('nama_guru', $dataGuruBK->nama_gurubk);
        $processor->setValue('walikelas', $request->nama_walikelas_input);

        $fileName = 'SP_' . $dataSiswa->NIPD . '_' . time() . '.docx';
        $directory = storage_path('app/public/generated_surats');
        
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $processor->saveAs($directory . '/' . $fileName);

        // 2. LOGIKA GENERATE ID SURAT (FIXED: Menghindari Duplicate Entry)
        $lastEntry = ESurat::orderBy('id_surat', 'desc')->first();
        if ($lastEntry) {
            $lastNumber = (int) substr($lastEntry->id_surat, 2);
            $newId = 'SR' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = 'SR0001';
        }

        // 3. SIMPAN DATABASE
        ESurat::create([
            'id_surat' => $newId,
            'nomor_surat_resmi' => $request->nomor_surat_resmi,
            'id_siswa' => $request->id_siswa,
            'id_gurubk' => $idGurubk,
            'id_template' => $request->id_template,
            'tanggal_terbit' => now(),
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'file_generate' => $fileName,
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Surat Berhasil Dibuat!');
    }

   public function print_pdf($id)
{
    $surat = ESurat::with('siswa.kelas')->where('id_surat', $id)->firstOrFail();
    
    $wordFileName = $surat->file_generate; // Contoh: SR0014.docx
    $pdfFileName = str_replace('.docx', '.pdf', $wordFileName);
    
    $wordPath = storage_path('app/public/generated_surats/' . $wordFileName);
    $outDir = storage_path('app/public/generated_surats');
    $pdfPath = $outDir . '/' . $pdfFileName;

    // Jika PDF belum ada, kita panggil mesin LibreOffice
    if (!file_exists($pdfPath)) {
        // Lokasi standar instalasi LibreOffice di Windows
        $libreOfficePath = '"C:\Program Files\LibreOffice\program\soffice.exe"';
        
        // Perintah konversi
        $cmd = "{$libreOfficePath} --headless --convert-to pdf --outdir \"{$outDir}\" \"{$wordPath}\"";
        
        shell_exec($cmd);
    }

    return view('gurubk.e_surat.preview', [
        'surat' => $surat,
        'pdfName' => $pdfFileName
    ]);
}
    public function stream_pdf($filename)
{
    $path = storage_path('app/public/generated_surats/' . $filename);
    
    if (!file_exists($path)) {
        abort(404, "File PDF belum ter-generate. Pastikan LibreOffice terinstal.");
    }

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'X-Frame-Options' => 'ALLOW-FROM *'
    ]);
}

    public function send_email($id)
    {
        $surat = ESurat::with(['siswa.kelas.walikelas'])->where('id_surat', $id)->firstOrFail();
        $emailWali = $surat->siswa->kelas->walikelas->email ?? null;

        if (!$emailWali) {
            return redirect()->back()->with('error', 'Gagal! Email Wali Kelas tidak ditemukan.');
        }

        $fileNamePdf = str_replace('.docx', '.pdf', $surat->file_generate);
        $pdfPath = storage_path('app/public/generated_surats/' . $fileNamePdf);

        if (!File::exists($pdfPath)) {
            return redirect()->back()->with('error', 'File PDF belum di-generate. Silakan klik Cetak PDF terlebih dahulu.');
        }

        $rincian = [
            'subjek'   => 'Pemberitahuan SP: ' . $surat->siswa->nama_siswa,
            'surat'    => $surat,
            'pdf_path' => $pdfPath,
            'nama_file'=> 'Surat_Peringatan_' . $surat->siswa->nama_siswa . '.pdf'
        ];

        try {
            Mail::to($emailWali)->send(new LaporanBKMail($rincian));

            $surat->update(['status' => 'sent']);

            // Simpan ke Kotak Surat Siswa
            KotakSurats::create([
                'id_siswa' => $surat->id_siswa,
                'judul' => 'Surat Peringatan Baru: ' . $surat->nomor_surat_resmi,
                'pesan' => "Pemberitahuan resmi mengenai: " . $surat->keterangan_tambahan,
                'file_pdf' => $fileNamePdf,
                'is_read' => false,
            ]);

            // Kirim Notifikasi via Chat Konseling (jika ada)
            $konseling = CounselingRequest::where('id_siswa', $surat->id_siswa)
                                           ->whereIn('status', ['ongoing', 'accepted'])
                                           ->first();
            if ($konseling) {
                Chat::create([
                    'konseling_id' => $konseling->id,
                    'sender_type' => 'gurubk',
                    'message' => "🤖 [BOT ALERT]: Halo, surat SP ({$surat->nomor_surat_resmi}) telah dikirim ke wali kelasmu dan tersedia di Kotak Surat. Harap dicek.",
                    'is_read' => false
                ]);
            }

            return redirect()->route('gurubk.e_surat.index')
                             ->with('success', 'Surat Berhasil Dikirim ke Wali Kelas (' . $emailWali . ')');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}