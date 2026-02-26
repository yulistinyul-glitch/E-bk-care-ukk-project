
@extends('partials.app')

@section('content')
{{-- Header profile --}}
<div class="lg:ml-28 px-6 lg:px-10 max-w-7xl mx-auto">


<div class="w-full font-['Poppins'] ">
  <div class="mx-auto  bg-[#1A374C] text-white p-5 rounded-b-[40px] shadow-lg">
     <div class="flex items-center gap-6 md:gap-4">
      <div class="w-24 h-24 md:w-20 md:h-20 bg-white text-black rounded-full flex items-center justify-center shrink-0 border-2 border-blue-400 overflow-hidden text-xs font-bold uppercase">
        Profile
      </div>
      <div class="flex-1 min-w-0">
        <h2 class="text-lg md:text-xl font-bold  leading-tight uppercase">
          {{ Auth::user()->siswa->nama_siswa ?? 'Nama siswa'}}
        </h2>
        <p class="text-md md:text-sm font-medium  text-blue-200 mt-1">
          {{ Auth::user()->siswa->kelas->nama_kelas ?? 'Kelas tidak ada'}}
        </p>
        <p class="text-xs md:text-xs text-gray-300 mt-1 tracking-widest ">
          {{ Auth::user()->username }}
        </p>
      </div>
     </div>
  </div>
</div>

{{-- mood tracker --}}
<h3 class="text-blue-950 font-bold mb-4 text-center text-lg my-4">How are you feeling today? don't be afraid to tell me</h3>
<section class="bg-white border-2 border-blue-950 rounded-full backdrop-blur-md shadow-xl max-w-md mx-auto font-['Poppins'] py-3.5">

  <div class="flex justify-between items-center mx-7 p-2"> <div class="group relative flex flex-col items-center">
      <button onclick="selectMood(event, 'sad', 'Sad? we are here to hear you. wanna talk?')"
        class="cursor-pointer mood-btn text-2xl hover:scale-125  transition-all duration-300 filter grayscale hover:grayscale-0 focus:outline-none">
        <svg class="pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
          <g fill="#4facfe"> <path d="M9.704 7.54a2 2 0 0 1-.318.712c-.184.263-.42.461-.72.541c-.298.08-.602.027-.893-.108a2 2 0 0 1-.631-.459l-1.131.986c.229.262.625.598 1.13.833c.51.237 1.183.393 1.914.197c.732-.196 1.236-.667 1.56-1.128c.319-.455.494-.944.561-1.286zm4.593 0c.03.154.13.444.318.712c.184.263.42.461.72.541c.298.08.602.027.893-.108c.298-.139.528-.34.631-.459l1.131.986a3.5 3.5 0 0 1-1.13.833c-.51.237-1.182.393-1.914.197c-.731-.196-1.236-.667-1.56-1.128a3.5 3.5 0 0 1-.56-1.286z" />
            <path fill-rule="evenodd" d="M8.641 12.641A4.75 4.75 0 0 1 16.75 16v.75h-9.5V16c0-1.26.5-2.468 1.391-3.359M12 12.75a3.25 3.25 0 0 0-3.162 2.5h6.324A3.25 3.25 0 0 0 12 12.75" clip-rule="evenodd" />
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2M4 12a8 8 0 1 1 16 0a8 8 0 0 1-16 0" clip-rule="evenodd" />
          </g>
        </svg>
      </button>
      <span class="absolute top-10 z-10 whitespace-nowrap text-blue-700 text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">So sad</span>
    </div>

    <div class="group relative flex flex-col items-center">
      <button onclick="selectMood(event, 'happy', 'Glad to hear that! hope you always like that yay!')"
        class="cursor-pointer mood-btn text-2xl hover:scale-125 transition-all duration-300 filter grayscale hover:grayscale-0 focus:outline-none">
        <svg class="pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
          <g fill="#ffe388">
            <path d="M7.212 10.737c.089-.267.283-.682.553-1.014c.28-.344.533-.473.735-.473s.455.13.735.473c.27.332.464.747.553 1.014l1.423-.474a5 5 0 0 0-.812-1.486C10 8.287 9.364 7.75 8.5 7.75S7 8.288 6.601 8.777a5 5 0 0 0-.813 1.486zm7 0c.089-.267.283-.682.553-1.014c.28-.344.533-.473.735-.473s.455.13.735.473c.27.332.464.747.553 1.014l1.424-.474a5 5 0 0 0-.814-1.486c-.397-.49-1.034-1.027-1.898-1.027s-1.5.538-1.899 1.027a5 5 0 0 0-.812 1.486z" />
            <path fill-rule="evenodd" d="M17.25 12.75H6.75v.75a5.249 5.249 0 1 0 10.5 0zm-8.716 2.18q-.135-.33-.208-.68h7.348a3.8 3.8 0 0 1-.357 1H8.683a4 4 0 0 1-.15-.32" clip-rule="evenodd" />
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2M4 12a8 8 0 1 1 16 0a8 8 0 0 1-16 0" clip-rule="evenodd" />
          </g>
        </svg>
      </button>
      <span class="absolute top-10 z-10 whitespace-nowrap  text-yellow-300 text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Happy</span>
    </div>

    <div class="group relative flex flex-col items-center">
      <button onclick="selectMood(event, 'flat', 'Okay? Are you sure?')"
        class="cursor-pointer mood-btn text-2xl hover:scale-125 transition-all duration-300 filter grayscale hover:grayscale-0 focus:outline-none">
        <svg class="pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 48 48">
          <g fill="none" stroke="#c63cc3" stroke-linejoin="round" stroke-width="5">
            <path d="M45 24c0 11.598-9.402 21-21 21S3 35.598 3 24S12.402 3 24 3s21 9.402 21 21Z" />
            <path stroke-linecap="round" d="M16 32h16M13 18h6m10 0h6" />
          </g>
        </svg>
      </button>
      <span class="absolute top-10 z-10 whitespace-nowrap text-fuchsia-800 text-sm px-2 pb-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Flat</span>
    </div>

    <div class="group relative flex flex-col items-center">
      <button onclick="selectMood(event, 'angry', 'Ohh chill, calm yourself first')"
        class="cursor-pointer mood-btn text-2xl hover:scale-125 transition-all duration-300 filter grayscale hover:grayscale-0 focus:outline-none">
        <svg class="pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
          <g fill="#ff5f5f">
            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12m10-8a8 8 0 1 0 0 16a8 8 0 0 0 0-16" clip-rule="evenodd" />
            <path fill-rule="evenodd" d="M16.21 14.473c.741.641.706 1.599.335 2.198c-.363.588-1.166 1.035-2.049.72l-1-.356a4.6 4.6 0 0 0-.895-.24a4 4 0 0 0-.601-.03a4 4 0 0 0-.6.03a4.6 4.6 0 0 0-.896.24l-1 .356c-.883.315-1.686-.132-2.049-.72c-.37-.599-.406-1.556.334-2.198c.817-.708 2.296-1.777 4.211-1.777s3.394 1.07 4.21 1.777m-6.033 1.088l-.177.061l-1 .357c-.229.081-.412-.213-.229-.372l.074-.063a7 7 0 0 1 .962-.694c.622-.368 1.364-.654 2.193-.654s1.571.286 2.193.654l.068.04a7 7 0 0 1 .968.717c.183.159 0 .453-.229.372l-1-.357l-.177-.061c-.884-.295-1.354-.295-1.823-.295c-.47 0-.94 0-1.823.295" clip-rule="evenodd" />
            <path d="M6.842 8.75c1.28 0 2.492.576 3.62 1.632l1.026-1.094C10.17 8.053 8.608 7.25 6.842 7.25zm10.316 0c-1.28 0-2.493.576-3.62 1.632l-1.026-1.094c1.318-1.235 2.88-2.038 4.646-2.038z" />
            <path d="M8.75 12.15a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m6.5 0a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3" />
          </g>
        </svg>
      </button>
      <span class="absolute top-10 z-10 whitespace-nowrap  text-red-700 text-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">Upset</span>
    </div>
  </div>

</section>
<div id="mood-status" class="hidden animate-fade-inborder mt-1 p-4 rounded-2xl text-center">
  <p id="status-text" class="text-md italic font-semibold "></p>
  <button id="action-btn" class="mt-2 text-[10px] font-bold  decoration-blue-400 hover:text-blue-300">
    Klik untuk lanjut
  </button>
</div>


{{-- kotak surat - bar point - btn mulai chat baru --}}
  <div class="my-10 mx-5 font-['Poppins']">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
    
    <div class="flex flex-col gap-2">
      <p class="text-slate-500 text-xs md:text-sm font-medium ml-1">Mail box</p>
      <button class="aspect-square flex flex-col items-center justify-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-[2rem] shadow-sm border border-blue-100 transition-all active:scale-95 group">
        <div class="p-3 bg-white rounded-2xl shadow-sm group-hover:scale-110 transition-transform">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
        </div>
        <p class="font-semibold text-sm text-center leading-tight">Pesan<br>Masuk</p>
      </button>
    </div>

    <div class="flex flex-col gap-2">
      <p class="text-slate-500 text-xs md:text-sm font-medium ml-1">Mail box</p>
      <button class="aspect-square flex flex-col items-center justify-center gap-3 p-4 bg-teal-50 hover:bg-teal-100 text-teal-600 rounded-[2rem] shadow-sm border border-teal-100 transition-all active:scale-95 group">
        <div class="p-3 bg-white rounded-2xl shadow-sm group-hover:scale-110 transition-transform">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          </svg>
        </div>
        <p class="font-semibold text-sm text-center leading-tight">Kotak<br>Saran</p>
      </button>
    </div>

    <div class="col-span-2 flex flex-col gap-4 justify-end">
      
      <div class="flex flex-col gap-2">
        <p class="text-slate-500 text-xs md:text-sm font-medium ml-1">Status Siswa</p>
        <div class="bg-orange-50 border border-orange-100 p-4 flex items-center justify-between rounded-2xl shadow-sm">
          <div class="flex items-center gap-3">
            <div class="p-2 bg-orange-200 text-orange-700 rounded-lg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
            </div>
            <p class="text-orange-800 font-medium text-sm md:text-base">Poin Pelanggaran</p>
          </div>
          <p class="font-bold text-xl text-orange-600">50</p>
        </div>
      </div>

      <form action="{{ route('siswa.chat')}}" method="GET" >
        @csrf
        <button class="w-full bg-emerald-500 hover:bg-emerald-600 text-white p-4 flex items-center justify-center gap-3 rounded-2xl shadow-lg shadow-emerald-100 transition-all hover:-translate-y-1 active:scale-95">
          <span class="font-bold tracking-wide">MULAI KONSELING</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
          </svg>
        </button>
      </form>

    </div>
  </div>
</div>

{{-- Recent chat --}}
<div class="mt-8 font-['poppins']">
  <h4 class="text-black font-bold text-sm">Recent Chat</h4>
  <div class="bg-white border-2 border-blue-950 flex p-4 items-center mx-auto rounded-2xl gap-6 shadow-sm">
    <div class="w-10 h-10 shrink-0 bg-blue-100 rounded-full items-center justify-center overflow-hidden border border-blue-200">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <g fill="#132645" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                    <path d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21" />
                </g>
            </svg> --}}
    </div>

    <div class="flex-1 min-w-0">
      <h5 class="text-lg uppercase font-bood text-[#132645] leading-tight truncate"> mr. james</h5>
      <p class="text-sm italic text-gray-500">Pesan masuk</p>
    </div>
  </div>
</div>

{{-- Self report - status laporan --}}
<div class="mx-8 mt-4 mb-6 font-poppins">
  <h4 class="text-black font-bold text-sm mb-2">Self report</h4>
  
  <div class="flex p-4 items-center mx-auto gap-6 rounded-2xl shadow-md transition-all duration-300 hover:brightness-110 active:scale-[0.98] cursor-pointer" 
       style="background: linear-gradient(135deg, #1A374C, #2C5C7F, #3D81B2);">
    <div>
      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 32 32">
        <path fill="#fff" d="M15 20h2v4h-2zm5-2h2v6h-2zm-10-4h2v10h-2z" />
        <path fill="#fff" d="M25 5h-3V4a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v1H7a2 2 0 0 0-2 2v21a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2M12 4h8v4h-8Zm13 24H7V7h3v3h12V7h3Z" />
      </svg>
    </div>
    <div class="flex-1 min-w-0">
      <h3 class="leading-tight text-white text-lg font-bold">QUICK ACTION</h3>
      <p class="leading-tight text-white text-xs font-medium">Ada kejadian apa hari ini? <br> Laporkan disini!!</p>
    </div>
    <div class="shrink-0">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 15 15">
        <path fill="#fff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414" />
      </svg>
    </div>
  </div>

 <div class="mx-auto mt-4 font-['Poppins']">
    <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-100">
        
        <div class="mb-6 text-center">
            <h3 class="text-xl font-bold text-[#1A374C] inline-block border-b-4 border-blue-400 pb-1">
                Status Laporanmu
            </h3>
        </div>
        <div class="flex flex-col space-y-2">
    
          <div class="group flex items-center justify-between p-4 border-b border-gray-100 transition-all hover:bg-gray-100 cursor-pointer rounded-xl">
              <span class="font-semibold text-gray-700">Laporan#12-april-2026</span>
              
              <div style="background-color: #dcfce7; color: #166534;" class="flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                  Selesai
              </div>
          </div>

          <div class="group flex items-center justify-between p-4 border-b border-gray-100 transition-all hover:bg-gray-100 cursor-pointer rounded-xl">
              <span class="font-semibold text-gray-700">Laporan#20-maret-2026</span>
              
              <div style="background-color: #fee2e2; color: #991b1b;" class="flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                  Ditolak
              </div>
          </div>

          <div class="group flex items-center justify-between p-4 border-b border-gray-100 transition-all hover:bg-gray-100 cursor-pointer rounded-xl">
              <span class="font-semibold text-gray-700">Laporan#12-januari-2026</span>
              
              <div style="background-color: #B8D2E0; color: #1A374D;" class="flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>
                  Diproses
              </div>
          </div>


    </div>
  </div>
</div>

</div>


{{-- card motivasi & reminder --}}
<div id="card-container" class="p-3 sm:p-4 md:p-4 gap-3 sm:gap-4 md:gap-4 mb-28 flex overflow-x-auto scroll-snap-x-mandatory scrollbar-hide 
        md:grid md:grid-cols-3 md:grid-rows-2 md:overflow-visible md:justify-items-center md:mx-auto md:max-w-5xl">
            
          <div class="card min-w-[250px] md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#541212] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
              transition-all duration-300 ease-out hover:-translate-y-3 hover:shadow-[0_20px_50px_rgba(252,165,165,0.5)] cursor-pointer" 
              style="background: linear-gradient(135deg, #fca5a5, #ffffff);">
              <div class="flex gap-3.5 items-center">
                <div class="p-2 bg-white/50 rounded-full shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#541212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"/><path d="M8 9h.01M16 9h.01M9 16a3 3 0 0 0 6 0"/>
                  </svg>
              </div>
                <h2 class="text-[#541212] text-sm md:text-base font-bold uppercase tracking-tight">Ekspresikan Perasaan</h2>
              </div>
              <p class="text-xs md:text-sm text-[#541212]/80 leading-relaxed font-medium">Jangan tahan emosi. Berbagi perasaanmu dengan orang terpercaya bisa membantu mengatasi beban.</p>
          </div>

       
          <div class="card min-w-[250px] md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#3a1254] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
              transition-all duration-300 ease-out hover:-translate-y-3 hover:shadow-[0_20px_50px_rgba(191,165,252,0.5)] cursor-pointer" 
              style="background: linear-gradient(135deg, #bfa5fc, #ffffff);">
              <div class="flex gap-3.5 items-center">
                <div class="p-2 bg-white/50 rounded-full shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#3a1254" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 3v18M3 12h18M7.5 7.5h9v9h-9z"/><circle cx="12" cy="12" r="9"/>
                  </svg>
              </div>
                <h2 class="text-[#3a1254] text-sm md:text-base font-bold uppercase tracking-tight">Manajemen Stres</h2>
              </div>
              <p class="text-xs md:text-sm text-[#3a1254]/80 leading-relaxed font-medium">Coba teknik pernapasan atau meditasi untuk menenangkan pikiran saat merasa overwhelmed.</p>
          </div>

       
          <div class="card min-w-[250px] md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#125254] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
              transition-all duration-300 ease-out hover:-translate-y-3 hover:shadow-[0_20px_50px_rgba(165,222,252,0.5)] cursor-pointer" 
              style="background: linear-gradient(135deg, #a5defc, #ffffff);">
              <div class="flex gap-3.5 items-center">
                <div class="p-2 bg-white/50 rounded-full shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#125254" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                  </svg>
              </div>
                <h2 class="text-[#125254] text-sm md:text-base font-bold uppercase tracking-tight">Tidur Berkualitas</h2>
              </div>
              <p class="text-xs md:text-sm text-[#125254]/80 leading-relaxed font-medium">Istirahat yang cukup sangat penting. Atur jadwal tidur teratur untuk kesehatan mentalmu.</p>
          </div>

      
          <div class="card min-w-[250px] md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#125416] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
              transition-all duration-300 ease-out hover:-translate-y-3 hover:shadow-[0_20px_50px_rgba(147,255,154,0.5)] cursor-pointer" 
              style="background: linear-gradient(135deg, #93ff9a, #ffffff);">
              <div class="flex gap-3.5 items-center">
                <div class="p-2 bg-white/50 rounded-full shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#125416" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M14 4l-8 8m0-8l8 8M12 2v20M2 12h20"/>
                  </svg>
              </div>
                <h2 class="text-[#125416] text-sm md:text-base font-bold uppercase tracking-tight">Aktivitas Positif</h2>
              </div>
              <p class="text-xs md:text-sm text-[#125416]/80 leading-relaxed font-medium">Lakukan hobi yang kamu sukai. Olahraga atau kegiatan kreatif bisa meningkatkan mood.</p>
          </div>

   
          <div class="card min-w-[250px] md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#4d1254] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
              transition-all duration-300 ease-out hover:-translate-y-3 hover:shadow-[0_20px_50px_rgba(248,165,252,0.5)] cursor-pointer" 
              style="background: linear-gradient(135deg, #f8a5fc, #ffffff);">
              <div class="flex gap-3.5 items-center">
                <div class="p-2 bg-white/50 rounded-full shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#4d1254" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87m-4-12a4 4 0 0 1 0 7.75"/>
                  </svg>
              </div>
                <h2 class="text-[#4d1254] text-sm md:text-base font-bold uppercase tracking-tight">Hubungan Sehat</h2>
              </div>
              <p class="text-xs md:text-sm text-[#4d1254]/80 leading-relaxed font-medium">Jalin komunikasi baik dengan keluarga dan teman. Dukungan sosial sangat berarti.</p>
          </div>


          <div class="card min-w-[250px] md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#544712] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
              transition-all duration-300 ease-out hover:-translate-y-3 hover:shadow-[0_20px_50px_rgba(253,240,127,0.5)] cursor-pointer" 
              style="background: linear-gradient(135deg, #fdf07f, #ffffff);">
              <div class="flex gap-3.5 items-center">
                <div class="p-2 bg-white/50 rounded-full shadow-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#544712" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 2L15.09 8.26H22L17.55 12.5L19.64 18.76L12 14.51L4.36 18.76L6.45 12.5L2 8.26H8.91L12 2Z"/>
                  </svg>
              </div>
                <h2 class="text-[#544712] text-sm md:text-base font-bold uppercase tracking-tight">Pola Hidup Sehat</h2>
              </div>
              <p class="text-xs md:text-sm text-[#544712]/80 leading-relaxed font-medium">Makan bergizi dan minum air cukup. Kesehatan fisik mempengaruhi kesehatan mental.</p>
          </div>

</div>





</div>

<style>
  @keyframes custom-bounce {
    0%, 100% {transform: scale(1); }
    50% {transform: scale(1.4); }
  }

  .animate-click { 
    animation: custom-bounce 0.4s ease-in-out;
  }

  @keyframes fade-in {
    from {opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translate(0); }
  }

  .animate-fade-in {
    animation: fade-in 0.4s ease-in-out forwards;
  }
</style>

{{-- script --}}
<script>
  function selectMood(event, type, message) {
   
    const btn = event.currentTarget;
    const statusDiv = document.getElementById('mood-status');
    const statusText = document.getElementById('status-text');
    const allBtns = document.querySelectorAll('.mood-btn');

    const moodConfig = {
      'sad': {bg: 'bg-blue-500/20', border:'border-blue-400', text: 'text-blue-300' },
      'happy': {bg: 'bg-yellow-500/20', border: 'border-yellow-400', text: 'text-yellow-300'},
      'flat': {bg: 'bg-purple-500/20', border: 'border-purple-400', text: 'text-purple-300'},
      'angry': {bg: 'bg-red-500/20', border:'border-red-400', text:'text-red-300'}
    };
  
    btn.classList.add('animate-click');
   
    
   
    setTimeout(() => {
        btn.classList.remove('animate-click');
    }, 400);

    allBtns.forEach(b => b.classList.add('grayscale'));
    btn.classList.remove('grayscale');

    statusText.innerText = message;
    statusDiv.classList.remove('hidden');

    const config = moodConfig[type];
    if (config) {
      statusDiv.classList.add(config.bg, config.border);
      statusText.className = 'text-md italic font-semibold ${config.text}';
    }

    statusDiv.classList.remove('hidden');
    
    
    statusDiv.classList.remove('animate-fade-in');
    void statusDiv.offsetWidth; 
    statusDiv.classList.add('animate-fade-in');
  }

  // loop card
  const container = document.getElementById('card-container');
  if(window.innerWidth < 768) {
    const cards = Array.from(container.children);

    cards.forEach(card => {
      const clone = card.cloneNode(true);
      container.appendChild(clone);
    });

    container.addEventListener('scroll', () => {
      const maxScroll = container.scrollWidth - container.clientWidht;
      const currentScroll = container.scrollLeft;

      if (currentScroll >= maxScroll - 1){
        container.scrollTo({ left: 1});
      } else if (currentScroll <= 0) {
        container.scrollTo({ left: maxScroll - 1});
      }
    });
  }
</script>
@endsection

