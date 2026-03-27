@extends('layouts.app')

@section('title', 'Tentang Kami - E-BK Care')

@section('content')

<div class="bg-white-custom w-100 pb-5">
    @php $content = \App\Models\About::first(); @endphp

    <div class="bg-soft-blue-area" data-aos="fade-down">
        <div class="container px-4">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="divider-line" data-aos="zoom-in" data-aos-delay="200">
                        <h1 class="font-poppins mb-3 text-uppercase" style="font-size: 2.6rem; font-weight: 500;">{{ $content->title ?? 'E-BK CARE' }}</h1>
                        <p class="font-poppins-italic" style="color: #333; font-size: 1rem;  font-weight: 600; line-height: 40px;">"{{ $content->tagline ?? 'Tagline belum diisi' }}"</p>
                        <p class="font-poppins text-muted mb-4 px-lg-5 " style="font-size: 14px; font-weight: 100; line-height: 30px;">{{ $content->desc_1 ?? 'Deskripsi belum diisi.' }}</p>
                        <p class="font-poppins text-muted px-lg-5" style="font-size: 14px; font-weight: 100; line-height: 30px;">{{ $content->desc_2 ?? 'Deskripsi tambahan belum diisi.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <div class="row text-center">
            <div class="col-md-4 service-box" data-aos="flip-up" data-aos-delay="100">
                <div class="service-icon-wrapper"><i class="fas fa-users"></i></div>
                <h4 class="font-montserrat service-title">COUNSELING</h4>
                <p class="font-poppins service-subtitle">The Professional Guidance</p>
                <div class="service-line"></div>
            </div>
            <div class="col-md-4 service-box" data-aos="flip-up" data-aos-delay="200">
                <div class="service-icon-wrapper"><i class="fas fa-brain"></i></div>
                <h4 class="font-montserrat service-title">PSYCHOTHERAPY</h4>
                <p class="font-poppins service-subtitle">A Preventive Treatment</p>
                <div class="service-line"></div>
            </div>
            <div class="col-md-4 service-box" data-aos="flip-up" data-aos-delay="300">
                <div class="service-icon-wrapper"><i class="fas fa-heart-pulse"></i></div>
                <h4 class="font-montserrat service-title">SELF MANAGEMENT</h4>
                <p class="font-poppins service-subtitle">A Physical and Mental Health</p>
                <div class="service-line"></div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <div class="row align-items-center">
            <div class="col-lg-7 px-0" data-aos="fade-right"><img src="{{ $content?->foto_visi ? asset('storage/'.$content->foto_visi) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000' }}" class="img-full shadow" alt="Visi"></div>
            <div class="col-lg-5 px-0" data-aos="fade-left">
                <div class="overlap-box-blue overlap-right border-kuning-kanan shadow-lg">
                    <h2 class="font-montserrat h4 mb-3 text-uppercase">{{ $content->visi_judul ?? 'VISI KAMI' }}</h2>
                    <p class="font-poppins small fw-bold mb-3">{{ $content->visi_tagline ?? 'Tagline visi belum diisi.' }}</p>
                    <p class="font-poppins text-description-muted mb-4">{{ $content->visi_desc ?? 'Deskripsi visi belum diisi.' }}</p>
                    <div class="font-montserrat badge-custom">Core Purpose</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 pt-5">
        <div class="row align-items-center">
            <div class="col-lg-5 px-0" data-aos="fade-right" style="position: relative; z-index: 20;">
                <div class="overlap-box-blue border-kuning-kiri shadow-lg overlap-left">
                    <h2 class="font-montserrat h4 mb-3 text-uppercase">{{ $content->misi_judul ?? 'MISI KAMI' }}</h2>
                    <p class="font-poppins small fw-bold mb-3">{{ $content->misi_tagline ?? 'Tagline misi belum diisi.' }}</p>
                    <p class="font-poppins text-description-muted mb-4">{{ $content->misi_desc ?? 'Deskripsi misi belum diisi.' }}</p>
                    <div class="font-montserrat badge-custom">Daily Commitment</div>
                </div>
            </div>
            <div class="col-lg-7 px-0" data-aos="fade-left" style="position: relative; z-index: 10;">
                <img src="{{ $content?->foto_misi ? asset('storage/'.$content->foto_misi) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000' }}" 
                     class="img-full shadow" alt="Misi">
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true, offset: 100 });
</script>

@endsection