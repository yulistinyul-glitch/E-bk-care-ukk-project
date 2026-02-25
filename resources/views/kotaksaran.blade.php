@extends('layouts.app')

@section('title', 'Kotak Saran')

@section('content')

<style>
    :root {
        --bg-gray: #f4f7f9;
        --dark-box: #343a40;
        --accent-blue: #007bff;
        --text-gray: #6c757d;
        --accent-pink: #e91e63;
        --soft-blue-testi: #f0f7ff;
    }

    body { font-family: 'Inter', sans-serif; background-color: #fff; }

    /* --- TESTIMONIAL --- */
    .testi-outer-container { margin-top: 70px; background-color: #fff; }
    .testimonial-wrapper { display: flex; align-items: center; justify-content: center; position: relative; height: 330px; max-width: 1100px; margin: 0 auto; overflow: hidden; }
    .testi-card { position: absolute; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 15px 35px rgba(0,0,0,0.12), 0 5px 15px rgba(0,0,0,0.06); text-align: center; width: 100%; max-width: 500px; transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0; z-index: 1; pointer-events: none; }
    .testi-card.active { opacity: 1; z-index: 3; transform: translateX(0) scale(1); pointer-events: all; }
    .testi-card.prev { opacity: 0.4; z-index: 2; transform: translateX(-350px) scale(0.8); }
    .testi-card.next { opacity: 0.4; z-index: 2; transform: translateX(350px) scale(0.8); }
    .stars { color: #ffc107; margin-bottom: 15px; }
    .stars i.gray { color: #ddd; }
    .quote-icon { position: absolute; bottom: -15px; right: 30px; color: var(--accent-pink); font-size: 5rem; font-family: Georgia, serif; opacity: 0.7; }
    .nav-btn-testi { cursor: pointer; font-size: 1.5rem; color: #333; z-index: 10; transition: 0.3s; padding: 10px; }
    .nav-btn-testi:hover { color: var(--accent-pink); }

    /* --- TEASER --- */
    .teaser-section { display: flex; background: var(--dark-box); }
    .teaser-box { flex: 1; padding: 60px 30px; color: #fff; text-align: center; border-right: 1px solid rgba(255,255,255,0.1); transition: 0.3s; }
    .teaser-box:last-child { border-right: none; }
    .teaser-box.active { background: #4a5057; }
    .teaser-box h5 { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; opacity: 0.8; }
    .teaser-box .icon-placeholder { width: 40px; height: 40px; margin: 0 auto 20px; border: 1px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; }
    .teaser-box .nav-arrow { width: 30px; height: 30px; border-radius: 50%; border: 1px solid #fff; margin: 20px auto 0; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; }

    /* --- HOW IT WORKS --- */
    .how-it-works-title { text-align: center; font-weight: 500; color: #333; margin-bottom: 40px; font-size: 2rem; }
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

    /* --- CTA SECTION DENGAN ANIMASI SURAT --- */
    .cta-wrapper { 
        padding: 100px 0; 
        background-color: #f2f5f7; /* Background abu-abu luar */
    }
    .cta-container { 
        background: #fff; 
        border-radius: 24px; 
        padding: 60px; 
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        gap: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.02);
    }
    .cta-content { flex: 1.2; z-index: 2; }
    .cta-title { font-size: 2.8rem; color: var(--dark-box); margin-bottom: 20px; line-height: 1.2; font-weight: 800; }
    .cta-btn { 
        background: var(--text-gray); 
        color: #fff !important; 
        padding: 16px 35px; 
        border-radius: 30px; 
        text-decoration: none; 
        font-weight: 700; 
        display: inline-flex; 
        align-items: center; 
        gap: 12px;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .cta-btn:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(99, 159, 255, 0.3); }

    /* Animasi Kotak Surat */
    .plane-animation-area { 
        flex: 0.8; 
        height: 250px; 
        position: relative; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
    }
    .mailbox-static {
        font-size: 7rem;
        color: var(--dark-box);
        z-index: 1;
        position: relative;
    }
    .letter-icon {
        position: absolute;
        font-size: 2.5rem;
        color: var(--accent-pink);
        z-index: 2;
        animation: letter-in 2.5s ease-in-out infinite;
    }
    .plane-circle {
        width: 220px;
        height: 220px;
        border: 2px dashed #dee2e6;
        border-radius: 50%;
        position: absolute;
        animation: rotate-circle 15s linear infinite;
    }

    @keyframes letter-in {
        0% { transform: translate(100px, -100px) rotate(45deg); opacity: 0; }
        30% { opacity: 1; }
        70% { transform: translate(0, 0) rotate(0deg); opacity: 1; }
        100% { transform: translate(-20px, 10px) scale(0.5); opacity: 0; }
    }

    @keyframes rotate-circle {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<div class="testi-outer-container">
    <div class="container text-center">
        <h2 class="fw-bold">Qué dicen nuestros clientes</h2>
        <div class="testimonial-wrapper">
            <div class="nav-btn-testi" onclick="slideTesti('prev')"><i class="bi bi-chevron-left"></i></div>
            <div id="testi-slider-content" style="position:relative; width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
                <div class="testi-card active" id="t-0">
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill gray"></i></div>
                    <p class="fst-italic text-muted">"Sin duda repetiríamos. Nos ha gustado lo bien equipada que estaba. Selain itu mereka sangat ramah."</p>
                    <div class="fw-bold small text-uppercase mt-3">Pedro Santos - GRANADA</div>
                    <div class="quote-icon">”</div>
                </div>
                <div class="testi-card next" id="t-1">
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p class="fst-italic text-muted">"We had a great time staying here. Arrival was seamless and location is great."</p>
                    <div class="fw-bold small text-uppercase mt-3">Maria Samper - MADRID</div>
                    <div class="quote-icon">”</div>
                </div>
                <div class="testi-card" id="t-2">
                    <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                    <p class="fst-italic text-muted">"Excelente ubicación y servicio impecable. Muy recomendado untuk familias."</p>
                    <div class="fw-bold small text-uppercase mt-3">Juan Carlos - BARCELONA</div>
                    <div class="quote-icon">”</div>
                </div>
            </div>
            <div class="nav-btn-testi" onclick="slideTesti('next')"><i class="bi bi-chevron-right"></i></div>
        </div>
    </div>
</div>

<div class="teaser-section">
    <div class="teaser-box">
        <h5>One<br>Teaser Box</h5>
        <div class="icon-placeholder"><i class="bi bi-image"></i></div>
        <div class="nav-arrow"><i class="bi bi-arrow-right"></i></div>
    </div>
    <div class="teaser-box">
        <h5>Two<br>Teaser Box</h5>
        <div class="icon-placeholder"><i class="bi bi-image"></i></div>
        <div class="nav-arrow"><i class="bi bi-arrow-right"></i></div>
    </div>
    <div class="teaser-box active">
        <h5>Three<br>Teaser Box</h5>
        <p class="small opacity-75">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>
        <div class="nav-arrow"><i class="bi bi-arrow-right"></i></div>
    </div>
    <div class="teaser-box">
        <h5>Four<br>Teaser Box</h5>
        <div class="icon-placeholder"><i class="bi bi-image"></i></div>
        <div class="nav-arrow"><i class="bi bi-arrow-right"></i></div>
    </div>
</div>

<div class="py-5" style="background: #fff;">
    <div class="container">
        <h2 class="how-it-works-title mt-2">How it works?</h2>
        <div class="nav-steps-container">
            <div class="nav-line"></div>
            <div class="nav-steps-wrapper">
                <div class="step-item active" onclick="manualChange(1)" id="nav-1"><div class="step-circle">1</div><div class="step-label">Step One</div></div>
                <div class="step-item" onclick="manualChange(2)" id="nav-2"><div class="step-circle">2</div><div class="step-label">Step Two</div></div>
                <div class="step-item" onclick="manualChange(3)" id="nav-3"><div class="step-circle">3</div><div class="step-label">Step Three</div></div>
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
                <div id="text-content" style="transition: 0.4s;">
                    <h3 class="fw-bold mb-3" id="step-title">Step One</h3>
                    <p class="text-muted mb-4" id="step-desc" style="font-size: 0.95rem; line-height: 1.8;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in form.</p>
                    <div class="d-flex align-items-center">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;"><i class="bi bi-play-fill"></i></div>
                        <span class="fw-bold small">Watch how it works!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cta-wrapper">
    <div class="container">
        <div class="cta-container">
            <div class="cta-content">
                <h2 class="cta-title">Punya Saran <br>untuk Kami?</h2>
                <p class="text-muted mb-4" style="font-size: 1.1rem;">Kami sangat menghargai setiap masukan Anda untuk terus meningkatkan layanan kami. Sampaikan pesan Anda secara digital sekarang juga!</p>
                <a href="#" class="cta-btn">
                    Kirim Saran Sekarang <i class="bi bi-send-fill"></i>
                </a>
            </div>
            <div class="plane-animation-area">
                <i class="bi bi-mailbox2 mailbox-static"></i>
                <i class="bi bi-envelope-paper-fill letter-icon"></i>
                <div class="plane-circle"></div>
            </div>
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
            card.className = 'testi-card';
            if(i === currentT) card.classList.add('active');
            else if(i === (currentT - 1 + totalT) % totalT) card.classList.add('prev');
            else if(i === (currentT + 1) % totalT) card.classList.add('next');
        }
    }
    const stepsData = [
        { title: "Step One", desc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in form." },
        { title: "Step Two", desc: "It is a long established fact that a reader will be distracted by the readable content of a page." },
        { title: "Step Three", desc: "Contrary to popular belief, Lorem Ipsum is not simply random text." }
    ];
    function changeStep(n) {
        const idx = n - 1;
        document.querySelectorAll('.step-item').forEach((item, i) => { item.classList.toggle('active', i === idx); });
        const textArea = document.getElementById('text-content');
        textArea.style.opacity = 0;
        setTimeout(() => {
            document.getElementById('step-title').innerText = stepsData[idx].title;
            document.getElementById('step-desc').innerText = stepsData[idx].desc;
            textArea.style.opacity = 1;
        }, 400);
        const p1 = document.getElementById('photo-1'), p2 = document.getElementById('photo-2'), p3 = document.getElementById('photo-3');
        p1.className = 'photo-card'; p2.className = 'photo-card'; p3.className = 'photo-card';
        if (n === 1) { p1.classList.add('front'); p2.classList.add('mid'); p3.classList.add('back'); }
        else if (n === 2) { p2.classList.add('front'); p3.classList.add('mid'); p1.classList.add('back'); }
        else { p3.classList.add('front'); p1.classList.add('mid'); p2.classList.add('back'); }
    }
    function manualChange(n) { changeStep(n); }
    slideTesti('init');
</script>

@endsection