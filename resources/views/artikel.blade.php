@extends('layouts.app')

@section('title', 'Artikel - E-BK Care')

@section('content')

<div class="container px-4">
    <div class="text-center text-unggul">
        <h1 class="fw-bold hover-underline">Our Insightful <span class="text-teal">Blog</span></h1>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            @if(isset($hero) && $hero)
            <div class="hero-container">
                <img src="{{ asset('storage/' . $hero->image) }}" class="featured-img" alt="{{ $hero->title }}">
                <div class="card-img-gradient">
                    <p class="small mb-2"> <i class="bi bi-clock"></i> {{ $hero->created_at->format('d M Y') }}</p>
                    <h2 class="fw-bold">{{ $hero->title }}</h2>
                    <p class="small mb-3" style="line-height: 1.5; opacity: 0.9;">{{ Str::limit($hero->description, 100) }}</p>
                    <a href="#" class="text-white fw-bold text-decoration-none">Read More →</a>
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-5">
            @forelse($sidebar as $s)
            <div class="card sidebar-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="sidebar-img-wrapper"><img src="{{ asset('storage/' . $s->image) }}" class="sidebar-img"></div>
                    <div>
                        <p class="small"><i class="bi bi-clock"></i> {{ $s->created_at->format('d M Y') }}</p>
                        <h6 class="fw-bold mb-2">{{ Str::limit($s->title, 40) }}</h6>
                        <a href="#" class="text-black fw-bold small text-decoration-none">Read More →</a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">Tidak ada artikel tambahan.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="article-section">
    <div class="container px-4">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-4 hover-underline">Explore Our Latest <span class="text-teal">Articles</span></h3>
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <button class="btn filter-btn active" data-filter="all">All</button>
                <button class="btn filter-btn" data-filter="mental-health">Mental Health</button>
                <button class="btn filter-btn" data-filter="career">Career & Future</button>
                <button class="btn filter-btn" data-filter="self-growth">Self Growth</button>
            </div>
        </div>

        <div class="article-grid-wrapper" id="article-grid">
            @forelse($semua_artikel as $item)
            <div class="article-item" data-category="{{ $item->category_slug ?? 'all' }}">
                <div class="custom-card shadow">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                    <div class="card-body-text">
                        <h5>{{ Str::limit($item->title, 60) }}</h5>
                    </div>
                    <div class="card-footer-box">
                        <div class="author-group">
                            <div class="author-icon"></div>
                            <span class="author-name">direct by {{ $item->penulis ?? 'Admin' }}</span>
                        </div>
                        <div class="arrow-icon">→</div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center w-100">Belum ada artikel tersedia.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btns = document.querySelectorAll('.filter-btn');
        const items = document.querySelectorAll('.article-item');
        btns.forEach(btn => {
            btn.addEventListener('click', function() {
                btns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.getAttribute('data-filter');
                items.forEach(item => {
                    item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'block' : 'none';
                });
            });
        });
    });
</script>
@endsection