<?php $__env->startSection('title', 'S-Report | Kotak Masuk'); ?>

<?php $__env->startSection('content'); ?>

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
            <a href="<?php echo e(route('gurubk.selfreport.index')); ?>"
               class="btn-switch active-btn">
                Kotak Masuk
                <?php if($reports->count() > 0): ?>
                    <span class="badge bg-danger ms-2">
                        <?php echo e($reports->count()); ?>

                    </span>
                <?php endif; ?>
            </a>

            <a href="<?php echo e(route('gurubk.selfreport.arsip')); ?>"
               class="btn-switch">
                Arsip Laporan
            </a>
        </div>

    </div>

    <div class="row">

        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <div class="col-md-4 mb-4">

                <div class="report-card"
                     data-bs-toggle="modal"
                     data-bs-target="#detailModal<?php echo e($report->id); ?>">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge bg-warning text-dark">
                            Menunggu
                        </span>

                        <small class="text-muted">
                            <?php echo e(\Carbon\Carbon::parse($report->tanggal_lapor)->format('d M Y')); ?>

                        </small>
                    </div>

                    <h6 class="fw-bold">
                        <?php echo e($report->kategori); ?>

                    </h6>

                    <p class="small text-muted mb-0">
                        <?php echo e(\Illuminate\Support\Str::limit($report->deskripsi, 90)); ?>

                    </p>

                </div>

            </div>

            <div class="modal fade" id="detailModal<?php echo e($report->id); ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                Detail Laporan #<?php echo e($report->id); ?>

                            </h5>
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <p><strong>Kategori:</strong> <?php echo e($report->kategori); ?></p>
                            <p><strong>Tanggal:</strong>
                                <?php echo e(\Carbon\Carbon::parse($report->tanggal_lapor)->format('d F Y')); ?>

                            </p>

                            <p><strong>Deskripsi:</strong></p>
                            <p><?php echo e($report->deskripsi); ?></p>

                        </div>

                        <div class="modal-footer">

                            <form action="<?php echo e(route('gurubk.selfreport.verifikasi', $report->id)); ?>"
                                  method="POST"
                                  class="d-flex gap-2">
                                <?php echo csrf_field(); ?>

                                <button type="submit"
                                        name="status"
                                        value="disetujui"
                                        class="btn btn-success">
                                    ✔ Setujui
                                </button>

                                <button type="submit"
                                        name="status"
                                        value="ditolak"
                                        class="btn btn-danger">
                                    ✖ Tolak
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-folder2-open" style="font-size: 60px;"></i>
                    <h5 class="mt-4">Belum ada laporan masuk</h5>
                    <p>Laporan dari siswa akan muncul di sini.</p>
                </div>
            </div>

        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('gurubk.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\e-bk-care-venusvault\resources\views/gurubk/selfreport/index.blade.php ENDPATH**/ ?>