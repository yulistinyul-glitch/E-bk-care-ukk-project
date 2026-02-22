@extends('layouts.app')

@section('title', 'Kotak Saran')

@section('content')

<style>
    :root {
        --bg-gray: #f4f7f9;
        --dark-box: #343a40;
        --accent-blue: #007bff;
        --text-gray: #6c757d;
    }

    body { font-family: 'Inter', sans-serif; background-color: #fff; }

    /* --- STEP NAVIGATION (EXACT MATCH) --- */
    .how-it-works-title {
        text-align: center;
        font-weight: 500;
        color: #333;
        margin-bottom: 40px;
        font-size: 2rem;
    }

    .nav-steps-container {
        position: relative;
        max-width: 800px;
        margin: 0 auto 60px;
    }

    .nav-line {
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e9ecef;
        z-index: 1;
    }

    .nav-steps-wrapper {
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .step-item {
        text-align: center;
        flex: 1;
        cursor: pointer;
        opacity: 0.4;
        transition: 0.3s;
    }

    .step-item.active { opacity: 1; }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #6c757d;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-weight: bold;
        border: 4px solid #fff;
    }

    .step-item.active .step-circle { background: var(--dark-box); }
    .step-label { font-size: 0.9rem; font-weight: 600; color: #333; }

    /* --- PHOTO STACK (LEFT STACKING) --- */
    .stack-area {
        position: relative;
        width: 100%;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-card {
        position: absolute;
        width: 320px;
        height: 400px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px; /* Sesuai gambar: lebih kotak */
        overflow: hidden;
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .photo-card img { width: 100%; height: 100%; object-fit: cover; }

    /* Posisi tumpukan ke KIRI (sesuai referensi gambar) */
    .photo-card.front { z-index: 10; transform: translateX(40px) scale(1); opacity: 1; }
    .photo-card.mid { z-index: 5; transform: translateX(10px) scale(0.95); opacity: 0.6; }
    .photo-card.back { z-index: 1; transform: translateX(-20px) scale(0.9); opacity: 0.3; }

    /* --- TEASER BOXES (BOTTOM) --- */
    .teaser-section {
        display: flex;
        background: var(--dark-box);
        margin-top: 50px;
    }

    .teaser-box {
        flex: 1;
        padding: 60px 30px;
        color: #fff;
        text-align: center;
        border-right: 1px solid rgba(255,255,255,0.1);
        transition: 0.3s;
    }

    .teaser-box:last-child { border-right: none; }
    .teaser-box.active { background: #4a5057; }
    .teaser-box h5 { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; opacity: 0.8; }
    .teaser-box .icon-placeholder { 
        width: 40px; height: 40px; margin: 0 auto 20px; 
        border: 1px solid rgba(255,255,255,0.3); 
        display: flex; align-items: center; justify-content: center;
    }
    .teaser-box .nav-arrow { 
        width: 30px; height: 30px; border-radius: 50%; 
        border: 1px solid #fff; margin: 20px auto 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
    }
</style>

<div class="py-5">
    <div class="container">
        <h2 class="how-it-works-title">How it works?</h2>
        
        <div class="nav-steps-container">
            <div class="nav-line"></div>
            <div class="nav-steps-wrapper">
                <div class="step-item active" onclick="manualChange(1)" id="nav-1">
                    <div class="step-circle">1</div>
                    <div class="step-label">Step One</div>
                </div>
                <div class="step-item" onclick="manualChange(2)" id="nav-2">
                    <div class="step-circle">2</div>
                    <div class="step-label">Step Two</div>
                </div>
                <div class="step-item" onclick="manualChange(3)" id="nav-3">
                    <div class="step-circle">3</div>
                    <div class="step-label">Step Three</div>
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <div class="stack-area">
                    <div id="photo-1" class="photo-card front">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600" alt="Step 1">
                    </div>
                    <div id="photo-2" class="photo-card mid">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=600" alt="Step 2">
                    </div>
                    <div id="photo-3" class="photo-card back">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=600" alt="Step 3">
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div id="text-content">
                    <h3 class="fw-bold mb-3" id="step-title">Step One</h3>
                    <p class="text-muted mb-4" id="step-desc" style="font-size: 0.95rem; line-height: 1.8;">
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in form. 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                            <i class="bi bi-play-fill"></i>
                        </div>
                        <span class="fw-bold small">Watch how it works!</span>
                    </div>
                </div>
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
</div>

<script>
    const stepsData = [
        { title: "Step One", desc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in form. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt." },
        { title: "Step Two", desc: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal." },
        { title: "Step Three", desc: "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old." }
    ];

    function changeStep(n) {
        const idx = n - 1;
        
        // Nav Update
        document.querySelectorAll('.step-item').forEach((item, i) => {
            item.classList.toggle('active', i === idx);
        });

        // Text Update
        const textArea = document.getElementById('text-content');
        textArea.style.opacity = 0;
        
        setTimeout(() => {
            document.getElementById('step-title').innerText = stepsData[idx].title;
            document.getElementById('step-desc').innerText = stepsData[idx].desc;
            textArea.style.opacity = 1;
        }, 400);

        // Photo Stack Update (Left Stacking Logic)
        const p1 = document.getElementById('photo-1');
        const p2 = document.getElementById('photo-2');
        const p3 = document.getElementById('photo-3');

        p1.className = 'photo-card'; p2.className = 'photo-card'; p3.className = 'photo-card';

        if (n === 1) {
            p1.classList.add('front'); p2.classList.add('mid'); p3.classList.add('back');
        } else if (n === 2) {
            p2.classList.add('front'); p3.classList.add('mid'); p1.classList.add('back');
        } else {
            p3.classList.add('front'); p1.classList.add('mid'); p2.classList.add('back');
        }
    }

    let currentStep = 1;
    let autoSlide = setInterval(() => {
        currentStep = (currentStep % 3) + 1;
        changeStep(currentStep);
    }, 5000);

    function manualChange(n) {
        clearInterval(autoSlide);
        changeStep(n);
    }
</script>

@endsection