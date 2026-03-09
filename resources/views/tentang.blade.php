@extends('layouts.app')

@section('title', 'Tentang Kami - E-BK Care')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .bg-white-custom { background-color: #ffffff !important; color: #000000; font-family: 'Arial', sans-serif; }
    .bg-soft-blue-area { background-color: #f2f5f7 !important; width: 100%; }
    .font-serif-custom { font-family: 'Playfair Display', serif; letter-spacing: 3px; }
    .divider-line { border-top: 1px solid #333; border-bottom: 1px solid #333; padding: 30px 0; margin: 50px 0; }
    .service-box { transition: all 0.4s ease; padding: 20px; cursor: pointer; perspective: 1000px; }
    .service-icon-wrapper { font-size: 3.5rem; color: #B89551; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), color 0.4s ease; margin-bottom: 20px; display: inline-block; transform-style: preserve-3d; }
    .service-line { width: 60px; height: 3px; background-color: #B89551; transition: all 0.4s ease; margin: 15px auto 0; }
    .service-box:hover .service-icon-wrapper { color: #1A374D; transform: rotateY(180deg); }
    .service-box:hover .service-line { background-color: #1A374D; width: 100px; }
    .service-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 8px; text-transform: uppercase; color: #000; }
    .service-subtitle { color: #777; font-size: 0.85rem; }
    
    /* Badge pengganti Read More */
    .badge-custom { background-color: #B89551; color: #fff; padding: 5px 15px; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; display: inline-block; }

    .overlap-box-blue { background-color: #1A374D !important; color: #ffffff !important; padding: 45px; position: relative; z-index: 10; }
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
    
@php
    $content = \App\Models\About::first();
@endphp

<div class="bg-soft-blue-area">
    <div class="container px-4">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10">
                <div class="divider-line">
                    <h1 class="font-serif-custom mb-3 text-uppercase" style="font-size: 2.8rem; font-weight: 700;">
                        {{ $content->title ?? 'E-BK CARE' }}
                    </h1>
                    <p class="fst-italic" style="color: #333; font-size: 1.3rem;">
                        "{{ $content->tagline ?? 'Tagline belum diisi' }}"
                    </p>
                    <p class="text-muted mb-4 px-lg-5" style="font-size: 1rem; line-height: 1.8;">
                        {{ $content->desc_1 ?? 'Deskripsi belum diisi.' }}
                    </p>
                    <p class="text-muted px-lg-5" style="font-size: 1rem; line-height: 1.8;">
                        {{ $content->desc_2 ?? 'Deskripsi tambahan belum diisi.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container px-4 py-5">
    <div class="row align-items-center">
        <div class="col-lg-7 px-0">
<img src="{{ $content?->foto_visi ? asset('storage/'.$content->foto_visi) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000' }}" 
     class="img-full shadow" alt="Visi">
        </div>
        <div class="col-lg-5 px-0">
            <div class="overlap-box-blue overlap-right border-kuning-kanan shadow-lg">
                <h2 class="font-serif-custom h4 mb-3 text-uppercase">{{ $content->visi_judul ?? 'VISI KAMI' }}</h2>
                <p class="small fw-bold mb-3">{{ $content->visi_tagline ?? 'Tagline visi belum diisi.' }}</p>
                <p class="text-description-muted mb-4">{{ $content->visi_desc ?? 'Deskripsi visi belum diisi.' }}</p>
                <div class="badge-custom">Core Purpose</div>
            </div>
        </div>
    </div>
</div>

<div class="container px-4 pt-5">
    <div class="row align-items-center flex-column-reverse flex-lg-row">
        <div class="col-lg-5 px-0">
            <div class="overlap-box-blue overlap-left border-kuning-kiri shadow-lg">
                <h2 class="font-serif-custom h4 mb-3 text-uppercase">{{ $content->misi_judul ?? 'MISI KAMI' }}</h2>
                <p class="small fw-bold mb-3">{{ $content->misi_tagline ?? 'Tagline misi belum diisi.' }}</p>
                <p class="text-description-muted mb-4">{{ $content->misi_desc ?? 'Deskripsi misi belum diisi.' }}</p>
                <div class="badge-custom">Daily Commitment</div>
            </div>
        </div>
        <div class="col-lg-7 px-0">
<img src="{{ $content?->foto_misi ? asset('storage/'.$content->foto_misi) : 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000' }}" 
     class="img-full shadow" alt="Misi">
        </div>
    </div>
</div>

</div>

@endsection