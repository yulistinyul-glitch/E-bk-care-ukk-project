<style>
    .card-jadwal {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
        background: #fff;
    }
    .card-jadwal:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    .time-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 8px 12px;
        border-radius: 12px;
        font-weight: 700;
        min-width: 65px;
        text-align: center;
    }
    .date-divider {
        display: flex;
        align-items: center;
        margin: 30px 0 20px;
    }
    .date-divider h6 {
        margin: 0 15px;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.75rem;
    }
    .date-divider::before, .date-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: 0.2s;
        border: none;
    }
</style>



<?php $__env->startSection('content'); ?>
<div class="container-fluid py-3">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">Agenda Konseling Siswa</h4>
        <p class="text-muted small">Pantau jadwal aktif dan kelola status sesi di sini.</p>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari => $listJadwal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="date-divider">
            <h6><?php echo e($hari); ?></h6>
        </div>

        <div class="row">
          <?php $__currentLoopData = $listJadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 mb-3"> <div class="card card-jadwal shadow-sm border-0 border-start border-primary border-4">
         <div class="card-body p-3">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="time-badge px-3 py-2 text-center" style="background: #f0f4ff; color: #4f46e5; border-radius: 12px; min-width: 80px;">
                        <small class="d-block text-uppercase fw-bold" style="font-size: 10px; opacity: 0.6;">Jam</small>
                        <span class="fw-bold"><?php echo e(substr($session->scheduled_time, 0, 5)); ?></span>
                    </div>
                </div>

                <div class="col">
                    <h6 class="fw-bold mb-1 text-dark"><?php echo e($session->request->siswa->nama_siswa); ?></h6>
                    <div class="text-muted small">
                        <i class="fas fa-map-marker-alt me-1 text-primary"></i> 
                        <?php echo e($session->location_link); ?>

                    </div>
                </div>
  
                <div class="col-auto">
                    <div class="d-flex gap-2">
                        <form action="<?php echo e(route('gurubk.konseling.updateStatus', $session->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?> 
                            <?php echo method_field('PATCH'); ?> <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check me-1"></i>Selesai</button>
                        </form>
                        
                        <form action="<?php echo e(route('gurubk.konseling.updateStatus', $session->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <input type="hidden" name="status" value="dibatalkan">
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-3">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed">
            <i class="fas fa-calendar-check fa-3x text-light mb-3"></i>
            <h5 class="text-muted fw-bold">Belum ada jadwal konseling</h5>
            <p class="text-muted small">Semua permintaan sudah diproses atau dibatalkan.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('gurubk.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\e-bk-care-venusvault\resources\views/gurubk/konseling/konseling.blade.php ENDPATH**/ ?>