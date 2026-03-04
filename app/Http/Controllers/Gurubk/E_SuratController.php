<?php

namespace App\Http\Controllers\Gurubk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Siswa, Gurubk, TemplateSurat, ESurat};
use App\Mail\LaporanBKMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class E_SuratController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $siswa = Siswa::with(['kelas.walikelas'])->get();
        $gurubk = Gurubk::all(); 
        $template = TemplateSurat::all();
        
        $surat = ESurat::with(['siswa.kelas.walikelas', 'gurubk'])
                    ->latest()
                    ->paginate(15);

        // Logika Nomor Surat Otomatis
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
            'tanggal_terbit' => 'required|date',
            'keterangan_tambahan' => 'required',
            'nama_walikelas_input' => 'required', 
        ]);

        Carbon::setLocale('id');

        $dataSiswa = Siswa::with(['kelas.walikelas'])->where('id_siswa', $request->id_siswa)->firstOrFail();
        
        // Ambil Guru BK pertama jika tidak dipilih eksplisit (atau sesuaikan logic Anda)
        $dataGuruBK = Gurubk::firstOrFail(); 
        $dataTemplate = TemplateSurat::where('id_template', $request->id_template)->firstOrFail();

        $templatePath = storage_path('app/public/template_surats/' . $dataTemplate->file);
        
        if (!File::exists($templatePath)) {
            return redirect()->back()->with('error', 'File template dokumen tidak ditemukan di server.');
        }

        // 1. GENERATE WORD
        $processor = new TemplateProcessor($templatePath);
        $processor->setValue('nomor_surat_resmi', $request->nomor_surat_resmi);
        $processor->setValue('nama_siswa', $dataSiswa->nama_siswa);
        $processor->setValue('nipd', $dataSiswa->NIPD);
        $processor->setValue('kelas', $dataSiswa->kelas->nama_lengkap ?? '-');
        
        $tanggalIndo = Carbon::parse($request->tanggal_terbit)->translatedFormat('d F Y');
        $processor->setValue('tanggal', $tanggalIndo);
        $processor->setValue('keterangan', $request->keterangan_tambahan);
        $processor->setValue('nama_guru', $dataGuruBK->nama_gurubk);
        $processor->setValue('walikelas', $request->nama_walikelas_input);

        $fileName = 'SP_' . $dataSiswa->NIPD . '_' . time() . '.docx';
        $directory = storage_path('app/public/generated_surats');
        
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $processor->saveAs($directory . '/' . $fileName);

        // 2. SIMPAN DATABASE
        ESurat::create([
            'id_surat' => 'SR' . str_pad(ESurat::count() + 1, 4, '0', STR_PAD_LEFT),
            'nomor_surat_resmi' => $request->nomor_surat_resmi,
            'id_siswa' => $request->id_siswa,
            'id_gurubk' => $dataGuruBK->id_gurubk,
            'id_template' => $request->id_template,
            'tanggal_terbit' => $request->tanggal_terbit,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'file_generate' => $fileName,
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Surat Berhasil Dibuat (Status: Draft)');
    }

    public function print_pdf($id)
    {
        $surat = ESurat::where('id_surat', $id)->firstOrFail();
        $wordPath = storage_path('app/public/generated_surats/' . $surat->file_generate);
        $outDir = storage_path('app/public/generated_surats');
        $pdfName = str_replace('.docx', '.pdf', $surat->file_generate);
        $pdfPath = $outDir . '/' . $pdfName;

        if (!File::exists($wordPath)) {
            return redirect()->back()->with('error', 'File Word asal tidak ditemukan.');
        }

        if (!File::exists($pdfPath)) {
            $libreOfficePath = '"C:\Program Files\LibreOffice\program\soffice.exe"';
            $shellCommand = "$libreOfficePath --headless --convert-to pdf --outdir " . escapeshellarg($outDir) . " " . escapeshellarg($wordPath);
            shell_exec($shellCommand);
        }

        if ($surat->status == 'draft') {
            $surat->update(['status' => 'cetak_pdf']);
        }

        return view('gurubk.e_surat.preview', compact('surat', 'pdfName'));
    }

public function send_email($id)
{
    // 1. Ambil data surat beserta relasi wali kelas
    $surat = ESurat::with(['siswa.kelas.walikelas'])->where('id_surat', $id)->firstOrFail();
    $emailWali = $surat->siswa->kelas->walikelas->email ?? null;

    if (!$emailWali) {
        return redirect()->back()->with('error', 'Gagal! Email Wali Kelas tidak ditemukan di database.');
    }

    // 2. Tentukan path PDF (Mengonversi nama file .docx ke .pdf)
    $fileNamePdf = str_replace('.docx', '.pdf', $surat->file_generate);
    $pdfPath = storage_path('app/public/generated_surats/' . $fileNamePdf);

    // 3. Cek fisik file PDF sebelum lanjut
    if (!File::exists($pdfPath)) {
        return redirect()->back()->with('error', 'File PDF tidak ditemukan di folder penyimpanan.');
    }

    // 4. Bungkus data untuk Mailable
    $rincian = [
        'subjek'   => 'Pemberitahuan SP: ' . $surat->siswa->nama_siswa,
        'surat'    => $surat,
        'pdf_path' => $pdfPath,
        'nama_file'=> 'Surat_Peringatan_' . $surat->siswa->nama_siswa . '.pdf'
    ];

    try {
        // 5. Kirim Email
        Mail::to($emailWali)->send(new LaporanBKMail($rincian));

        // 6. Update status ke 'sent'
        $surat->update(['status' => 'sent']);

        return redirect()->route('gurubk.e_surat.index')
                         ->with('success', 'Surat Berhasil Dikirim ke Wali Kelas (' . $emailWali . ')');

    } catch (\Exception $e) {
        // Jika ada kesalahan SMTP atau jaringan
        return redirect()->back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
    }
}
}