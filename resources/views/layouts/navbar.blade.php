<div class="hero-slider">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="home.html">
                <img src="{{asset('img/logo-ebkCare.png')}}" alt="Logo" width="40" class="me-2">
                <div class="brand-text">
                    <span class="font-montserrat d-block" style="letter-spacing: 2px; font-weight: 700;">E-BK CARE</span>
                    <small class="font-montserrat d-block text-uppercase" style="font-size: 0.6rem; letter-spacing: 2px; color: #B89551;">Layanan konseling bagi siswa</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center font-montserrat">
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
                <img src="{{ asset('img/hero1.jpg') }}" class="d-block w-100 vh-100 object-fit-cover">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <div class="overlay"></div>
                <img src="{{ asset('img/hero2.jpg') }}" class="d-block w-100 vh-100 object-fit-cover">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <div class="overlay"></div>
                <img src="{{ asset('img/hero4.jpg') }}" class="d-block w-100 vh-100 object-fit-cover">
            </div>
        </div>

        <div class="hero-caption-centered">
            <h1 id="hero-title" class="font-montserrat display-1">LEGAL EDGE</h1>
        </div>
    </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        var myCarousel = document.querySelector('#heroCarousel');

        if (myCarousel) {
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000,
                ride: 'carousel',
                pause: false
            });
        }

        var titleElement = document.getElementById('hero-title');
        if (titleElement) {
            var path = window.location.pathname.toLowerCase();

            if (path.includes('layanan')) {
                titleElement.innerText = 'LAYANAN';
            } else if (path.includes('tentang')) {
                titleElement.innerText = 'TENTANG KAMI';
            } else if (path.includes('artikel')) {
                titleElement.innerText = 'ARTIKEL';
            } else if (path.includes('kotaksaran')) {
                titleElement.innerText = 'KOTAK SARAN';
            } else if (path.includes('galeri')) { 
                titleElement.innerText = 'GALERI LAYANAN';
            } else {
                titleElement.innerText = 'LEGAL EDGE'; 
            }
        }

        var nav = document.getElementById('mainNav');
        if (nav) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            });
        }
    });
</script>