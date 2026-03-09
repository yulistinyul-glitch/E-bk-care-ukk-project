<?php $__env->startSection('title', 'Kotak Saran - E-BK Care'); ?>

<?php $__env->startSection('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-gray: #f4f7f9;
        --dark-box: #343a40;
        --accent-blue: #007bff;
        --navy-deep: #000c1a;
        --navy-modern: #001f3f;
        --navy-light: #083358;
        --text-gray: #6c757d;
        --accent-pink: #e91e63;
    }

    body { font-family: 'Poppins', sans-serif; background-color: #fff; margin: 0; }
    h2, h3, h5, .fw-bold { font-family: 'Montserrat', sans-serif; }

    /* --- TESTIMONIAL --- */
    .testi-outer-container { margin-top: 70px; background-color: #fff; }
    .testimonial-wrapper { display: flex; align-items: center; justify-content: center; position: relative; height: 330px; max-width: 1000px; margin: 0 auto; overflow: hidden; }
    .testi-card { position: absolute; background: #fff; padding: 40px 30px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.12), 0 5px 15px rgba(0,0,0,0.06); text-align: center; width: 100%; max-width: 450px; transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; z-index: 1; pointer-events: none; }
    .testi-card.active { opacity: 1; z-index: 3; transform: translateX(0) scale(1); pointer-events: all; }
    .testi-card.prev { opacity: 0.4; z-index: 2; transform: translateX(-350px) scale(0.8); }
    .testi-card.next { opacity: 0.4; z-index: 2; transform: translateX(350px) scale(0.8); }
    
    .quote-icon { position: absolute; bottom: -15px; right: 30px; color: var(--accent-pink); font-size: 5rem; font-family: Georgia, serif; opacity: 0.7; }
    .nav-btn-testi { cursor: pointer; font-size: 1.5rem; color: #333; z-index: 10; transition: 0.3s; padding: 10px; }
    .nav-btn-testi:hover { color: var(--accent-pink); }

    /* --- FEEDBACK OUTPUT SECTION (4 COLUMNS) --- */
    .teaser-section { display: flex; flex-wrap: wrap; background: #000; overflow: hidden; }
    .teaser-box { 
        flex: 1; 
        min-width: 250px; 
        height: 380px; 
        position: relative; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        color: #fff; 
        text-align: center; 
        padding: 30px; 
        cursor: pointer;
        transition: 0.5s ease;
        overflow: hidden;
    }
    
    .teaser-box .bg-img {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0.35;
        transition: 0.8s;
        z-index: 1;
    }

    .teaser-box:hover .bg-img { transform: scale(1.1); opacity: 0.5; }
    
    .teaser-content { position: relative; z-index: 2; width: 100%; }
    
    .teaser-box h5 { 
        font-size: 1rem; 
        font-weight: 700;
        text-transform: uppercase; 
        letter-spacing: 1.5px; 
        margin-bottom: 10px; 
        transform: translateY(20px);
        transition: 0.5s;
    }
    
    .teaser-box .icon-placeholder { 
        font-size: 2.5rem; 
        margin-bottom: 20px; 
        transition: 0.5s;
        color: #fff;
    }

    .teaser-box .short-desc {
        font-size: 0.85rem;
        opacity: 0;
        max-height: 0;
        transition: 0.5s ease;
        line-height: 1.6;
        padding: 0 10px;
    }

    .teaser-box:hover { background: var(--navy-modern); }
    .teaser-box:hover h5 { transform: translateY(0); }
    .teaser-box:hover .short-desc { opacity: 1; max-height: 120px; margin-top: 15px; }

    /* --- HOW IT WORKS --- */
    .how-it-works-title { text-align: center; font-weight: 500; color: #333; margin-bottom: 50px; font-size: 2rem; margin-top: 50px;}
    .nav-steps-container { position: relative; max-width: 800px; margin: 0 auto 60px; }
    .nav-line { position: absolute; top: 25px; left: 0; right: 0; height: 2px; background: #e9ecef; z-index: 1; }
    .nav-steps-wrapper { display: flex; justify-content: space-between; position: relative; z-index: 2; }
    .step-item { text-align: center; flex: 1; cursor: pointer; opacity: 0.4; transition: 0.3s; }
    .step-item.active { opacity: 1; }
    .step-circle { width: 50px; height: 50px; border-radius: 50%; background: #6c757d; color: #fff; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold; border: 4px solid #fff; }
    .step-item.active .step-circle { background: var(--dark-box); }
    .step-label { font-size: 0.9rem; font-weight: 600; color: #333; }
    .stack-area { position: relative; width: 100%; height: 400px; display: flex; align-items: center; justify-content: center; }
    .photo-card { position: absolute; width: 320px; height: 400px; background: #fff; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .photo-card img { width: 100%; height: 100%; object-fit: cover; }
    .photo-card.front { z-index: 10; transform: translateX(40px) scale(1); opacity: 1; }
    .photo-card.mid { z-index: 5; transform: translateX(10px) scale(0.95); opacity: 0.6; }
    .photo-card.back { z-index: 1; transform: translateX(-20px) scale(0.9); opacity: 0.3; }

    /* --- CTA SECTION --- */
    .subscribe-cta-wrapper {
        width: 100%;
        background: linear-gradient(135deg, var(--navy-deep) 0%, var(--navy-modern) 50%, #0e4d88 100%);
        padding: 60px 0;
        margin-top: 50px;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    @keyframes floating {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }

    .cta-content-full {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
        text-align: center;
        position: relative;
        z-index: 5;
    }

    .cta-icon-mini {
        font-size: 2.2rem;
        background: rgba(255, 255, 255, 0.1);
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
        margin: 0 auto 30px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        animation: floating 3s ease-in-out infinite;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .cta-content-full h2 {
        font-size: 2.2rem; 
        font-weight: 700;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    .cta-content-full p {
        font-size: 1.1rem;
        opacity: 0.85;
        margin-bottom: 40px;
        line-height: 1.7;
    }

    .modern-input-group {
        display: flex;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px;
        border-radius: 100px;
        max-width: 600px;
        margin: 0 auto;
        transition: 0.4s;
        backdrop-filter: blur(5px);
    }

    .modern-input-group input {
        background: transparent;
        border: none;
        padding: 12px 25px;
        color: #fff;
        flex: 1;
        outline: none;
    }

    .btn-modern-submit {
        background: #fff;
        color: var(--navy-deep);
        border: none;
        padding: 0 35px;
        border-radius: 100px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none; 
    }

    .btn-modern-submit:hover {
        background: var(--accent-blue);
        color: #fff;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .teaser-section { flex-direction: column; }
        .teaser-box { height: 320px; }
        .cta-content-full h2 { font-size: 1.8rem; }
        .modern-input-group { flex-direction: column; border-radius: 20px; background: transparent; border: none; }
        .modern-input-group input { background: rgba(255,255,255,0.1); margin-bottom: 12px; border-radius: 50px; text-align: center; }
        .btn-modern-submit { padding: 15px; }
    }
</style>

<div class="testi-outer-container">
    <div class="container text-center">
        <h2 class="fw-bold">Apa Kata Mereka?</h2>
        <div class="testimonial-wrapper">
            <div class="nav-btn-testi" onclick="slideTesti('prev')"><i class="bi bi-chevron-left"></i></div>
            <div id="testi-slider-content" style="position:relative; width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
                <div class="testi-card active" id="t-0">
                    <p class="fst-italic text-muted">"Layanan BK sangat membantu saya dalam menentukan jurusan kuliah."</p>
                    <div class="fw-bold small text-uppercase mt-3">Siswa Kelas XII - IPA</div>
                    <div class="quote-icon">”</div>
                </div>
                <div class="testi-card next" id="t-1">
                    <p class="fst-italic text-muted">"Fasilitas sekolah semakin lengkap berkat kotak saran yang aktif didengar."</p>
                    <div class="fw-bold small text-uppercase mt-3">Alumni 2024</div>
                    <div class="quote-icon">”</div>
                </div>
                <div class="testi-card" id="t-2">
                    <p class="fst-italic text-muted">"Proses konseling jadi jauh lebih nyaman dan terjaga kerahasiaannya."</p>
                    <div class="fw-bold small text-uppercase mt-3">Siswa Kelas XI</div>
                    <div class="quote-icon">”</div>
                </div>
            </div>
            <div class="nav-btn-testi" onclick="slideTesti('next')"><i class="bi bi-chevron-right"></i></div>
        </div>
    </div>
</div>

<div class="teaser-section">
    <div class="teaser-box">
        <div class="bg-img" style="background-image: url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?q=80&w=800');"></div>
        <div class="teaser-content">
            <div class="icon-placeholder"><i class="bi bi-shield-check"></i></div>
            <h5>Respon Anonim</h5>
            <p class="short-desc">Setiap saran yang masuk ditangani tanpa perlu mengungkap identitasmu, memberikan rasa aman 100%.</p>
        </div>
    </div>
    <div class="teaser-box">
        <div class="bg-img" style="background-image: url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=800');"></div>
        <div class="teaser-content">
            <div class="icon-placeholder"><i class="bi bi-chat-right-quote"></i></div>
            <h5>Validasi Nyata</h5>
            <p class="short-desc">Saranmu tidak hanya dibaca, tapi divalidasi oleh tim BK untuk memastikan aspirasimu sampai ke pihak sekolah.</p>
        </div>
    </div>
    <div class="teaser-box">
        <div class="bg-img" style="background-image: url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?q=80&w=800');"></div>
        <div class="teaser-content">
            <div class="icon-placeholder"><i class="bi bi-patch-check"></i></div>
            <h5>Aksi Perubahan</h5>
            <p class="short-desc">Dari fasilitas rusak hingga kebijakan sekolah, saranmu menjadi dasar perubahan nyata di lingkungan sekolah.</p>
        </div>
    </div>
    <div class="teaser-box">
        <div class="bg-img" style="background-image: url('https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=800');"></div>
        <div class="teaser-content">
            <div class="icon-placeholder"><i class="bi bi-clipboard-data"></i></div>
            <h5>Transparansi Solusi</h5>
            <p class="short-desc">Siswa mendapatkan kepastian bahwa setiap masalah yang dilaporkan melalui kotak saran sedang diproses.</p>
        </div>
    </div>
</div>

<div style="background: #fff;">
    <div class="container">
        <h2 class="how-it-works-title">How Its Works ?</h2>
        <div class="nav-steps-container">
            <div class="nav-line"></div>
            <div class="nav-steps-wrapper">
                <div class="step-item active" onclick="manualChange(1)" id="nav-1"><div class="step-circle">1</div><div class="step-label">Tulis Saran</div></div>
                <div class="step-item" onclick="manualChange(2)" id="nav-2"><div class="step-circle">2</div><div class="step-label">Validasi BK</div></div>
                <div class="step-item" onclick="manualChange(3)" id="nav-3"><div class="step-circle">3</div><div class="step-label">Tindak Lanjut</div></div>
            </div>
        </div>
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <div class="stack-area">
                    <div id="photo-1" class="photo-card front"><img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600" alt="Step 1"></div>
                    <div id="photo-2" class="photo-card mid"><img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=600" alt="Step 2"></div>
                    <div id="photo-3" class="photo-card back"><img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=600" alt="Step 3"></div>
                </div>
            </div>
            <div class="col-md-5">
                <div id="text-content">
                    <h3 class="fw-bold mb-3" id="step-title">Tulis Saran</h3>
                    <p class="text-muted mb-4" id="step-desc">Sampaikan aspirasi atau ide cemerlangmu melalui form yang tersedia.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;"><i class="bi bi-play-fill"></i></div>
                        <span class="fw-bold small">Lihat Video Panduan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="subscribe-cta-wrapper">
    <div class="cta-content-full">
        <div class="cta-icon-mini">
            <i class="bi bi-chat-heart-fill"></i>
        </div>
        <h2>Suaramu Adalah Perubahan</h2>
        <p>Butuh bantuan BK atau punya ide cemerlang untuk kemajuan sekolah? Kirimkan aspirasimu sekarang secara aman dan 100% rahasia.</p>
        
        <div class="modern-input-group">
            <input type="text" placeholder="Apa yang ada di pikiranmu hari ini?" readonly style="cursor: default;">
            <a href="<?php echo e(route('login')); ?>" class="btn-modern-submit">
                Kirim Sekarang <i class="bi bi-send-fill"></i>
            </a>
        </div>
    </div>
</div>

<script>
    let currentT = 0;
    const totalT = 3;
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

    const stepsData = [
        { title: "Tulis Saran", desc: "Sampaikan aspirasi atau ide cemerlangmu melalui form yang tersedia." },
        { title: "Validasi BK", desc: "Tim bimbingan konseling akan memvalidasi masukanmu secara profesional." },
        { title: "Tindak Lanjut", desc: "Saran yang membangun akan direalisasikan demi kemajuan sekolah." }
    ];
    function changeStep(n) {
        const idx = n - 1;
        document.querySelectorAll('.step-item').forEach((item, i) => { item.classList.toggle('active', i === idx); });
        document.getElementById('step-title').innerText = stepsData[idx].title;
        document.getElementById('step-desc').innerText = stepsData[idx].desc;
        const p1 = document.getElementById('photo-1'), p2 = document.getElementById('photo-2'), p3 = document.getElementById('photo-3');
        p1.className = 'photo-card'; p2.className = 'photo-card'; p3.className = 'photo-card';
        if (n === 1) { p1.classList.add('front'); p2.classList.add('mid'); p3.classList.add('back'); }
        else if (n === 2) { p2.classList.add('front'); p3.classList.add('mid'); p1.classList.add('back'); }
        else { p3.classList.add('front'); p1.classList.add('mid'); p2.classList.add('back'); }
    }
    function manualChange(n) { changeStep(n); }
    slideTesti('init');
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\e-bk-care-venusvault\resources\views/kotaksaran.blade.php ENDPATH**/ ?>