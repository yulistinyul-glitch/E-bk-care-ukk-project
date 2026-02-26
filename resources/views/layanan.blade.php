@extends('layouts.app')

@section('title', 'Layanan - E-BK Care')

@section('content')
<style>
    :root {
        --teal-color: #20c997;
        --dark-navy: #1e2a3a;
        --light-bg: #fcfdfe;
        --gold-accent: #d4af37; 
    }

    .text-teal { color: var(--teal-color) !important; }
    .section-padding { padding: 100px 0; }

    /* Hero Section */
    .hero-service { background-color: var(--light-bg); padding: 80px 0; position: relative; overflow: hidden;}

    /* Responsive Decoration X */
    .hero-service::after {
        content: "✕"; position: absolute; top: -50px; right: -30px; 
        font-size: 300px; color: #f1f1f1; z-index: 0; font-weight: bold; opacity: 0.5;
        pointer-events: none;
    }

    /* Why Choose Decoration X */
    .why-choose::before {
        content: "✕"; position: absolute; bottom: -50px; left: -30px; 
        font-size: 250px; color: #f8f9fa; z-index: 0; font-weight: bold;
        pointer-events: none;
    }

    /* Fix Overlap on Responsive */
    @media (max-width: 991.98px) {
        .hero-service::after, .why-choose::before {
            display: none; 
        }
        .section-padding { padding: 60px 0; }
        .hero-service { padding: 40px 0; }
    }

    .hero-img-box { position: relative; z-index: 1; }
    .hero-img-box img { border-radius: 0; box-shadow: 15px 15px 0px var(--light-bg), 15px 15px 0px 1px #ddd; }
    
    .title-accent { border-left: 3px solid var(--gold-accent); padding-left: 15px; }

    .focus-areas {
        background: linear-gradient(rgba(30, 42, 58, 0.85), rgba(30, 42, 58, 0.85)), 
                    url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop');
        background-size: cover; background-position: center; background-attachment: fixed;
        color: white;
    }

    .area-sub { letter-spacing: 2px; font-size: 0.8rem; font-weight: 700; color: #aaa; text-transform: uppercase; }

    /* Feature Cards */
    .service-card-minimal {
        padding: 40px 20px;
        text-align: left;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.02);
        transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .service-card-minimal:hover { 
        background: rgba(255,255,255,0.05); 
        border-color: var(--teal-color);
        transform: translateY(-5px);
    }

    .icon-box { font-size: 2.5rem; margin-bottom: 30px; color: white; opacity: 0.9; }
    .service-title { font-size: 1rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 20px; }
    .service-desc { font-size: 0.85rem; color: #ccc; line-height: 1.8; margin-bottom: 25px; }
    
    .learn-more-link { 
        color: var(--gold-accent); 
        text-decoration: none; 
        font-weight: 700; 
        font-size: 0.8rem; 
        margin-top: auto;
        letter-spacing: 1px;
    }

    .why-choose { background-color: white; position: relative; overflow: hidden; }

    /* Interactive List Styles */
    .list-bordered { list-style: none; padding: 0; position: relative; z-index: 1; }
    .list-bordered li { border-bottom: 1px solid #eee; }

    .list-trigger {
        width: 100%;
        padding: 18px 0;
        display: flex;
        align-items: center;
        background: none;
        border: none;
        font-weight: 500;
        color: #444;
        font-size: 0.95rem;
        cursor: pointer;
        text-align: left;
        transition: color 0.3s ease;
    }

    .list-trigger:hover { color: var(--teal-color); }

    .list-trigger i { 
        color: var(--teal-color); 
        font-size: 0.75rem; 
        margin-right: 15px;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
    }

    .list-trigger[aria-expanded="true"] i { transform: rotate(90deg); }
    
    .desc-collapse {
        font-size: 0.88rem;
        color: #666;
        line-height: 1.7;
        padding-bottom: 20px;
        padding-left: 28px;
    }

    /* Label Button */
    .btn-label {
        display: inline-flex;
        align-items: center;
        background-color: var(--dark-navy);
        color: white;
        padding: 12px 28px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 4px;
        border: none;
        transition: all 0.4s ease;
        margin-top: 25px;
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .btn-label:hover {
        background-color: var(--teal-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(32, 201, 151, 0.2);
    }
</style>

<section class="hero-service">
    <div class="container px-4" style="z-index: 2; position: relative;">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="hero-img-box">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2070&auto=format&fit=crop" class="img-fluid w-100" alt="Counseling">
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5">
                <div class="title-accent">
                    <h1 class="display-6 fw-bold mb-3" style="color: #222;">Committed To Helping<br>Siswa Meraih Prestasi</h1>
                </div>
                <p class="text-muted mt-4" style="line-height: 1.8; font-size: 0.95rem;">
                    Kesejahteraan mental siswa adalah prioritas utama kami. Kami berkomitmen memberikan bimbingan profesional untuk membantu setiap siswa mencapai potensi terbaik mereka.
                </p>
                <a href="#" class="btn btn-link p-0 mt-3 text-teal fw-bold text-decoration-none border-bottom border-teal">Pelajari Filosofi Kami →</a>
            </div>
        </div>
    </div>
</section>

<section class="focus-areas section-padding">
    <div class="container px-4">
        <div class="mb-5">
            <p class="area-sub mb-2">System Features</p>
            <div style="border-left: 3px solid var(--gold-accent); padding-left: 15px;">
                <h2 class="fw-bold h1 text-white">Fitur Utama E-BK</h2>
            </div>
        </div>

        <div class="row g-4">
            @forelse($semua_layanan as $item)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="service-card-minimal">
                        <div class="icon-box">
                            <i class="bi {{ $item->icon }}"></i>
                        </div>
                        <h3 class="service-title">{{ $item->title }}</h3>
                        <p class="service-desc">{{ Str::limit($item->description, 120) }}</p>
                        <a href="{{ route('layanan.show', $item->slug) }}" class="learn-more-link text-uppercase">Buka Fitur <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white-50 py-5">Layanan belum tersedia.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="why-choose section-padding">
    <div class="container px-4">
        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                <p class="area-sub mb-2">Counseling Program</p>
                <div style="border-left: 3px solid var(--gold-accent); padding-left: 15px;">
                    <h2 class="fw-bold h1">Mengapa Pilih E-BK Care?</h2>
                </div>
                <p class="mt-4 text-muted" style="line-height: 1.8;">
                    E-BK Care bukan sekedar sistem aplikasi, namun wadah profesional untuk berbagai layanan bimbingsn konseling yang dirancang khusus untuk kebutuhan siswa.
                </p>
            </div>
            <div class="col-lg-6">
                <ul class="list-bordered">
                    <li>
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc1" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Orientasi & Informasi
                        </button>
                        <div class="collapse" id="desc1">
                            <div class="desc-collapse">
                                Membantu siswa memahami lingkungan sekolah baru, aturan, serta menyediakan informasi karir dan pendidikan lanjutan.
                            </div>
                        </div>
                    </li>
                    <li>
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc2" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Konseling Perorangan
                        </button>
                        <div class="collapse" id="desc2">
                            <div class="desc-collapse">
                                Sesi privat rahasia antara siswa dan guru BK untuk memecahkan masalah pribadi, sosial, atau hambatan belajar.
                            </div>
                        </div>
                    </li>
                    <li>
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc3" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Konseling Kelompok
                        </button>
                        <div class="collapse" id="desc3">
                            <div class="desc-collapse">
                                Diskusi kelompok terbimbing untuk berbagi pengalaman dan mencari solusi bersama dalam lingkungan yang suportif.
                            </div>
                        </div>
                    </li>
                    <li>
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc4" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Penempatan & Penyaluran
                        </button>
                        <div class="collapse" id="desc4">
                            <div class="desc-collapse">
                                Membantu siswa dalam pemilihan jurusan, minat bakat, ekstra kurikuler, hingga persiapan karir di masa depan.
                            </div>
                        </div>
                    </li>
                    <li>
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc5" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Advokasi
                        </button>
                        <div class="collapse" id="desc5">
                            <div class="desc-collapse">
                                Menjamin hak-hak siswa dalam proses pendidikan agar tetap terpenuhi dengan adil dan tanpa diskriminasi.
                            </div>
                        </div>
                    </li>
                </ul>
                
                <a href="#" class="btn-label shadow-sm">
                  Konsultasi Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection