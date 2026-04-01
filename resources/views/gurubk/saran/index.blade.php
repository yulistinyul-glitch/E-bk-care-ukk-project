@extends('gurubk.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Kotak Saran</h4>
            <p class="text-muted small mb-0">Kelola aspirasi dan saran dari siswa secara real-time.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm custom-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase tracking-wider">Tanggal</th>
                            <th>Pengirim</th>
                            <th>Target</th>
                            <th>Pesan</th>
                            <th class="text-center">Status</th>
                            <th class="pe-4 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($saran as $item)
                        <tr>
                            <td class="ps-4">
                                <span class="text-dark fw-medium">{{ $item->created_at->format('d M Y') }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2 bg-soft-primary d-flex align-items-center justify-content-center">
                                        <i class="bi {{ $item->is_anonymous ? 'bi-incognito' : 'bi-person' }}"></i>
                                    </div>
                                    <span class="fw-semibold text-dark">
                                        {{ $item->is_anonymous ? 'Anonim' : ($item->siswa->nama_siswa ?? 'Siswa') }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge-custom bg-soft-target">{{ $item->target }}</span>
                            </td>
                            <td>
                                <div class="text-message-truncate">
                                    {{ $item->message }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->status == 'unread')
                                    <span class="status-indicator bg-unread">Baru</span>
                                @else
                                    <span class="status-indicator bg-read">Dibaca</span>
                                @endif
                            </td>
                            <td class="pe-4">
                                <div class="d-flex gap-2 justify-content-end px-2">
                                   <button class="btn btn-action btn-view" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalDetailSaran"
                                        data-bs-container="body"
                                        data-id="{{ $item->id }}"
                                        data-status="{{ $item->status }}"
                                        data-pesan="{{ $item->message }}"
                                        data-pengirim="{{ $item->is_anonymous ? 'Anonim' : ($item->siswa->nama_siswa ?? 'Siswa') }}"
                                        data-target="{{ $item->target }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    @if($item->status == 'unread')
                                        <form action="{{ route('gurubk.saran.read', $item->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-action btn-check" title="Tandai Sudah Baca">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/empty-states.svg" alt="empty" style="width: 120px;" class="mb-3 opacity-50">
                                <p class="text-muted fw-medium">Belum ada saran yang masuk saat ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<style>
    .custom-card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .tracking-wider {
        letter-spacing: 0.05em;
        font-size: 0.75rem;
        color: #8898aa;
    }

    .table-responsive {
        border-radius: 12px;
    }

    .table thead th {
        border-top: none;
        border-bottom: 1px solid #edf2f9;
        font-weight: 600;
    }

    .table tbody td {
        padding: 1rem 0.5rem;
        font-size: 0.875rem;
        border-bottom: 1px solid #edf2f9;
    }

    .avatar-sm {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-size: 1.1rem;
    }
    .bg-soft-primary { background: #eef2ff; color: #4f46e5; }

    .badge-custom {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .bg-soft-target { background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd; }

    .status-indicator {
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .bg-unread { background: #fee2e2; color: #dc2626; }
    .bg-read { background: #dcfce7; color: #16a34a; }

    .text-message-truncate {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #64748b;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
        border: 1px solid #e2e8f0;
        background: white;
    }
    
    .btn-view { color: #6366f1; }
    .btn-view:hover { background: #6366f1; color: white; border-color: #6366f1; }
    
    .btn-check { color: #10b981; }
    .btn-check:hover { background: #10b981; color: white; border-color: #10b981; }

    @media (max-width: 768px) {
        .text-message-truncate { max-width: 150px; }
        .table { min-width: 800px; }
    }

    #modalDetailSaran {
        border-radius: 20px;
        z-index: 9999 !important;
    }
</style>
@endsection