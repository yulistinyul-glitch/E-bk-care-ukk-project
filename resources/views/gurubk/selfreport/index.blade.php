@extends('gurubk.layouts.app')

@section('title', 'S-Report | Kotak Masuk')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .header-title {
        font-size: 26px;
        font-weight: 700;
        color: #333;
    }

    .btn-switch {
        background-color: #eef0ff;
        color: #5d5fef;
        padding: 10px 22px;
        border-radius: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-switch:hover {
        background-color: #dcdcff;
        color: #4a4cd9;
    }

    .active-btn {
        background-color: #5d5fef;
        color: white !important;
        box-shadow: 0 6px 18px rgba(93, 95, 239, 0.35);
    }

    .report-card {
        background: white;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.03);
        transition: 0.3s;
        cursor: pointer;
        border-left: 5px solid #ffc107;
    }

    .report-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    }

    .empty-state {
        padding: 100px 0;
        text-align: center;
        color: #b5b5b5;
    }

</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

        <h4 class="header-title mb-0">S - Report</h4>

        <div class="d-flex gap-3">
            <a href="{{ route('gurubk.selfreport.index') }}"
               class="btn-switch active-btn">
                Kotak Masuk
                @if($reports->count() > 0)
                    <span class="badge bg-danger ms-2">
                        {{ $reports->count() }}
                    </span>
                @endif
            </a>

            <a href="{{ route('gurubk.selfreport.arsip') }}"
               class="btn-switch">
                Arsip Laporan
            </a>
        </div>

    </div>

    <div class="row">

        @forelse($reports as $report)

            <div class="col-md-4 mb-4">

                <div class="report-card"
                     data-bs-toggle="modal"
                     data-bs-target="#detailModal{{ $report->id_report }}">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-warning text-dark">
                            Menunggu
                        </span>

                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($report->tanggal_lapor)->format('d M Y') }}
                        </small>
                    </div>

                    <h6 class="fw-bold">
                        {{ $report->kategori_masalah }}
                    </h6>

                    <p class="small text-muted mb-0">
                        {{ \Illuminate\Support\Str::limit($report->isi_laporan, 90) }}
                    </p>

                </div>

            </div>   

        @empty

            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-folder2-open" style="font-size: 60px;"></i>
                    <h5 class="mt-4">Belum ada laporan masuk</h5>
                    <p>Laporan dari siswa akan muncul di sini.</p>
                </div>
            </div>

        @endforelse

    </div>

</div>
@foreach ($reports as $report)     
    <div class="modal fade" 
         id="detailModal{{ $report->id_report }}" 
         tabindex="-1" 
         data-bs-backdrop="true" 
         data-bs-focus="false"
         style="z-index: 9999;"> <div class="modal-dialog modal-dialog-centered"> <div class="modal-content rounded-4 border-0 shadow">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">
                        Detail Laporan #{{ $report->id_report }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="text-muted small d-block">Kategori Masalah</label>
                        <h6 class="fw-bold">
                            {{ $report->getRawOriginal('kategori_masalah') ?? 'Kolom tidak ditemukan' }}
                        </h6>
                    </div>
                    
                    <div class="mb-3">
                        <label class="text-muted small d-block">Tanggal Kejadian</label>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($report->tanggal_lapor)->format('d F Y') }}</span>
                    </div>

                    <hr class="text-gray-200">

                    <p class="text-muted small mb-1">Deskripsi Kronologi:</p>
                    <div class="p-3 bg-light rounded-3 text-dark">
                        {{ $report->isi_laporan }}
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0 d-flex gap-2">
                    <form action="{{ route('gurubk.selfreport.verifikasi', $report->id_report) }}" method="POST" class="flex-fill">
                        @csrf
                        <input type="hidden" name="status" value="disetujui">
                        <button type="submit" class="btn btn-success w-100 rounded-3 py-2">
                            ✔ Setujui
                        </button>
                    </form>

                    <form action="{{ route('gurubk.selfreport.verifikasi', $report->id_report) }}" method="POST" class="flex-fill">
                        @csrf
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="btn btn-danger w-100 rounded-3 py-2">
                            ✖ Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- js --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const myModals = document.querySelectorAll('.modal');
        myModals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function () {
                document.body.appendChild(this);
            });
        });
    });
</script>
@endsection
