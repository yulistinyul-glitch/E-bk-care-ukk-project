

<?php $__env->startSection('content'); ?>
<style>
    .poppins-wrapper, .poppins-wrapper * { font-family: 'Poppins', sans-serif !important; }
    .card-header { display: flex !important; justify-content: space-between; align-items: center; padding: 20px; background: #fff; border-bottom: 1px solid #edf2f7; }
    .btn-tambah { background-color: #2563eb; color: white; padding: 8px 15px; border-radius: 10px; font-weight: 600; font-size: 13px; border: none; transition: 0.3s; }
    .custom-pop-up { display: flex; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.3s; }
    .custom-pop-up.active { opacity: 1; visibility: visible; }
    .modal-content { background: #fff; padding: 25px; border-radius: 15px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; }
    .preview-img { width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; display: none; }
</style>

<div class="container-fluid py-4 poppins-wrapper">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="fw-bold mb-0">Manajemen Kotak Saran</h4>
            <div>
                <button class="btn-tambah" onclick="bukaModal('modalTambahTeaser')" id="btnTeaser">+ Tambah Teaser</button>
                <button class="btn-tambah" onclick="bukaModal('modalTambahHow')" id="btnHow" style="display:none;">+ Tambah How It Works</button>
            </div>
        </div>

        <div class="p-4">
            <ul class="nav nav-pills mb-3" id="saranTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" onclick="switchTab('tab-teaser', 'btnTeaser', this)">Teaser</button></li>
                <li class="nav-item ms-2"><button class="nav-link" onclick="switchTab('tab-how-it-works', 'btnHow', this)">How It Works</button></li>
            </ul>

            <div class="tab-content">
                <div id="tab-teaser" class="tab-pane">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>No</th><th>Image</th><th>Judul</th><th>Icon</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $items->where('section', 'teaser'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><img src="<?php echo e(asset('storage/'.$item->image)); ?>" style="width: 50px; border-radius: 5px;"></td>
                                <td><?php echo e($item->title); ?></td>
                                <td><i class="bi <?php echo e($item->icon); ?>"></i></td>
                                <td><?php echo e(Str::limit($item->description, 20)); ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal<?php echo e($item->id); ?>')">Edit</button>
                                        <form action="<?php echo e(route('admin.data.kotaksaran.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div id="tab-how-it-works" class="tab-pane" style="display:none;">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>No</th><th>Image</th><th>Judul</th><th>Deskripsi</th><th>Video</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $items->where('section', 'how_it_works')->sortBy('order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->order); ?></td>
                                <td><img src="<?php echo e(asset('storage/'.$item->image)); ?>" style="width: 50px; border-radius: 5px;"></td>
                                <td><?php echo e($item->title); ?></td>
                                <td><?php echo e(Str::limit($item->description, 20)); ?></td>
                                <td><?php echo $item->video ? '<span class="badge bg-primary">Ada</span>' : '-'; ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal<?php echo e($item->id); ?>')">Edit</button>
                                        <form action="<?php echo e(route('admin.data.kotaksaran.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
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
    </div>
</div>

<div class="custom-pop-up" id="modalTambahTeaser">
    <form action="<?php echo e(route('admin.data.kotaksaran.store')); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <input type="hidden" name="section" value="teaser">
        <h6 class="fw-bold mb-3">Tambah Teaser</h6>
        <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>
        <input type="text" name="icon" class="form-control mb-2" placeholder="Icon (Contoh: bi-star)">
        <img id="prevImgTeaser" class="preview-img">
        <input type="file" name="image" class="form-control mb-2" onchange="previewFile(this, 'prevImgTeaser')" required>
        <textarea name="description" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary w-50" onclick="tutupModal('modalTambahTeaser')">Batal</button>
            <button type="submit" class="btn btn-success w-50">Simpan</button>
        </div>
    </form>
</div>

<div class="custom-pop-up" id="modalTambahHow">
    <form action="<?php echo e(route('admin.data.kotaksaran.store')); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <input type="hidden" name="section" value="how_it_works">
        <h6 class="fw-bold mb-3">Tambah How It Works</h6>
        <input type="number" name="order" class="form-control mb-2" placeholder="No Urut" required>
        <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>
        <img id="prevImgHow" class="preview-img">
        <input type="file" name="image" class="form-control mb-2" onchange="previewFile(this, 'prevImgHow')" required>
        <label class="small text-muted">Video (Opsional)</label>
        <input type="file" name="video" class="form-control mb-2" accept="video/*">
        <textarea name="description" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary w-50" onclick="tutupModal('modalTambahHow')">Batal</button>
            <button type="submit" class="btn btn-success w-50">Simpan</button>
        </div>
    </form>
</div>

<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="custom-pop-up" id="editModal<?php echo e($item->id); ?>">
    <form action="<?php echo e(route('admin.data.kotaksaran.update', $item->id)); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <h6 class="fw-bold mb-3">Edit: <?php echo e($item->title); ?></h6>
        <input type="text" name="title" value="<?php echo e($item->title); ?>" class="form-control mb-2">
        <img id="prevEdit<?php echo e($item->id); ?>" class="preview-img" style="display:block;" src="<?php echo e(asset('storage/'.$item->image)); ?>">
        <input type="file" name="image" class="form-control mb-2" onchange="previewFile(this, 'prevEdit<?php echo e($item->id); ?>')">
        <?php if($item->section == 'how_it_works'): ?>
            <input type="number" name="order" value="<?php echo e($item->order); ?>" class="form-control mb-2">
            <input type="file" name="video" class="form-control mb-2" accept="video/*">
        <?php else: ?>
            <input type="text" name="icon" value="<?php echo e($item->icon); ?>" class="form-control mb-2">
        <?php endif; ?>
        <textarea name="description" class="form-control mb-2"><?php echo e($item->description); ?></textarea>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary w-25" onclick="tutupModal('editModal<?php echo e($item->id); ?>')">Batal</button>
            <button type="submit" class="btn btn-success w-50">Update</button>
            <a href="#" class="btn btn-danger w-25" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) { document.getElementById('deleteForm<?php echo e($item->id); ?>').submit(); }">Hapus</a>
        </div>
    </form>
    <form id="deleteForm<?php echo e($item->id); ?>" action="<?php echo e(route('admin.data.kotaksaran.destroy', $item->id)); ?>" method="POST" style="display:none;">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
    </form>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    function switchTab(tabId, btnId, el) {
        document.querySelectorAll('.tab-pane').forEach(t => t.style.display = 'none');
        document.getElementById(tabId).style.display = 'block';
        document.querySelectorAll('.btn-tambah').forEach(b => b.style.display = 'none');
        document.getElementById(btnId).style.display = 'inline-block';
        document.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active'));
        el.classList.add('active');
    }
    function previewFile(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => { document.getElementById(id).src = e.target.result; document.getElementById(id).style.display = 'block'; }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function bukaModal(id) { document.getElementById(id).classList.add('active'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('active'); }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/data/kotaksaran.blade.php ENDPATH**/ ?>