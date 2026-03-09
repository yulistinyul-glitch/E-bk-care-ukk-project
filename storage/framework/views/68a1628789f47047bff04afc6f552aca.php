<?php $__env->startSection('title', 'Manajemen GuruBK'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
    .header-title { font-size: 24px; font-weight: 800; color: #333; }
    .sub-title { font-size: 13px; color: #888; margin-top: 5px; display: block; }
    .btn-catat { background:#5d5fef;color:white;padding:8px 18px;border-radius:10px;font-weight:600;font-size:13px;text-decoration:none;transition:.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-catat:hover { transform:translateY(-2px); color: white; box-shadow: 0 4px 12px rgba(93, 95, 239, 0.2); }

    .main-wrapper { background:white;border-radius:10px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.03); margin-top: 20px; }

    .table-container { padding:20px; }
    .table thead th { background:#f8fafc;border:none;font-size:12px;color:#888;font-weight:600;padding:12px; text-transform: uppercase; }
    .table tbody td { font-size:12.5px;padding:12px;border-bottom:1px solid #f1f1f1; }

    .badge-jk { padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600; }
    .badge-l { background:#e3f2fd;color:#1976d2; }
    .badge-p { background:#fce4ec;color:#d81b60; }

    .btn-action-icon { border:none;background:none;font-size:1.1rem;cursor:pointer; transition: 0.2s; padding: 0; }
    .icon-edit { color:#ffb74d; }
    .icon-delete { color:#ff7070; }
    .btn-action-icon:hover { transform:scale(1.15); }

    .pagination-wrapper { display: flex !important; justify-content: center !important; padding: 20px 0; }

    .my-swal-popup { border-radius: 18px !important; padding: 1.5em !important; width: 320px !important; }
    .swal2-title { font-size: 18px !important; font-weight: 800 !important; }
    .swal2-html-container { font-size: 13px !important; }
    .swal2-icon { transform: scale(0.7); margin: 10px auto 5px !important; }
    .swal-button-custom { border-radius: 8px !important; padding: 6px 20px !important; font-size: 12px !important; }
</style>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-start mb-4 px-2">
        <div>
            <h4 class="header-title mb-1">Manajemen Data Guru BK</h4>
            <span class="sub-title">Daftar Seluruh Guru Bimbingan Konseling</span>
        </div>
        <a href="<?php echo e(route('admin.gurubk.create')); ?>" class="btn-catat">
            <i class="bi bi-plus-lg"></i> Tambah Guru
        </a>
    </div>

    <?php if(session('default_password')): ?>
    <div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 10px; font-size: 13px;">
        <i class="bi bi-info-circle-fill me-2"></i>
        Password default Guru BK baru: <strong><?php echo e(session('default_password')); ?></strong>
    </div>
    <?php endif; ?>

    <div class="main-wrapper shadow">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Guru</th>
                            <th>NIP</th>
                            <th class="text-start">Nama Lengkap</th>
                            <th>JK</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $gurubk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($gurubk->firstItem() + $index); ?></td>
                            <td class="fw-bold text-primary"><?php echo e($g->id_gurubk); ?></td>
                            <td><?php echo e($g->NIP ?? '-'); ?></td>
                            <td class="text-start fw-medium"><?php echo e($g->nama_gurubk); ?></td>
                            <td>
                                <span class="badge-jk <?php echo e($g->JK == 'L' ? 'badge-l' : 'badge-p'); ?>">
                                    <?php echo e($g->JK); ?>

                                </span>
                            </td>
                            <td><?php echo e($g->no_telp); ?></td>
                            <td><?php echo e($g->email); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="<?php echo e(route('admin.gurubk.edit', $g->id_gurubk)); ?>" 
                                       class="btn-action-icon icon-edit" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <button type="button" 
                                            class="btn-action-icon icon-delete" 
                                            onclick="confirmDelete('<?php echo e($g->id_gurubk); ?>')" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                    <form id="delete-form-<?php echo e($g->id_gurubk); ?>" 
                                          action="<?php echo e(route('admin.gurubk.destroy', $g->id_gurubk)); ?>" 
                                          method="POST" style="display:none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-muted py-5">
                                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                Belum ada data Guru BK
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <?php echo e($gurubk->links('pagination::bootstrap-5')); ?>

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

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data Guru BK akan dihapus permanen dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff7070',
            cancelButtonColor: '#b5b5b5',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'my-swal-popup',
                confirmButton: 'swal-button-custom',
                cancelButton: 'swal-button-custom'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/gurubk/index.blade.php ENDPATH**/ ?>