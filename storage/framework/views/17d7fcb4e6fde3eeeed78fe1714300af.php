<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-BK Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    :root {
        --dark-blue: #0f2744;
        --gold: #B89551;
        --navy: #1A374D;
        --faq-bg: #0a0a0a;
    }

    body { font-family: 'Montserrat', sans-serif; margin: 0; overflow-x: hidden; background-color: #fff; }
    .hero-section { position: relative; min-height: 100vh; display: flex; flex-direction: column; overflow: hidden; }
    .hero-slideshow { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; }
    .slide { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; opacity: 1; transition: opacity 1.5s ease-in-out; }
    .slide.active { opacity: 1; }
    .hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.42); z-index: -2; }

    /* --- HEADER & NAV --- */
    .header-top { padding: 40px 0 20px 0; text-align: center; position: relative; z-index: 1000; }
    .logo-placeholder { width: 100px; height: 100px; background: white; border: 3px solid #8ba8bc; border-radius: 50%; display: inline-block; margin-bottom: 40px; }
    .logo-img { width: 5rem; height: 5rem; justify-content: center; align-items: center; overflow: hidden; transform: translateY(4px);}
    
    .nav-menu { display: flex; justify-content: center; gap: 70px; transition: 0.4s ease; }
    .nav-menu a { 
        text-decoration: none; 
        color: var(--dark-blue); 
        font-weight: 600; 
        font-size: 0.85rem; 
        letter-spacing: 1.5px; 
        position: relative; 
        transition: color 0.3s ease; 
    }
    .nav-menu a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: var(--gold);
        transition: width 0.3s ease;
    }
    .nav-menu a:hover::after { width: 100%; }

    .login-btn { 
        position: absolute; 
        top: 0; 
        right: 1.5rem; 
        background: var(--dark-blue); 
        color: white !important; 
        padding: 7px 25px; 
        border-radius: 20px; 
        font-weight: bold; 
        text-decoration: none; 
        font-size: 0.8rem; 
        z-index: 1001; 
        transition: all 0.3s ease;
    }
    .login-btn:hover { background: var(--gold); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(184, 149, 81, 0.3); }

    .hamburger { display: none; cursor: pointer; flex-direction: column; gap: 6px; position: absolute; top: 5px; left: 1.5rem; z-index: 1100; }
    .hamburger span { width: 30px; height: 3px; background: var(--dark-blue); border-radius: 10px; transition: 0.3s; transform-origin: left; }

    @media (max-width: 992px) {
        .hamburger { display: flex; }
        .nav-menu {
            position: fixed; top: 0; left: -100%; width: 280px; height: 100vh;
            background: white; flex-direction: column; justify-content: flex-start;
            padding: 120px 40px; gap: 30px; box-shadow: 10px 0 30px rgba(0,0,0,0.1); z-index: 1050;
        }
        .nav-menu.active { left: 0; }
        .hamburger.open span:nth-child(1) { transform: rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: rotate(-45deg); }
    }

    .content-area { padding-top: 40px; max-width: 850px; }
    .title-large { font-family: 'Great Vibes', cursive; font-size: 3.4rem; color: var(--dark-blue); line-height: 1.2; margin-bottom: 40px; }
    .title-small { font-family: 'Great Vibes', cursive; font-size: 3.2rem; color: var(--dark-blue); line-height: 1.1; margin-top: -10px; margin-bottom: 15px; }
    .description { color: #ffffff; font-size: 0.9rem; max-width: 480px; line-height: 1.6; text-shadow: 1px 1px 3px rgba(0,0,0,0.4); margin-bottom: 35px; }
    .btn-see-more { display: inline-flex; align-items: center; justify-content: space-between; margin-bottom: 50px; width: 210px; border: 2px solid rgba(255, 255, 255, 0.8); color: white; text-decoration: none; padding: 10px 25px; border-radius: 50px; font-weight: bold; font-size: 0.85rem; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(2px); }

    /* --- SECTIONS (VALUES, STATS, SLIDER, FEEDBACK) --- */
    .values-section { padding: 80px 0; background: #fff; }
    .values-title-box h2 { font-weight: 800; color: var(--dark-blue); font-size: 2.2rem; line-height: 1.2; }
    .values-title-box span { font-family: 'Great Vibes', cursive; color: var(--gold); font-size: 2.5rem; font-weight: 400; display: block; margin-top: 12px; }
    .values-content p { color: #64748b; font-size: 0.9rem; line-height: 1.8; margin-bottom: 20px; text-align: justify; }
    .btn-read-more { background: #4a443e; color: white; padding: 10px 30px; border-radius: 18px; text-decoration: none; font-weight: 600; font-size: 0.85rem; display: inline-block; transition: 0.3s; }
    .btn-read-more:hover { background: var(--dark-blue); color: #fff; }

    .stats-section { background: linear-gradient(rgba(15, 39, 68, 0.85), rgba(15, 39, 68, 0.85)), url('https://images.pexels.com/photos/3184311/pexels-photo-3184311.jpeg?auto=compress&cs=tinysrgb&w=1260'); background-size: cover; background-position: center; background-attachment: fixed; padding: 60px 0; color: white; text-align: center; }
    .stats-header h2 { font-weight: 700; font-size: 2rem; margin-bottom: 15px; }
    .stats-header p { font-size: 0.85rem; max-width: 700px; margin: 0 auto 50px; opacity: 0.8; line-height: 1.6; }
    .stat-item h3 { font-size: 2.4rem; font-weight: 800; margin-bottom: 5px; }
    .stat-item p { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; color: var(--gold); font-weight: 700; }

    .card-slider-section { padding: 80px 0 40px 0; background-color: #f1f5f9; display: flex; flex-direction: column; align-items: center; overflow: hidden; }
    .slider-wrapper { display: flex; align-items: center; justify-content: center; width: 100%; perspective: 1200px; padding: 40px 0; height: 420px; position: relative; }
    .custom-card { width: 260px; height: 360px; background: white; position: absolute; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.8s ease-in-out; display: flex; flex-direction: column; padding: 12px; border: 1px solid #e2e8f0; visibility: hidden; opacity: 0; }
    .card-img-top { margin-top: 5px; padding: 15px; max-width: 100%; height: 180px; object-fit: cover; }
    .card-body-text { padding: 15px 5px; flex-grow: 1; display: flex; align-items: center; }
    .card-body-text h5 { font-size: 0.95rem; font-weight: 800; color: #1e293b; text-align: center; line-height: 1.4; margin-bottom: 15px; }
    .card-footer-box { display: flex; align-items: center; justify-content: space-between; padding: 10px 5px; border-top: 1px solid #f1f5f9; }
    .author-group { display: flex; align-items: center; gap: 8px; }
    .author-icon { width: 22px; height: 22px; background: #cbd5e1; border-radius: 50%; flex-shrink: 0; }
    .author-name { font-size: 0.65rem; color: #64748b; margin-bottom: 0; white-space: nowrap; }
    .arrow-icon { font-size: 1rem; color: #334155; }
    .pos-center { visibility: visible; opacity: 1; z-index: 5; transform: translateZ(100px); }
    .pos-left-1 { visibility: visible; opacity: 0.7; z-index: 3; transform: translateX(-220px) rotateY(30deg) scale(0.85); }
    .pos-left-2 { visibility: visible; opacity: 0.3; z-index: 1; transform: translateX(-400px) rotateY(45deg) scale(0.7); }
    .pos-right-1 { visibility: visible; opacity: 0.7; z-index: 3; transform: translateX(220px) rotateY(-30deg) scale(0.85); }
    .pos-right-2 { visibility: visible; opacity: 0.3; z-index: 1; transform: translateX(400px) rotateY(-45deg) scale(0.7); }
    .dots-container { display: flex; gap: 10px; margin-top: 20px; }
    .dot { width: 8px; height: 8px; background: #d1d1d1; border-radius: 50%; border: none; padding: 0; cursor: pointer; transition: 0.4s; }
    .dot.active { background: var(--dark-blue); transform: scale(1.3); }

.feedback-section { padding: 100px 0; background-color: #ffffff; font-family: 'Poppins', sans-serif; }

.feedback-header { text-align: center; margin-bottom: 60px; }

/* Sub-judul yang konsisten */
.feedback-header span { 
    color: var(--gold); 
    font-size: 0.9rem; 
    font-weight: 600; 
    letter-spacing: 3px; 
    text-transform: uppercase; 
    display: block; 
    margin-bottom: 15px; 
}

.feedback-header h2 { 
    font-weight: 800; 
    color: var(--dark-blue); 
    font-size: 2.2rem; 
}


.feedback-card { 
    background: #ffffff; 
    border-radius: 20px; 
    padding: 40px; 
    height: 100%; 
    border: 1px solid #f0f0f0; 
    position: relative;
    transition: all 0.4s ease; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.feedback-card:hover { 
    transform: translateY(-10px); 
    border-color: var(--gold); 
    box-shadow: 0 20px 40px rgba(184, 149, 81, 0.1); 
}

.feedback-text { 
    color: #475569; 
    font-size: 0.95rem; 
    line-height: 1.7; 
    margin: 20px 0; 
    font-weight: 400; 
}

.user-details h6 { 
    margin: 0; 
    font-weight: 700; 
    color: #0f2744; 
    font-size: 0.95rem; 
}

.user-details p { 
    margin: 0; 
    color: #94a3b8; 
    font-size: 0.8rem; 
    font-weight: 400; 
}
    .user-info { display: flex; align-items: center; gap: 15px; }
    .avatar { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.85rem; }

    /* --- FAQ SECTION --- */
    .faq-section { background-color: #fff; padding: 50px 20px; color: #000; }
    .faq-title { color: #000; font-weight: 800; font-size: 2.5rem; margin-bottom: 40px; text-align: center; }
    .faq-section .accordion-item { background: #fff; border: none; border-bottom: 1px solid #e2e8f0; margin-bottom: 10px; }
    .faq-section .accordion-button { background: transparent; color: #000; font-weight: 600; font-size: 1rem; padding: 25px 10px; box-shadow: none !important; }
    .faq-section .accordion-button:not(.collapsed) { color: var(--gold); background: transparent; }
    .faq-section .accordion-button::after { filter: brightness(0) invert(1); }
    .faq-section .accordion-body { color: #64748b; font-size: 0.95rem; line-height: 1.8; padding-bottom: 30px; }

    .feedback-footer-link { text-align: center; }
    .btn-feedback-cta { color: var(--dark-blue); text-decoration: none; font-weight: 800; font-size: 1rem; display: inline-flex; align-items: center; gap: 10px; transition: 0.3s; margin-top: 70px;  margin-bottom: 8px;}
    .btn-feedback-cta:hover { color: var(--gold); transform: translateX(5px); }

    @media (max-width: 768px) {
        .custom-card { width: 200px; height: 300px; }
        .pos-left-1 { transform: translateX(-120px) scale(0.8); }
        .pos-right-1 { transform: translateX(120px) scale(0.8); }
        .pos-left-2, .pos-right-2 { display: none; }
        .title-large { font-size: 2.5rem; }
        .title-small { font-size: 2.2rem; }
        .faq-title { font-size: 1.8rem; }
    }
</style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-slideshow">
            <div class="slide active" style="background-image: url('/img/hero.jpeg')"></div>
        </div>
        <div class="hero-overlay"></div>

        <div class="header-top">
            <div class="container px-4 position-relative">
                <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
                <div class="logo-placeholder">
                      <img src="<?php echo e(asset('img/logo-ebkCare.png')); ?>" alt="Logo" width="40" class="logo-img">
                </div>
                <a href="<?php echo e(route('login')); ?>" class="login-btn">LOGIN</a>
                <div class="nav-menu" id="navMenu">
                    <a href="home">BERANDA</a><a href="tentang">TENTANG</a><a href="artikel">ARTIKEL</a><a href="layanan">LAYANAN</a><a href="kotaksaran">KOTAK SARAN</a> 
                </div>
            </div>
        </div>

        <div class="container px-4">
            <div class="content-area">
                <div class="title-large ">Your Safety is Our Priority</div>
                <div class="title-small">Voice is Your Power</div>
                <p class="description">Identity remains strictly confidential. You are never alone.</p>
                <a href="#values-section" class="btn-see-more">SEE MORE <span>&rarr;</span></a>
            </div>
        </div>
    </div>

<section id="values-section" class="values-section">
    <div class="container px-4">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="values-title-box">
                    <h2>Why You Can Trust BK Care, <span>Our Values</span></h2>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="values-content">
                    <p><?php echo e($data->desc_1 ?? 'Deskripsi belum diisi.'); ?></p>
                    
                    <a href="<?php echo e(route('tentang.index')); ?>" class="btn-read-more">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container px-4">
        
<div class="row g-4 justify-content-center">
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="100" data-suffix="%">0</h3>
            <p>Tingkat Kerahasiaan</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="24" data-suffix="">0</h3>
            <p>Jam Respon Cepat</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="450" data-suffix="+">0</h3>
            <p>Konsultasi Selesai</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-item">
            <h3 class="count" data-target="100" data-suffix="%">0</h3>
            <p>Aksesibilitas Digital</p>
        </div>
    </div>
</div>
    </div>
</section>
<section class="card-slider-section">
    <div class="container px-4 text-center mb-5">
        <h2 style="font-weight: 800; color: #0f2744; font-size: 2.2rem; margin-bottom: 10px;">
            Artikel & Insight Terbaru
        </h2>
        <div style="width: 50px; height: 3px; background: #B89551; margin: 0 auto 15px;"></div>
    </div>

    <div class="slider-wrapper" id="sliderContainer">
        <div class="custom-card">
            <img src="https://images.pexels.com/photos/1438072/pexels-photo-1438072.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
            <div class="card-body-text"><h5>Menghadapi Insecurity: Kamu Lebih Dari Sekadar Angka.</h5></div>
            <div class="card-footer-box">
                <div class="author-group"><div class="author-icon"></div><span class="author-name">direct by lisa 2025</span></div>
                <div class="arrow-icon">→</div>
            </div>
        </div>
        <div class="custom-card">
            <img src="https://images.pexels.com/photos/1438072/pexels-photo-1438072.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
            <div class="card-body-text"><h5>Building Resilience: Cara Bangkit Setelah Masa Sulit.</h5></div>
            <div class="card-footer-box">
                <div class="author-group"><div class="author-icon"></div><span class="author-name">direct by lisa 2025</span></div>
                <div class="arrow-icon">→</div>
            </div>
        </div>
        <div class="custom-card">
            <img src="https://images.pexels.com/photos/3184311/pexels-photo-3184311.jpeg?auto=compress&cs=tinysrgb&w=1260" class="card-img-top">
            <div class="card-body-text"><h5>Cyberbullying: Langkah Melindungi Jejak Digitalmu.</h5></div>
            <div class="card-footer-box">
                <div class="author-group"><div class="author-icon"></div><span class="author-name">direct by lisa 2025</span></div>
                <div class="arrow-icon">→</div>
            </div>
        </div>
        <div class="custom-card">
            <img src="https://images.pexels.com/photos/1438081/pexels-photo-1438081.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
            <div class="card-body-text"><h5>Pentingnya Kesehatan Mental di Era Digital.</h5></div>
            <div class="card-footer-box">
                <div class="author-group"><div class="author-icon"></div><span class="author-name">direct by lisa 2025</span></div>
                <div class="arrow-icon">→</div>
            </div>
        </div>
        <div class="custom-card">
            <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
            <div class="card-body-text"><h5>Manajemen Waktu Agar Belajar Lebih Efektif.</h5></div>
            <div class="card-footer-box">
                <div class="author-group"><div class="author-icon"></div><span class="author-name">direct by lisa 2025</span></div>
                <div class="arrow-icon">→</div>
            </div>
        </div>
    </div>
    <div class="dots-container" id="dotsContainer" style="justify-content: center;"></div>
</section>

    <section class="feedback-section">
        <div class="container px-4">
            <div class="feedback-header">
                <span>Voices of Healing</span>
                <h2>Dampak Positif E-BK Care</h2>
                <p class="px-5 py-2">"Di balik setiap aspirasi, ada perubahan nyata. Simak pengalaman tulus dari mereka yang telah merasakan manfaat layanan E-BK Care."</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4" style="cursor: pointer; ">
                    <div class="feedback-card shadow">
                        <i class="fas fa-quote-right quote-icon-top"></i>
                        <div class="stars-row">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="feedback-text">
                            "Sistem anonimitasnya luar biasa. Saya merasa sangat aman saat melakukan konseling pribadi tanpa takut identitas tersebar."
                        </p>
                        <div class="user-info">
                            <div class="avatar" style="background-color: #0f2744;">AN</div>
                            <div class="user-details"><h6>Anonim</h6><p>Layanan Konseling</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="cursor: pointer; ">
                    <div class="feedback-card shadow">
                        <i class="fas fa-quote-right quote-icon-top"></i>
                        <div class="stars-row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="feedback-text">"Kotak saran ini benar-benar didengar! Masalah di kelas saya selesai dalam seminggu setelah melapor di sini."</p>
                        <div class="user-info">
                            <div class="avatar" style="background-color: #B89551;">S</div>
                            <div class="user-details"><h6>Siswa Kelas XI</h6><p>Layanan Kotak Saran</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="cursor: pointer; ">
                    <div class="feedback-card shadow">
                        <i class="fas fa-quote-right quote-icon-top"></i>
                        <div class="stars-row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="feedback-text">"Artikel edukasinya sangat mencerahkan. Saya jadi lebih paham cara mengelola stres saat ujian akhir. Sangat bermanfaat!"</p>
                        <div class="user-info">
                            <div class="avatar" style="background-color: #1A374D;">R</div>
                            <div class="user-details">
                                <h6>Rizka Amelia</h6>
                                <p>Layanan Artikel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feedback-footer-link">
                <a href="<?php echo e(route('kotaksaran')); ?>" class="btn-feedback-cta">Bantu Kami Berkembang, Kirim Feedback Anda &rarr;</a>
            </div>
        </div>
    </section>

<section class="faq-section" style=" background-color: #f1f5f9; ">
    <div class="container px-4">
        <div class="text-center">
            <h2 style="font-weight: 800; color: #0f2744; font-size: 2rem; margin-bottom: 60px; margin-top: 40px; ">Frequently Asked Questions</h2>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-5">
                <div class="accordion accordion-flush" id="faqAccordionLeft">
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#l1" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Bagaimana cara melakukan konseling anonim?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="l1" class="accordion-collapse collapse" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.95rem;">
                                <p class="mb-3">Untuk menjaga privasi dan kenyamanan Anda, berikut adalah langkah-langkah melakukan konseling secara anonim:</p>
                                
                                <div class="mb-2">
                                    <span class="fw-bold text-dark">1. Pengajuan Jadwal:</span> Siswa mengklik tombol untuk mengajukan jadwal konseling kepada Guru BK melalui menu 'Layanan' dan memilih <strong>'Mode Anonim'</strong>.
                                </div>

                                <div class="mb-2">
                                    <span class="fw-bold text-dark">2. Menunggu Respon:</span> Siswa menunggu konfirmasi atau respon dari Guru BK terkait permohonan konseling tersebut.
                                </div>

                                <div class="mb-2">
                                    <span class="fw-bold text-dark">3. Penetapan Jadwal:</span> Jika disetujui, Guru BK akan memberikan informasi mengenai <strong>jadwal, tanggal, dan waktu</strong> pelaksanaan konseling.
                                </div>

                                <div class="mb-2">
                                    <span class="fw-bold text-dark">4. Sesi Konseling:</span>
                                    <ul class="mt-2 mb-0 ps-3">
                                        <li><span class="fw-bold">Sistem Online:</span> Siswa akan diarahkan ke halaman <strong>chat pribadi</strong> yang aman antara siswa dan Guru BK.</li>
                                        <li><span class="fw-bold">Sistem Offline:</span> Siswa akan diarahkan untuk datang langsung ke <strong>ruang BK sekolah</strong> sesuai jadwal yang telah ditentukan.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#l2" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Berapa lama respon kotak saran?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="l2" class="accordion-collapse collapse" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.9rem;">
                                Setiap saran yang masuk akan ditinjau oleh gurubk dalam waktu 1x24 jam. Masukan Anda akan divalidasi kepada pihak sekolah untuk memastikan kelayakan tindak lanjut, dan penjadwalan aksi atas saran tersebut akan dilakukan dalam jangka waktu kurang lebih 1 hingga 2 minggu.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#l3" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Bagaimana cara login dan aktivasi akun siswa?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="l3" class="accordion-collapse collapse" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.95rem;">
                                <p class="mb-3">Ikuti langkah-langkah berikut untuk mengaktifkan akun E-BK Care Anda:</p>
                                
                                <ul class="ps-3 mb-0">
                                    <li class="mb-2"><strong>Akses Halaman Login:</strong> Buka halaman login dan pilih opsi <strong>sebagai siswa</strong>.</li>
                                    <li class="mb-2"><strong>Masukkan Identitas:</strong> Masukkan <strong>Nama Lengkap</strong> dan <strong>NIPD</strong> siswa dengan benar.</li>
                                    <li class="mb-2"><strong>Registrasi Data:</strong> Anda akan diarahkan ke halaman berikutnya untuk mengisi <strong>Email Belajar aktif</strong> dan membuat <strong>Password Baru</strong>.</li>
                                    <li class="mb-2"><strong>Aktivasi:</strong> Klik tombol <strong>'Aktivasi Akun'</strong>.</li>
                                    <li class="mb-2"><strong>Selesai:</strong> Jika data email ditemukan di database, Anda akan diarahkan kembali ke halaman login dan akan muncul notifikasi <strong>sukses</strong>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="accordion accordion-flush" id="faqAccordionRight">
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#selfReport" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Sudah memahami tata cara Self-Report?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="selfReport" class="accordion-collapse collapse" data-bs-parent="#faqAccordionSelfReport">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.95rem;">
                                <p class="mb-3">Kerahasiaan identitas Anda adalah prioritas kami. Berikut adalah prosedur pelaporannya:</p>
                                
                                <ul class="ps-3 mb-3" style="list-style-type: decimal;">
                                    <li class="mb-2"><strong>Akses Fitur:</strong> Klik tombol laporan untuk memulai sesi Self-Report.</li>
                                    <li class="mb-2"><strong>Lengkapi Data:</strong> Isi formulir dengan detail kejadian yang sebenar-benarnya.</li>
                                    <li class="mb-2"><strong>Lampirkan Bukti:</strong> Sertakan dokumentasi pendukung (foto/dokumen) yang relevan.</li>
                                    <li class="mb-2"><strong>Kirim Laporan:</strong> Identitas Anda akan tetap terenkripsi dan terlindungi oleh sistem.</li>
                                </ul>
                                
                                <p class="small text-center mt-3 mb-0" style="color: #0f2744; opacity: 0.8;">
                                    <i class="fas fa-lock me-1"></i> Seluruh data laporan dijamin kerahasiaannya secara profesional.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#r2" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Siapa yang mengelola laporan dan poin saya?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="r2" class="accordion-collapse collapse" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.9rem;">
                                Laporan dikelola langsung oleh <strong>Guru BK</strong>. Selain itu, informasi poin pelanggaran akan <strong>muncul secara otomatis</strong> di halaman profil Anda untuk pemantauan kedisiplinan yang transparan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-4 shadow" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#r3" style="background: #fff; color: #0f2744; box-shadow: none; font-size: 0.95rem;">
                                Lupa akun atau kendala teknis?
                                <i class="fas fa-chevron-down" style="font-size: 0.7rem; transition: 0.3s; opacity: 0.6;"></i>
                            </button>
                        </h2>
                        <div id="r3" class="accordion-collapse collapse" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.9rem;">
                                <p class="mb-3">Jika Anda lupa kata sandi akun, silakan ikuti langkah berikut:</p>
                                <ul class="ps-3 mb-3">
                                    <li class="mb-1"><strong>Klik 'Lupa Password'</strong> pada halaman login.</li>
                                    <li class="mb-1"><strong>Isi Email Belajar</strong> dan buat kata sandi baru.</li>
                                    <li class="mb-1">Cek inbox email belajar untuk menerima <strong>kode OTP</strong>.</li>
                                    <li class="mb-1">Masukkan <strong>kode OTP</strong> di halaman verifikasi.</li>
                                    <li class="mb-1">Login kembali dengan <strong>NIPD</strong> sebagai username dan kata sandi baru Anda.</li>
                                </ul>
                                <p class="mb-0">Jika masih terkendala, hubungi bantuan teknis melalui WhatsApp Admin dibagian bawah situs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .accordion-button:not(.collapsed) i { transform: rotate(180deg); }
    .accordion-button::after { display: none !important; }
</style>
    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.onclick = () => { hamburger.classList.toggle('open'); navMenu.classList.toggle('active'); };

        const cards = document.querySelectorAll('.custom-card');
        const dotsContainer = document.getElementById('dotsContainer');
        let currentIndex = 2; 
        let autoPlayTimer;

        if(cards.length > 0) {
            cards.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.classList.add('dot');
                if(i === currentIndex) dot.classList.add('active');
                dot.onclick = () => { currentIndex = i; updateSlider(); resetAutoPlay(); };
                dotsContainer.appendChild(dot);
            });
        }

        const dots = document.querySelectorAll('.dot');
        function updateSlider() {
            const n = cards.length;
            cards.forEach((card, i) => {
                card.classList.remove('pos-left-2', 'pos-left-1', 'pos-center', 'pos-right-1', 'pos-right-2');
                if(dots[i]) dots[i].classList.remove('active');
                let diff = (i - currentIndex + n) % n;
                if (diff === 0) card.classList.add('pos-center');
                else if (diff === 1) card.classList.add('pos-right-1');
                else if (diff === 2) card.classList.add('pos-right-2');
                else if (diff === n - 1) card.classList.add('pos-left-1');
                else if (diff === n - 2) card.classList.add('pos-left-2');
                if (i === currentIndex && dots[i]) dots[i].classList.add('active');
            });
        }

        function startAutoPlay() {
            autoPlayTimer = setInterval(() => {
                currentIndex = (currentIndex + 1) % cards.length;
                updateSlider();
            }, 3000);
        }

        function resetAutoPlay() { clearInterval(autoPlayTimer); startAutoPlay(); }

        updateSlider();
        startAutoPlay();
document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.count');

        const animateCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            const suffix = counter.getAttribute('data-suffix') || '';
            const duration = 2000; // durasi 2 detik
            let start = null;

            const step = (timestamp) => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                
                // Menghitung angka
                const currentCount = Math.floor(progress * target);
                counter.innerText = currentCount + suffix;

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Animasi dimulai
                    animateCounter(entry.target);
                } else {
                    // Reset ke 0 saat keluar layar
                    entry.target.innerText = '0' + (entry.target.getAttribute('data-suffix') || '');
                }
            });
        }, { threshold: 0.5 }); // Animasi jalan saat 50% elemen terlihat

        counters.forEach(c => observer.observe(c));
    });
    </script>
</body>
</html><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/home.blade.php ENDPATH**/ ?>