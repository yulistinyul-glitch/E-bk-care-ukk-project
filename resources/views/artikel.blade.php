@extends('layouts.app')

@section('title', 'Artikel - E-BK Care')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Our Insightful <span class="text-teal border-bottom border-3 border-teal">Blog</span></h1>
    </div>

    <div class="row g-2 mb-5">
        <div class="col-lg-7">
            @if($unggulan)
            <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 position-relative">
                <img src="{{ asset('storage/' . $unggulan->image) }}" class="w-100 featured-img" alt="{{ $unggulan->title }}">
                <div class="card-img-gradient">
                    <p class="small mb-1"><i class="bi bi-clock me-1"></i> {{ $unggulan->created_at->format('M d, Y') }}</p>
                    <h2 class="fw-bold">{{ $unggulan->title }}</h2>
                    <p class="small opacity-75 line-clamp-2 mb-3">{{ $unggulan->excerpt }}</p>
                    <a href="#" class="text-teal text-decoration-none fw-bold">Read More →</a>
                </div>
            </div>
            @else
            <div class="card border-0 rounded-4 shadow-sm h-100 p-5 d-flex align-items-center justify-content-center bg-light">
                <p class="text-muted">Belum ada artikel unggulan.</p>
            </div>
            @endif
        </div>

        <div class="col-lg-5">
            <div class="d-flex flex-column gap-3">
                @forelse($sidebar as $s)
                <div class="card sidebar-card shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/' . $s->image) }}" class="sidebar-img" alt="{{ $s->title }}">
                        <div>
                            <h6 class="fw-bold mb-1 small">{{ $s->title }}</h6>
                            <p class="text-muted mb-2" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i> {{ $s->created_at->format('M d, Y') }}</p>
                            <a href="#" class="text-dark fw-bold text-decoration-none" style="font-size: 0.75rem;">Read More →</a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted">Tidak ada artikel terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="section-biru-soft">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-4">Explore Our Latest <span class="text-teal">Articles</span></h3>
            <div class="d-flex justify-content-center gap-2 flex-wrap mb-5">
                <button class="btn btn-outline-dark filter-btn active" data-filter="all">All</button>
                <button class="btn btn-outline-dark filter-btn" data-filter="mental-health">Mental Health</button>
                <button class="btn btn-outline-dark filter-btn" data-filter="career">Career & Future</button>
                <button class="btn btn-outline-dark filter-btn" data-filter="self-growth">Self Growth</button>
                <button class="btn btn-outline-dark filter-btn" data-filter="study">Study Tips</button>
            </div>
        </div>

        <div class="row g-4" id="article-grid">
            @forelse($semua_artikel as $item)
            <div class="col-12 col-md-4 mb-4 article-item" data-category="{{ $item->category ?? 'tech' }}">
                <div class="card card-artikel-putih shadow">
                    <div class="img-container-center">
                        <img src="{{ asset('storage/' . $item->image) }}" class="img-centered" alt="{{ $item->title }}">
                    </div>
                    <div class="card-body d-flex flex-column pt-0">
                        <h5 class="title-bawah-foto">{{ $item->title }}</h5>
                        <div class="footer-card-custom d-flex justify-content-between align-items-center">
                            <div class="author-info">
                                <div class="author-avatar"></div>
                                <span>{{ $item->author ?? 'Admin' }}</span>
                            </div>
                            <a href="#" class="text-dark text-decoration-none fs-5">→</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada artikel yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection