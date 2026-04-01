@extends('gurubk.layouts.app')

@section('title', 'Akumulasi Poin Siswa')

@section('content')
<style>

    :root {
        --navy-pekat: #1A374D;
        --soft-indigo: #f0f1ff; --indigo-text: #5d5fef;
        --soft-red: #fff5f5; --red-text: #ff4757;
        --soft-teal: #e6fffa; --teal-text: #38b2ac;
        --soft-orange: #fffaf0; --orange-text: #dd6b20;
    }
    .table-container, .table-responsive, .card, .row, [class*="col-"] {
        overflow: visible !important;
        z-index: auto !important;
    }
    .modal-backdrop.show { backdrop-filter: blur(8px); background: rgba(0,0,0,0.4); }
    .modal-content { border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
    .modal-detail-label { font-size: 11px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-bottom: 2px; }
    .modal-detail-value { font-size: 14px; color: #1e293b; font-weight: 700; margin-bottom: 15px; }
    .btn-xs-soft {
        padding: 6px 14px; font-size: 0.75rem; border-radius: 50px;
        font-weight: 600; display: inline-flex; align-items: center;
        gap: 8px; transition: all 0.2s; border: 1px solid transparent;
    }
    .btn-soft-primary { background-color: #eef2ff; color: var(--indigo-text); border-color: #dbe0ff; }
    
    .btn-soft-danger { background-color: #fff0f0; color: #e55039; border-color: #ffcccc; }
    .btn-soft-danger:hover { background-color: var(--red-text); color: white; }
    
    .btn-locked { background-color: #f1f5f9; color: #94a3b8; cursor: not-allowed; border-color: #e2e8f0; pointer-events: none; }

    .pulse-urgent { animation: pulse-red 2s infinite; }
    @keyframes pulse-red {
        0% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(255, 71, 87, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0); }
    }
    .table-custom { font-size: 0.85rem; }
    .header-subtitle { font-size: 13px; color: #71717a; margin-bottom: 25px; }
</style>

<div class="mb-4">
    <h4 class="header-title fw-bold mb-1" style="color: var(--navy-pekat);">Akumulasi Poin Siswa</h4>
    <p class="header-subtitle">Rekapitulasi total poin pelanggaran untuk menentukan tindakan pembinaan atau penerbitan E-SP.</p>
</div>

<div class="row mb-4 g-3">
    <div class="col-md-7">
        <div class="row g-3 h-100">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 20px;">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <small class="fw-bold text-uppercase text-muted" style="font-size: 0.65rem;">Siswa Melanggar</small>
                            <h2 class="fw-bold mb-0 mt-1" style="color: var(--navy-pekat);">{{ $totalSiswaMelanggar }}</h2>
                        </div>
                        <i class="bi bi-person-exclamation fs-1 text-warning opacity-75"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 bg-white h-100" style="border-radius: 20px;">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <small class="fw-bold text-uppercase text-muted" style="font-size: 0.65rem;">Zona Merah (Poin 50+)</small>
                            <h2 class="fw-bold mb-0 mt-1" style="color: var(--red-text);">
                                {{ $siswaList->where('total_poin', '>=', 50)->count() }}
                            </h2>
                        </div>
                        <i class="bi bi-exclamation-triangle-fill fs-1 text-danger opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-3 bg-white h-100" style="border-radius: 20px; border-left: 5px solid var(--navy-pekat) !important;">
            <h6 class="fw-bold mb-2" style="font-size: 0.8rem; color: var(--navy-pekat);">
                <i class="bi bi-info-circle-fill me-1"></i> Syarat Pembuatan E-SP
            </h6>
            <div class="d-flex flex-column gap-2">
                <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded-3 border">
                    <span class="small fw-semibold text-secondary">50 - 74 Poin</span>
                    <span class="badge bg-info text-white" style="font-size: 0.6rem;">SP 1</span>
                </div>
                <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded-3 border">
                    <span class="small fw-semibold text-secondary">75 - 79 Poin</span>
                    <span class="badge bg-warning text-dark" style="font-size: 0.6rem;">SP 2</span>
                </div>
                <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded-3 border">
                    <span class="small fw-semibold text-secondary">80+ Poin</span>
                    <span class="badge bg-danger text-white" style="font-size: 0.6rem;">SP 3</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="table-container shadow-sm p-4 bg-white" style="border-radius: 20px;">
    <form action="{{ route('gurubk.riwayatpelanggaran.akumulasi') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control rounded-pill border-0 bg-light px-4" placeholder="Cari nama atau NISN..." value="{{ request('search') }}" style="font-size: 0.85rem;">
        </div>
        <div class="col-md-4">
            <select name="id_kelas" class="form-select rounded-pill border-0 bg-light px-4" onchange="this.form.submit()" style="font-size: 0.85rem;">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-custom align-middle text-center table-hover">
            <thead>
                <tr class="border-bottom text-muted small uppercase">
                    <th class="py-3 text-start ps-4">Siswa</th>
                    <th class="py-3">Poin</th>
                    <th class="py-3">Rekomendasi</th>
                    <th class="py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswaList as $s)
                @if($s->total_poin > 0) 
                <tr class="border-transparent">
                    <td class="text-start ps-4">
                        <div class="fw-bold text-dark">{{ $s->nama_siswa }}</div>
                        <small class="text-muted">{{ $s->NISN }} | {{ $s->kelas->nama_lengkap }}</small>
                    </td>
                    <td>
                        <span class="badge {{ $s->total_poin >= 50 ? 'bg-soft-red text-danger' : 'bg-light text-dark' }} rounded-pill px-3 py-2 fw-bold">
                            {{ $s->total_poin }}
                        </span>
                    </td>
                    <td>
                        @if($s->total_poin >= 80)
                            <span class="badge bg-danger text-white px-3 py-2">WAJIB SP 3</span>
                        @elseif($s->total_poin >= 75)
                            <span class="badge bg-warning text-dark px-3 py-2">KIRIM SP 2</span>
                        @elseif($s->total_poin >= 50)
                            <span class="badge bg-info text-white px-3 py-2">KIRIM SP 1</span>
                        @else
                            <span class="text-muted small">Pembinaan Berkala</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">

                            <button type="button" 
   class="btn btn-xs-soft btn-soft-primary" 
    data-bs-toggle="modal" 
    data-bs-target="#modalDetailPelanggaran"
    data-siswa="{{ $s->nama_siswa }}"
    data-kelas="{{ $s->kelas->nama_kelas ?? '-' }} {{ $s->kelas->jurusan ?? '' }}"
    data-poin="{{ $s->total_poin }}"
    data-riwayat="{{ json_encode($s->riwayatPelanggaran->map(function($r) {
        return [
            'tanggal' => \Carbon\Carbon::parse($r->tanggal_kejadian)->format('d/m/Y'),
            'jenis' => $r->pelanggaran->jenis_kegiatan ?? 'Pelanggaran',
            'poin' => $r->poin
        ];
    })) }}">
    <i class="bi bi-search"></i> Detail
</button>
                            @if($s->total_poin >= 50)
                                <a href="{{ route('gurubk.e_surat.index', ['id_siswa' => $s->id_siswa]) }}" 
                                   class="btn btn-xs-soft btn-soft-danger {{ $s->total_poin >= 50 ? 'pulse-urgent' : '' }}">
                                    <i class="bi bi-file-earmark-plus"></i> E-SP
                                </a>
                            @else
                                <button class="btn btn-xs-soft btn-locked" title="Poin belum cukup untuk SP">
                                    <i class="bi bi-lock-fill"></i> E-SP
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalDetailPelanggaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Riwayat Akumulasi Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <div class="row mb-4 bg-light p-3 rounded-4 mx-0 border">
                    <div class="col-md-5">
                        <div class="modal-detail-label">Nama Lengkap</div>
                        <div class="modal-detail-value" id="md-siswa">-</div>
                    </div>
                    <div class="col-md-4">
                        <div class="modal-detail-label">Kelas / Jurusan</div>
                        <div class="modal-detail-value" id="md-kelas">-</div>
                    </div>
                    <div class="col-md-3">
                        <div class="modal-detail-label">Total Poin</div>
                        <div class="modal-detail-value fs-5 text-danger fw-bold" id="md-poin">-</div>
                    </div>
                </div>

                <div class="modal-detail-label mb-3 ps-1">Rincian Pelanggaran Tercatat</div>
                <div class="table-responsive" style="max-height: 350px;">
                    <table class="table table-hover align-middle border-top">
                        <thead class="bg-light sticky-top">
                            <tr class="text-muted small uppercase" style="font-size: 10px; letter-spacing: 1px;">
                                <th class="ps-3 py-3">Waktu</th>
                                <th class="py-3 text-start">Jenis Pelanggaran</th>
                                <th class="py-3 text-center">Poin</th>
                            </tr>
                        </thead>
                        <tbody id="md-tabel-riwayat" style="font-size: 13px;">
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalEl = document.getElementById('modalDetailPelanggaran');

    if (modalEl) {
        // Pindahkan modal ke body agar tidak tertutup backdrop/blur
        document.body.appendChild(modalEl);
        
        const modalBs = new bootstrap.Modal(modalEl);

        document.addEventListener('click', function(e) {
            // DISESUAIKAN: Mencari class 'btn-soft-primary' sesuai tombol di HTML Anda
            const btn = e.target.closest('.btn-soft-primary'); 
            
            // Pastikan yang diklik adalah tombol detail, bukan tombol E-SP
            if (!btn || !btn.hasAttribute('data-riwayat')) return;

            e.preventDefault();

            // 1. Ambil data dari atribut data-
            const nama = btn.getAttribute('data-siswa');
            const kelas = btn.getAttribute('data-kelas');
            const poin = btn.getAttribute('data-poin');
            const riwayatRaw = btn.getAttribute('data-riwayat');

            // 2. Masukkan ke elemen modal
            document.getElementById('md-siswa').innerText = nama;
            document.getElementById('md-kelas').innerText = kelas;
            document.getElementById('md-poin').innerText = poin + " Poin";

            // 3. Render tabel riwayat
            let html = '';
            try {
                const riwayat = JSON.parse(riwayatRaw || "[]");
                if (riwayat.length > 0) {
                    riwayat.forEach(item => {
                        html += `
                            <tr>
                                <td class="ps-3 text-muted">${item.tanggal}</td>
                                <td class="text-start fw-semibold text-dark">${item.jenis}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-danger fw-bold" style="font-size: 11px; padding: 4px 8px; border-radius: 5px;">
                                        +${item.poin}
                                    </span>
                                </td>
                            </tr>`;
                    });
                } else {
                    html = '<tr><td colspan="3" class="text-center py-4 text-muted small">Belum ada riwayat pelanggaran.</td></tr>';
                }
            } catch (err) {
                console.error("Parsing error:", err);
                html = '<tr><td colspan="3" class="text-center text-danger py-4 small">Gagal memuat rincian data.</td></tr>';
            }

            document.getElementById('md-tabel-riwayat').innerHTML = html;

            // 4. Tampilkan modal secara manual
            modalBs.show();
        });
    }
});
</script>
@endsection