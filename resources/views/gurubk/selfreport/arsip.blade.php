@extends('gurubk.layouts.app')

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold mb-0">S - Report</h2>

        <div class="d-flex gap-3">
            <a href="{{ route('gurubk.selfreport.index') }}"
               class="btn-switch">
                Kotak Masuk
            </a>

            <a href="{{ route('gurubk.selfreport.arsip') }}"
               class="btn-switch active-btn">
                Arsip Laporan
            </a>
        </div>
    </div>
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Verifikasi</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td class="fw-semibold">#{{ $report->id }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($report->updated_at)->format('d F Y') }}
                                </td>

                                <td>{{ $report->kategori }}</td>

                                <td>
                                    @if($report->status_verifikasi == 'disetujui')
                                        <span class="status-badge success">
                                            Disetujui
                                        </span>
                                    @elseif($report->status_verifikasi == 'ditolak')
                                        <span class="status-badge danger">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('gurubk.selfreport.show', $report->id) }}"
                                       class="btn-detail">
                                        👁 Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    Belum ada laporan arsip
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

.custom-table thead {
    background-color: #f8f9ff;
    font-weight: 600;
}

.custom-table th {
    padding: 16px;
    color: #555;
    font-size: 14px;
}

.custom-table td {
    padding: 16px;
    font-size: 14px;
}

.btn-switch {
    background-color: #eef0ff;
    color: #5d5fef;
    padding: 10px 24px;
    border-radius: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.btn-switch:hover {
    background-color: #dcdcff;
}

.active-btn {
    background-color: #5d5fef;
    color: white !important;
    box-shadow: 0 6px 18px rgba(93, 95, 239, 0.35);
}

.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.success {
    background-color: #e6f9f0;
    color: #1ca86a;
}

.status-badge.danger {
    background-color: #ffeaea;
    color: #e74c3c;
}

.btn-detail {
    background-color: #5d5fef;
    color: white;
    padding: 6px 16px;
    border-radius: 8px;
    font-size: 13px;
    text-decoration: none;
    transition: 0.3s;
}

.btn-detail:hover {
    background-color: #4a4cd9;
    color: white;
}

</style>

@endsection
