<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>E-BK care</title>
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
    /* Pastikan overflow terlihat agar kartu samping tidak terpotong */
    overflow: visible !important; 
  }

  .swiper-slide {
    transition: all 0.5s ease;
    /* Memberikan efek blur/gelap sedikit pada slide yang tidak aktif */
    filter: brightness(0.7);
    transform: scale(0.8);
  }

  /* Slide yang aktif (paling depan) */
  .swiper-slide-active {
    filter: brightness(1);
    transform: scale(1.1);
    z-index: 10;
  }

  /* Slide tepat di sebelah aktif (layer kedua) */
  .swiper-slide-next, .swiper-slide-prev {
    filter: brightness(0.85);
    z-index: 5;
    opacity: 1 !important;
  }

  /* Slide lebih jauh (layer ketiga) */
  .swiper-slide-next + .swiper-slide, 
  .swiper-slide-prev {
    opacity: 0.5;
  }

  .swiper-button-next:after,
  .swiper-button-prev:after {
    display: none !important;
  }

  
  .swiper-button-prev {
    position: absolute !important; 
    margin: 0 !important;
    display: flex !important;
    align-items: center;
    justify-content: center;
  }
</style>

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Qwigley&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="mx-auto max-w-7xl font-[Poppins]">
  {{-- header --}}
  <div class="relative w-full min-h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-center md:justify-start"
       style="background-image: url('{{ asset('img/hero.jpg') }}');">
    
    {{-- White blur overlay --}}
    <div class="absolute inset-0 bg-white/50 backdrop-blur-[2px] opacity-40 z-0"></div>

    {{-- tab, desk nav --}}
    <div class="hidden md:flex flex-col items-center justify-center bg-white/60 py-4 gap-4 relative">
       <button class="absolute top-5 right-6 px-6 py-2 text-white bg-[#1A374D] text-sm font-bold rounded-full">LOGIN</button>
       <div class="w-24 h-24 rounded-full bg-white border-2 border-blue-950 flex items-center justify-center">
          <p class="text-center font-semibold">logo</p>
       </div>

      <nav class="flex gap-24 text-[#1A374D] font-bold text-lg">
        <a href="" class="relative group">
          BERANDA
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span>
        </a>
    
        <a href="" class="relative group">
          TENTANG KAMI
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span>
        </a>

        <a href="" class="relative group">
          ARTIKEL
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span>
        </a>
    
        <a href="" class="relative group">
          LAYANAN
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span>
        </a>
  
      </nav>
    </div>

  
    {{-- Overlay Gelap (Backdrop) --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-95 hidden opacity-0 duration-300 md:hidden"></div>

    {{-- main btn toogle --}}
    <button id="menu-toggle" class="fixed top-5 left-5 z-110 bg-blue-950 p-3 rounded-full text-white active:scale-95 transition-all duration-300 ease-in-out md:hidden">

      {{-- opem --}}
    <svg id="icon-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>

    {{-- close --}}
    <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
    </button>

    {{-- mobile sidebar --}}
    <div id="mobile-sidebar" class="fixed top-0 left-0 z-100 h-screen p-6 bg-blue-950 backdrop-blur-md w-1/2 md:hidden transform -translate-x-full transition-transform duration-300 ease-in-out pt-24">
      <nav class="flex flex-col gap-8 text-white font-poppins">
        <h3 class="text-3xl font-['Qwigley'] text-blue-200 mb-4"> E-BK CARE</h3>
        <a href="" class="text-lg font-semibold hover:translate-x-2 transition-transform">BERANDA</a>
        <a href="" class="text-lg font-semibold hover:translate-x-2 transition-transform">TENTANG KAMI</a>
        <a href="" class="text-lg font-semibold hover:translate-x-2 transition-transform">ARTIKEL</a>
        <a href="" class="text-lg font-semibold hover:translate-x-2 transition-transform">LAYANAN</a>
    </nav>
    </div>


    {{-- content area --}}
    <div class="flex flex-col gap-4 sm:gap-6 items-center text-center mx-4 md:items-start md:text-left md:ml-10 md:mt-10 md:mb-5 md:w-2/3 lg:w-1/2 z-50 overflow-hidden">
    
      <h1 class="text-5xl lg:text-7xl font-['Qwigley'] text-blue-950 leading-tight">
          Your safety is our priority, Your <br> voice is your power
      </h1>

      <p class="text-white font-['Poppins'] font-semibold text-sm xs:text-base sm:text-lg md:text-lg lg:text-xl leading-relaxed max-w-md sm:max-w-none">
          We ensure that your identity remains strictly confidential <br> while providing you the platform to speak up. <br> You are never alone in this journey.
      </p>

      <a href="#" id="btn-see-more" class="font-['Poppins'] p-2 sm:p-3 px-4 sm:px-6 border-2 border-white rounded-full flex text-white font-semibold text-base sm:text-lg gap-2 sm:gap-3 items-center mt-6 sm:mt-8 md:mt-12 hover:bg-white hover:text-blue-950 transition-all duration-300 cursor-pointer whitespace-nowrap">
          See more 
          <svg class="w-5 h-5 sm:w-6 sm:h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7m0 0l-7 7"></path>
          </svg>
      </a>
  </div>

  </div>

  {{-- visi & misi --}}
  <div class="bg-custom min-h-screen relative overflow-x-hidden p-8 md:p-16">
    <div class="absolute -top-16 -left-5 w-80 h-64 bg-[#0d283d] rounded-full"></div>
    <div class="absolute top-20 -left-10 w-48 h-48 bg-[#0d283d] rounded-full"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">

      <div class="relative flex justify-center lg:justify-start ">
        <div class="w-32 h-40 md:w-64 md:h-80 rounded-[3rem] absolute md:translate-x-11  bg-amber-800"></div>
        <div class="relative w-40 h-33 md:w-80 md:h-64 rounded-4xl overflow-hidden border-4 border-white md:translate-x-24 md:translate-y-24 md:shadow-xl shadow-amber-200">
          <img src="{{asset('img/visimisiIMG.jpg')}}" alt="kegiatan pembelajaran murid" class="w-full h-full object-cover ">
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
        <div class="swiper-wrapper ">

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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

            <div class="swiper-slide rounded-[2.5rem] p-6 md:p-8 shadow-xl flex flex-col min-h-[400px] md:min-h-[550px]"
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

      <button class="swiper-button-prev absolute top-1/2 -left-4 lg:-left-20 transform -translate-y-1/2 w-12 h-12  bg-[#0d283d] text-white rounded-full flex items-center justify-center z-50 shadow-lg hover:bg-blue-900 transition-all border-none outline-none">
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
      <ul class="w-full shrink-0 flex flex-col items-start text-amber-950 text-sm md:text-base font-semibold space-y-2 list-disc list-inside">
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
//mobile nav
  const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggleBtn = document.getElementById('menu-toggle');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    let isMenuOpen = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
           
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
            
          
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            
            
            toggleBtn.classList.add('left-[45%]', 'sm:left-[45%]'); 
            toggleBtn.classList.remove('left-5');
        } else {
         
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            
          
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
            
           
            toggleBtn.classList.remove('left-[45%]', 'sm:left-[45%]');
            toggleBtn.classList.add('left-5');

            setTimeout(() => {
                if (!isMenuOpen) overlay.classList.add('hidden');
            }, 300);
        }
    }

    toggleBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);

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
        
        coverflowEffect: {
            rotate: 0,       
            stretch: -20,    
            depth: 150,       
            slideShadows: false, 
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            // Mobile
            0: {
                slidesPerView: 1.5,
                spaceBetween: 0
            },
            // Desktop
            1024: {
                slidesPerView: 3,
                spaceBetween: 0
            }
        }
    });
});
</script>


</body>
</html>