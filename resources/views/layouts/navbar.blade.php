<style>
    /* --- NAVBAR STYLE --- */
    .custom-navbar {
        padding: 20px 0;
        background-color: transparent;
        transition: all 0.4s ease;
        z-index: 1050; /* Memastikan di atas elemen lain */
    }

    /* State saat discroll */
    .custom-navbar.scrolled {
        background: rgba(3, 8, 49, 0.95);
        padding: 10px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .brand-text span {
        font-size: 1.2rem;
        line-height: 1;
        color: white;
    }

    .custom-navbar .nav-link {
        font-size: 0.8rem;
        font-weight: 600;
        color: rgba(255,255,255,0.8) !important;
        margin: 0 10px;
        transition: 0.3s;
    }

    .custom-navbar .nav-link:hover {
        color: #B89551 !important;
    }

    /* --- MOBILE RESPONSIVE --- */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: rgba(3, 8, 49, 0.98); /* Background menu mobile */
            margin-top: 15px;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(184, 149, 81, 0.2);
        }
        
        .custom-navbar .nav-link {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin: 0;
        }
    }

    /* --- HERO STYLE --- */
    .hero-slider {
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(3, 8, 49, 0.6); 
        z-index: 1;
    }

    .hero-caption-centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 90%;
        text-align: center;
    }

    .hero-caption-centered h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3.8rem;
        letter-spacing: -1px;
        color: white;
        animation: fadeInUp 1.2s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .carousel-indicators button {
        width: 30px !important; 
        height: 3px !important;
        margin: 0 5px;
        background-color: #fff !important;
        border: none !important;
        opacity: 0.5;
        transition: all 0.3s ease;
    }

    .carousel-indicators button.active {
        opacity: 1;
        background-color: #B89551 !important;
        width: 45px !important; 
    }
</style>

<div class="hero-slider">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="home.html">
                <img src="logo-anda.png" alt="Logo" width="40" class="me-2">
                <div class="brand-text">
                    <span class="d-block fw-bold" style="letter-spacing: 2px;">LEGAL EDGE</span>
                    <small class="d-block text-uppercase" style="font-size: 0.6rem; letter-spacing: 3px; color: #B89551;">Law Firm</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="home">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentang">TENTANG</a></li>
                    <li class="nav-item"><a class="nav-link" href="artikel">ARTIKEL</a></li>
                    <li class="nav-item"><a class="nav-link" href="layanan">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="kotaksaran">KOTAK SARAN</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <div class="overlay"></div>
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" class="d-block w-100 vh-100 object-fit-cover">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <div class="overlay"></div>
                <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=2069&auto=format&fit=crop" class="d-block w-100 vh-100 object-fit-cover">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <div class="overlay"></div>
                <img src="https://images.unsplash.com/photo-1453928582365-b6ad33cbcf64?q=80&w=2073&auto=format&fit=crop" class="d-block w-100 vh-100 object-fit-cover">
            </div>
        </div>

        <div class="hero-caption-centered">
            <h1 id="hero-title" class="display-1 fw-bold">LEGAL EDGE</h1>
        </div>
    </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Carousel
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            ride: 'carousel',
            pause: false
        });

        // Logika Ganti Teks Berdasarkan URL
        var titleElement = document.getElementById('hero-title');
        var path = window.location.pathname.toLowerCase();

        if (path.includes('layanan')) {
            titleElement.innerText = 'LAYANAN';
        } else if (path.includes('tentang')) {
            titleElement.innerText = 'TENTANG KAMI';
        } else if (path.includes('artikel')) {
            titleElement.innerText = 'ARTIKEL';
        } else if (path.includes('kotaksaran')) {
            titleElement.innerText = 'KOTAK SARAN';
        } else {
            titleElement.innerText = 'LEGAL EDGE'; 
        }
        
        // Navbar scroll effect
        var nav = document.getElementById('mainNav');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    });
</script>