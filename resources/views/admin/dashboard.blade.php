@extends('admin.layouts.app')

@section('title', 'Dashboard Admin | Sistem BK Digital')

@section('content')
<div class="container-fluid p-0" style="font-family: 'Inter', sans-serif; color: #1a233a;">
    
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div class="text-start">
            <h2 class="fw-bold m-0" style="color: #1a233a; letter-spacing: -1px;">Dashboard Admin</h2>
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
        <div class="col-xl-9 col-lg-8">
    <div class="card mb-3 border-0 shadow overflow-hidden" style="background: linear-gradient(135deg, #739aef 0%, #bdd0ff 100%); border-radius: 20px;">
        <div class="card-body p-4 p-md-3 d-flex justify-content-between align-items-center">
            <div class="text-white text-start" style="z-index: 2; max-width: 60%;">
                <div class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill small fw-bold" style="background: rgba(255,255,255,0.1) !important; color: #fff !important;">
                    <i class="feather-activity me-1"></i> Sistem Terintegrasi
                </div>
                <h3 class="fw-bold mb-2 text-white" style="letter-spacing: -0.5px;">Kelola Laporan & Data Terpadu</h3>
                <p class="opacity-75 mb-4" style="font-size: 13px; line-height: 1.6;">
                    Pantau, kelola, dan analisis seluruh data siswa, guru, serta laporan bimbingan konseling secara efisien dalam satu panel kendali.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#" class="btn btn-light text-dark fw-bold small rounded-3 px-4 py-2 shadow-sm transition-all hover-lift">
                        <i class="feather-bar-chart-2 me-2"></i> Dashboard Data
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-light fw-bold small rounded-3 px-4 py-2 transition-all">
                        <i class="feather-settings me-1"></i> Konfigurasi
                    </a>
                </div>
            </div>

            <div class="d-none d-md-block position-relative" style="z-index: 1;">
                <img src="https://illustrations.popsy.co/white/work-from-home.svg" 
                    alt="Management Illustration" 
                    style="height: 200px; filter: drop-shadow(0px 10px 20px rgba(0,0,0,0.3));" 
                    class="img-fluid floating-anim">
            </div>
        </div>
    </div>

<div class="row g-3 mb-4 text-start">
    @php
        $main_stats = [
            [
                'label' => 'Total Siswa', 
                'val' => number_format($totalSiswa ?? 0), 
                'icon' => 'users', 
                'color' => '#3b82f6', 
                'id' => 'ID_STUDENT'
            ],
            [
                'label' => 'Guru BK', 
                'val' => number_format($totalGuruBK ?? 0), 
                'icon' => 'shield', 
                'color' => '#10b981', 
                'id' => 'ID_COUNSELOR'
            ],
            [
                'label' => 'Wali Kelas', 
                'val' => number_format($totalWalas ?? 0), 
                'icon' => 'briefcase', 
                'color' => '#f59e0b', 
                'id' => 'ID_WALAS'
            ]
        ];
    @endphp

    @foreach($main_stats as $ms)
    <div class="col-md-4">
        <div class="card border-0 shadow transition-all hover-lift" 
             style="border-radius: 20px; background: #ffffff; border: 1px solid #f1f5f9 !important;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="p-3 rounded-circle d-flex align-items-center justify-content-center" 
                         style="background: {{ $ms['color'] }}10; color: {{ $ms['color'] }}; width: 45px; height: 45px;">
                        <i class="feather-{{ $ms['icon'] }}" style="font-size: 20px;"></i>
                    </div>
                    <span class="badge rounded-pill fw-bold" 
                          style="font-size: 9px; background: #f8fafc; color: #94a3b8; border: 1px solid #e2e8f0;">
                        {{ $ms['id'] }}
                    </span>
                </div>
                
                <h6 class="text-muted small fw-bold mb-1" style="letter-spacing: 0.5px;">{{ $ms['label'] }}</h6>
                <h2 class="fw-bold m-0" style="color: #1a233a; letter-spacing: -1px;">{{ $ms['val'] }}</h2>
            </div>
        </div>
    </div>
    @endforeach
</div>

            <div class="card border-0 shadow mb-4 text-start" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h6 class="fw-bold m-0" style="color: #1a233a;">Manajemen Sesi & Autentikasi Pengguna</h6>
                </div>
                <div class="table-responsive px-4 pb-4">
                    <table class="table align-middle mb-0">
                        <thead class="small text-muted text-uppercase" style="background: #f8fafc;">
                            <tr>
                                <th class="py-3 border-0 ps-3">User / ID</th>
                                <th class="py-3 border-0">Jabatan</th>
                                <th class="py-3 border-0 text-center">Status</th>
                                <th class="py-3 border-0 text-center">Terakhir Akses</th>
                                <th class="py-3 border-0 text-end pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $authUsers = [
                                    ['name' => 'Budi Sudarsono', 'id' => 'BK-001', 'role' => 'Guru BK', 'status' => 'Online', 'time' => 'Baru Saja'],
                                    ['name' => 'Heny Rahmawati', 'id' => 'WL-042', 'role' => 'Wali Kelas', 'status' => 'Offline', 'time' => '2 Jam Lalu'],
                                    ['name' => 'Andi Wijaya', 'id' => 'BK-003', 'role' => 'Guru BK', 'status' => 'Online', 'time' => '5 Menit Lalu'],
                                ];
                            @endphp
                            @foreach($authUsers as $u)
                            <tr>
                                <td class="ps-3 border-bottom-0 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 35px; height: 35px; background: #1a233a; font-size: 11px;">
                                            {{ substr($u['name'], 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="fw-bold small d-block">{{ $u['name'] }}</span>
                                            <small class="text-muted" style="font-size: 10px;">ID: {{ $u['id'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="small border-bottom-0">{{ $u['role'] }}</td>
                                <td class="text-center border-bottom-0">
                                    <span class="badge rounded-pill px-2 {{ $u['status'] == 'Online' ? 'bg-success-subtle text-success' : 'bg-light text-muted' }}" style="font-size: 10px;">{{ $u['status'] }}</span>
                                </td>
                                <td class="text-center small text-muted border-bottom-0">{{ $u['time'] }}</td>
                                <td class="text-end pe-3 border-bottom-0">
                                    <button class="btn btn-sm btn-light text-danger rounded-2 border"><i class="feather-log-out" style="font-size: 12px;"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row g-4 text-start">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h6 class="fw-bold m-0">Ringkasan Konseling & Pelanggaran Bulanan</h6>
                            <select class="form-select form-select-sm w-auto border-0 bg-light fw-bold">
                                <option>Februari 2026</option>
                            </select>
                        </div>
                        <div id="monthly-report-chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 text-start">
            
            <div class="card border-0 shadow p-4 mb-4 text-center" style="border-radius: 20px; background: #fff;">
                <div class="position-relative d-inline-block mb-3">
                    <img src="https://ui-avatars.com/api/?name=Admin+Utama&background=1a233a&color=fff" class="rounded-circle shadow" width="80">
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white border-3 rounded-circle" style="width: 18px; height: 18px;"></span>
                </div>
                <h6 class="fw-bold mb-0" style="color: #1a233a;">Admin Utama</h6>
                <p class="text-muted small mb-3">Super Administrator</p>
                
                <div class="bg-light p-3 rounded-4 text-start mb-3" style="font-size: 11px;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status:</span>
                        <span class="text-success fw-bold">Aktif Login</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Terakhir Aktif:</span>
                        <span class="fw-bold text-dark">Baru Saja</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Alamat IP:</span>
                        <span class="fw-bold text-dark">192.168.43.12</span>
                    </div>
                </div>

                <button class="btn btn-danger w-100 rounded-3 fw-bold py-2 border-0 shadow-sm" style="background: #ef4444;">
                    <i class="feather-power me-2"></i>Logout Sesi
                </button>
            </div>

            <div class="card border-0 shadow p-3 mb-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                    <h6 class="fw-bold m-0 small">Calendar 2026</h6>
                    <i class="feather-calendar text-primary"></i>
                </div>
                <div class="calendar-mini text-center">
                    <div class="row g-0 mb-2 fw-bold text-muted" style="font-size: 10px;">
                        <div class="col">S</div><div class="col">M</div><div class="col">T</div><div class="col">W</div><div class="col">T</div><div class="col">F</div><div class="col">S</div>
                    </div>
                    <div class="row g-0 small" style="font-size: 11px;">
                        @for($i=1; $i<=28; $i++)
                            <div class="col-1-7 p-1">
                                <div class="py-1 rounded-2 {{ $i == 19 ? 'bg-primary text-white fw-bold shadow-sm' : '' }}" style="{{ $i == 19 ? 'background: #1a233a !important;' : '' }}">
                                    {{ $i }}
                                </div>
                            </div>
                            @if($i % 7 == 0) </div><div class="row g-0 small" style="font-size: 11px;"> @endif
                        @endfor
                    </div>
                </div>
                <hr class="my-3 opacity-50">
                <div class="small px-2 text-start">
                    <p class="fw-bold mb-1" style="font-size: 10px;"><i class="feather-circle text-primary me-2"></i>19 Feb: Rapat BK</p>
                    <p class="fw-bold mb-0 text-muted" style="font-size: 10px;"><i class="feather-circle text-warning me-2"></i>22 Feb: Visitasi Siswa</p>
                </div>
            </div>

<div class="card border-0 shadow overflow-hidden" style="border-radius: 15px; background: #ffffff;">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h6 class="fw-bold m-0" style="color: #1a233a;">Log Aktivitas</h6>
                <small class="text-muted" style="font-size: 10px;">Pembaruan sistem real-time</small>
            </div>
            <span class="badge bg-danger rounded-pill" style="font-size: 9px; padding: 5px 10px;">3 Baru</span>
        </div>

        <div class="activity-timeline">
            @php
                $notifs = [
                    ['user' => 'Guru BK', 'msg' => 'Kirim Laporan #S-102', 'time' => '2m ago', 'icon' => 'file-text', 'color' => '#3b82f6', 'new' => true],
                    ['user' => 'Siswa', 'msg' => 'Update Profil ID-99', 'time' => '1h ago', 'icon' => 'user', 'color' => '#10b981', 'new' => true],
                    ['user' => 'System', 'msg' => 'Backup Otomatis Berhasil', 'time' => '3h ago', 'icon' => 'database', 'color' => '#6366f1', 'new' => false],
                    ['user' => 'Siswa', 'msg' => 'Update Profil ID-99', 'time' => '1h ago', 'icon' => 'user', 'color' => '#10b981', 'new' => true],
                    ['user' => 'System', 'msg' => 'Backup Otomatis Berhasil', 'time' => '3h ago', 'icon' => 'database', 'color' => '#6366f1', 'new' => false],
                    
                ];
            @endphp

            @foreach($notifs as $n)
            <div class="d-flex gap-3 mb-4 position-relative p-2 rounded-3 transition-all activity-item">
                @if($n['new'])
                    <span class="position-absolute translate-middle border border-white rounded-circle bg-danger" 
                          style="padding: 4px; left: 8px; top: 10px; z-index: 1;"></span>
                @endif

                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                     style="width: 35px; height: 35px; background: {{ $n['color'] ?? '#1a233a' }}15; color: {{ $n['color'] ?? '#1a233a' }};">
                    <i class="feather-{{ $n['icon'] }}" style="font-size: 13px;"></i>
                </div>

                <div class="w-100 overflow-hidden">
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="mb-0 small fw-bold text-dark text-truncate" style="max-width: 150px;">{{ $n['msg'] }}</p>
                        <small class="text-muted flex-shrink-0" style="font-size: 9px;">{{ $n['time'] }}</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted" style="font-size: 10px;">{{ $n['user'] }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="btn btn-light w-100 rounded-3 fw-bold small py-2 mt-2 transition-all" 
                style="font-size: 11px; background: #f8fafc; border: 1px solid #e2e8f0;">
            Lihat Aktivitas
        </button>
    </div>
</div>

<style>
    /* Terapkan font Poppins ke seluruh halaman */
    body { 
        font-family: 'Poppins', sans-serif !important;
        background-color: #f8fafc !important; 
    }

    /* Card & Hover Effects */
    .card { 
        transition: transform 0.2s; 
        font-family: 'Poppins', sans-serif;
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }

    /* Layout Khusus */
    .col-1-7 { width: 14.28%; flex: 0 0 14.28%; }

    /* Log Aktivitas */
    .activity-item {
        transition: all 0.2s ease-in-out;
    }
    .activity-item:hover {
        background: #f8fafc;
        transform: translateX(3px);
    }

    /* Animasi Mengambang untuk Ilustrasi */
    .floating-anim {
        animation: float 5s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(1deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }

    /* Global Transition */
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            series: [
                { name: 'Kasus Pelanggaran', data: [31, 40, 28, 51, 42, 109, 100] }, 
                { name: 'Sesi Konseling', data: [11, 32, 45, 32, 34, 52, 41] }
            ],
            chart: { 
                height: 300, 
                type: 'area', 
                toolbar: { show: false } 
            },
            dataLabels: {
                enabled: false 
            },
            colors: ['#ef4444', '#10b981'],
            stroke: { 
                curve: 'smooth', 
                width: 2 
            },
            xaxis: { 
                categories: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4", "Minggu 5", "Minggu 6", "Minggu 7"] 
            },
            grid: { 
                borderColor: '#f1f1f1' 
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center'
            }
        };
        new ApexCharts(document.querySelector("#monthly-report-chart"), options).render();
    });
</script>
@endsection