

<?php $__env->startSection('title', 'History Siswa'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body { background-color: #f5f7fb; font-family: 'Poppins', sans-serif; }
.header-title { font-size: 24px; font-weight: 700; color: #333; }
.header-subtitle { font-size: 12px; color: #888; margin-top: -5px; margin-bottom: 25px; }
.btn-back { background-color: #5d5fef; color: white; padding: 8px 18px; border-radius: 10px; font-weight: 600; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
.btn-back:hover { color: white; opacity: 0.9; transform: translateX(-5px); }
.main-wrapper { background: white; border-radius: 10px; padding: 0; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
.table-container { padding: 20px 15px 15px 15px; }
.table thead th { background-color: #f8fafc; border: none; font-size: 12px; color: #888; font-weight: 600; padding: 12px; }
.table tbody td { padding: 12px; color: #444; font-size: 12.5px; border-bottom: 1px solid #f8f9fa; }
.btn-action-icon { border: none; background: none; padding: 0; font-size: 1.2rem; cursor: pointer; transition: 0.2s; }
.icon-restore { color: #5bcb65; }
.icon-delete-permanent { color: #ff7070; }
.btn-action-icon:hover { transform: scale(1.2); }
.pagination-wrapper { display: flex; justify-content: center; padding: 20px 0; }
.page-link { padding: 3px 10px; font-size: 11px; border-radius: 5px; }
    /* KUSTOMISASI MODAL POPUP SUKSES (LEBIH KECIL) */
    .my-swal-popup { 
        border-radius: 18px !important; 
        padding: 1.5em !important; 
        width: 320px !important; /* Perkecil lebar modal */
    }

    .swal2-title { 
        font-size: 18px !important; /* Perkecil teks judul */
        font-weight: 700 !important; 
    }

    .swal2-html-container { 
        font-size: 13px !important; /* Perkecil teks pesan */
    }

    .swal2-icon {
        transform: scale(0.7); /* Perkecil icon centang/warning */
        margin: 10px auto 5px !important;
    }

    .swal-button-custom {
        border-radius: 8px !important; 
        padding: 6px 20px !important; 
        font-size: 12px !important;
    }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 px-2">
        <div>
            <h4 class="header-title mb-0">History Hapus Siswa</h4>
            <p class="header-subtitle text-muted mt-2">Data di bawah ini dapat dikembalikan atau dihapus permanen!</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.siswa.index')); ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Data
            </a>
        </div>
    </div>

    <div class="main-wrapper shadow">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIPD</th>
                            <th class="text-start">Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Tgl Dihapus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($siswa->firstItem() + $index); ?></td>
                            <td class="fw-bold"><?php echo e($s->NIPD); ?></td>
                            <td class="text-start"><?php echo e($s->nama_siswa); ?></td>
                            <td><?php echo e($s->kelas->nama_lengkap ?? $s->kelas->nama_kelas ?? '-'); ?></td>
                            <td><?php echo e($s->deleted_at->format('d M Y, H:i')); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    
                                    <form action="<?php echo e(route('admin.siswa.restore', $s->id_siswa)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn-action-icon icon-restore" title="Kembalikan Data">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </button>
                                    </form>

                                    
                                    <form id="force-delete-<?php echo e($s->id_siswa); ?>" action="<?php echo e(route('admin.siswa.forceDelete', $s->id_siswa)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-action-icon icon-delete-permanent" title="Hapus Permanen">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Tidak ada data di tempat sampah.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <?php echo e($siswa->links('pagination::bootstrap-5')); ?>

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
            icon: 'info',
            iconColor: '#5d5fef',
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/siswa/history.blade.php ENDPATH**/ ?>