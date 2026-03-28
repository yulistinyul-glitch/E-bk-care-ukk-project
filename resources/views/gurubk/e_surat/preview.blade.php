<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview SP - {{ $surat->nomor_surat_resmi }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { 
            background-color: #0f172a; 
            font-family: 'Poppins', sans-serif; 
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        .preview-navbar {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 15px 30px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 75px;
            z-index: 9999999 !important; 
            display: flex;
            align-items: center;
        }

        .btn-back {
            background: rgba(255,255,255,0.15);
            color: white !important;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 10px 25px;
            transition: 0.3s;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer !important;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            position: relative;
            z-index: 10000000 !important;
        }
        
        .btn-back:hover { 
            background: rgba(255,255,255,0.3); 
            transform: translateY(-1px);
            color: white !important;
        }

        .preview-body {
            display: flex;
            flex: 1;
            padding: 20px;
            gap: 20px;
            margin-top: 75px;
            height: calc(100vh - 75px);
            box-sizing: border-box;
            overflow: hidden;
        }

        .info-card {
            width: 350px;
            background: white;
            border-radius: 20px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            height: 100%;
        }

        .info-content-scroll {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 15px;
            padding-right: 5px;
        }

        .info-content-scroll::-webkit-scrollbar { width: 5px; }
        .info-content-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        .pdf-container {
            flex: 1;
            background: #334155;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            height: 100%;
        }

        iframe { width: 100%; height: 100%; border: none; }
        
        .info-label { font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 2px; }
        .info-value { font-size: 14px; color: #1e293b; font-weight: 600; margin-bottom: 20px; word-wrap: break-word; }
        .badge-status { padding: 8px 15px; border-radius: 8px; font-size: 12px; font-weight: 600; }
        
        .footer-card {
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <nav class="preview-navbar justify-content-between">
        <div class="d-flex align-items-center">
            <a href="{{ route('gurubk.e_surat.index') }}" class="btn-back me-3">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
            <div class="text-white">
                <h6 class="mb-0 fw-bold">Preview Dokumen Digital</h6>
                <small class="text-white-50">{{ $surat->nomor_surat_resmi }}</small>
            </div>
        </div>
        
        <div>
            @if($surat->status == 'sent')
                <span class="badge bg-success badge-status"><i class="bi bi-send-check me-1"></i> Terkirim Ke Wali Kelas</span>
            @else
                <span class="badge bg-warning text-dark badge-status"><i class="bi bi-file-earmark-text me-1"></i> Status: {{ strtoupper($surat->status) }}</span>
            @endif
        </div>
    </nav>

    <div class="preview-body">
        <div class="info-card">
            <h6 class="fw-bold mb-4 text-primary"><i class="bi bi-info-circle me-2"></i>Detail Surat</h6>
            
            <div class="info-content-scroll">
                <label class="info-label">Nama Siswa</label>
                <p class="info-value">{{ $surat->siswa->nama_siswa }}</p>

                <label class="info-label">NIPD / Kelas</label>
                <p class="info-value">{{ $surat->siswa->NIPD }} / {{ $surat->siswa->kelas->nama_lengkap ?? '-' }}</p>

                <label class="info-label">Keterangan Pelanggaran</label>
                <p class="info-value text-muted" style="font-weight: 400; line-height: 1.6; margin-bottom: 0;">
                    {{ $surat->keterangan_tambahan }}
                </p>
            </div>

            <div class="footer-card">
                <div class="p-3 rounded-4 bg-light border text-center">
                    <i class="bi bi-shield-check text-success fs-3 mb-2 d-block"></i>
                    <small class="text-muted d-block mb-1" style="font-size: 11px;">Diterbitkan pada:</small>
                    <p class="mb-2 fw-bold text-dark" style="font-size: 13px;">{{ \Carbon\Carbon::parse($surat->tanggal_terbit)->translatedFormat('d F Y') }}</p>
                    
                    <hr class="my-2 opacity-5">
                    
                    <small class="text-muted d-block" style="font-size: 10px;">E-BK Care System</small>
                </div>
            </div>
        </div>

        <div class="pdf-container">
            @php
                $pdfFileName = str_replace('.docx', '.pdf', $surat->file_generate);
                $pdfUrl = asset('storage/generated_surats/' . $pdfFileName);
            @endphp
            <iframe src="{{ $pdfUrl }}#toolbar=0"></iframe>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>