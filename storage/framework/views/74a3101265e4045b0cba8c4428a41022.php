<?php $__env->startSection('content'); ?>

<div class="container mt-4">

    <h3 class="fw-bold mb-4">Generate E-SP</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card border-0 rounded-4 mb-5"
         style="box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
        <div class="card-body">

            <form action="<?php echo e(route('gurubk.e_surat.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Siswa</label>
                        <select name="id_siswa" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->id); ?>">
                                    <?php echo e($s->nama); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Template</label>
                        <select name="id_template" class="form-control" required>
                            <option value="">-- Pilih Template --</option>
                            <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t->id); ?>">
                                    <?php echo e($t->nama_template); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Tanggal Terbit</label>
                        <input type="date"
                               name="tanggal_terbit"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="fw-semibold">Keterangan</label>
                        <textarea name="keterangan_tambahan"
                                  class="form-control"
                                  rows="2"
                                  required></textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-success rounded-pill px-4">
                    Simpan
                </button>

            </form>

        </div>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <form method="GET" class="w-50">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control rounded-start-pill"
                       placeholder="Cari Nama Siswa"
                       value="<?php echo e(request('search')); ?>">
                <button class="btn btn-outline-secondary rounded-end-pill">
                    🔍
                </button>
            </div>
        </form>
    </div>

    <div class="card border-0 rounded-4"
         style="box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
        <div class="card-body">

            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Jenis SP</th>
                        <th>Tanggal Terbit</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php echo e(($surat->currentPage()-1)*$surat->perPage()+$loop->iteration); ?>

                        </td>

                        <td><?php echo e(optional($item->siswa)->nama ?? '-'); ?></td>

                        <td><?php echo e(optional($item->template)->nama_template ?? '-'); ?></td>

                        <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_terbit)->format('d-m-Y')); ?></td>

                        <td>
                            <?php if($item->status == 'draft'): ?>
                                <span class="badge bg-secondary">Draft</span>
                            <?php elseif($item->status == 'pdf'): ?>
                                <span class="badge bg-primary">PDF</span>
                            <?php elseif($item->status == 'emailed'): ?>
                                <span class="badge bg-warning text-dark">Emailed</span>
                            <?php elseif($item->status == 'selesai'): ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if($item->status == 'draft'): ?>
                                <a href="<?php echo e(route('gurubk.e_surat.export',$item->id)); ?>"
                                   class="btn btn-success btn-sm">
                                   Export PDF
                                </a>

                            <?php elseif($item->status == 'pdf'): ?>
                                <a href="<?php echo e(route('gurubk.e_surat.email',$item->id)); ?>"
                                   class="btn btn-secondary btn-sm">
                                   Kirim Email
                                </a>

                            <?php elseif($item->status == 'emailed'): ?>
                                <a href="<?php echo e(route('gurubk.e_surat.selesai',$item->id)); ?>"
                                   class="btn btn-warning btn-sm">
                                   Selesai
                                </a>

                            <?php elseif($item->status == 'selesai'): ?>
                                <span class="badge bg-success">
                                    ✔ Selesai
                                </span>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($surat->withQueryString()->links()); ?>

            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('gurubk.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/gurubk/e_surat/index.blade.php ENDPATH**/ ?>