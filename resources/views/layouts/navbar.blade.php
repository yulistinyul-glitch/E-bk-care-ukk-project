<style>
    .custom-navbar {
        padding: 20px 0;
        background-color: transparent;
        transition: background 0.4s;
    }

    .brand-text span {
        font-size: 1.2rem;
        line-height: 1;
    }

    .custom-navbar .nav-link {
        font-size: 0.8rem;
        font-weight: 600;
        color: rgba(255,255,255,0.8) !important;
        margin: 0 10px;
    }

    .custom-navbar .nav-link:hover {
        color: #B89551 !important;
    }

    .btn-contact {
        background-color: #B89551;
        color: white;
        border-radius: 0; 
        padding: 10px 25px;
        font-size: 0.8rem;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        border: none;
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
    }

    .hero-caption-centered h1 {
        font-family: 'Playfair Display', serif;
        font-size: 5rem;
        letter-spacing: -1px;
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
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="logo-anda.png" alt="Logo" width="40" class="me-2">
                <div class="brand-text">
                    <span class="d-block fw-bold" style="letter-spacing: 2px;">LEGAL EDGE</span>
                    <small class="d-block text-uppercase" style="font-size: 0.6rem; letter-spacing: 3px;">Law Firm</small>
                </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">TENTANG</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">ARTIKEL</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">LAYANAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">KOTAK SARAN</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-contact" href="#">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
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
            <h1 class="display-1 fw-bold text-white text-center">LAYANAN</h1>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myCarousel = document.querySelector('#heroCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            ride: 'carousel',
            pause: false
        });
    });
</script>