@extends('layouts.app')

@section('title', 'Galeri Kegiatan - E-BK Care')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    /* Global Font Poppins dan Container dengan Padding Horizontal */
    .gallery-page-container { 
        font-family: 'Poppins', sans-serif;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    /* Navy Pekat & Kotak (Square-ish) */
    .btn-navy-dark {
        background-color: #000033; /* Navy yang sangat pekat */
        color: #ffffff;
        border: none;
        border-radius: 4px; /* Kotak dengan sedikit curve di sudut */
        padding: 12px 28px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .btn-navy-dark:hover {
        background-color: #00001a;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Gallery Item Styling */
    .gallery-item { 
        position: relative; 
        cursor: pointer;
        overflow: hidden; 
        border-radius: 12px; 
        height: 280px; 
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    }
    
    .gallery-item img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        transition: transform 0.5s ease; 
    }
    
    .gallery-item:hover img { 
        transform: scale(1.05); 
    }
    
    .gallery-overlay {
        position: absolute; 
        bottom: 0; 
        left: 0; 
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
        padding: 20px; 
        color: white; 
    }
    
    .gallery-title {
        font-size: 0.95rem;
        margin: 0;
        font-weight: 500;
        line-height: 1.4;
    }
</style>

<div class="container gallery-page-container px-4">
    
    <div class="row g-4">
        @forelse($galleries as $foto)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="gallery-item">
                    <img src="{{ filter_var($foto->image, FILTER_VALIDATE_URL) ? $foto->image : asset('storage/'.$foto->image) }}" 
                         alt="{{ $foto->title }}">
                    <div class="gallery-overlay">
                        <p class="gallery-title">{{ $foto->title }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted"><i class="bi bi-images"></i>Belum ada foto kegiatan.</p>
            </div>
        @endforelse
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('layanan.index') }}" class="btn btn-navy-dark shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Layanan
        </a>
    </div>
</div>
@endsection