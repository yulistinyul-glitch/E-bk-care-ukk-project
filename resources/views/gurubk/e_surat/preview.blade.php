<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Surat - {{ $surat->nomor_surat_resmi }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .preview-container { max-width: 1000px; margin: 30px auto; }
        .iframe-wrapper { 
            background: white; 
            border-radius: 12px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        iframe { display: block; width: 100%; height: 85vh; border: none; }
        .header-area { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container-fluid preview-container">
    {{-- BAGIAN HEADER --}}
    <div class="header-area d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold text-dark mb-0">
                <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>Preview Dokumen
            </h4>
            <small class="text-muted">Nomor: {{ $surat->nomor_surat_resmi }}</small>
        </div>

        {{-- HANYA TOMBOL KEMBALI --}}
        <a href="{{ route('gurubk.e_surat.index') }}" class="btn btn-dark shadow-sm px-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
        </a>
    </div>

    {{-- AREA PDF --}}
    <div class="iframe-wrapper">
        @php
            $pdfFileName = str_replace('.docx', '.pdf', $surat->file_generate);
            $pdfUrl = asset('storage/generated_surats/' . $pdfFileName);
        @endphp

        <iframe src="{{ $pdfUrl }}">
            Browser Anda tidak mendukung preview PDF. 
            <a href="{{ $pdfUrl }}">Klik di sini untuk mengunduh.</a>
        </iframe>
    </div>

    <div class="text-center mt-3">
        <p class="text-muted x-small">Sistem E-BK &copy; 2026 - Dokumen Terverifikasi</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>