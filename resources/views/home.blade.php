<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BK Care - Kotak Saran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --dark-blue: #0f2744;
            --gold: #B89551;
            --navy: #1A374D;
        }

        body { 
            font-family: 'Montserrat', sans-serif; 
            margin: 0; 
            overflow-x: hidden;
        }

        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.568);
            z-index: -1;
        }

        .header-top {
            padding: 40px 0 20px 0;
            text-align: center;
            position: relative;
        }

        .logo-placeholder {
            width: 100px;
            height: 100px;
            background: white;
            border: 3px solid #8ba8bc;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 40px;
        }

        .nav-menu {
            display: flex;
            justify-content: center;
            gap: 70px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--dark-blue);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            transition: 0.3s;
        }

        .nav-menu a.active {
            border-bottom: 2px solid var(--dark-blue);
        }

        .login-btn {
            position: absolute;
            top: 40px;
            right: 60px;
            background: var(--dark-blue);
            color: white !important;
            padding: 7px 25px;
            border-radius: 20px;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.8rem;
        }

        .content-area {
            padding: 40px 0 0 10%; 
            max-width: 850px;
        }

        .title-large {
            font-family: 'Great Vibes', cursive;
            font-size: 3.4rem; 
            color: var(--dark-blue);
            line-height: 2.5; 
            margin-bottom: 0;
        }

        .title-small {
            font-family: 'Great Vibes', cursive;
            font-size: 3.2rem; 
            color: var(--dark-blue);
            line-height: 1.1;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .description {
            color: #ffffff;
            font-size: 0.9rem;
            max-width: 480px;
            line-height: 1.6;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
            margin-bottom: 35px;
        }

        .btn-see-more {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 50px;
            width: 210px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(2px);
            transition: all 0.3s ease;
        }

        .divider-line { 
            border-top: 2.5px solid #333; 
            border-bottom: 2.5px solid #333; 
            padding: 80px 0; 
            margin: 80px 0; 
        }

        .font-serif-custom { 
            font-family: 'Playfair Display', serif; 
            letter-spacing: 4px; 
            font-weight: 700;
            font-size: 2.5rem;
            line-height: 1.1;
        }

        .service-box {
            padding: 20px;
            cursor: pointer;
            perspective: 1000px; 
            text-align: center;
        }

        .service-icon-wrapper {
            font-size: 3.5rem;
            color: var(--gold); 
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), color 0.4s ease;
            margin-bottom: 20px;
            display: inline-block;
            transform-style: preserve-3d;
        }

        .service-line {
            width: 50px;
            height: 3px;
            background-color: var(--gold); 
            transition: all 0.4s ease;
            margin: 15px auto 0;
        }

        .service-box:hover .service-icon-wrapper {
            color: var(--navy); 
            transform: rotateY(180deg); 
        }

        .service-box:hover .service-line {
            background-color: var(--navy); 
            width: 80px;
        }

        .service-title {
            font-weight: 700;
            font-size: 1.1rem;
            text-transform: uppercase;
            color: #000;
        }

        .service-subtitle {
            color: #777;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <div class="hero-slideshow">
            <div class="slide active" style="background-image: url('https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"></div>
            <div class="slide" style="background-image: url('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260');"></div>
            <div class="slide" style="background-image: url('https://images.pexels.com/photos/3184311/pexels-photo-3184311.jpeg?auto=compress&cs=tinysrgb&w=1260');"></div>
        </div>
        
        <div class="hero-overlay"></div>

        <div class="header-top">
            <div class="logo-placeholder"></div>
            <a href="#" class="login-btn">LOGIN</a>
            
            <div class="nav-menu">
                <a href="home" class="active">BERANDA</a>
                <a href="tentang">TENTANG</a>
                <a href="artikel">ARTIKEL</a>
                <a href="layanan">LAYANAN</a>
                <a href="#">KOTAK SARAN</a> 
            </div>
        </div>

        <div class="content-area">
            <div class="title-large">Your Safety is Our Priority</div>
            <div class="title-small">Voice is Your Power</div>
            
            <p class="description">
                We ensure that your identity remains strictly confidential while providing you the platform to speak up. You are never alone in this journey.
            </p>
            
            <a href="#" class="btn-see-more">
                SEE MORE <span>&rarr;</span>
            </a>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        
        function showNextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        
        setInterval(showNextSlide, 5000); // Ganti foto setiap 5 detik
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>