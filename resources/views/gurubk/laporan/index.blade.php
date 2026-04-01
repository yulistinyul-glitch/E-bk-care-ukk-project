@extends('gurubk.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    
    /* TABLE INDEX STYLE */
    .header-title { font-size: 24px; font-weight: 800; color: #333; }
    .header-subtitle { font-size: 13px; color: #888; margin-top: 5px; display: block; }
    .btn-create { background:#5d5fef; color:white; padding:8px 18px; border-radius:10px; font-weight:600; font-size:13px; border:none; transition:.3s; cursor: pointer; }
    .btn-create:hover { transform:translateY(-2px); box-shadow: 0 5px 15px rgba(93, 95, 239, 0.3); color: white; }
    
    .main-wrapper { background:white; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,.03); margin-top: 20px; border: 1px solid #f1f1f1; }
    .table-container { padding: 20px; }
    .table thead th { background:#f8fafc; border:none; font-size:11px; color:#888; font-weight:700; padding:12px; text-transform: uppercase; }
    .table tbody td { font-size:12px; padding:14px 12px; border-bottom:1px solid #f8fafc; color: #4a5568; }

    /* MODAL FINAL BALANCE */
    .modal-content { border-radius: 20px; border: none; overflow: hidden; }
    .modal-dialog { max-width: 450px; }
    .card-header-modal { background: white; padding: 20px 25px; border-bottom: 1px solid #f8fafc; }
    .card-header-modal h6 { font-size: 16px; font-weight: 700; margin: 0; color: #333; }
    
    .alert-soft-primary { background-color: #eef2ff; color: #4338ca; border: none; border-radius: 12px; font-size: 12px; padding: 15px; line-height: 1.5; }
    
    /* Input Container Fixed */
    .custom-input-wrap {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        display: flex;
        align-items: center;
        background: #f8fafc;
        padding: 0 15px;
        height: 50px;
        transition: 0.3s;
    }
    .custom-input-wrap:focus-within { border-color: #5d5fef; background: white; box-shadow: 0 0 0 4px rgba(93, 95, 239, 0.1); }
    .custom-input-wrap i { color: #94a3b8; font-size: 18px; margin-right: 12px; }
    .custom-input-wrap input[type="month"] {
        border: none;
        background: transparent;
        font-family: 'Poppins', sans-serif;
        font-size: 14px !important;
        font-weight: 600;
        color: #334155;
        width: 100%;
        outline: none;
        height: 100%;
        cursor: pointer;
    }

    /* Balanced Modal Buttons */
    .btn-modal-action {
        height: 48px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
        border: none;
        width: 100%;
    }
    .btn-cancel { background: #f1f5f9; color: #64748b; }
    .btn-cancel:hover { background: #e2e8f0; color: #475569; }
    
    .btn-save { background: #5d5fef; color: white; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.2); }
    .btn-save:hover { background: #4e50d9; transform: translateY(-1px); box-shadow: 0 6px 15px rgba(93, 95, 239, 0.3); color: white; }

    /* Action & Status Buttons */
    .btn-action-small { padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; border: none; }
    .btn-preview { background: #fff5f5; color: #c53030; border: 1px solid #feb2b2; }
    .status-badge { padding:4px 10px; border-radius:6px; font-size:10px; font-weight:700; background:#e3f2fd; color:#1976d2; }
</style>

<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">Laporan Bulanan</h4>
            <span class="header-subtitle">Rekapitulasi data otomatis berdasarkan periode bulan.</span>
        </div>
        <button type="button" class="btn-create shadow-sm" data-bs-toggle="modal" data-bs-target="#modalLaporan">
            <i class="bi bi-plus-lg me-1"></i> Buat Laporan Baru
        </button>
    </div>

    <div class="main-wrapper shadow-sm">
        <div class="table-container text-center">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-start">Periode Laporan</th>
                            <th>Pelanggaran</th>
                            <th>Saran</th>
                            <th>Self Report</th>
                            <th>Konseling</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $index => $l)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start">
                                <span class="fw-bold text-dark" style="font-size: 13px;">{{ \Carbon\Carbon::parse($l->bulan)->translatedFormat('F Y') }}</span>
                                <br><small class="text-muted" style="font-size: 10px;">Dibuat: {{ $l->created_at->translatedFormat('d F Y') }}</small>
                            </td>
                            <td><span class="fw-bold">{{ $l->total_pelanggaran }}</span></td>
                            <td><span class="fw-bold">{{ $l->total_saran }}</span></td>
                            <td><span class="fw-bold">{{ $l->total_selfreport }}</span></td>
                            <td><span class="fw-bold">{{ $l->total_konseling }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ url('/gurubk/laporan/cetak/' . $l->id) }}" class="btn-action-small btn-preview" target="_blank">
                                        <i class="bi bi-file-earmark-pdf"></i> PDF
                                    </a>
                                    @if($l->status == 'terkirim')
                                        <span class="status-badge"><i class="bi bi-check-all"></i> Terkirim</span>
                                    @else
                                        <form action="{{ route('gurubk.laporan.kirim', $l->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn-action-small px-3" style="background: #5bcb65; color: white;"><i class="bi bi-send-fill"></i> Kirim</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="py-5 text-muted small">Belum ada data laporan tersedia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            
            <div class="card-header-modal d-flex justify-content-between align-items-center">
                <h6><i class="bi bi-file-earmark-plus-fill text-primary me-2"></i>Buat Laporan Baru</h6>
            </div>

            <div class="modal-body p-4">
                <div class="alert alert-soft-primary mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Sistem akan merangkum semua aktivitas konseling dan pelanggaran pada bulan yang dipilih.
                </div>

                <form action="{{ route('gurubk.laporan.store') }}" method="POST" id="formLaporan">
                    @csrf 
                    
                    <div class="mb-4">
                        <label class="fw-bold text-dark mb-2" style="font-size: 12px; letter-spacing: 0.5px;">PILIH BULAN & TAHUN</label>
                        <div class="custom-input-wrap">
                            <i class="bi bi-calendar-event"></i>
                            <input type="month" name="bulan" id="bulan" value="{{ date('Y-m') }}" required>
                        </div>
                        <p class="text-muted mt-3 mb-0" style="font-size: 10px; line-height: 1.6;">
                        * Pastikan semua data pada bulan tersebut sudah di-input dengan benar sebelum menekan tombol generate.
                        </p>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" class="btn-modal-action btn-cancel" data-bs-dismiss="modal">
                                <i class="bi-box-arrow-left me-2"></i> Batal
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn-modal-action btn-save" id="btnSubmit">
                                <i class="bi bi-gear-wide-connected me-2"></i> Generate
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Pindahkan modal ke luar body agar tidak blur/terpotong
    document.addEventListener("DOMContentLoaded", function() {
        var modalElement = document.getElementById('modalLaporan');
        if(modalElement) document.body.appendChild(modalElement);
    });

    document.getElementById('formLaporan').addEventListener('submit', function() {
        let btn = document.getElementById('btnSubmit');
        btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;
        btn.classList.add('disabled');
    });
</script>
@endsection