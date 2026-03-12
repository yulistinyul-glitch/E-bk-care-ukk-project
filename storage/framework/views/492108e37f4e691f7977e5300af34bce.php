

<?php $__env->startSection('content'); ?>
<style>
    .poppins-wrapper, .poppins-wrapper * { font-family: 'Poppins', sans-serif !important; }
    .card-header { display: flex !important; justify-content: space-between; align-items: center; padding: 20px; background: #fff; border-bottom: 1px solid #edf2f7; }
    .btn-tambah { background-color: #2563eb; color: white; padding: 8px 15px; border-radius: 10px; font-weight: 600; font-size: 13px; border: none; transition: 0.3s; }
    .btn-disabled { background-color: #cbd5e1; cursor: not-allowed; }
    .custom-pop-up { display: flex; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: 0.3s; }
    .custom-pop-up.active { opacity: 1; visibility: visible; }
    .modal-content { background: #fff; padding: 25px; border-radius: 15px; width: 90%; max-width: 500px; max-height: 90vh; overflow-y: auto; }
    .table-img { width: 80px; height: 60px; object-fit: cover; border-radius: 5px; }
</style>

<div class="container-fluid py-4 poppins-wrapper">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="fw-bold mb-0">Manajemen Artikel</h4>
            <div>
                
                <?php if(($unggulan ?? collect())->count() < 4): ?>
                    <button class="btn-tambah" id="btnUnggulan" onclick="bukaModal('modalTambahUnggulan')">+ Tambah Unggulan</button>
                <?php else: ?>
                    <button class="btn-tambah btn-disabled" disabled>Unggulan Penuh (4/4)</button>
                <?php endif; ?>
                <button class="btn-tambah" id="btnSemua" onclick="bukaModal('modalTambahSemua')" style="display:none;">+ Tambah Artikel</button>
            </div>
        </div>

        <div class="p-4">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="link-unggulan" onclick="switchTab('tab-unggulan', 'btnUnggulan', this)">Artikel Unggulan</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link" id="link-semua" onclick="switchTab('tab-semua', 'btnSemua', this)">Semua Artikel</button>
                </li>
            </ul>

            <div class="tab-content">
                <div id="tab-unggulan" class="tab-pane">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>No</th><th>Image</th><th>Judul</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = ($unggulan ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><img src="<?php echo e(asset('storage/'.$item->image)); ?>" class="table-img"></td>
                                <td><?php echo e($item->title); ?></td>
                                <td><button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal<?php echo e($item->id); ?>')">Edit</button></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div id="tab-semua" class="tab-pane" style="display:none;">
                    <table class="table table-hover align-middle">
                        <thead><tr><th>No</th><th>Image</th><th>Judul</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = ($semua_artikel ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><img src="<?php echo e(asset('storage/'.$item->image)); ?>" class="table-img"></td>
                                <td><?php echo e($item->title); ?></td>
                                <td><button class="btn btn-sm btn-outline-warning" onclick="bukaModal('editModal<?php echo e($item->id); ?>')">Edit</button></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-pop-up" id="modalTambahUnggulan">
    <form action="<?php echo e(route('admin.data.artikel.store')); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <input type="hidden" name="section" value="unggulan">
        <h6 class="fw-bold mb-3">Tambah Artikel Unggulan</h6>
        <input name="title" class="form-control mb-2" placeholder="Judul" required>
        <textarea name="excerpt" class="form-control mb-2" placeholder="Deskripsi Singkat" required></textarea>
        <textarea name="content" class="form-control mb-2" placeholder="Isi Konten Lengkap" required></textarea>
        <input type="file" name="image" class="form-control mb-2" required>
        <button type="submit" class="btn btn-success w-100">Simpan Artikel</button>
        <button type="button" class="btn btn-link w-100 text-secondary" onclick="tutupModal('modalTambahUnggulan')">Batal</button>
    </form>
</div>

<div class="custom-pop-up" id="modalTambahSemua">
    <form action="<?php echo e(route('admin.data.artikel.store')); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <input type="hidden" name="section" value="biasa">
        <h6 class="fw-bold mb-3">Tambah Artikel Baru</h6>
        <input name="title" class="form-control mb-2" placeholder="Judul" required>
        <textarea name="excerpt" class="form-control mb-2" placeholder="Deskripsi Singkat" required></textarea>
        <textarea name="content" class="form-control mb-2" placeholder="Isi Konten Lengkap" required></textarea>
        <input type="file" name="image" class="form-control mb-2" required>
        <button type="submit" class="btn btn-success w-100">Simpan Artikel</button>
        <button type="button" class="btn btn-link w-100 text-secondary" onclick="tutupModal('modalTambahSemua')">Batal</button>
    </form>
</div>

<?php $__currentLoopData = (($semua_artikel ?? collect())->merge(($unggulan ?? collect()))); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="custom-pop-up" id="editModal<?php echo e($item->id); ?>">
    <form action="<?php echo e(route('admin.data.artikel.update', $item->id)); ?>" method="POST" class="modal-content" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <h6 class="fw-bold mb-3">Edit: <?php echo e($item->title); ?></h6>
        <input name="title" value="<?php echo e($item->title); ?>" class="form-control mb-2" required>
        <textarea name="excerpt" class="form-control mb-2" required><?php echo e($item->excerpt); ?></textarea>
        <textarea name="content" class="form-control mb-2" required><?php echo e($item->content); ?></textarea>
        <input type="file" name="image" class="form-control mb-2">
        <button type="submit" class="btn btn-success w-100">Perbarui Data</button>
        <button type="button" class="btn btn-link w-100 text-secondary" onclick="tutupModal('editModal<?php echo e($item->id); ?>')">Batal</button>
    </form>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script>
    function switchTab(tabId, btnId, el) {
        document.querySelectorAll('.tab-pane').forEach(t => t.style.display = 'none');
        document.querySelectorAll('.btn-tambah').forEach(b => { if(b.id === 'btnUnggulan' || b.id === 'btnSemua') b.style.display = 'none'; });
        document.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active'));
        document.getElementById(tabId).style.display = 'block';
        const targetBtn = document.getElementById(btnId);
        if(targetBtn) targetBtn.style.display = 'inline-block';
        el.classList.add('active');
        localStorage.setItem('activeTab', tabId);
    }
    window.onload = function() {
        if (localStorage.getItem('activeTab') === 'tab-semua') document.getElementById('link-semua').click();
    };
    function bukaModal(id) { document.getElementById(id).classList.add('active'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('active'); }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/data/artikel.blade.php ENDPATH**/ ?>