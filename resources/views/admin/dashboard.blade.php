@extends('admin.layouts.app')

@section('title', 'Dashboard Admin | Sistem BK Digital')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.css">

<div class="container-fluid p-0" style="font-family: 'Poppins', sans-serif; color: #1a233a; position: relative; z-index: 1;">
    
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="text-start">
            <h2 class="fw-bold m-0" style="color: #1a233a; letter-spacing: -1px;">Dashboard Admin</h2>
            <p class="text-muted small m-0">Selamat datang kembali, {{ auth()->user()->name ?? 'Administrator' }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-white bg-white shadow-sm border px-3 py-2 rounded-3 text-dark fw-bold small transition-all">
                <i class="feather-external-link me-2 text-primary"></i>Lihat Website
            </a>
            <button class="btn text-white px-3 py-2 rounded-3 fw-bold small shadow-sm border-0" style="background: #1a233a;">
                <i class="feather-file-text me-2"></i>Laporan Bulanan
            </button>
        </div>
    </div>

    <div class="row g-4">
        {{-- Kolom Kiri (Main Content) --}}
        <div class="col-xl-9 col-lg-8">
            
            {{-- Hero Banner --}}
            <div class="card mb-4 border-0 shadow overflow-hidden" style="background: linear-gradient(135deg, #739aef 0%, #bdd0ff 100%); border-radius: 20px;">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div class="text-white text-start" style="z-index: 2; max-width: 60%;">
                        <div class="badge mb-3 px-3 py-2 rounded-pill small fw-bold" style="background: rgba(255,255,255,0.2) !important; color: #fff !important;">
                            <i class="feather-activity me-1"></i> Sistem Terintegrasi
                        </div>
                        <h3 class="fw-bold mb-2 text-white" style="letter-spacing: -0.5px;">Kelola Laporan & Data Terpadu</h3>
                        <p class="opacity-75 mb-4" style="font-size: 13px; line-height: 1.6;">
                            Pantau, kelola, dan analisis seluruh data siswa, guru, serta laporan bimbingan konseling secara efisien.
                        </p>
<div class="d-flex gap-2 flex-wrap">
                <a href="#" class="btn btn-light text-dark fw-bold rounded-3 px-4 py-2 shadow-sm transition-all hover-lift d-inline-flex align-items-center" style="font-size: 13px;">
                    <i class="feather-bar-chart-2 me-2"></i> Dashboard Data
                </a>
                <a href="#" class="btn btn-outline-light fw-bold rounded-3 px-4 py-2 transition-all hover-lift d-inline-flex align-items-center" style="font-size: 13px; border-width: 2px;">
                    <i class="feather-settings me-2"></i> Konfigurasi
                </a>
            </div>
                    </div>
                    <div class="d-none d-md-block position-relative" style="z-index: 1;">
                        <img src="https://illustrations.popsy.co/white/work-from-home.svg" alt="Illustration" style="height: 180px;" class="img-fluid floating-anim">
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="row g-3 mb-4 text-start">
                @php
                    $main_stats = [
                        ['label' => 'Total Siswa', 'val' => number_format($totalSiswa ?? 0), 'icon' => 'users', 'color' => '#3b82f6', 'id' => 'ID_STUDENT'],
                        ['label' => 'Guru BK', 'val' => number_format($totalGuruBK ?? 0), 'icon' => 'shield', 'color' => '#10b981', 'id' => 'ID_COUNSELOR'],
                        ['label' => 'Wali Kelas', 'val' => number_format($totalWalas ?? 0), 'icon' => 'briefcase', 'color' => '#f59e0b', 'id' => 'ID_WALAS']
                    ];
                @endphp
                @foreach($main_stats as $ms)
                <div class="col-md-4">
                    <div class="card border-0 shadow transition-all hover-lift" style="border-radius: 20px; border: 1px solid #f1f5f9 !important;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="p-3 rounded-circle d-flex align-items-center justify-content-center" style="background: {{ $ms['color'] }}10; color: {{ $ms['color'] }}; width: 45px; height: 45px;">
                                    <i class="feather-{{ $ms['icon'] }}" style="font-size: 20px;"></i>
                                </div>
                                <span class="badge rounded-pill fw-bold" style="font-size: 9px; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">{{ $ms['id'] }}</span>
                            </div>
                            <h6 class="text-muted small fw-bold mb-1">{{ $ms['label'] }}</h6>
                            <h2 class="fw-bold m-0" style="color: #1a233a;">{{ $ms['val'] }}</h2>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <div class="card border-0 shadow mb-4 text-start" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h6 class="fw-bold m-0" style="color: #1a233a;">Manajemen Sesi & Autentikasi Pengguna</h6>
                </div>
                <div class="table-responsive px-4 pb-4">
                    <table class="table align-middle mb-0">
                        <thead class="small text-muted text-uppercase" style="background: #f8fafc;">
                            <tr>
                                <th>User / ID</th>
                                <th>Jabatan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Terakhir Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestAuth as $u)
                            <tr>
                                <td>
                                    {{ $u->nama_tampil }}
                                    <br>
                                    <small class="text-muted">ID: {{ $u->id_tampil }}</small>
                                </td>
                                <td>{{ $u->role }}</td>
                                <td class="text-center">
                                    @php
                                        $statusClass = match($u->status) {
                                            'Sedang Login' => 'bg-success-subtle text-success',
                                            'Telah Logout' => 'bg-danger-subtle text-danger',
                                            'Belum Login' => 'bg-light text-muted',
                                            default => 'bg-light text-muted',
                                        };
                                    @endphp
                                    <span class="badge rounded-pill px-2 {{ $statusClass }}">
                                        {{ $u->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $u->last_activity ? \Carbon\Carbon::createFromTimestamp($u->last_activity)->locale('id')->diffForHumans() : '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada autentikasi pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Chart --}}
            <div class="card border-0 shadow-sm p-4 text-start mb-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold m-0">Ringkasan Konseling & Pelanggaran Bulanan</h6>
                    <select class="form-select form-select-sm w-auto border-0 bg-light fw-bold">
                        <option>Maret 2026</option>
                    </select>
                </div>
                <div id="monthly-report-chart"></div>
            </div>

        </div>

        {{-- Kolom Kanan (Sidebar) --}}
        <div class="col-xl-3 col-lg-4 text-start">
            
            {{-- Profile Card --}}
            <div class="card border-0 shadow p-4 mb-4 text-center" style="border-radius: 20px;">
                <div class="position-relative d-inline-block mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=1a233a&color=fff" class="rounded-circle shadow" width="80">
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white border-3 rounded-circle" style="width: 18px; height: 18px;"></span>
                </div>
                <h6 class="fw-bold mb-0">{{ auth()->user()->name ?? 'Admin Utama' }}</h6>
                <p class="text-muted small mb-3">Super Administrator</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 rounded-3 fw-bold py-2 border-0 shadow-sm">Logout Sesi</button>
                </form>
            </div>

{{-- Calendar & Agenda Rapat Guru BK --}}
<div class="card border-0 shadow mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h6 class="fw-bold m-0" style="color: #1a233a;">
            <i class="feather-calendar me-2 text-primary"></i>Agenda Rapat BK
        </h6>
    </div>
    <div class="card-body p-3">
        {{-- Mini Calendar --}}
        <div class="calendar-mini text-center mb-4 p-2 bg-light rounded-4 text-start">
            <div class="row g-0 mb-2 fw-bold text-muted" style="font-size: 10px;">
                <div class="col text-center">S</div><div class="col text-center">M</div><div class="col text-center">T</div><div class="col text-center">W</div><div class="col text-center">T</div><div class="col text-center">F</div><div class="col text-center">S</div>
            </div>
            <div class="row g-0 small">
                @php
                    $date = now();
                    $daysInMonth = $date->daysInMonth;
                    $firstDayOfMonth = $date->copy()->startOfMonth()->dayOfWeek;

                    // Dummy Data Status Rapat
                    $rapatPending = [5, 12]; // Merah
                    $rapatSelesai = [2];     // Hijau
                @endphp

                @for ($i = 0; $i < $firstDayOfMonth; $i++)
                    <div class="col-1-7 p-1 text-center"></div>
                @endfor

                @for ($i = 1; $i <= $daysInMonth; $i++)
                    @php
                        $isToday = ($i == now()->day);
                        $isPending = in_array($i, $rapatPending);
                        $isDone = in_array($i, $rapatSelesai);
                    @endphp
                    <div class="col-1-7 p-1 text-center">
                        <div class="py-1 rounded-2 day-cell position-relative transition-all" 
                             onclick="triggerAgendaModal('{{ $i }} {{ now()->format('F Y') }}')"
                             style="cursor: pointer; font-size: 11px;
                                @if($isToday) 
                                    background: #1a233a !important; color: white; font-weight: bold;
                                @elseif($isPending)
                                    background: #fee2e2 !important; color: #ef4444; font-weight: bold;
                                @elseif($isDone)
                                    background: #dcfce7 !important; color: #10b981; font-weight: bold;
                                @endif">
                            {{ $i }}
                            
                            {{-- Titik Status --}}
                            @if(($isPending || $isDone) && !$isToday)
                                <span class="position-absolute start-50 translate-middle-x" 
                                      style="bottom: 2px; width: 4px; height: 4px; border-radius: 50%; 
                                      background: {{ $isPending ? '#ef4444' : '#10b981' }};">
                                </span>
                            @endif
                        </div>
                    </div>
                    @if (($i + $firstDayOfMonth) % 7 == 0)
                        </div><div class="row g-0 small">
                    @endif
                @endfor
            </div>
        </div>

        {{-- Legend Sederhana --}}
        <div class="d-flex justify-content-center gap-3 mb-4" style="font-size: 8px; text-transform: uppercase; font-weight: bold;">
            <div class="d-flex align-items-center gap-1"><span class="rounded-circle" style="width: 6px; height: 6px; background: #ef4444;"></span> Mendatang</div>
            <div class="d-flex align-items-center gap-1"><span class="rounded-circle" style="width: 6px; height: 6px; background: #10b981;"></span> Selesai</div>
        </div>

        <h6 class="fw-bold mb-3 small px-2 text-start">Daftar Rapat</h6>
        <div class="agenda-list px-1 text-start" style="max-height: 250px; overflow-y: auto;">
            
            {{-- Rapat Mendatang (Merah) --}}
            <div class="d-flex gap-3 mb-3 pb-3 border-bottom border-light">
                <div class="text-center rounded-3 p-2" style="background: #fee2e2; min-width: 48px; height: 48px;">
                    <span class="d-block fw-bold text-danger" style="font-size: 14px; line-height: 1;">05</span>
                    <small class="text-danger fw-bold" style="font-size: 9px;">MAR</small>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-1 fw-bold text-truncate" style="font-size: 11px; color: #1a233a;">Rapat Koordinasi BK</h6>
                    <div class="text-muted d-flex flex-column gap-1" style="font-size: 10px;">
                        <span><i class="feather-clock me-1"></i> 09:00 WIB</span>
                        <span class="text-truncate"><i class="feather-map-pin me-1"></i> Ruang Rapat</span>
                    </div>
                </div>
            </div>

            {{-- Rapat Selesai (Hijau) --}}
            <div class="d-flex gap-3 mb-3 pb-3 border-bottom border-light opacity-75">
                <div class="text-center rounded-3 p-2" style="background: #dcfce7; min-width: 48px; height: 48px;">
                    <span class="d-block fw-bold text-success" style="font-size: 14px; line-height: 1;">02</span>
                    <small class="text-success fw-bold" style="font-size: 9px;">MAR</small>
                </div>
                <div class="overflow-hidden">
                    <h6 class="mb-1 fw-bold text-truncate text-muted" style="font-size: 11px; text-decoration: line-through;">Rapat Dinas Bulanan</h6>
                    <div class="text-muted d-flex flex-column gap-1" style="font-size: 10px;">
                        <span><i class="feather-map-pin me-1"></i> Aula Utama</span>
                    </div>
                </div>
            </div>

        </div>

        <button class="btn btn-light w-100 rounded-3 fw-bold mt-2 py-2" onclick="triggerAgendaModal('{{ now()->format('d F Y') }}')" style="font-size: 10px; border: 1px dashed #cbd5e1; color: #1a233a;">
            <i class="feather-plus-circle me-1 text-primary"></i>Buat Jadwal Rapat
        </button>
    </div>
</div>
            {{-- Activity Log --}}
            <div class="card border-0 shadow overflow-hidden" style="border-radius: 20px; background: #ffffff;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-bold m-0" style="color: #1a233a;">Log Aktivitas</h6>
                        <span class="badge bg-danger rounded-pill" style="font-size: 9px; padding: 5px 10px;">{{ $logs->count() ?? 0 }} Terbaru</span>
                    </div>
                    <div class="activity-timeline">
                        @forelse($logs ?? [] as $log)
                            @php
                                $act = strtolower($log->aktivitas);
                                $isGuru = str_contains($log->id_pengguna, 'BK');
                                if(str_contains($act, 'login')) { $icon = 'log-in'; $color = '#3b82f6'; }
                                elseif(str_contains($act, 'input') || str_contains($act, 'tambah')) { $icon = 'plus-square'; $color = '#10b981'; }
                                elseif(str_contains($act, 'hapus')) { $icon = 'trash-2'; $color = '#ef4444'; }
                                else { $icon = 'activity'; $color = '#6366f1'; }
                            @endphp
                            <div class="d-flex gap-3 mb-4 position-relative p-2 rounded-3 transition-all activity-item">
                                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px; background: {{ $color }}15; color: {{ $color }};">
                                    <i class="feather-{{ $icon }}" style="font-size: 13px;"></i>
                                </div>
                                <div class="w-100 overflow-hidden">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <p class="mb-0 small fw-bold text-dark text-truncate">{{ $log->aktivitas }}</p>
                                        <small class="text-muted" style="font-size: 9px;">{{ \Carbon\Carbon::parse($log->waktu_akses)->diffForHumans() }}</small>
                                    </div>
                                    <small class="text-muted d-block" style="font-size: 10px;">{{ $log->guru->nama_guru ?? $log->id_pengguna }} • {{ $isGuru ? 'Guru BK' : 'Admin' }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4"><p class="text-muted small">Belum ada aktivitas.</p></div>
                        @endforelse
                    </div>
                    <a href="{{ route('admin.log') }}" class="btn btn-light w-100 rounded-3 fw-bold py-2 border-0 shadow-sm transition-all mt-2" style="font-size: 11px; color: #1a233a; background: #f1f5f9;">
                        Lihat Semua <i class="feather-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAgenda" tabindex="-1" aria-labelledby="modalAgendaLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4 pb-0">
                <h6 class="modal-title fw-bold" id="modalAgendaLabel"><i class="feather-edit-3 me-2 text-primary"></i>Agenda Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="#" method="POST" id="formAgenda">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Tanggal</label>
                        <input type="text" id="display_date" class="form-control bg-light border-0 rounded-3 text-dark fw-bold" name="tanggal" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Kegiatan</label>
                        <input type="text" name="judul" class="form-control rounded-3" placeholder="Input kegiatan..." required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Waktu</label>
                            <input type="time" name="jam" class="form-control rounded-3" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control rounded-3" placeholder="Ruang BK" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold py-2 border-0" style="background: #1a233a;">Simpan Agenda</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body { font-family: 'Inter', sans-serif !important; background-color: #f8fafc !important; }
    .card { border: none; }
    .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    .col-1-7 { width: 14.28%; flex: 0 0 14.28%; }
    .activity-item:hover { background: #f8fafc; transform: translateX(3px); }
    .day-cell:hover:not(.bg-primary) { background: #e2e8f0; }
    .floating-anim { animation: float 5s ease-in-out infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
    .transition-all { transition: all 0.3s ease; }
    .modal-backdrop { z-index: 1040 !important; }
    .modal { z-index: 1050 !important; }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    function triggerAgendaModal(selectedDate) {
        document.getElementById('display_date').value = selectedDate;
        const modalEl = document.getElementById('modalAgenda');
        const inst = bootstrap.Modal.getOrCreateInstance(modalEl);
        inst.show();
    }

    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('modalAgenda');
        document.body.appendChild(modal);

        const options = {
            series: [
                { name: 'Kasus Pelanggaran', data: [31, 40, 28, 51, 42, 109, 100] }, 
                { name: 'Sesi Konseling', data: [11, 32, 45, 32, 34, 52, 41] }
            ],
            chart: { height: 300, type: 'area', fontFamily: 'Inter, sans-serif', toolbar: { show: false } },
            dataLabels: { enabled: false },
            colors: ['#ef4444', '#10b981'],
            stroke: { curve: 'smooth', width: 2 },
            xaxis: { categories: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4", "Minggu 5", "Minggu 6", "Minggu 7"] },
            grid: { borderColor: '#f1f1f1' },
            legend: { position: 'bottom', horizontalAlign: 'center' }
        };
        
        if(document.querySelector("#monthly-report-chart")) {
            new ApexCharts(document.querySelector("#monthly-report-chart"), options).render();
        }
    });
</script>
@endpush
@endsection