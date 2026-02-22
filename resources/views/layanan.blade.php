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

    .hero-service { background-color: var(--light-bg); padding: 100px 0; position: relative; overflow: hidden;}

    .hero-service::after {
        content: "✕"; position: absolute; top: -50px; right: -30px; 
        font-size: 300px; color: #f1f1f1; z-index: 0; font-weight: bold; opacity: 0.5;
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

    .service-card-minimal {
        padding: 40px 20px;
        text-align: left;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.02);
        transition: 0.3s;
    }

    .service-card-minimal:hover { background: rgba(255,255,255,0.05); border-color: var(--teal-color); }

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
    .learn-more-link:hover { color: white; }

    .why-choose { background-color: white; position: relative; }

    .why-choose::before {
        content: "✕"; position: absolute; bottom: -50px; left: -30px; 
        font-size: 250px; color: #f8f9fa; z-index: 0; font-weight: bold;
    }

    .list-bordered { list-style: none; align-content: flex-end; }
    .list-bordered li { 
        padding: 15px 0; 
        border-bottom: 1px solid #eee; 
        display: flex; 
        align-items: flex-end; 
        font-weight: 500;
        color: #555;
        font-size: 0.95rem;
    }
    .list-bordered li i { color: var(--teal-color); margin-right: 12px; font-size: 0.8rem; }

    .btn-action {
        background-color: #2c3e50; color: white; padding: 12px 25px; 
        border-radius: 2px; text-transform: uppercase; font-weight: 700; 
        border: none; font-size: 0.85rem; letter-spacing: 1px; margin-left: 60px; 
    }
    .btn-action:hover { background-color: var(--teal-color); color: white; }
</style>


<section class="hero-service">
    <div class="container px-4" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="hero-img-box">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2070&auto=format&fit=crop" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5">
                <div class="title-accent">
                    <h1 class="display-6 fw-bold mb-3" style="color: #222;">Committed To Helping<br>Our Clients Succeed.</h1>
                </div>
                <p class="text-muted mt-4" style="line-height: 1.8; font-size: 0.95rem;">
                    Our client's success is our top priority, and we strive to deliver exceptional psychological support, advocacy, and counsel every step of the way. Trust us to be your reliable partner, committed to achieving your personal well-being goals.
                </p>
                <a href="#" class="btn btn-link p-0 mt-3 text-teal fw-bold text-decoration-none border-bottom border-teal">Learn About Our Philosophy →</a>
            </div>
        </div>
    </div>
</section>

<section class="focus-areas section-padding">
    <div class="container px-4">
        <div class="mb-5">
            <p class="area-sub mb-2">Practice Areas</p>
            <div style="border-left: 3px solid var(--gold-accent); padding-left: 15px;">
                <h2 class="fw-bold h1">How We Can Help</h2>
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
                        <a href="{{ route('layanan.show', $item->slug) }}" class="learn-more-link text-uppercase">Learn More <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white-50 py-5">Layanan belum tersedia.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="why-choose section-padding">
    <div class="container px-4" style="z-index: 2;">
        <div class="row g-5">
            <div class="col-lg-6">
                <p class="area-sub mb-2">We Make A Difference</p>
                <div style="border-left: 3px solid var(--gold-accent); padding-left: 15px;">
                    <h2 class="fw-bold h1">Why E-BK Care?</h2>
                </div>
                <p class="mt-4 text-muted" style="line-height: 1.8;">
                    At E-BK Care, we understand that choosing the right counseling support is crucial for achieving successful outcomes in your mental health journey. We firmly believe that our team stands out for the following reasons.
                </p>
            </div>
            <div class="col-lg-6">
                <ul class="list-bordered mb-4">
                    <li><i class="bi bi-chevron-right"></i> Layanan Orientasi & Informasi</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Konseling Perorangan (Privat)</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Konseling Kelompok</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Penempatan & Penyaluran</li>
                    <li><i class="bi bi-chevron-right"></i> Layanan Advokasi</li>
                </ul>
                <button class="btn btn-action shadow-sm">Book A Consultation</button>
            </div>
        </div>
    </div>
</section>
@endsection