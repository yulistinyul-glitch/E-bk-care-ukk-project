@extends('layouts.app')

@section('title', 'Visi & Misi - E-BK Care')

@section('content')
<style>
    :root {
        --dark-navy: #1e2a3a;
        --teal-accent: #20c997;
    }

    /* --- HERO SECTION --- */
    .about-hero {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                    url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');
        background-size: cover; background-position: center; height: 50vh;
        display: flex; align-items: center; justify-content: center; text-align: center; color: white;
    }

    .hero-title-main {
        font-family: 'Playfair Display', serif; font-style: italic;
        font-size: 3rem;
        margin-bottom: 5px;
    }

    /* --- VISI & MISI SECTION --- */
    .vision-mission-section { padding: 80px 0; background-color: #fff; overflow: hidden; }

    .section-label {
        font-weight: 800;
        font-size: 2.2rem;
        color: #000;
        margin-bottom: 25px;
    }

    /* Kotak Navy di Belakang Gambar */
    .image-container { position: relative; display: inline-block; width: 100%; }

    .navy-block {
        position: absolute;
        background-color: var(--dark-navy);
        width: 240px; 
        height: 280px;
        z-index: 1;
    }

    .vision-block { top: -20px; right: 0; }
    .mission-block { bottom: -20px; left: 0; }

    .img-asymmetric {
        position: relative; z-index: 2;
        width: 100%; max-width: 400px; 
        height: 280px; object-fit: cover; display: block;
        box-shadow: 10px 10px 20px rgba(0,0,0,0.1);
    }

    .vision-img-pos { margin-left: auto; margin-right: 30px; margin-top: 15px; }
    .mission-img-pos { margin-left: 30px; margin-bottom: 15px; }

    .lead-text { font-size: 0.95rem; line-height: 1.6; color: #444; }

    .mission-list li { margin-bottom: 10px; display: flex; align-items: flex-start; font-size: 0.95rem; }
    .mission-list i { color: var(--teal-accent); font-size: 1rem; margin-right: 12px; margin-top: 3px; }

    @media (max-width: 991px) {
        .navy-block { width: 150px; height: 200px; }
        .hero-title-main { font-size: 2.2rem; }
        .img-asymmetric { height: 220px; max-width: 100%; }
        .vision-img-pos { margin-right: 15px; }
        .mission-img-pos { margin-left: 15px; }
    }
</style>

<section id="vision-section" class="vision-mission-section">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-label">VISI</h2>
                <div class="pe-lg-4">
                    <p class="lead-text">
                        {{ $aboutData->vision ?? 'Menjadi pusat layanan bimbingan konseling digital yang profesional, inklusif, dan terpercaya untuk mendukung tumbuh kembang mental serta karakter siswa secara optimal di lingkungan sekolah.' }}
                    </p>
                    <p class="lead-text mt-3">
                        Kami berkomitmen untuk menciptakan ekosistem pendidikan di mana setiap siswa merasa didengarkan, dihargai, dan dibimbing menuju masa depan yang cerah.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-container text-end">
                    <div class="navy-block vision-block"></div>
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1000&auto=format&fit=crop" 
                         class="img-asymmetric vision-img-pos" alt="Visi">
                </div>
            </div>
        </div>

        <div style="height: 100px;"></div>

        <div class="row align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6">
                <div class="image-container">
                    <div class="navy-block mission-block"></div>
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1000&auto=format&fit=crop" 
                         class="img-asymmetric mission-img-pos" alt="Misi">
                </div>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="ps-lg-4 text-end">
                    <h2 class="section-label">MISI</h2>
                                    <div class="pe-lg-4">
                    <p class="lead-text">
                        {{ $aboutData->vision ?? 'Menjadi pusat layanan bimbingan konseling digital yang profesional, inklusif, dan terpercaya untuk mendukung tumbuh kembang mental serta karakter siswa secara optimal di lingkungan sekolah.' }}
                    </p>
                    <p class="lead-text mt-3">
                        Kami berkomitmen untuk menciptakan ekosistem pendidikan di mana setiap siswa merasa didengarkan, dihargai, dan dibimbing menuju masa depan yang cerah.
                    </p>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection