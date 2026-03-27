<?php $__env->startSection('title', 'Kotak Saran - E-BK Care'); ?>

<?php $__env->startSection('content'); ?>

<div class="testi-outer-container" data-aos="fade-up" data-aos-duration="1000">
    <div class="font-poppins container px-4 text-center">
        <div class="text-center">
            <h2 class="fw-bold section-divider">"Aspirasi Para Siswa"</h2>
        </div>
        <div class="testimonial-wrapper">
            <div class="nav-btn-testi" onclick="slideTesti('prev')"><i class="bi bi-chevron-left"></i></div>
            <div id="testi-slider-content" style="position:relative; width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
                <div class="testi-card active" id="t-0">
                    <p class="fst-italic text-muted" style="font-size: 13px;">"Layanan BK sangat membantu saya dalam menentukan jurusan kuliah."</p>
                    <div class=" small text-uppercase mt-4" style="font-size: 15px; font-weight: 800;">Siswa - Kelas XII</div>
                    <div class="quote-icon">”</div>
                </div>
                <div class="testi-card next" id="t-1">
                    <p class="fst-italic text-muted" style="font-size: 13px;">"Fasilitas sekolah semakin lengkap berkat kotak saran yang aktif didengar."</p>
                    <div class="fw-bold small text-uppercase mt-4" style="font-size: 15px; font-weight: 800;">Alumni/21-24</div>
                    <div class="quote-icon">”</div>
                </div>
                <div class="testi-card" id="t-2">
                    <p class="fst-italic text-muted" style="font-size: 13px;">"Proses konseling jadi jauh lebih nyaman dan terjaga kerahasiaannya."</p>
                    <div class="fw-bold small text-uppercase mt-4" style="font-size: 15px; font-weight: 800;">Siswa - Kelas XI</div>
                    <div class="quote-icon">”</div>
                </div>
            </div>
            <div class="nav-btn-testi" onclick="slideTesti('next')"><i class="bi bi-chevron-right"></i></div>
        </div>
    </div>
</div>

<div class="teaser-section" data-aos="fade-in" data-aos-duration="1200">
    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="font-poppins teaser-box" data-aos="zoom-in" data-aos-delay="<?php echo e($loop->index * 150); ?>">
        <div class="bg-img" style="background-image: url('<?php echo e(asset('storage/' . $feature->image)); ?>');"></div>
        <div class="teaser-content">
            <div class="icon-placeholder"><i class="<?php echo e($feature->icon); ?>"></i></div>
            <h5><?php echo e($feature->title); ?></h5>
            <p class="short-desc"><?php echo e($feature->description); ?></p>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div style="background: #fff; padding: 60px 0;">
    <div class="container px-4 font-poppins">
        <h2 class="how-it-works-title" data-aos="zoom-in-up">How It Works?</h2>
        <div class="nav-steps-container" data-aos="fade-up" data-aos-delay="200">
            <div class="nav-line"></div>
            <div class="nav-steps-wrapper">
                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="step-item <?php echo e($index == 0 ? 'active' : ''); ?>" onclick="manualChange(<?php echo e($index + 1); ?>)" id="nav-<?php echo e($index + 1); ?>">
                    <div class="step-circle"><?php echo e($index + 1); ?></div>
                    <div class="step-label"><?php echo e($step->title); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                <div class="stack-area">
                    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="photo-<?php echo e($index + 1); ?>" class="photo-card <?php echo e($index == 0 ? 'front' : ($index == 1 ? 'mid' : 'back')); ?>">
                        <img src="<?php echo e(asset('storage/' . $step->image)); ?>" alt="Step <?php echo e($index + 1); ?>">
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-5 py-4" data-aos="fade-left" data-aos-delay="400">
                <div id="text-content">
                    <?php if($steps->isNotEmpty()): ?>
                        <h4 class="font-poppins fw-bold mb-4" id="step-title"><?php echo e($steps[0]->title); ?></h4>
                        <p class="font-poppins text-muted mb-4" id="step-desc" style="white-space: pre-line; line-height: 1.6; font-size: 14px;">
                            <?php echo e($steps[0]->description); ?>

                        </p>
                    <?php endif; ?>
                    <div class="d-flex align-items-center" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#videoModal">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                            <i class="bi bi-play-fill"></i>
                        </div>
                        <span class="font-poppins fw-bold small">Lihat Video Panduan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="subscribe-cta-wrapper" data-aos="fade-up" data-aos-duration="1000">
    <div class="cta-content-full">
        <div class="cta-icon-mini"><i class="bi bi-chat-heart-fill"></i></div>
        <h3 class="font-poppins fw-bold">Suaramu Adalah Perubahan</h3>
        <p class="font-poppins">Butuh bantuan BK atau punya ide cemerlang untuk kemajuan sekolah? Kirimkan aspirasimu sekarang secara aman dan 100% rahasia.</p>
        <div class="font-poppins modern-input-group">
            <input type="text" placeholder="Apa yang ada di pikiranmu hari ini?" readonly style="cursor: default;">
            <a href="<?php echo e(route('login')); ?>" class="btn-modern-submit">Kirim Sekarang <i class="bi bi-send-fill"></i></a>
        </div>
    </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0 video-container">
                <video width="100%" height="100%" controls>
                    <source src="<?php echo e(asset('path/to/video-panduan.mp4')); ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>

<script>
    let currentT = 0; const totalT = 3;
    function slideTesti(dir) {
        if(dir === 'next') currentT = (currentT + 1) % totalT;
        else if(dir === 'prev') currentT = (currentT - 1 + totalT) % totalT;
        for(let i=0; i<totalT; i++) {
            const card = document.getElementById(`t-${i}`);
            if(!card) continue;
            card.className = 'testi-card';
            if(i === currentT) card.classList.add('active');
            else if(i === (currentT - 1 + totalT) % totalT) card.classList.add('prev');
            else if(i === (currentT + 1) % totalT) card.classList.add('next');
        }
    }

    const stepsData = <?php echo json_encode($steps, 15, 512) ?>;
    let autoSlideInterval, isPaused = false; 

    function changeStep(n) {
        const idx = n - 1;
        document.querySelectorAll('.step-item').forEach((item, i) => { item.classList.toggle('active', i === idx); });
        document.getElementById('step-title').innerText = stepsData[idx].title;
        document.getElementById('step-desc').innerText = stepsData[idx].description;
        const photos = [document.getElementById('photo-1'), document.getElementById('photo-2'), document.getElementById('photo-3')];
        photos.forEach(p => p.className = 'photo-card');
        if (n === 1) { photos[0].classList.add('front'); photos[1].classList.add('mid'); photos[2].classList.add('back'); }
        else if (n === 2) { photos[1].classList.add('front'); photos[2].classList.add('mid'); photos[0].classList.add('back'); }
        else { photos[2].classList.add('front'); photos[0].classList.add('mid'); photos[1].classList.add('back'); }
    }

    function startAutoSlide() {
        return setInterval(() => {
            if (!isPaused) {
                let active = document.querySelector('.step-item.active');
                let next = (parseInt(active.id.replace('nav-', '')) % 3) + 1;
                changeStep(next);
            }
        }, 4000);
    }

    function manualChange(n) { isPaused = true; changeStep(n); }

    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({ 
            once: true, 
            duration: 1000, 
            offset: 50,
            easing: 'ease-in-out'
        });
        slideTesti('init');
        autoSlideInterval = startAutoSlide();
    });

    const videoModal = document.getElementById('videoModal');
    if(videoModal) {
        videoModal.addEventListener('hidden.bs.modal', function () {
            const v = videoModal.querySelector('video');
            v.pause(); v.currentTime = 0;
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/kotaksaran.blade.php ENDPATH**/ ?>