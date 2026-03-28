@extends('gurubk.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f4f7fe; font-family: 'Poppins', sans-serif; }
    .main-wrapper { background: white; border-radius: 20px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,.06) !important; padding: 35px !important; }
    .header-title { font-size: 26px; font-weight: 800; color: #2d3748; letter-spacing: -0.5px; }
    .icon-box { width: 48px; height: 48px; background: #ecfdf5; color: #10b981; display: inline-flex; align-items: center; justify-content: center; border-radius: 14px; margin-right: 15px; font-size: 24px; }
    .form-label-custom { font-size: 13px; font-weight: 600; color: #718096; margin-bottom: 10px; display: block; }
    .form-control-custom { border-radius: 12px; border: 1px solid #e2e8f0; font-size: 14px; padding: 12px 18px; transition: 0.3s; }
    .form-control-custom:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
    .btn-save-green { background: #10b981; color: white; border: none; padding: 12px 28px; border-radius: 12px; font-weight: 600; font-size: 13px; transition: .3s; }
    .btn-save-green:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2); }
    
    .status-badge { padding: 7px 15px; border-radius: 10px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; }
    .status-draft { background: #f7fafc; color: #718096; border: 1px solid #edf2f7; }
    .status-sent { background: #f0fff4; color: #2f855a; border: 1px solid #c6f6d5; }
    .status-print { background: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8; }

    .btn-action { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 38px; padding: 0 20px; border-radius: 50px; font-size: 11px; font-weight: 700; transition: 0.3s; }
    
    /* Search Styling */
    .search-wrapper { position: relative; max-width: 400px; }
    .search-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
    .search-input { padding-left: 45px !important; border-radius: 50px !important; background: #f8fafc !important; border: 1px solid #e2e8f0 !important; }
</style>

<div class="container-fluid py-5 px-5">
    
    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center">
            <div class="icon-box shadow-sm"><i class="bi bi-shield-check"></i></div>
            <h4 class="header-title mb-0">E-Surat Peringatan</h4>
        </div>
        <div class="badge bg-white text-dark border shadow-sm px-4 py-2" style="border-radius: 12px;">
            <i class="bi bi-calendar3 me-2 text-primary"></i>{{ date('d F Y') }}
        </div>
    </div>

    {{-- Form Create --}}
    <div class="main-wrapper mb-5">
        <div class="mb-5 border-start border-5 border-success ps-4">
            <h5 class="fw-bold mb-1 text-navy">Buat Dokumen SP Baru</h5>
            <p class="text-muted small mb-0">Input data pelanggaran untuk generate surat resmi</p>
        </div>

        <form action="{{ route('gurubk.e_surat.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-3">
                    <label class="form-label-custom">Pilih Siswa</label>
                    <select name="id_siswa" id="siswa_select" class="form-select form-control-custom" onchange="isiOtomatis()" required>
                        <option value="">-- Cari Nama --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id_siswa }}" 
                                    data-nipd="{{ $s->NIPD }}" 
                                    data-kelas="{{ $s->kelas->nama_lengkap ?? '-' }}"
                                    data-walikelas="{{ $s->kelas->walikelas->nama_guru ?? 'Belum Set' }}">
                                {{ $s->nama_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label-custom text-primary fw-bold">Jenis Surat Peringatan</label>
                    <select name="id_template" id="template_select" class="form-select form-control-custom border-primary" required>
                        <option value="">-- Pilih Jenis SP --</option>
                        @foreach($template as $t)
                            <option value="{{ $t->id_template }}">
                                {{ $t->nama_template }} ({{ $t->jenis_surat }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label-custom">NIPD</label>
                    <input type="text" id="auto_nipd" class="form-control form-control-custom bg-light border-0" readonly>
                </div>

                <div class="col-md-2">
                    <label class="form-label-custom">Kelas</label>
                    <input type="text" id="auto_kelas" class="form-control form-control-custom bg-light border-0" readonly>
                </div>

                <div class="col-md-2">
                    <label class="form-label-custom">Wali Kelas</label>
                    <input type="text" id="auto_walikelas" class="form-control form-control-custom bg-light border-0 fw-bold" readonly>
                    <input type="hidden" name="nama_walikelas_input" id="hidden_walikelas">
                </div>

                <div class="col-md-3">
                    <label class="form-label-custom text-danger">Nomor Surat Resmi</label>
                    <input type="text" name="nomor_surat_resmi" class="form-control form-control-custom border-danger fw-bold text-center text-danger" value="{{ $nomorOtomatis }}" required>
                </div>

                <div class="col-md-9">
                    <label class="form-label-custom">Alasan / Keterangan Pelanggaran</label>
                    <input type="text" name="keterangan_tambahan" class="form-control form-control-custom" placeholder="Tuliskan alasan pengeluaran SP secara detail..." required>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top">
                <input type="hidden" name="id_gurubk" value="{{ $gurubk->first()->id_gurubk ?? '' }}">
                <input type="hidden" name="tanggal_terbit" value="{{ date('Y-m-d') }}">
                
                <button type="submit" class="btn-save-green">
                    <i class="bi bi-file-earmark-plus me-2"></i>Simpan & Generate Surat
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="main-wrapper">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h5 class="fw-bold mb-0 text-navy"><i class="bi bi-clock-history text-success me-2"></i>Daftar Riwayat SP</h5>
            
            {{-- SEARCH BAR --}}
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" id="tableSearch" class="form-control form-control-custom search-input" placeholder="Cari siswa atau kelas...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle" id="historyTable">
                <thead>
                    <tr>
                        <th class="ps-4">No. Surat</th>
                        <th>Identitas Siswa</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi Operasional</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surat as $item)
                    <tr>
                        <td class="ps-4 fw-bold text-danger">{{ $item->nomor_surat_resmi }}</td>
                        <td class="search-target">
                            <div class="fw-bold name-text">{{ $item->siswa->nama_siswa ?? 'N/A' }}</div>
                            <small class="text-muted class-text">{{ $item->siswa->kelas->nama_lengkap ?? '-' }}</small>
                        </td>
                        <td class="text-center">
                            @if($item->status == 'sent')
                                <span class="status-badge status-sent"><i class="bi bi-send-check-fill"></i> TERKIRIM</span>
                            @elseif($item->status == 'cetak_pdf')
                                <span class="status-badge status-print"><i class="bi bi-printer-fill"></i> PDF READY</span>
                            @else
                                <span class="status-badge status-draft"><i class="bi bi-file-earmark-text"></i> DRAFT</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('gurubk.e_surat.print_pdf', $item->id_surat) }}" class="btn btn-outline-danger btn-action" target="_blank">
                                    <i class="bi bi-printer"></i> VIEW PDF
                                </a>

                                @if($item->status !== 'sent')
                                    @php $emailWali = $item->siswa->kelas->walikelas->email ?? null; @endphp
                                    <form action="{{ route('gurubk.e_surat.send_email', $item->id_surat) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-action" {{ !$emailWali ? 'disabled' : '' }}>
                                            <i class="bi bi-envelope"></i> KIRIM EMAIL
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-action" disabled>
                                        <i class="bi bi-check2-all"></i> SELESAI
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="no-data">
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada riwayat dokumen.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $surat->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi Auto-fill Form
    function isiOtomatis() {
        const select = document.getElementById('siswa_select');
        const opt = select.options[select.selectedIndex];
        if(opt.value) {
            document.getElementById('auto_nipd').value = opt.getAttribute('data-nipd');
            document.getElementById('auto_kelas').value = opt.getAttribute('data-kelas');
            document.getElementById('auto_walikelas').value = opt.getAttribute('data-walikelas');
            document.getElementById('hidden_walikelas').value = opt.getAttribute('data-walikelas');
        } else {
            document.getElementById('auto_nipd').value = "";
            document.getElementById('auto_kelas').value = "";
            document.getElementById('auto_walikelas').value = "";
            document.getElementById('hidden_walikelas').value = "";
        }
    }

    // Fungsi Search Tabel (Live Filtering)
    document.getElementById('tableSearch').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#historyTable tbody tr:not(.no-data)');

        rows.forEach(row => {
            let name = row.querySelector('.name-text').textContent.toLowerCase();
            let className = row.querySelector('.class-text').textContent.toLowerCase();
            
            if (name.includes(filter) || className.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>
@endsection