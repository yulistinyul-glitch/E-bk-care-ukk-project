@extends('layouts.app')

@section('title', 'Artikel - E-BK Care')

@section('content')
<style>
/* Efek garis bawah shadow khusus untuk teks teal */
.text-teal { 
    color: #20c997 !important; 
    position: relative;
    display: inline-block;
}

.text-teal::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px; /* Jarak dari teks */
    width: 100%;
    height: 2px;
    background-color: #ffffff; /* Warna teal */
    border-radius: 2px;
    /* Efek shadow agar terlihat menonjol/mengambang */
    box-shadow: 0 3px 5px rgba(60, 60, 60, 0.4);
}
    .text-black { color: #000 !important; }
    .text-unggul { margin-top: 60px; margin-bottom: 60px; }
    .hero-container { position: relative; height: 420px; border-radius: 15px; overflow: hidden; margin-bottom: 80px;}
    .featured-img { width: 100%; height: 100%; object-fit: cover; }
    .card-img-gradient { position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 100%); color: white; }
    
    .sidebar-card { border: none; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 12px; }
    .sidebar-img-wrapper { width: 160px; height: 120px; flex-shrink: 0; border-radius: 15px; overflow: hidden; }
    .sidebar-img { width: 100%; height: 100%; object-fit: cover; margin-bottom: 5px;}
    
    .article-section { padding: 60px 0; background-color: #f0f7ff; }
    .article-grid-wrapper { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; }
    
    .custom-card { 
        width: 98%; height: 400px; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); 
        border-radius: 5px; display: flex; flex-direction: column; padding: 20px; 
        border: 1px solid #e2e8f0; transition: transform 0.3s ease; margin-bottom: 10px;
    }
    .custom-card:hover { transform: translateY(-5px); }

    .card-img-top { max-width: 100%; height: 220px; object-fit: cover; border-radius: 5px; margin-top: 10px; padding: 20px; }
    .card-body-text { flex-grow: 1; display: flex; align-items: center; justify-content: center; text-align: center; padding: 0 10px; }
    .card-body-text h5 { font-size: 1rem; font-weight: 700; color: #1e293b; line-height: 1.4; margin: 0; }
    
    .card-footer-box { display: flex; align-items: center; justify-content: space-between; padding-top: 15px; border-top: 1px solid #edf2f7; }
    .author-group { display: flex; align-items: center; gap: 8px; }
    .author-icon { width: 22px; height: 22px; background: #cbd5e1; border-radius: 50%; }
    .author-name { font-size: 0.75rem; color: #64748b; margin-bottom: 0; }
    .arrow-icon { font-size: 1.2rem; color: #334155; }
    
    .filter-btn { border-radius: 20px; padding: 8px 25px; font-weight: 600; border: 1.2px solid #ddd; background: #fff; }
    .filter-btn.active { background: #111; color: #fff; border-color: #111; }
</style>

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