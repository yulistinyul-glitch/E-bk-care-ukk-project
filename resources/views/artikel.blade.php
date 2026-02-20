@extends('layouts.app')

@section('title', 'Our Insightful Blog')

@section('content')
<style>
    .line-clamp-2 {
         display: -webkit-box; 
         -webkit-line-clamp: 2; 
         -webkit-box-orient: vertical; 
         overflow: hidden; 
    }
    .card-img-gradient { 
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%); 
        position: absolute; 
        bottom: 0; 
        left: 0; 
        right: 0; 
        padding: 2rem; 
        color: white; 
    }
    .text-teal { 
        color: #20c997 !important; 
    }
    .featured-img { 
        min-height: 380px; 
        object-fit: cover; 
    }
    .sidebar-img { 
        width: 150px; 
        height: 110px; 
        object-fit: cover; 
        border-radius: 8px; 
    }
    .sidebar-card { 
        border: none; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
        border-radius: 12px; 
        padding: 10px; 
    }
    .section-biru-soft { 
        background-color: #eef6ff; 
        padding: 80px 0; 
        margin-top: 50px; 
        border-radius: 40px 40px 0 0; 
    }
    .card-artikel-putih { 
        border: none; 
        background-color: #ffffff; 
        height: 100%; 
        display: flex; 
        flex-direction: column; 
        transition: transform 0.3s ease; 
        padding: 20px; 
    }
    .card-artikel-putih:hover { 
        transform: translateY(-8px); 
    }
    .img-container-center { 
        width: 100%; 
        height: 180px; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        margin-bottom: 20px; 
        margin-top: 20px; 
        flex-shrink: 0; 
    }
    .img-centered { 
        max-width: 100%; 
        max-height: 100%; 
        object-fit: cover; 
    }
    .title-bawah-foto { 
        text-align: center; 
        font-size: 1.1rem; 
        font-weight: 800; 
        color: #111; 
        margin-bottom: 1.5rem; 
        min-height: 4rem; 
        display: flex; 
        align-items: flex-start; 
        justify-content: center; 
        line-height: 1.4; 
        padding: 0 5px; 
        word-wrap: break-word; 
        overflow: hidden; 
    }
    .footer-card-custom { 
        margin-top: auto; 
        border-top: 1px solid #f1f1f1; 
        padding-top: 15px; 
    }
    .author-info { 
        display: flex; 
        align-items: center; 
        gap: 8px; 
        font-size: 0.75rem; 
        color: #777; 
    }
    .author-avatar { 
        width: 24px; 
        height: 24px; 
        border-radius: 50%; 
        background: #ddd; 
    }

    .filter-btn { 
        transition: all 0.3s ease; 
        border-radius: 30px; 
        font-weight: 600; 
        padding: 8px 25px;
     }
    .filter-btn.active { 
        background-color: #111; 
        color: #fff; 
        border-color: #111; 
        }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Our Insightful <span class="text-teal border-bottom border-3 border-teal">Blog</span></h1>
    </div>

    <div class="row g-2 mb-5">
        <div class="col-lg-7">
            <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 position-relative">
                <img src="{{ $unggulan->image }}" class="w-100 featured-img">
                <div class="card-img-gradient">
                    <p class="small mb-1"><i class="bi bi-clock me-1"></i> {{ $unggulan->date }}</p>
                    <h2 class="fw-bold">{{ $unggulan->title }}</h2>
                    <p class="small opacity-75 line-clamp-2 mb-3">{{ $unggulan->excerpt }}</p>
                    <a href="#" class="text-teal text-decoration-none fw-bold">Read More →</a>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="d-flex flex-column gap-3">
                @foreach($sidebar as $s)
                <div class="card sidebar-card shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $s->image }}" class="sidebar-img">
                        <div>
                            <h6 class="fw-bold mb-1 small">{{ $s->title }}</h6>
                            <p class="text-muted mb-2" style="font-size: 0.7rem;"><i class="bi bi-clock me-1"></i> {{ $s->date }}</p>
                            <a href="#" class="text-dark fw-bold text-decoration-none" style="font-size: 0.75rem;">Read More →</a>
                        </div>
                    </div>
                </div>
                @endforeach
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
            @foreach($semua_artikel as $item)
            <div class="col-12 col-md-4 mb-4 article-item" data-category="{{ $item->category_slug ?? 'tech' }}">
                <div class="card card-artikel-putih shadow">
                    <div class="img-container-center">
                        <img src="{{ $item->image }}" class="img-centered">
                    </div>
                    
                    <div class="card-body d-flex flex-column pt-0">
                        <h5 class="title-bawah-foto">{{ $item->title }}</h5>
                        
                        <div class="footer-card-custom d-flex justify-content-between align-items-center">
                            <div class="author-info">
                                <div class="author-avatar"></div>
                                <span>{{ $item->penulis }}</span>
                            </div>
                            <a href="#" class="text-dark text-decoration-none fs-5">→</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- <div class="text-center mt-5">
            <button class="btn btn-dark px-5 py-2 fw-bold shadow-sm">View All Articles</button>
        </div> --}}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const articles = document.querySelectorAll('.article-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // 1. Ubah tampilan tombol aktif
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // 2. Ambil nilai filter
                const filterValue = this.getAttribute('data-filter');

                // 3. Filter Artikel
                articles.forEach(article => {
                    if (filterValue === 'all') {
                        article.style.display = 'block';
                    } else {
                        // Jika kategori artikel cocok dengan tombol filter
                        if (article.getAttribute('data-category') === filterValue) {
                            article.style.display = 'block';
                        } else {
                            article.style.display = 'none';
                        }
                    }
                });
            });
        });
    });
</script>
@endsection