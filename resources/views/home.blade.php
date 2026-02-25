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
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --dark-blue: #0f2744;
            --gold: #B89551;
            --navy: #1A374D;
        }

        body { font-family: 'Montserrat', sans-serif; margin: 0; overflow-x: hidden; background-color: #fff; }

        /* --- HERO SECTION --- */
        .hero-section { position: relative; min-height: 100vh; display: flex; flex-direction: column; overflow: hidden; }
        .hero-slideshow { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -2; }
        .slide { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; opacity: 0; transition: opacity 1.5s ease-in-out; }
        .slide.active { opacity: 1; }
        .hero-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.568); z-index: -1; }

        /* --- HEADER & NAV --- */
        .header-top { padding: 40px 0 20px 0; text-align: center; position: relative; z-index: 1000; }
        .logo-placeholder { width: 100px; height: 100px; background: white; border: 3px solid #8ba8bc; border-radius: 50%; display: inline-block; margin-bottom: 40px; }
        .nav-menu { display: flex; justify-content: center; gap: 70px; transition: 0.4s ease; }
        .nav-menu a { text-decoration: none; color: var(--dark-blue); font-weight: 600; font-size: 0.85rem; letter-spacing: 1.5px; position: relative; }
        .login-btn { position: absolute; top: 0; right: 1.5rem; background: var(--dark-blue); color: white !important; padding: 7px 25px; border-radius: 20px; font-weight: bold; text-decoration: none; font-size: 0.8rem; z-index: 1001; }

        /* Burger Menu */
        .hamburger { display: none; cursor: pointer; flex-direction: column; gap: 6px; position: absolute; top: 5px; left: 1.5rem; z-index: 1100; }
        .hamburger span { width: 30px; height: 3px; background: var(--dark-blue); border-radius: 10px; transition: 0.3s; transform-origin: left; }

        @media (max-width: 992px) {
            .hamburger { display: flex; }
            .nav-menu {
                position: fixed; top: 0; left: -100%; width: 280px; height: 100vh;
                background: white; flex-direction: column; justify-content: flex-start;
                padding: 120px 40px; gap: 30px; box-shadow: 10px 0 30px rgba(0,0,0,0.1); z-index: 1050;
            }
            .nav-menu.active { left: 0; }
            .hamburger.open span:nth-child(1) { transform: rotate(45deg); }
            .hamburger.open span:nth-child(2) { opacity: 0; }
            .hamburger.open span:nth-child(3) { transform: rotate(-45deg); }
        }

        /* --- CONTENT AREA --- */
        .content-area { padding-top: 40px; max-width: 850px; }
        .title-large { font-family: 'Great Vibes', cursive; font-size: 3.4rem; color: var(--dark-blue); line-height: 1.2; margin-bottom: 0; }
        .title-small { font-family: 'Great Vibes', cursive; font-size: 3.2rem; color: var(--dark-blue); line-height: 1.1; margin-top: 30px; margin-bottom: 15px; }
        .description { color: #ffffff; font-size: 0.9rem; max-width: 480px; line-height: 1.6; text-shadow: 1px 1px 3px rgba(0,0,0,0.4); margin-bottom: 35px; }
        .btn-see-more { display: inline-flex; align-items: center; justify-content: space-between; margin-bottom: 50px; width: 210px; border: 2px solid rgba(255, 255, 255, 0.8); color: white; text-decoration: none; padding: 10px 25px; border-radius: 50px; font-weight: bold; font-size: 0.85rem; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(2px); }

        /* --- ARTIKEL SLIDER --- */
        .card-slider-section { padding: 60px 0 100px 0; background-color: #f1f5f9; display: flex; flex-direction: column; align-items: center; overflow: hidden; }
        .slider-wrapper { display: flex; align-items: center; justify-content: center; width: 100%; perspective: 1200px; padding: 40px 0; height: 420px; position: relative; }

        .custom-card {
            width: 260px; height: 360px; background: white;
            position: absolute; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.8s ease-in-out; display: flex; flex-direction: column;
            padding: 12px; border: 1px solid #e2e8f0; visibility: hidden; opacity: 0;
        }

<<<<<<< HEAD
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
=======
        .card-img-top { 
>>>>>>> 098a2476afb3c6d271f5c6d5d0ee5e4dc20902d5
            margin-top: 5px;
            padding: 15px;
            max-width: 100%; 
            max-height: 100%; 
            object-fit: cover; 
        }
        .card-body-text { padding: 15px 5px; flex-grow: 1; display: flex; align-items: center; }
        .card-body-text h5 { font-size: 0.95rem; font-weight: 800; color: #1e293b; text-align: center; line-height: 1.4; margin-bottom: 15px; }
        
        /* FIX: FOOTER CARD ALIGNMENT */
        .card-footer-box { display: flex; align-items: center; justify-content: space-between; padding: 10px 5px; border-top: 1px solid #f1f5f9; }
        .author-group { display: flex; align-items: center; gap: 8px; } /* Sejajarkan foto & nama */
        .author-icon { width: 22px; height: 22px; background: #cbd5e1; border-radius: 50%; flex-shrink: 0; }
        .author-name { font-size: 0.65rem; color: #64748b; margin-bottom: 0; white-space: nowrap; }
        .arrow-icon { font-size: 1rem; color: #334155; }

        /* Posisi 3D */
        .pos-center { visibility: visible; opacity: 1; z-index: 5; transform: translateZ(100px); }
        .pos-left-1 { visibility: visible; opacity: 0.7; z-index: 3; transform: translateX(-220px) rotateY(30deg) scale(0.85); }
        .pos-left-2 { visibility: visible; opacity: 0.3; z-index: 1; transform: translateX(-400px) rotateY(45deg) scale(0.7); }
        .pos-right-1 { visibility: visible; opacity: 0.7; z-index: 3; transform: translateX(220px) rotateY(-30deg) scale(0.85); }
        .pos-right-2 { visibility: visible; opacity: 0.3; z-index: 1; transform: translateX(400px) rotateY(-45deg) scale(0.7); }

        .dots-container { display: flex; gap: 10px; margin-top: 20px; }
        .dot { width: 8px; height: 8px; background: #d1d1d1; border-radius: 50%; border: none; padding: 0; cursor: pointer; transition: 0.4s; }
        .dot.active { background: var(--dark-blue); transform: scale(1.3); }

        @media (max-width: 768px) {
            .custom-card { width: 200px; height: 300px; }
            .pos-left-1 { transform: translateX(-120px) scale(0.8); }
            .pos-right-1 { transform: translateX(120px) scale(0.8); }
            .pos-left-2, .pos-right-2 { display: none; }
            .title-large { font-size: 2.5rem; }
            .title-small { font-size: 2.2rem; }
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
        </div>
<<<<<<< HEAD
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
        
=======
>>>>>>> 098a2476afb3c6d271f5c6d5d0ee5e4dc20902d5
        <div class="hero-overlay"></div>

        <div class="header-top">
            <div class="container px-4 position-relative">
                <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
                <div class="logo-placeholder"></div>
                <a href="#" class="login-btn">LOGIN</a>
                <div class="nav-menu" id="navMenu">
                    <a href="home">BERANDA</a><a href="tentang">TENTANG</a><a href="artikel">ARTIKEL</a><a href="layanan">LAYANAN</a><a href="kotaksaran">KOTAK SARAN</a> 
                </div>
            </div>
        </div>

        <div class="container px-4">
            <div class="content-area">
                <div class="title-large">Your Safety is Our Priority</div>
                <div class="title-small">Voice is Your Power</div>
                <p class="description">Identity remains strictly confidential. You are never alone.</p>
                <a href="#" class="btn-see-more">SEE MORE <span>&rarr;</span></a>
            </div>
        </div>
    </div>

    <div class="card-slider-section">
        <div class="slider-wrapper" id="sliderContainer">
            <div class="custom-card">
                <img src="https://images.pexels.com/photos/1438072/pexels-photo-1438072.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
                <div class="card-body-text"><h5>Menghadapi Insecurity: Kamu Lebih Dari Sekadar Angka.</h5></div>
                <div class="card-footer-box">
                    <div class="author-group">
                        <div class="author-icon"></div>
                        <span class="author-name">direct by lisa 2025</span>
                    </div>
                    <div class="arrow-icon">→</div>
                </div>
            </div>

            <div class="custom-card">
                <img src="https://images.pexels.com/photos/1438072/pexels-photo-1438072.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
                <div class="card-body-text"><h5>Building Resilience: Cara Bangkit Setelah Masa Sulit.</h5></div>
                <div class="card-footer-box">
                    <div class="author-group">
                        <div class="author-icon"></div>
                        <span class="author-name">direct by lisa 2025</span>
                    </div>
                    <div class="arrow-icon">→</div>
                </div>
            </div>

            <div class="custom-card">
                <img src="https://images.pexels.com/photos/3184311/pexels-photo-3184311.jpeg?auto=compress&cs=tinysrgb&w=1260" class="card-img-top">
                <div class="card-body-text"><h5>Cyberbullying: Langkah Melindungi Jejak Digitalmu.</h5></div>
                <div class="card-footer-box">
                    <div class="author-group">
                        <div class="author-icon"></div>
                        <span class="author-name">direct by lisa 2025</span>
                    </div>
                    <div class="arrow-icon">→</div>
                </div>
            </div>

            <div class="custom-card">
                <img src="https://images.pexels.com/photos/1438081/pexels-photo-1438081.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
                <div class="card-body-text"><h5>Pentingnya Kesehatan Mental di Era Digital.</h5></div>
                <div class="card-footer-box">
                    <div class="author-group">
                        <div class="author-icon"></div>
                        <span class="author-name">direct by lisa 2025</span>
                    </div>
                    <div class="arrow-icon">→</div>
                </div>
            </div>

            <div class="custom-card">
                <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=600" class="card-img-top">
                <div class="card-body-text"><h5>Manajemen Waktu Agar Belajar Lebih Efektif.</h5></div>
                <div class="card-footer-box">
                    <div class="author-group">
                        <div class="author-icon"></div>
                        <span class="author-name">direct by lisa 2025</span>
                    </div>
                    <div class="arrow-icon">→</div>
                </div>
            </div>
        </div>
        <div class="dots-container" id="dotsContainer"></div>
    </div>

    @include('layouts.footer')

    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        hamburger.onclick = () => { hamburger.classList.toggle('open'); navMenu.classList.toggle('active'); };

<<<<<<< HEAD
<<<<<<< HEAD
@endsection
=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
=======
        let heroIdx = 0;
        const heroSlides = document.querySelectorAll('.slide');
        setInterval(() => {
            heroSlides[heroIdx].classList.remove('active');
            heroIdx = (heroIdx + 1) % heroSlides.length;
            heroSlides[heroIdx].classList.add('active');
        }, 5000);

        const cards = document.querySelectorAll('.custom-card');
        const dotsContainer = document.getElementById('dotsContainer');
        let currentIndex = 2; 
        let autoPlayTimer;

        cards.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.classList.add('dot');
            if(i === currentIndex) dot.classList.add('active');
            dot.onclick = () => { currentIndex = i; updateSlider(); resetAutoPlay(); };
            dotsContainer.appendChild(dot);
        });

        const dots = document.querySelectorAll('.dot');
        function updateSlider() {
            const n = cards.length;
            cards.forEach((card, i) => {
                card.classList.remove('pos-left-2', 'pos-left-1', 'pos-center', 'pos-right-1', 'pos-right-2');
                dots[i].classList.remove('active');
                let diff = (i - currentIndex + n) % n;
                if (diff === 0) card.classList.add('pos-center');
                else if (diff === 1) card.classList.add('pos-right-1');
                else if (diff === 2) card.classList.add('pos-right-2');
                else if (diff === n - 1) card.classList.add('pos-left-1');
                else if (diff === n - 2) card.classList.add('pos-left-2');
                if (i === currentIndex) dots[i].classList.add('active');
            });
        }

        function startAutoPlay() {
            autoPlayTimer = setInterval(() => {
                currentIndex = (currentIndex + 1) % cards.length;
                updateSlider();
            }, 3000);
        }

        function resetAutoPlay() { clearInterval(autoPlayTimer); startAutoPlay(); }

        updateSlider();
        startAutoPlay();
    </script>
>>>>>>> 098a2476afb3c6d271f5c6d5d0ee5e4dc20902d5
</body>
</html>
>>>>>>> 957644ee89040ee092b747323a3d7de854820c46
