<?php $__env->startSection('title', 'Data Pelanggaran'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; } 
    .header-title { font-size: 24px; font-weight: 700; color: #333; } 

    /* BUTTONS */
    .btn-catat { background-color: #5d5fef; color: white; padding: 8px 18px; border-radius: 10px; font-weight: 600; font-size: 13px; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 15px rgba(93, 95, 239, 0.2); }
    .btn-catat:hover { color: white; opacity: 0.9; transform: translateY(-2px); }

    .btn-history { background-color: #b5b5b5; color: white; padding: 8px 20px; border-radius: 10px; font-weight: 500; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
    .btn-history:hover { background-color: #999; color: white; transform: translateY(-2px); }

    .btn-export-solid { height: 34px; background: #5bcb65; color: white; border: none; border-radius: 10px; font-size: 12px; padding: 0 15px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; transition: 0.3s; }
    .btn-export-solid:hover { background: #4eb658; color: white; transform: translateY(-2px); }

    .btn-search-outline { height: 34px; border: 2px solid #3b82f6; color: #3b82f6; border-radius: 10px; font-size: 12px; padding: 0 20px; background: white; font-weight: 600; transition: 0.3s; }
    .btn-search-outline:hover { background: #3b82f6; color: white; }

    /* WRAPPERS */
    .main-wrapper { background: white; border-radius: 20px; padding: 0; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
    .filter-area { padding: 20px; }
    .input-group-custom { background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; height: 34px; padding: 0 12px; font-size: 12px; width: 100%; outline: none; }

    /* TABLE */
    .table-container { padding: 0 15px 15px 15px; }
    .table thead th { background-color: #f8fafc; border: none; font-size: 12px; color: #888; font-weight: 600; padding: 12px; }
    .table tbody td { padding: 12px; color: #444; font-size: 12.5px; border-bottom: 1px solid #f8f9fa; }
    
    /* BADGES */
    .badge-tingkat { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; display: inline-block; }
    .ringan { background: #e3f2fd; color: #1976d2; }
    .sedang { background: #fff3e0; color: #ef6c00; }
    .berat { background: #ffebee; color: #c62828; }

    /* ACTIONS */
    .btn-action-icon { border: none; background: none; padding: 0; cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem; }
    .icon-edit { color: #ffb74d; }
    .icon-delete { color: #ff7070; }
    .btn-action-icon:hover { transform: scale(1.15); }
    
    .pagination-wrapper { display: flex !important; justify-content: center !important; padding: 20px 0; }
    .page-link { padding: 3px 10px !important; font-size: 11px !important; border-radius: 5px !important; }

    .import-box { background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 12px; margin-top: 12px; }

    /* SWAL CUSTOM */
    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 700 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <h4 class="header-title mb-0">Manajemen Data Pelanggaran</h4>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('admin.pelanggaran.history')); ?>" class="btn-history">
                <i class="bi bi-clock-history"></i> History
            </a>
            <a href="<?php echo e(route('admin.pelanggaran.create')); ?>" class="btn-catat">
                <i class="bi bi-plus-lg"></i> Tambah Pelanggaran
            </a>
        </div>
    </div>

    <div class="main-wrapper shadow-sm">
        <div class="filter-area">
            <form action="<?php echo e(route('admin.pelanggaran.index')); ?>" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #b5b5b5; font-size: 12px;"></i>
                            <input type="text" name="search" class="input-group-custom" 
                                placeholder="Cari Kategori atau Jenis Pelanggaran..." 
                                value="<?php echo e(request('search')); ?>" 
                                style="padding-left: 35px;">
                        </div>
                    </div>
                    <div class="col text-end">
                        <a href="" class="btn-export-solid">
                            <i class="bi bi-file-earmark-pdf"></i> Export PDF
                        </a>
                    </div>
                </div>
            </form>

            <div class="import-box">
                <form action="<?php echo e(route('admin.pelanggaran.import')); ?>" method="POST" enctype="multipart/form-data" class="row g-2 align-items-center">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-4">
                        <input type="file" name="file" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th class="text-start">Jenis Kegiatan</th>
                            <th>Tingkatan</th>
                            <th>Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pelanggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($pelanggaran->firstItem() + $i); ?></td>
                            <td class="fw-bold text-dark"><?php echo e($p->id_pelanggaran); ?></td>
                            <td><?php echo e($p->kategori_pelanggaran); ?></td>
                            <td class="text-start"><?php echo e($p->jenis_kegiatan); ?></td>
                            <td>
                                <span class="badge-tingkat <?php echo e(strtolower($p->tingkatan)); ?>">
                                    <?php echo e(ucfirst($p->tingkatan)); ?>

                                </span>
                            </td>
                            <td class="fw-bold"><?php echo e($p->poin_pelanggaran); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="<?php echo e(route('admin.pelanggaran.edit', $p->id_pelanggaran)); ?>" class="btn-action-icon icon-edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="button" class="btn-action-icon icon-delete" onclick="confirmDelete('<?php echo e($p->id_pelanggaran); ?>', '<?php echo e($p->jenis_kegiatan); ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-form-<?php echo e($p->id_pelanggaran); ?>" action="<?php echo e(route('admin.pelanggaran.destroy', $p->id_pelanggaran)); ?>" method="POST" style="display:none;">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-exclamation-circle" style="font-size: 40px; opacity: 0.5;"></i>
                                <p class="mt-2 fw-bold" style="font-size: 13px;">Belum ada data pelanggaran.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <?php echo e($pelanggaran->links('pagination::bootstrap-5')); ?>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if(session('success')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: "<?php echo e(session('success')); ?>",
            icon: 'success',
            iconColor: '#00C897',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            customClass: { 
                popup: 'my-swal-popup',
                title: 'swal2-title',
                htmlContainer: 'swal2-html-container'
            }
        });
    <?php endif; ?>

function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Data?',
        text: "Yakin ingin menghapus " + nama + "?",
        icon: 'warning',
        iconColor: '#ff7070',
        showCancelButton: true,
        confirmButtonColor: '#ff7070',
        cancelButtonColor: '#f1f1f1',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'my-swal-popup',
            confirmButton: 'swal-button-custom',
            cancelButton: 'swal-button-custom',
            title: 'swal2-title',
            htmlContainer: 'swal2-html-container'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/pelanggaran/index.blade.php ENDPATH**/ ?>