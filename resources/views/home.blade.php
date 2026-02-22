<<<<<<< HEAD
@extends('layouts.app')

@section('title', 'Visi & Misi - E-BK Care')
@section( 'content')
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

   <style>
     .bg-custom {
      background-color: #ffffff;
      background-image:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%230d283d' fill-opacity='1' fill-rule='evenodd'%3E%3Cpath d='M10 10l-2-2m2 2l2 2m-2-2l2-2m-2 2l-2 2M30 30l-2-2m2 2l2 2m-2-2l2-2m-2 2l-2 2' stroke='%230d283d' stroke-width='2'/%3E%3C/g%3E%3C/svg%3E");
    }

     .swiper {
    width: 100%;
    padding-top: 50px;
    padding-bottom: 50px;
    overflow: visible !important; 
  }

  .swiper-slide {
    transition: all 0.5s ease;
    filter: brightness(0.7);
    transform: scale(0.8);
  }

  .swiper-slide-active {
    filter: brightness(1);
    transform: scale(1.1);
    z-index: 10;
  }

  .swiper-slide-next, .swiper-slide-prev {
    filter: brightness(0.85);
    z-index: 5;
    opacity: 1 !important;
  }

  .swiper-slide-next + .swiper-slide, 
  .swiper-slide-prev {
    opacity: 0.5;
  }
=======
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
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46

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

<<<<<<< HEAD
=======
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
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
</head>
<body>

<<<<<<< HEAD
<body class="mx-auto max-w-7xl font-[Poppins]">
  

  {{-- visi & misi --}}
  <div class="bg-custom min-h-screen relative overflow-x-hidden p-8 md:p-16">
    <div class="absolute -top-16 -left-5 w-80 h-64 bg-[#0d283d] rounded-full"></div>
    <div class="absolute top-15 -left-10 w-48 h-48 bg-[#0d283d] rounded-full"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">

      <div class="relative flex justify-center lg:justify-start">
        <div class="w-32 h-40 md:w-64 md:h-80 rounded-[3rem] absolute md:translate-x-11 md:-translate-y-10 bg-amber-800"></div>
        <div class="relative w-40 h-33 md:w-80 md:h-64 rounded-4xl overflow-hidden border-4 border-white md:translate-x-24  md:translate-y-10 md:shadow-xl shadow-amber-200">
          <img src="{{asset('img/visimisiIMG.jpg')}}" alt="kegiatan pembelajaran murid" class="w-full h-full object-cover">
        </div>
      </div>

      <div class="flex flex-col gap-12">
        <div class="flex flex-col items-start">
           <div class="bg-[#b8d2e0] px-10 py-2 rounded-xl text-gray-800 mb-4 z-20 mr-4">
              <h2 class="text-3xl font-bold">Visi</h2>
            </div>
        <div class="bg-[#d9d9d9] p-8 rounded-2xl shadow-sm text-gray-700 font-semibold leading-relaxed text-sm md:text-base">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, odit possimus. Esse blanditiis illo, aspernatur incidunt eveniet itaque officiis ut ad reiciendis, veritatis beatae inventore porro eligendi laudantium, assumenda magni.
        </div>
      </div>

      <div class="flex flex-col items-end">
        <div class="bg-[#b8d2e0] px-10 py-2 rounded-xl text-gray-800 font-semibold mb-4 z-20 mr-4">
          <h2 class="text-3xl font-bold">Misi</h2>
        </div>
        <div class="bg-[#d9d9d9] p-8 rounded-2xl shadow-sm text-gray-700 leading-relaxed text-sm md:text-base">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum, odit possimus. Esse blanditiis illo, aspernatur incidunt eveniet itaque officiis ut ad reiciendis, veritatis beatae inventore porro eligendi laudantium, assumenda magni.
        </div>
      </div>
    </div>

  </div>
</div>



{{-- artikel page --}}
<div class="bg-white flex flex-col items-center mt-8 w-full overflow-hidden">
  <div class="w-full max-w-7xl px-4 py-12">
    
    <div class="bg-[#0d283d] text-white text-center font-poppins py-4 rounded-full mb-12 shadow-md">
      <h1 class="text-2xl font-bold uppercase tracking-[0.2rem]">Artikel</h1>
    </div>

    <div class="relative w-full">
      <div class="swiper mySwiper py-20">
        <div class="swiper-wrapper">

          <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
            <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
              <img src="{{asset('img/artikel1.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
            </div>
            <div class="flex flex-col grow text-[#1e3a52]">
              <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
              <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </p>
            </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel2.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel3.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel4.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel5.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
                style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel6.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel7.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
                style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #def7fe 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel8.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px] overflow-hidden"
               style="background: linear-gradient(to bottom, #CBD8D9 0%, #CFDBDB 50%, #88A9B2 100%);">
              <div class="bg-white rounded-2xl p-2 mb-6 shadow-sm">
                <img src="{{asset('img/artikel9.jpg')}}" alt="Artikel" class="rounded-xl w-full h-40 md:h-52 object-cover">
              </div>
              <div class="flex flex-col grow text-[#1e3a52]">
                <h3 class="text-lg md:text-xl font-bold font-poppins text-center mb-3 leading-tight">Building Resilience</h3>
                <p class="text-sm text-center text-gray-600 line-clamp-3 md:line-clamp-4 leading-relaxed">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
          </div>
          
          </div>
        <div class="swiper-pagination !-bottom-10"></div>
      </div>

      <button class="swiper-button-prev absolute top-1/2 left-4 lg:-left-20 transform -translate-y-1/2 w-12 h-12 bg-[#0d283d] text-white rounded-full flex items-center justify-center z-50 shadow-lg hover:bg-blue-900 transition-all border-none outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <button class="swiper-button-next absolute top-1/2 -right-4 lg:-right-20 transform -translate-y-1/2 w-12 h-12 bg-[#0d283d] text-white rounded-full flex items-center justify-center z-50 shadow-lg hover:bg-blue-900 transition-all border-none outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
        </svg>
    </button>
    </div>
  </div>
</div>



{{-- layanan --}}
<div class="bg-custom overflow-x-hidden p-8 md:p-16">
  <div class="bg-gray-300 border-2 border-gray-500 opacity-70 w-full rounded-2xl p-6 md:p-12">
    <h3 class="text-center text-yellow-600 text-3xl md:text-4xl font-bold mb-8">Layanan</h3>

    <div class="flex ml-0 md:ml-12 mb-7 text-center md:text-left">
      <ul class="w-full shrink-0 flex flex-col items-start text-amber-950 text-sm md:text-base font-semibold list-disc list-inside gap-3">
        <li>Layanan Orientasi & Informasi Tujuan: <br>
           Agar siswa tidak merasa "tersesat" dan memiliki pengetahuan yang cukup untuk mengambil keputusan.</li>
        <li>Layanan Konseling Perorangan (Privat) Tujuan: <br>
         Membantu siswa mengentaskan masalah yang sedang dialaminya dalam suasana yang aman dan tertutup
        </li>
        <li>Layanan Konseling Kelompok Tujuan: <br>
           Memberikan dukungan moral bahwa "kamu tidak sendirian" dalam menghadapi masalah tersebut.
        </li>
        <li>Layanan Penempatan dan Penyaluran <br>>
           Tujuan: Agar siswa berada di lingkungan yang tepat untuk mengembangkan bakatnya
        </li>
        <li>Layanan Advokasi Tujuan: <br>
           Mengembalikan hak siswa dan memastikan mereka mendapatkan perlakuan yang adil.
          </li>
      </ul>
    </div>
  </div>
</div>

{{-- all js code --}}

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
//btn see more
document.getElementById('btn-see-more').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollBy({
      top: 800,
      left: 0,
      behavior: 'smooth'
    });
});

//  card carousel
document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.mySwiper', {
        effect: 'coverflow', 
        grabCursor: true,
        centeredSlides: true,
        loop: true,
=======
    <div class="hero-section">
        <div class="hero-slideshow">
            <div class="slide active" style="background-image: url('https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"></div>
            <div class="slide" style="background-image: url('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260');"></div>
            <div class="slide" style="background-image: url('https://images.pexels.com/photos/3184311/pexels-photo-3184311.jpeg?auto=compress&cs=tinysrgb&w=1260');"></div>
        </div>
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
        
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

<<<<<<< HEAD
@endsection
=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
