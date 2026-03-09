

<?php $__env->startSection('content'); ?>
<style>
    body { font-family: 'Poppins', sans-serif !important; background-color: #f8fafc; }
    .card { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.07); }
    .card-header { 
        display: grid !important; 
        grid-template-columns: 100px 1fr 100px; 
        align-items: center; 
        background: #fff; 
        border-bottom: 1px solid #edf2f7; 
        padding: 20px; 
        border-radius: 15px 15px 0 0 !important; 
    }
    .form-control { border-radius: 8px; border: 1px solid #e2e8f0; padding: 15px; }
    .img-preview { width: 100%; height: 160px; object-fit: cover; border-radius: 10px; border: 2px dashed #cbd5e0; }
    
    .btn-edit {
        background-color: #f59e0b;
        color: white; padding: 6px 12px;
        border-radius: 10px; font-weight: 600;
        font-size: 13px; text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
        border: none; display: inline-flex;
        margin-top: 25px;
        align-items: center; justify-content: center; gap: 8px;
    }
    .btn-edit:hover { color: white; opacity: 0.9; transform: translateY(-2px); }

    .btn-simpan {
        background-color: #10b981;
        color: white; padding: 8px 15px;
        border-radius: 10px; font-weight: 600;
        font-size: 13px; text-decoration: none; transition: 0.3s;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        border: none; display: inline-flex;
        align-items: center; justify-content: center; gap: 8px;
    }
    .btn-simpan:hover { color: white; opacity: 0.9; transform: translateY(-2px); }
</style>

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header">
            <div></div> 
            <h4 class="mb-0 fw-bold text-black text-center">Pengaturan Profil & Visi Misi</h4>
            <button type="button" id="btnEdit" class="btn-edit" onclick="unlockForm()">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <div class="card-body p-4">
            <form action="<?php echo e(route('admin.tentang.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <fieldset id="formFields" disabled>
                    <div class="mb-4">
                        <label class="fw-bold mb-2">Profil Utama</label>
                        <input type="text" name="title" class="form-control mb-2" value="<?php echo e($data->title); ?>">
                        <input type="text" name="tagline" class="form-control mb-2" value="<?php echo e($data->tagline); ?>">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <textarea name="desc_1" class="form-control" rows="4" placeholder="Deskripsi 1"><?php echo e($data->desc_1); ?></textarea>
                            </div>
                            <div class="col-md-6 mb-2">
                                <textarea name="desc_2" class="form-control" rows="4" placeholder="Deskripsi 2"><?php echo e($data->desc_2); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 p-3 bg-light rounded align-items-start">
                        <div class="col-md-8">
                            <label class="fw-bold mb-2">Visi</label>
                            <input type="text" name="visi_judul" class="form-control mb-2" value="<?php echo e($data->visi_judul); ?>">
                            <input type="text" name="visi_tagline" class="form-control mb-2" value="<?php echo e($data->visi_tagline); ?>">
                            <textarea name="visi_desc" class="form-control" rows="3"><?php echo e($data->visi_desc); ?></textarea>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="d-block small text-muted mb-1">Preview Foto Visi</label>
                            <img id="prevVisi" src="<?php echo e($data->foto_visi ? asset('storage/'.$data->foto_visi) : '#'); ?>" class="img-preview" style="display:<?php echo e($data->foto_visi ? 'block':'none'); ?>">
                            <input type="file" name="foto_visi" class="form-control form-control-sm mt-2" onchange="preview(this, 'prevVisi')">
                        </div>
                    </div>

                    <div class="row mb-4 p-3 bg-light rounded align-items-start">
                        <div class="col-md-8">
                            <label class="fw-bold mb-2">Misi</label>
                            <input type="text" name="misi_judul" class="form-control mb-2" value="<?php echo e($data->misi_judul); ?>">
                            <input type="text" name="misi_tagline" class="form-control mb-2" value="<?php echo e($data->misi_tagline); ?>">
                            <textarea name="misi_desc" class="form-control" rows="3"><?php echo e($data->misi_desc); ?></textarea>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="d-block small text-muted mb-1">Preview Foto Misi</label>
                            <img id="prevMisi" src="<?php echo e($data->foto_misi ? asset('storage/'.$data->foto_misi) : '#'); ?>" class="img-preview" style="display:<?php echo e($data->foto_misi ? 'block':'none'); ?>">
                            <input type="file" name="foto_misi" class="form-control form-control-sm mt-2" onchange="preview(this, 'prevMisi')">
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <button type="submit" id="btnSimpan" class="btn-simpan" style="display:none;">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script>
    function unlockForm() {
        document.getElementById('formFields').disabled = false;
        document.getElementById('btnEdit').style.display = 'none';
        document.getElementById('btnSimpan').style.display = 'inline-flex';
    }
    function preview(input, id) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = (e) => { 
                let img = document.getElementById(id);
                img.src = e.target.result; img.style.display = 'block'; 
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/admin/data/tentang.blade.php ENDPATH**/ ?>