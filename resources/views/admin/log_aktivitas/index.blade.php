@extends('admin.layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body { background-color: #f5f7fb; font-family: 'Inter', sans-serif; }
    .header-title { font-size: 22px; font-weight: 900; color: #333; }
    .header-subtitle { font-size: 13px; color: #64748b; margin-top: 2px; }
    
    .main-wrapper { 
        background: white; 
        border-radius: 12px; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
        margin-top: 20px;
        padding: 10px;
    }

    .table-custom thead th { 
        background: #f8fafc; 
        font-size: 11px; 
        color: #475569; 
        font-weight: 700; 
        text-transform: uppercase; 
        padding: 15px; 
        border: none;
    }
    .table-custom tbody td { 
        font-size: 13px; 
        padding: 12px 15px; 
        border-bottom: 1px solid #f1f5f9; 
        vertical-align: middle;
        color: #1e293b;
    }

    .icon-box {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-right: 12px;
    }

    .bg-soft-blue { background: #e0f2fe; color: #0369a1; } /* Login */
    .bg-soft-orange { background: #ffedd5; color: #c2410c; } /* Input */
    .bg-soft-purple { background: #f3e8ff; color: #7e22ce; } /* Edit */
    .bg-soft-red { background: #fee2e2; color: #b91c1c; } /* Hapus */
    .bg-soft-green { background: #dcfce7; color: #15803d; } /* Konseling */

    .id-log-text { font-family: monospace; color: #6366f1; font-weight: 600; text-decoration: none; }
    .role-text { font-weight: 700; color: #334155; display: flex; align-items: center; gap: 8px; }
    .time-text { font-weight: 700; color: #1e293b; }
</style>

<div class="container-fluid py-4">
    <div class="mb-2 px-1">
        <h4 class="header-title mb-0">{{ $title }}</h4>
        <p class="header-subtitle">Daftar riwayat audit log aktivitas pengguna dalam sistem.</p>
    </div>

    <div class="main-wrapper shadow">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="60">NO</th>
                        <th width="140">ID LOG</th>
                        <th width="200">ROLE PENGGUNA</th>
                        <th>AKTIVITAS</th>
                        <th class="text-center" width="200">WAKTU AKSES</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                    @php 
                        $isGuru = str_contains($log->id_pengguna, 'BK');
                        $act = strtolower($log->aktivitas);
                        $ket = $log->keterangan ?? $log->aktivitas;

                        if($act == 'login') {
                            $icon = 'bi-door-open'; $colorClass = 'bg-soft-blue'; $label = 'LOGIN SISTEM';
                        } elseif(!$isGuru && $act == 'input data') {
                            $icon = 'bi-chat-dots'; $colorClass = 'bg-soft-green'; $label = 'MELAKUKAN KONSELING';
                        } elseif($act == 'input data') {
                            $icon = 'bi-file-earmark-plus'; $colorClass = 'bg-soft-orange'; $label = $ket;
                        } elseif($act == 'edit data') {
                            $icon = 'bi-pencil-square'; $colorClass = 'bg-soft-purple'; $label = $ket;
                        } elseif($act == 'hapus data') {
                            $icon = 'bi-trash3'; $colorClass = 'bg-soft-red'; $label = $ket;
                        } else {
                            $icon = 'bi-info-circle'; $colorClass = 'bg-light'; $label = $ket;
                        }
                    @endphp
                    <tr>
                        <td class="text-center text-muted">{{ $logs->firstItem() + $index }}</td>
                        <td><a href="#" class="id-log-text">#{{ $log->   id_log }}</a></td>
                        <td>
                            <div class="role-text">
                                <i class="bi {{ $isGuru ? 'bi-person-badge-fill' : 'bi-person-fill' }} text-secondary"></i>
                                {{ $isGuru ? 'GURU BK' : 'SISWA' }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="icon-box {{ $colorClass }}">
                                    <i class="bi {{ $icon }}"></i>
                                </div>
                                <span class="fw-bold" style="font-size: 11px; letter-spacing: 0.5px; color: {{ $act == 'input data' && $isGuru ? '#c2410c' : 'inherit' }}">
                                    {{ strtoupper($label) }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="time-text">{{ date('d/m/y', strtotime($log->waktu_akses)) }}</span>
                            <span class="mx-2 text-muted">|</span>
                            <span class="text-muted">{{ date('H:i', strtotime($log->waktu_akses)) }} WIB</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada aktivitas tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection