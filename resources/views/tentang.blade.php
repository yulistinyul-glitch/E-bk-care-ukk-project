@extends('layouts.app')

@section('title', 'Visi & Misi - E-BK Care')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .bg-white-custom { 
        background-color: #ffffff !important; 
        color: #000000; 
        font-family: 'Arial', sans-serif;
    }
    .font-serif-custom { 
        font-family: 'Playfair Display', serif; 
        letter-spacing: 3px; 
    }
    
    .divider-line { 
        border-top: 1px solid #333; 
        border-bottom: 1px solid #333; 
        padding: 30px 0; 
        margin: 50px 0; 
    }

    .service-box {
        transition: all 0.4s ease;
        padding: 20px;
        cursor: pointer;
        perspective: 1000px; 
    }

    .service-icon-wrapper {
        font-size: 3.5rem;
        color: #B89551; 
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), color 0.4s ease;
        margin-bottom: 20px;
        display: inline-block;
        transform-style: preserve-3d;
    }

    .service-line {
        width: 60px;
        height: 3px;
        background-color: #B89551; 
        transition: all 0.4s ease;
        margin: 15px auto 0;
    }

    .service-box:hover .service-icon-wrapper {
        color: #1A374D; 
        transform: rotateY(180deg); 
    }

    .service-box:hover .service-line {
        background-color: #1A374D; 
        width: 100px;
    }

    .service-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 8px;
        text-transform: uppercase;
        color: #000;
    }

    .service-subtitle {
        color: #777;
        font-size: 0.85rem;
    }

    .btn-square-dark {
        border: 2px solid #000; 
        color: #000; 
        background: transparent;
        padding: 10px 30px; 
        text-transform: uppercase; 
        font-size: 11px; 
        letter-spacing: 2px; 
        border-radius: 0;
        transition: 0.3s; 
        text-decoration: none; 
        display: inline-block;
        font-weight: bold;
    }
    .btn-square-dark:hover { background: #000; color: #fff; }

    .btn-square-white {
        border: 1px solid #fff; color: #fff; background: transparent;
        padding: 8px 25px; text-transform: uppercase; font-size: 11px; letter-spacing: 2px; border-radius: 0;
        transition: 0.3s; text-decoration: none; display: inline-block;
    }
    .btn-square-white:hover { background: #fff; color: #1A374D; }

    .overlap-box-blue {
        background-color: #1A374D !important;
        color: #ffffff !important;
        padding: 45px;
        position: relative;
        z-index: 10;
    }

    .border-kuning-kanan { border-right: 6px solid #B89551 !important; } 
    .border-kuning-kiri { border-left: 6px solid #B89551 !important; }

    .img-full { width: 100%; height: auto; display: block; }

    @media (min-width: 992px) {
        .overlap-right { margin-left: -100px; margin-top: 50px; }
        .overlap-left { margin-right: -100px; margin-top: 50px; }
    }

    .text-description-muted { color: #d1d1d1; font-size: 0.9rem; line-height: 1.8; }
</style>

<div class="bg-white-custom w-100 pb-5">
    <div class="container px-4">
        
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="divider-line">
                    <h1 class="font-serif-custom mb-3 text-uppercase" style="font-size: 3rem; font-weight: 700;">E-BK CARE</h1>
                    <p class="fst-italic" style="color: #333; font-size: 1.3rem;">
                        "Memberikan layanan bimbingan, konseling, dan dukungan kesehatan mental"
                    </p>

                    <p class="text-muted mb-4 px-lg-5" style="font-size: 1rem; line-height: 1.8;">
                        E-BK Care menyediakan solusi berorientasi pada kesejahteraan mental yang efektif bagi isu-isu psikologis yang kompleks. Kami berkomitmen untuk mendampingi setiap individu dalam proses pengenalan diri dan pemecahan masalah secara profesional.
                    </p>
                    
                    <p class="text-muted px-lg-5" style="font-size: 1rem; line-height: 1.8;">
                        Melalui pendekatan yang inklusif dan teknologi bimbingan konseling terkini, kami membantu Anda dalam membuat keputusan yang tepat demi masa depan yang lebih baik. Mari wujudkan kesehatan mental yang stabil bersama tim ahli kami.
                    </p>
                </div>
            </div>
        </div>

        <div class="row text-center justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="service-box">
                    <div class="service-icon-wrapper">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3 class="service-title">Counseling</h3>
                    <p class="service-subtitle">The Professional Guidance</p>
                    <div class="service-line"></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="service-box">
                    <div class="service-icon-wrapper">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3 class="service-title">Psychotherapy</h3>
                    <p class="service-subtitle">A Collaborative Treatment</p>
                    <div class="service-line"></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="service-box">
                    <div class="service-icon-wrapper">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <h3 class="service-title">Self Management</h3>
                    <p class="service-subtitle">In Physical and Mental Health</p>
                    <div class="service-line"></div>
                </div>
            </div>
        </div>

        <div class="py-5"></div> <div class="row align-items-center mb-5 pb-lg-5">
            <div class="col-lg-7 px-0">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000" class="img-full shadow" alt="Visi">
            </div>
            <div class="col-lg-5 px-0">
                <div class="overlap-box-blue overlap-right border-kuning-kanan shadow-lg">
                    <h2 class="font-serif-custom h4 mb-3 text-uppercase">VISI KAMI</h2>
                    <p class="small fw-bold mb-3">Menjadi platform konseling digital yang humanis dan solutif.</p>
                    <p class="text-description-muted mb-4">
                        Membangun ekosistem kesehatan mental yang inklusif di lingkungan pendidikan guna mendukung pertumbuhan karakter siswa secara maksimal.
                    </p>
                    <a href="#" class="btn btn-square-white">Read More</a>
                </div>
            </div>
        </div>

        <div class="row align-items-center flex-column-reverse flex-lg-row pt-5">
            <div class="col-lg-5 px-0">
                <div class="overlap-box-blue overlap-left border-kuning-kiri shadow-lg">
                    <h2 class="font-serif-custom h4 mb-3 text-uppercase">MISI KAMI</h2>
                    <p class="small fw-bold mb-3">Menyediakan akses bimbingan profesional kapan saja.</p>
                    <p class="text-description-muted mb-4">
                        Berkomitmen memberikan layanan privasi tinggi dan edukasi preventif bagi seluruh civitas akademika dalam menghadapi tantangan psikologis.
                    </p>
                    <a href="#" class="btn btn-square-white">Read More</a>
                </div>
            </div>
            <div class="col-lg-7 px-0">
                <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1000" class="img-full shadow" alt="Misi">
            </div>
        </div>

    </div>
</div>

@endsection