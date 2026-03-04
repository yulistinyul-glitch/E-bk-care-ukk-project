<?php $__env->startSection('title', 'Pelanggaran siswa'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .header-title { font-size: 28px; font-weight: 700; color: #333; }

    .btn-catat {
        background-color: #5d5fef;
        color: white;
        padding: 12px 25px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(93, 95, 239, 0.3);
    }
    .btn-catat:hover {
        background-color: #4a4cd9;
        color: white;
    }

    .search-container {
        position: relative;
        max-width: 400px;
        margin-bottom: 12px;
    }

    .search-input {
        width: 100%;
        padding: 12px 45px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        outline: none;
        font-size: 14px;
    }

    .icon-left {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #b5b5b5;
    }

    .select-kelas {
        width: 100%;
        max-width: 300px; /* Ukuran disesuaikan */
        padding: 12px 20px;
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        background-color: white;
        color: #666;
    }

    .btn-history {
        background-color: #b5b5b5;
        color: white;
        padding: 10px 25px;
        border-radius: 15px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .table-container {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }

    .table thead th {
        border: none;
        font-size: 14px;
        color: #888;
        font-weight: 600;
        padding: 15px;
        border-bottom: 1px solid #f8f9fa;
    }

    .badge-poin {
        background: #fff5f5;
        color: #ff4757;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 8px;
    }

    .empty-state {
        padding: 80px 0;
        color: #b5b5b5;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="header-title">Pelanggaran siswa</h4>

    <a href="<?php echo e(route('gurubk.riwayatpelanggaran.create')); ?>" class="btn-catat">
        + Catat pelanggaran
    </a>
</div>


<?php if(session('success')): ?>
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="row align-items-end mb-3">
    <div class="col-md-8">
        <div class="search-container">
            <i class="bi bi-search icon-left"></i>
            <input type="text" class="search-input" placeholder="Cari pelanggaran">
        </div>

        <select class="select-kelas">
            <option value="">Semua kelas</option>
            <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k->id_kelas); ?>"><?php echo e($k->nama_lengkap); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-4 text-end">
        <a href="#" class="btn-history">
            <i class="bi bi-clock-history"></i> History
        </a>
    </div>
</div>

<div class="table-container">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($r->tanggal)->format('d/m/Y')); ?></td>
                    <td class="fw-bold text-dark text-start"><?php echo e($r->siswa->nama_siswa); ?></td>
                    <td><?php echo e($r->siswa->kelas->nama_lengkap); ?></td>
                    <td class="text-start"><?php echo e($r->pelanggaran->jenis_kegiatan); ?></td>
                    <td><span class="badge-poin"><?php echo e($r->poin); ?></span></td>
                    <td>
                        <span class="badge <?php echo e($r->status == 'Ringan' ? 'bg-info' : ($r->status == 'Sedang' ? 'bg-warning' : 'bg-danger')); ?> rounded-pill">
                            <?php echo e($r->status); ?>

                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-light rounded-pill"><i class="bi bi-three-dots"></i></button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="bi bi-folder2-open" style="font-size: 48px;"></i>
                        <p class="mt-3 mb-0 text-dark fw-bold">Belum ada data tersedia.</p>
                        <small>Data akan muncul setelah anda menginput pelanggaran baru.</small>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('gurubk.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/gurubk/riwayatpelanggaran/index.blade.php ENDPATH**/ ?>