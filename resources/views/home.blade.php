
@extends('app')

@section('content')
{{-- Header profile --}}
<div class="w-full relative ">
  <div class="mx-auto max-w-2xl bg-[#1A374C] text-white p-5 rounded-b-[40px] shadow-lg">
     <div class="flex items-center gap-6 md:gap-4">
      <div class="w-24 h-24 md:w-20 md:h-20 bg-white text-black rounded-full flex items-center justify-center shrink-0 border-2 border-blue-400 overflow-hidden text-xs font-bold uppercase">
        Profile
      </div>
      <div class="flex-1 min-w-0">
        <h2 class="text-lg md:text-sm font-bold font-serif leading-tight uppercase">
          YULISTIN SITI FADILAH FATHAN
        </h2>
        <p class="text-md md:text-sm font-medium font-serif text-blue-200 mt-1">
          12 RPL 1
        </p>
        <p class="text-xs md:text-xs font-mono text-gray-300 mt-1 tracking-widest ">
          123456/7891011
        </p>
      </div>
     </div>
  </div>
</div>

{{-- kotak surat - bar point - btn mulai chat baru --}}
<div class="my-8 mx-8 grid grid-cols-2 gap-5">
  <button class="bg-red-500 hover:bg-red-600 cursor-pointer text-white active:scale-95 transition-all duration-300 p-4 rounded-2xl flex flex-col items-center justify-center gap-2 shadow-lg shadow-red-200">
    <div class="shrink-0">

      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" class="fill-current items-center">
        <path  d="m20 8l-8 5l-8-5V6l8 5l8-5m0-2H4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2" />
      </svg>
    </div>
    <p class="text-md font-semibold text-center leading-tight uppercase px-2">See your <br> mail here</p>
  </button>

    <div class="grid grid-rows-2 gap-2 mx-auto">
      <button class="bg-blue-400 text-white p-2 flex gap-2 rounded-3xl items-center shadow-md shadow-blue-200 ">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 512 512">
	        <path fill="#fff" fill-rule="evenodd" d="m234.666 43.72l.001 233.613l233.613.002C457.576 385.138 366.62 469.333 256 469.333c-117.82 0-213.333-95.512-213.333-213.333c0-110.62 84.195-201.576 191.999-212.28m42.668 0c100.787 10.007 180.94 90.159 190.946 190.946H277.334z" />
        </svg>
        <p class="font-bold">50</p>
      </button>

       <button class="bg-blue-400 text-white p-2 py-3 flex gap-2 rounded-xl items-center shadow-md shadow-blue-200">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 512 512">
	        <path fill="#fff" fill-rule="evenodd" d="m234.666 43.72l.001 233.613l233.613.002C457.576 385.138 366.62 469.333 256 469.333c-117.82 0-213.333-95.512-213.333-213.333c0-110.62 84.195-201.576 191.999-212.28m42.668 0c100.787 10.007 180.94 90.159 190.946 190.946H277.334z" />
        </svg>
        <p class="font-bold text-xs">mulai konseling </p>
      </button>
    </div>
</div>

{{-- Recent chat --}}
<div class="mx-8 ">
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
<div class="mx-8 mt-4 mb-6">
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

 <div class="mx-auto max-w-2xl mt-4">
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

{{-- card motifasi --}}
<div class="p-4 gap-4 
            /* Mobile*/
            flex overflow-x-auto scroll-snap-x-mandatory scrollbar-hide 
            /* Desktop*/
            md:grid md:grid-cols-3 md:grid-rows-2 md:overflow-visible md:justify-items-center md:mx-auto md:max-w-5xl">
  <div class="min-w[250px] md:min-w[200px] h-40 bg-blue-300 text-white rounded-lg flex items-center justify-center font-bold scroll-snap-align-start
              transition-transform duration-300 ease-out hover:-translate-y-3 hover:shadow-xl cursor-pointer">
    CARD 1
  </div>
  <div class="min-w[250px] md:min-w[200px] h-40 bg-red-300 text-white rounded-lg flex items-center justify-center font-bold scroll-snap-align-start
              transition-transform duration-300 ease-out hover:-translate-y-3 hover:shadow-xl cursor-pointer">
    CARD 2
  </div>
  <div class="min-w[250px] md:min-w[200px] h-40 bg-green-300 text-white rounded-lg flex items-center justify-center font-bold scroll-snap-align-start
              transition-transform duration-300 ease-out hover:-translate-y-3 hover:shadow-xl cursor-pointer">
    CARD 3
  </div>
  <div class="min-w[250px] md:min-w[200px] h-40 bg-yellow-300 text-white rounded-lg flex items-center justify-center font-bold scroll-snap-align-start
              transition-transform duration-300 ease-out hover:-translate-y-3 hover:shadow-xl cursor-pointer">
    CARD 4
  </div>
  <div class="min-w[250px] md:min-w[200px] h-40 bg-violet-300 text-white rounded-lg flex items-center justify-center font-bold scroll-snap-align-start
              transition-transform duration-300 ease-out hover:-translate-y-3 hover:shadow-xl cursor-pointer">
    CARD 5
  </div>
  <div class="min-w[250px] md:min-w[200px] h-40 bg-cyan-300 text-white rounded-lg flex items-center justify-center font-bold scroll-snap-align-start
              transition-transform duration-300 ease-out hover:-translate-y-3 hover:shadow-xl cursor-pointer">
    CARD 6
  </div>
</div>

@endsection