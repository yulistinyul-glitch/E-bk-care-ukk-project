@extends('layouts.app')

@section('title', 'Galeri Kegiatan - E-BK Care')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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