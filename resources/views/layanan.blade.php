@extends('layouts.app')

@section('title', 'Layanan - E-BK Care')

@section('content')
<section class="hero-service">
    <div class="container px-4" style="z-index: 2; position: relative;">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="hero-img-box" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=2070&auto=format&fit=crop" class="img-fluid w-100" alt="Counseling">
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5" data-aos="fade-left">
                <div class="title-accent">
                    <h2 class="font-poppins display-6 fw-bold mb-4" style="color: #222; font-size: 36px; line-height: 1.3;">Committed To Helping<br>Siswa Meraih Prestasi</h2>
                </div>
                <p class="text-muted mt-4" style="line-height: 2; font-size: 0.95rem;">
                    Kesejahteraan mental siswa adalah prioritas utama kami. Kami berkomitmen memberikan bimbingan profesional untuk membantu setiap siswa mencapai potensi terbaik mereka.
                </p>
                <a href="{{ route('galeri') }}" class="mt-4 p-0 font-poppins btn-galeri-hover">
                    Lihat Galeri Kegiatan <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>


<section class="focus-areas section-padding">
    <div class="container px-4">
        <div class="mb-5">
            <p class="font-montserrat area-sub mb-3"  data-aos="fade-right">System Features</p>
            <div style="border-left: 2px solid var(--gold-accent); padding-left: 15px;"  data-aos="fade-right">
                <h2 class="font-poppins fw-bold text-white" style="font-size: 30px; margin-bottom: 80px;">Fitur Utama Layanan</h2>
            </div>
        </div>

        <div class="row g-4">
            @forelse($semua_layanan as $item)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="font-poppins service-card-minimal" data-aos="fade-up">
                        <div class="icon-box">
                            <i class="bi {{ $item->icon }}"></i>
                        </div>
                        <h3 class="service-title">{{ $item->title }}</h3>
                        <p class="service-desc">{{ Str::limit($item->description, 120) }}</p>
                        <button type="button" class="btn btn-link learn-more-link text-uppercase p-0 border-0 text-start" 
                                data-bs-toggle="modal" 
                                data-bs-target="#loginModal" 
                                data-layanan="{{ $item->slug }}">
                            Buka Fitur <i class="bi bi-arrow-right small"></i>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-white-50 py-5">Layanan belum tersedia.</div>
            @endforelse
        </div>
    </div>
</section>


<section class="why-choose section-padding" data-aos="fade-up">
    <div class="container px-4">
        <div class="row g-5 align-items-start">
            <div class="col-lg-6">
                <p class="font-montserrat area-sub mb-3">Counseling Program</p>
                <div style="border-left: 2px solid var(--gold-accent); padding-left: 15px;">
                    <h2 class="fw-bold h1">Mengapa Pilih E-BK Care?</h2>
                </div>
                <p class="mt-4 text-muted" style="line-height: 1.8;">
                    E-BK Care bukan sekedar sistem aplikasi, namun wadah profesional untuk berbagai layanan bimbingsn konseling yang dirancang khusus untuk kebutuhan siswa.
                </p>
            </div>
            <div class="col-lg-6">
                <ul class="list-bordered">
                    <li data-aos="fade-left">
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc1" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Orientasi & Informasi
                        </button>
                        <div class="collapse" id="desc1">
                            <div class="desc-collapse">
                                Fokus pada pembekalan siswa mengenai pemahaman lingkungan sekolah, kurikulum, dan informasi pengembangan diri. Tujuannya agar siswa memiliki literasi informasi yang cukup untuk mengambil keputusan strategis terkait masa depan akademik mereka.
                            </div>
                        </div>
                    </li>
                    <li data-aos="fade-left">
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc2" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Konseling Perorangan
                        </button>
                        <div class="collapse" id="desc2">
                            <div class="desc-collapse">
                                Merupakan layanan bantuan profesional yang bersifat pribadi dan rahasia. Guru BK menyediakan ruang aman bagi siswa untuk mengeksplorasi dan menuntaskan masalah pribadi melalui pendekatan psikologis demi mencapai stabilitas emosional.
                            </div>
                        </div>
                    </li>
                    <li data-aos="fade-left">
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc3" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Konseling Kelompok
                        </button>
                        <div class="collapse" id="desc3">
                            <div class="desc-collapse">
                                Layanan ini memanfaatkan dinamika interaksi antar siswa yang memiliki masalah serupa. Melalui diskusi terbimbing, siswa dapat saling berbagi pengalaman, meningkatkan empati, dan mencari solusi bersama sehingga mereka tidak merasa berjuang sendirian.
                            </div>
                        </div>
                    </li>
                    <li data-aos="fade-left">
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc4" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Penempatan & Penyaluran
                        </button>
                        <div class="collapse" id="desc4">
                            <div class="desc-collapse">
                               Layanan ini difokuskan pada pemetaan potensi, minat, dan bakat siswa. Tujuannya adalah menempatkan siswa pada wadah yang tepat, seperti jurusan, kegiatan ekstrakurikuler, atau program pengembangan lainnya agar potensi individu dapat berkembang optimal.
                            </div>
                        </div>
                    </li>
                    <li data-aos="fade-left">  
                        <button class="list-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#desc5" aria-expanded="false">
                            <i class="bi bi-chevron-right"></i> Layanan Advokasi
                        </button>
                        <div class="collapse" id="desc5">
                            <div class="desc-collapse">
                                Berfungsi untuk melindungi dan memulihkan hak-hak siswa yang mungkin terabaikan atau terdampak oleh kebijakan yang tidak adil. Guru BK bertindak sebagai pembela kepentingan siswa untuk memastikan mereka mendapatkan perlindungan hukum dan moral.
                            </div>
                        </div>
                    </li>
                </ul>
                
                <a href="{{ route('home') }}" class="btn-label shadow-sm">
                  Mulai Konsultasi
                </a>
            </div>
        </div>
    </div>

    
</section>
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 350px; width: 90%; margin: auto;">
        <div class="modal-content" style="font-family: 'Poppins', sans-serif; border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15);">
            <div class="modal-body text-center p-4">
                <div class="icon-animate mb-3">
                    <i class="bi bi-person-lock" style="font-size: 2.5rem; color: #0f2744;"></i>
                </div>
                
                <h6 class="fw-bold mb-2" style="color: #0f2744; font-size: 1.1rem;">Akses Diperlukan</h6>
                <p class="text-muted mb-4 px-2" style="font-size: 0.9rem;">Silakan login untuk membuka fitur layanan ini!</p>
                
                <a id="loginRedirectBtn" href="{{ route('home') }}" 
                   class="btn btn-primary d-inline-flex align-items-center justify-content-center px-4 py-2 btn-login-hover" 
                   style="border-radius: 10px; font-size: 0.85rem; text-decoration: none; border: none;">
                    <i class="bi bi-arrow-left me-2"></i> Lanjutkan ke Login
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    AOS.init({ duration: 1000, once: true, offset: 100 });

var loginModal = document.getElementById('loginModal');
    loginModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var layananSlug = button.getAttribute('data-layanan');
        var loginBtn = document.getElementById('loginRedirectBtn');
        loginBtn.href = "{{ route('login') }}?layanan=" + layananSlug;
    });
</script>
@endsection