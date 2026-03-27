<?php $__env->startSection('title', 'Artikel - E-BK Care'); ?>

<?php $__env->startSection('content'); ?>

<div class="container px-4">
    <div class="text-center text-unggul">
        <h1 class="fw-bold hover-underline">Our Insightful <span class="text-teal">Blog</span></h1>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <?php if(isset($hero) && $hero): ?>
            <div class="hero-container">
                <img src="<?php echo e(asset('storage/' . $hero->image)); ?>" class="featured-img" alt="<?php echo e($hero->title); ?>">
                <div class="card-img-gradient">
                    <p class="small mb-2"> <i class="bi bi-clock"></i> <?php echo e($hero->created_at->format('d M Y')); ?></p>
                    <h2 class="fw-bold"><?php echo e($hero->title); ?></h2>
                    <p class="small mb-3" style="line-height: 1.5; opacity: 0.9;"><?php echo e(Str::limit($hero->description, 100)); ?></p>
                    <a href="#" class="text-white fw-bold text-decoration-none">Read More →</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-5">
            <?php $__empty_1 = true; $__currentLoopData = $sidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card sidebar-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="sidebar-img-wrapper"><img src="<?php echo e(asset('storage/' . $s->image)); ?>" class="sidebar-img"></div>
                    <div>
                        <p class="small"><i class="bi bi-clock"></i> <?php echo e($s->created_at->format('d M Y')); ?></p>
                        <h6 class="fw-bold mb-2"><?php echo e(Str::limit($s->title, 40)); ?></h6>
                        <a href="#" class="text-black fw-bold small text-decoration-none">Read More →</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted">Tidak ada artikel tambahan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="article-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-4 hover-underline">Explore Our Latest <span class="text-teal">Articles</span></h3>
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <button class="btn filter-btn active" data-filter="all">All</button>
                <button class="btn filter-btn" data-filter="mental-health">Mental Health</button>
                <button class="btn filter-btn" data-filter="career">Career & Future</button>
                <button class="btn filter-btn" data-filter="self-growth">Self Growth</button>
            </div>
        </div>

        <div class="article-grid-wrapper" id="article-grid">
            <?php $__empty_1 = true; $__currentLoopData = $semua_artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="article-item" data-category="<?php echo e($item->category_slug ?? 'all'); ?>">
                <div class="custom-card shadow">
                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="card-img-top" alt="<?php echo e($item->title); ?>">
                    <div class="card-body-text">
                        <h5><?php echo e(Str::limit($item->title, 60)); ?></h5>
                    </div>
                    <div class="card-footer-box">
                        <div class="author-group">
                            <div class="author-icon"></div>
                            <span class="author-name">direct by <?php echo e($item->penulis ?? 'Admin'); ?></span>
                        </div>
                        <div class="arrow-icon">→</div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center w-100">Belum ada artikel tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btns = document.querySelectorAll('.filter-btn');
        const items = document.querySelectorAll('.article-item');
        btns.forEach(btn => {
            btn.addEventListener('click', function() {
                btns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.getAttribute('data-filter');
                items.forEach(item => {
                    item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'block' : 'none';
                });
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/artikel.blade.php ENDPATH**/ ?>