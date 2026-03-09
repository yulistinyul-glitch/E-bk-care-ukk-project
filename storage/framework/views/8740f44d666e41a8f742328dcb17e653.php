<?php $__env->startSection('title', 'Dashboard Guru BK'); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-4 text-start">
    <div class="col-xxl-8 col-lg-7">
        <div class="card mb-4 border-0 shadow-sm" style="background:#fff; border-radius: 20px; color: white;">
            <div class="card-body p-4">
                <h2 class="fw-bold m-0" style="color: #000;">GOOD MORNING, MS/MR</h2>
                <p class="text-dark mt-2 mb-0 small">Sistem Informasi Bimbingan Konseling - Pantau aktivitas siswa hari ini!</p>
            </div>
        </div>

<div class="card mb-4 border-0 shadow-sm" 
     style="background-color: #1a233a; border-radius: 25px; color: white;">

    <div class="card-header bg-transparent border-0 pt-4 px-4 text-start">
        <h5 class="card-title text-white fw-bold m-0 text-uppercase">
            New Message
        </h5>
    </div>  

    <div class="card-body px-4 pb-4">
        <div class="d-flex flex-column">

            <?php for($i=0; $i<3; $i++): ?>
            <div class="d-flex align-items-center justify-content-between py-3 border-bottom"
                 style="border-color: rgba(255,255,255,0.2) !important;">

                <div class="d-flex align-items-center gap-3">
                    
                    <div class="avatar-text avatar-md bg-secondary rounded-circle text-white d-flex align-items-center justify-content-center">
                        <i class="feather-user"></i>
                    </div>

                    <div>
                        <h6 class="mb-0 text-white fs-12 fw-bold">
                            NAMA SISWA - KELAS
                        </h6>
                        <small class="text-white-50 small d-block">
                            PESAN MASUK...
                        </small>
                    </div>
                </div>

                <span class="badge rounded-circle d-flex align-items-center justify-content-center"
                      style="background-color: white; color: #1a233a; width: 24px; height: 24px;">
                    1
                </span>

            </div>
            <?php endfor; ?>

        </div>
    </div>
</div>


        <div class="row g-4">
            <div class="col-md-6">
                <div class="card stretch stretch-full border-0 shadow-sm" style="border-radius: 25px; background-color: #a4c5e2;">
                    <div class="card-header d-flex justify-content-between bg-transparent border-0 px-4 pt-4">
                        <h6 class="fw-bold m-0 text-white small">SELF-REPORT</h6>
                        <span class="badge bg-dark rounded-pill px-3">Today</span>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <p class="fw-bold text-white small mb-3 text-uppercase text-start">5 Laporan Masuk</p>
                        <div class="d-flex flex-column gap-2">
                            <?php for($i=0; $i<3; $i++): ?>
                            <div class="d-flex align-items-center justify-content-between p-2 bg-white rounded-pill px-3 shadow-sm">
                                <span class="fs-11 fw-bold text-dark"><i class="feather-file-text me-2 text-primary"></i> View details</span>
                                <i class="feather-chevron-right text-muted small"></i>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="text-white fw-bold small text-decoration-none d-flex align-items-center justify-content-center">
                                <span>more</span>
                                <i class="feather-arrow-right ms-1" style="font-size: 14px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card stretch stretch-full border-0 shadow-sm" style="border-radius: 25px; background-color: #ffffff;">
                    <div class="card-header bg-transparent border-0 px-4 pt-4 text-start">
                        <h6 class="fw-bold m-0 text-dark small text-uppercase">Traffic Pelanggaran</h6>
                    </div>
                    <div class="card-body p-0">
                        <div id="traffic-line-chart"></div>
                        <div class="px-4 pb-4 mt-2">
                            <div class="d-flex justify-content-between border rounded-4 p-2 bg-light shadow-sm">
                                <div class="text-center flex-fill">
                                    <span class="fw-bold d-block text-success fs-13">2</span>
                                    <small class="text-muted fs-8 fw-bold">RINGAN</small>
                                </div>
                                <div class="text-center flex-fill border-start border-end px-3">
                                    <span class="fw-bold d-block text-warning fs-13">5</span>
                                    <small class="text-muted fs-8 fw-bold">SEDANG</small>
                                </div>
                                <div class="text-center flex-fill">
                                    <span class="fw-bold d-block text-danger fs-13">10</span>
                                    <small class="text-muted fs-8 fw-bold">BERAT</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php
    date_default_timezone_set('Asia/Jakarta');
    
    $month = date('n'); 
    $year = date('Y');  
    $today = date('j'); 
    
    $monthName = strtoupper(date('F')); 
    
    $prevMonth = strtoupper(date('M', strtotime("-1 month")));
    $nextMonth = strtoupper(date('M', strtotime("+1 month")));

    $firstDayOfMonth = date('w', strtotime("$year-$month-01"));
    $daysInMonth = date('t'); // 't' otomatis mengambil jumlah hari dalam bulan berjalan
?>

<div class="col-xxl-4 col-lg-5">
    <div class="card h-100" style="background-color: #A9C9DB; border-radius: 45px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); overflow: hidden;">

        <div class="card-body p-4 d-flex flex-column text-start">
            <div class="d-flex justify-content-between align-items-center mb-4 px-2 text-dark">
                <span class="fw-bold small opacity-50"><?php echo e($prevMonth); ?></span>
                <div class="text-center">
                    <span class="badge bg-dark rounded-pill px-3 mb-1"><?php echo e($year); ?></span>
                    <h4 class="fw-bold m-0"><?php echo e($monthName); ?></h4>
                </div>
                <span class="fw-bold small opacity-50"><?php echo e($nextMonth); ?></span>
            </div>

            <div class="d-grid text-center mb-2" style="grid-template-columns: repeat(7, 1fr);">
                <?php $__currentLoopData = ['Min','Sen','Sel','Rab','Kam','Jum','Sab']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="small fw-bold text-dark opacity-50" style="font-size: 11px;"><?php echo e($d); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="d-grid text-center" style="grid-template-columns: repeat(7, 1fr); gap: 2px;">
                <?php for($i = 0; $i < $firstDayOfMonth; $i++): ?>
                    <div style="padding: 10px 0;"></div>
                <?php endfor; ?>

                <?php for($d = 1; $d <= $daysInMonth; $d++): ?>
                    <div onclick="updateSchedule(<?php echo e($d); ?>)"
                         id="date-<?php echo e($d); ?>"
                         class="calendar-day <?php echo e($d == $today ? 'active-date' : ''); ?>"
                         style="padding: 10px 0;">
                        <?php echo e($d); ?>

                    </div>
                <?php endfor; ?>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button class="btn bg-white rounded-pill px-4 py-2 shadow-sm fw-bold text-primary border-0 text-uppercase"
                        style="font-size: 11px;"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahJadwal">
                    <i class="feather-plus me-1"></i> TAMBAH JADWAL
                </button>
            </div>

            <div style="height:2px; background:white; margin:30px 0;"></div>

            <div class="rounded-4" style="border:2px solid white; overflow:hidden;">
                <div class="d-flex fw-bold small text-dark" style="border-bottom:2px solid white;">
                    <div class="w-25 text-center py-2" style="border-right:2px solid white;">JAM ⏰</div>
                    <div class="w-75 text-center py-2">Konseling siswa</div>
                </div>
                <div id="schedule-content">
                    </div>
            </div>
        
        </div>
    </div>
</div>




<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 30px; overflow: hidden;">
            <div class="modal-header border-0 p-4" style="background-color: #1A374D; color:white;">
                <h5 class="modal-title fw-bold" style="color: #ffffff"><i class="feather-calendar me-2" style="color: #ffffff"></i>BUAT JADWAL KONSELING</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formTambahJadwal">
                <div class="modal-body p-4 bg-light">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Nama Siswa</label>
                        <input type="text" class="form-control border-0 shadow-sm rounded-4 py-2" placeholder="Masukkan nama siswa..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Tanggal</label>
                            <input type="date" id="inputTgl" class="form-control border-0 shadow-sm rounded-4 py-2" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Jam</label>
                            <input type="time" class="form-control border-0 shadow-sm rounded-4 py-2" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Kategori Masalah</label>
                        <select class="form-select border-0 shadow-sm rounded-4 py-2">
                            <option value="Pribadi">Masalah Pribadi (Curhat)</option>
                            <option value="Akademik">Akademik / Belajar</option>
                            <option value="Sosial">Bullying / Masalah Sosial</option>
                            <option value="Aspirasi">Aspirasi Sekolah</option>
                        </select>
                    </div>

                    <div class="p-3 rounded-4" style="background-color: rgba(26, 55, 77, 0.05); border: 1px dashed #1A374D;">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="isPrivat">
                            <label class="form-check-label small fw-bold text-dark" for="isPrivat">
                                <i class="feather-lock me-1"></i> Mode Sangat Privat
                            </label>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 10px;">
                            Jika aktif, nama siswa hanya akan terlihat oleh Anda dan tidak muncul di statistik umum.
                        </small>
                    </div>
                </div>
                
                <div class="modal-footer border-0 p-4 bg-light">
                    <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn px-4 py-2 rounded-pill fw-bold text-white shadow" style="background-color: #1A374D;">SIMPAN JADWAL</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>


<div class="theme-customizer">
    <div class="customizer-handle"><a href="javascript:void(0);" class="cutomizer-open-trigger bg-primary"><i class="feather-settings"></i></a></div>
    <div class="customizer-sidebar-wrapper">
        <div class="customizer-sidebar-header px-4 ht-80 border-bottom d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Theme Settings</h5>
            <a href="javascript:void(0);" class="cutomizer-close-trigger d-flex"><i class="feather-x"></i></a>
        </div>
        <div class="customizer-sidebar-body p-4" data-scrollbar-target="#psScrollbarInit">
            
            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Navigation</label>
                <div class="row g-2 theme-options-items app-navigation">
                    <div class="col-6 text-center"><input type="radio" class="btn-check" id="n-light" name="app-navigation" data-app-navigation="app-navigation-light" checked /><label class="btn btn-outline-secondary w-100 fs-9 fw-bold" for="n-light">LIGHT</label></div>
                    <div class="col-6 text-center"><input type="radio" class="btn-check" id="n-dark" name="app-navigation" data-app-navigation="app-navigation-dark" /><label class="btn btn-outline-secondary w-100 fs-9 fw-bold" for="n-dark">DARK</label></div>
                </div>
            </div>

            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Header</label>
                <div class="row g-2 theme-options-items app-header">
                    <div class="col-6 text-center"><input type="radio" class="btn-check" id="h-light" name="app-header" data-app-header="app-header-light" checked /><label class="btn btn-outline-secondary w-100 fs-9 fw-bold" for="h-light">LIGHT</label></div>
                    <div class="col-6 text-center"><input type="radio" class="btn-check" id="h-dark" name="app-header" data-app-header="app-header-dark" /><label class="btn btn-outline-secondary w-100 fs-9 fw-bold" for="h-dark">DARK</label></div>
                </div>
            </div>

            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                <label class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted bg-white border border-gray-2 position-absolute rounded-2 options-label" style="top: -12px">Skins</label>
                <div class="row g-2 theme-options-items app-skin">
                    <div class="col-6 text-center"><input type="radio" class="btn-check" id="s-light" name="app-skin" data-app-skin="app-skin-light" checked /><label class="btn btn-outline-secondary w-100 fs-9 fw-bold" for="s-light">LIGHT</label></div>
                    <div class="col-6 text-center"><input type="radio" class="btn-check" id="s-dark" name="app-skin" data-app-skin="app-skin-dark" /><label class="btn btn-outline-secondary w-100 fs-9 fw-bold" for="s-dark">DARK</label></div>
                </div>
            </div>

        </div>
        <div class="customizer-sidebar-footer px-4 ht-60 border-top d-flex align-items-center gap-2">
            <button class="btn btn-danger w-50 btn-sm fw-bold" data-style="reset-all-common-style">RESET</button>
        </div>
    </div>
</div>

<style>
    .calendar-day { cursor: pointer; border-radius: 10px; transition: 0.2s; font-size: 13px; font-weight: 600; color: #1a233a; }
    .active-date { background: #1a233a !important; color: white !important; }
    .theme-customizer .customizer-sidebar-wrapper { width: 300px; }
    .btn-white { background-color: #ffffff !important; color: #3b82f6 !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    function updateSchedule(date) {
        document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('active-date'));
        document.getElementById('date-' + date).classList.add('active-date');
        document.getElementById('schedule-date').innerText = date;
    }

    document.addEventListener("DOMContentLoaded", function() {
        var options = {
            series: [{ name: 'Kasus', data: [31, 40, 28, 51, 42, 109, 100] }],
            chart: { type: 'area', height: 180, toolbar: {show: false} },
            colors: ['#3b82f6'],
            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.2, stops: [0, 90, 100] } },
            stroke: { curve: 'smooth', width: 3 },
            dataLabels: { enabled: false },
            xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], labels: {style: {fontSize: '9px'}} },
            yaxis: { show: false },
            grid: { show: false }
        };
        new ApexCharts(document.querySelector("#traffic-line-chart"), options).render();
    });

// calendar
    let selectedDay = <?php echo e($today); ?>;

    function updateSchedule(day) {
        selectedDay = day; 

        document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('active-date'));
        const targetDate = document.getElementById('date-' + day);
        if (targetDate) {
            targetDate.classList.add('active-date');
        }

        const container = document.getElementById('schedule-content');
        
        if (day == <?php echo e($today); ?>) { 
            container.innerHTML = `
            <div class="d-flex animate__animated animate__fadeIn" style="border-bottom:2px solid white;">
                <div class="w-25 text-center py-2 small" style="border-right:2px solid white;">10:00</div>
                <div class="w-75 px-3 py-2 small font-weight-bold">Aspirasi Siswa Kelas XI</div>
            </div>`;
        } else {
            container.innerHTML = '<div class="text-center py-4 opacity-50 small text-dark">Tidak ada jadwal untuk tanggal ini</div>';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSchedule(selectedDay);
    });

    const modalElement = document.getElementById('modalTambahJadwal');
    if (modalElement) {
        modalElement.addEventListener('show.bs.modal', function () {
            const year = <?php echo e($year); ?>;
            const month = String(<?php echo e($month); ?>).padStart(2, '0');
            const day = String(selectedDay).padStart(2, '0'); // Menggunakan selectedDay yang aktif
            
            const inputTgl = document.getElementById('inputTgl');
            if (inputTgl) {
                inputTgl.value = `${year}-${month}-${day}`;
            }
        });
    }

    const formJadwal = document.getElementById('formTambahJadwal');
    if (formJadwal) {
        formJadwal.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Jadwal berhasil disimpan secara privat ke database!');
            
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('modalTambahJadwal');
        document.body.appendChild(modal);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gurubk.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\e-bk-care-venusvault\resources\views/gurubk/dashboard.blade.php ENDPATH**/ ?>