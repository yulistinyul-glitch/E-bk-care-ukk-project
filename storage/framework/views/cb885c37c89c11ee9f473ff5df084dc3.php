

<?php $__env->startSection('content'); ?>
<style>
    .poppins-wrapper, .poppins-wrapper * { font-family: 'Poppins', sans-serif !important; }
    body { background-color: #f8fafc; }
    .card { border-radius: 15px !important; border: none !important; box-shadow: 0 4px 6px rgba(0,0,0,0.07) !important; }
    
    .card-header { 
        display: grid !important; 
        grid-template-columns: 100px 1fr 150px; 
        align-items: center; 
        background: #fff; 
        padding: 20px; 
        border-radius: 15px 15px 0 0 !important; 
        border-bottom: 1px solid #edf2f7;
    }

    /* Tombol Tambah dengan style khusus */
    .btn-tambah { 
        background-color: #2563eb; color: white; padding: 8px 15px; 
        border-radius: 10px; font-weight: 600; font-size: 13px; 
        border: none; transition: 0.3s; display: inline-flex;
        align-items: center; justify-content: center; gap: 8px;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
    }
    .btn-tambah:hover { opacity: 0.9; color: white; transform: translateY(-2px); }

    .table-container { padding: 20px; }
    .img-preview-table { width: 150px; 
        height: 100px; 
        object-fit: cover; 
        border-radius: 10px; 
        cursor: pointer;
        transition: transform 0.2s; }
    
    /* Modal & Preview */
    .custom-pop-up { display: flex; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s ease; }
    .custom-pop-up.active { opacity: 1; visibility: visible; }
    .custom-pop-up .modal-dialog { width: 90%; max-width: 450px; }
    .custom-pop-up .modal-content { background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
    .preview-img { width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; display: none; border: 1px solid #eee; }
    .preview-img.active-preview { display: block; }
</style>

<div class="container-fluid py-4 poppins-wrapper">
    <div class="card shadow">
        <div class="card-header">
            <div></div> 
            <h4 class="mb-0 fw-bold text-center">Daftar Galeri Kegiatan</h4>
            <button class="btn-tambah" onclick="bukaModal('tambahModal')">
                <i class="bi bi-plus-lg"></i> Tambah Foto
            </button>
        </div>

        <div class="table-container">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-muted">
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="img-preview-table shadow-sm" alt="Foto"></td>
                        <td class="fw-bold"><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal<?php echo e($item->id); ?>')">Edit</button>
                                <form action="<?php echo e(route('admin.data.galeri.destroy', $item->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="custom-pop-up poppins-wrapper" id="tambahModal">
    <div class="modal-dialog">
        <form action="<?php echo e(route('admin.data.galeri.store')); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h6 class="fw-bold mb-3">Tambah Foto Galeri</h6>
            <input type="text" name="title" class="form-control mb-2" placeholder="Judul Foto" required>
            <img id="prevTambah" class="preview-img">
            <input type="file" name="image" class="form-control mb-2" accept="image/*" onchange="previewFile(this, 'prevTambah')" required>
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-secondary me-2" onclick="tutupModal('tambahModal')">Batal</button>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="custom-pop-up poppins-wrapper" id="editModal<?php echo e($item->id); ?>">
    <div class="modal-dialog">
        <form action="<?php echo e(route('admin.data.galeri.update', $item->id)); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <h6 class="fw-bold mb-3">Edit Galeri</h6>
            <input type="text" name="title" value="<?php echo e($item->title); ?>" class="form-control mb-2" required>
            <img id="prevEdit<?php echo e($item->id); ?>" class="preview-img active-preview" src="<?php echo e(asset('storage/' . $item->image)); ?>">
            <input type="file" name="image" class="form-control mb-2" accept="image/*" onchange="previewFile(this, 'prevEdit<?php echo e($item->id); ?>')">
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-secondary me-2" onclick="tutupModal('editModal<?php echo e($item->id); ?>')">Batal</button>
                <button type="submit" class="btn btn-success">Update Data</button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    function previewFile(input, targetId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var el = document.getElementById(targetId);
                el.src = e.target.result;
                el.classList.add('active-preview');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function bukaModal(id) { document.getElementById(id).classList.add('active'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('active'); }
    window.onclick = function(event) { if (event.target.classList.contains('custom-pop-up')) tutupModal(event.target.id); }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/data/galeri.blade.php ENDPATH**/ ?>