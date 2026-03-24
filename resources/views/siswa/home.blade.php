
@extends('partials.app')

@section('content')
{{-- Header profile --}}
<div class="lg:ml-28 px-4 sm:px-6 lg:px-10 max-w-7xl mx-auto">


<div class="max-w-7xl mx-auto px-6 lg:px-10 mt-6 font-['Poppins'] ">
  <div class="mx-auto  bg-[#1A374C] text-white p-5 rounded-b-[40px] shadow-lg">
     <div class="flex items-center gap-4 md:gap-4">
      <div class="w-24 h-24 md:w-20 md:h-20 text-black rounded-full flex items-center justify-center shrink-0 border-2 border-blue-400 overflow-hidden text-xs font-bold uppercase">
        <img src="{{ Auth::user()->siswa->foto ? asset('storage/profile_siswa/' . Auth::user()->siswa->foto) : asset('img/guruProfile.jpg')}}" alt="Profile" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
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

@php
    $authSiswa = auth()->user() ? \App\Models\Siswa::where('id_pengguna', auth()->user()->id_pengguna)->first() : null;
    
    $suratBaru = null;
    if ($authSiswa) {
        $suratBaru = \App\Models\KotakSurats::where('id_siswa', $authSiswa->id_siswa)
                                          ->where('is_read', false)
                                          ->first();
    }
    
@endphp

@if ($suratBaru)
<div class="alert alert-danger border shadow-lg d-flex align-items-center fade show" role="alert" style="border-radius: 15px;">
  <div class="p-2 bg-white rounded-circle me-3">
    <i class="bi bi-exclamation-octagon-fill text-danger fs-4"></i>
  </div>
  <div>
    <h6 class="fw-bold mb-0 text-dark">⚠️Peringatan Penting!!🚨</h6>
    <small class="text-dark">Kamu memiliki surat peringatan baru yang belum dibaca.</small>
  </div>
  <a href="{{ route('siswa.kotaksurat.index') }}" class="btn btn-danger btn-sm rounded-pill ms-auto px-4">
    Buka sekarang
  </a>
</div>
  
@endif

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

@php
    $authSiswa = $siswa ?? (\App\Models\Siswa::where('id_pengguna', auth()->user()->id_pengguna)->first());
    
    // Pastikan $totalPoin terdefinisi (Hitung dari relasi jika null)
    if (!isset($totalPoin)) {
        $totalPoin = $authSiswa ? \DB::table('riwayat_pelanggarans')->where('id_siswa', $authSiswa->id_siswa)->sum('poin') : 0;
    }

    // Pastikan $status terdefinisi
    if (!isset($status)) {
        if ($totalPoin <= 20) {
            $status = ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'label' => 'Aman'];
        } elseif ($totalPoin <= 50) {
            $status = ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'label' => 'Waspada'];
        } else {
            $status = ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'label' => 'Bahaya'];
        }
    }

    // Pastikan variabel lain tidak bikin crash
    $unreadMessages = $unreadMessages ?? 0;
    $jadwalTerdekat = $jadwalTerdekat ?? null;
@endphp
{{-- Container Utama --}}
<div class="my-6 mx-4 sm:my-8 sm:mx-6 lg:my-8 lg:mx-4 font-['Poppins']">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        {{-- SISI KIRI: Notif & Jadwal (Mobile: Order 2) --}}
        <div class="md:col-span-4 flex flex-col gap-5 order-2 md:order-1">
            <div class="flex items-center justify-between px-1">
                <p class="text-slate-500 text-xs md:text-sm font-semibold uppercase tracking-wider">Akses Cepat</p>
                <a href="{{ route('siswa.kotaksurat.index') }}" class="relative p-3 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-900">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    @if ($unreadMessages > 0)
                        <span class="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full border-2 border-white animate-bounce">
                            {{ $unreadMessages }}
                        </span>
                    @endif
                </a>
            </div>

            <div class="bg-white p-5 rounded-[2.5rem] shadow-sm border border-gray-50 group hover:border-blue-100 transition-all">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-4 bg-blue-500 rounded-full"></div>
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-tight">Jadwal Terdekat</h3>
                </div>
                
                @if ($jadwalTerdekat)
                    <div class="bg-linear-to-br from-blue-50 to-indigo-50 p-4 rounded-[1.8rem] border border-blue-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white p-2 rounded-xl shadow-sm">
                                <i class="fas fa-calendar-alt text-blue-500 text-xs"></i>
                            </div>
                            <p class="text-xs font-bold text-blue-900 uppercase">
                                {{ \Carbon\Carbon::parse($jadwalTerdekat->scheduled_date)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-1 ml-1">
                            <span class="text-[10px] text-blue-600 font-bold uppercase tracking-wide italic">
                                <i class="far fa-clock mr-1"></i> {{ $jadwalTerdekat->scheduled_time }}
                            </span>
                            <span class="text-[10px] text-blue-500 font-medium truncate italic">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $jadwalTerdekat->location_link }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="py-6 flex flex-col items-center opacity-40">
                        <i class="fas fa-calendar-day text-2xl mb-2 text-slate-300"></i>
                        <p class="text-[10px] font-medium uppercase tracking-widest text-slate-400">Belum ada jadwal</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- TENGAH: Layanan (Mobile: Grid 2 Kolom) --}}
        <div class="md:col-span-3 flex flex-col gap-4 order-3 md:order-2">
            <p class="text-slate-500 text-xs md:text-sm font-semibold px-1 uppercase tracking-wider">Layanan</p>
            <div class="grid grid-cols-2 md:grid-cols-1 gap-4">
                <a href="{{ route('siswa.konseling.create') }}" class="flex flex-col items-center justify-center gap-2 p-5 bg-blue-50/50 hover:bg-blue-50 rounded-[2.5rem] border-2 border-dashed border-blue-100 transition-all active:scale-95 group">
                    <div class="p-3 bg-white rounded-2xl shadow-sm text-blue-500 group-hover:rotate-12 transition-transform">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="16" y1="11" x2="22" y2="11"/></svg>
                    </div>
                    <p class="font-bold text-[10px] text-blue-900 uppercase tracking-tighter">Ajukan Jadwal</p>
                </a>

                <a href="{{ route('siswa.kirim-saran')}}" class="flex flex-col items-center justify-center gap-2 p-5 bg-emerald-50/50 hover:bg-emerald-50 rounded-[2.5rem] border-2 border-dashed border-emerald-100 transition-all active:scale-95 group text-emerald-600">
                    <div class="p-3 bg-white rounded-2xl shadow-sm group-hover:-rotate-12 transition-transform">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <p class="font-bold text-[10px] text-emerald-900 uppercase tracking-tighter">Kotak Saran</p>
                </a>
            </div>
        </div>

        {{-- KANAN: Poin & Button Utama (Mobile: Order 1) --}}
        <div class="md:col-span-5 flex flex-col gap-6 order-1 md:order-3">
            <div class="bg-white p-6 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-gray-50 flex flex-col gap-4 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full opacity-50"></div>
                
                <div class="flex justify-between items-center relative z-10">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Kesehatan Poin</p>
                    <span class="px-3 py-1 {{ $status['bg'] }} {{ $status['text'] }} rounded-full text-[10px] font-black uppercase italic tracking-widest">
                        {{ $status['label'] }}
                    </span>
                </div>

               <div class="flex items-center gap-6 relative z-10">
                  {{-- Menampilkan angka total poin --}}
                  <div class="text-2xl font-black {{ $status['text'] }} tracking-tighter italic">
                      {{ $totalPoin }}
                  </div>
                  
                  <div class="flex-1">
                      <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden border border-slate-50 shadow-inner">
                          {{-- Progress bar menggunakan $totalPoin --}}
                          <div class="{{ $totalPoin > 50 ? 'bg-rose-500' : ($totalPoin > 20 ? 'bg-amber-400' : 'bg-emerald-500') }} h-full transition-all duration-1000" 
                              style="width: {{ min($totalPoin, 100) }}%">
                          </div>
                      </div>
                      <p class="text-[9px] text-slate-400 mt-2 font-bold uppercase tracking-tight">Akumulasi Poin Pelanggaran / 100</p>
                  </div>
              </div>

                <form action="{{route('siswa.chat', $lastChat->konseling_id)}}" method="GET" class="mt-2">
                    <button class="group w-full bg-slate-900 hover:bg-black text-white py-5 flex items-center justify-center gap-3 rounded-4xl shadow-2xl transition-all hover:-translate-y-1 active:scale-95">
                        <span class="font-black tracking-[0.2em] text-xs uppercase">Hubungi mentor</span>
                        <div class="bg-white/10 p-1 rounded-full group-hover:bg-emerald-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </div>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

{{-- Message Preview --}}
<div class="mx-5 mt-8 font-['Poppins']">
    
    <label class="text-sm font-bold p-2">Chat</label>
    @if($lastChat)
    <a href="{{ route('siswa.chat', $lastChat->konseling_id) }}" class="flex items-center gap-4 bg-white p-4 rounded-3xl shadow-sm border border-gray-100 hover:bg-gray-50 transition-all active:scale-[0.98]">
        <div class="relative">
            <img src="{{ asset('img/guruProfile.jpg') }}" alt="Guru BK" class="w-12 h-12 rounded-full object-cover shadow-sm border border-gray-100">
            @if($lastChat->sender_type == 'guru' && !$lastChat->is_read)
                <span class="absolute top-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
            @endif
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex justify-between items-center">
                <p class="text-[10px] md:text-md font-bold text-[#1A374C]  truncate">Mr. James Chao, S.Pd</p>
                <p class="text-[8px] text-gray-400">{{ $lastChat->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex items-center gap-1 mt-0.5">
                @if($lastChat->sender_type == 'siswa')
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M20 6 9 17l-5-5"/></svg>
                @endif
                <p class="text-[11px] {{ !$lastChat->is_read && $lastChat->sender_type == 'guru' ? 'font-bold text-slate-800' : 'text-slate-500' }} truncate">
                    {{ $lastChat->message }}
                </p>
            </div>
        </div>
    </a>
    @else
    <div class="bg-gray-50 border-2 border-dashed border-gray-200 p-6 rounded-3xl text-center">
        <p class="text-gray-400 text-xs italic">Belum ada percakapan dengan Guru BK.</p>
    </div>
    @endif
</div>

{{-- Self report - status laporan --}}
<div class="mx-8 mt-4 mb-6 font-poppins">
  <h4 class="text-black font-bold text-sm mb-2">Self report</h4>
  
  <div class="flex p-4 items-center mx-auto gap-6 rounded-2xl shadow-md transition-all duration-300 hover:brightness-110 active:scale-[0.98] cursor-pointer" 
       style="background: linear-gradient(135deg, #1A374C, #2C5C7F, #3D81B2);">
    <div>
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 32 32">
        <path fill="#fff" d="M15 20h2v4h-2zm5-2h2v6h-2zm-10-4h2v10h-2z" />
        <path fill="#fff" d="M25 5h-3V4a2 2 0 0 0-2-2h-8a2 2 0 0 0-2 2v1H7a2 2 0 0 0-2 2v21a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2M12 4h8v4h-8Zm13 24H7V7h3v3h12V7h3Z" />
      </svg>
    </div>
    <div class="flex-1 min-w-0">
      <h3 class="leading-tight text-white text-base sm:text-lg md:text-lg font-bold">QUICK ACTION</h3>
      <p class="leading-tight text-white text-xs sm:text-sm md:text-xs font-medium">Ada kejadian apa hari ini? <br> Laporkan disini!!</p>
    </div>
    <a href="{{ route('siswa.selfreport') }}" class="shrink-0">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 15 15">
          <path fill="#fff" d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414" />
      </svg>
    </a>
  </div>

 <div class="mx-auto mt-4 font-['Poppins']">
    <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-100">
        
        <div class="mb-6 text-center">
            <h3 class="text-xl font-bold text-[#1A374C] inline-block border-b-4 border-blue-400 pb-1">
                Status Laporanmu
            </h3>
        </div>

        <div class="mt-6 bg-blue-50 p-6 rounded-3xl border-2 border-dashed border-blue-200">
            <h4 class="text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                <span>🔍</span> Lacak Laporan Manual
            </h4>
            <form action="{{ route('siswa.selfreport.check') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="id_report" placeholder="Masukkan ID (Contoh: SR-A1B2)" 
                      class="flex-1 p-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-blue-400 text-sm uppercase font-mono">
                <button type="submit" class="bg-blue-900 text-white px-5 rounded-xl text-sm font-bold hover:bg-blue-800 transition-all">
                    Cek
                </button>
            </form>
            <p class="text-[10px] text-blue-600 mt-2 italic">*Gunakan ID yang kamu dapatkan saat mengirim laporan.</p>
          </div>
        <div class="flex flex-col space-y-2">

          @forelse ($reports as $report)
          <div class="group flex items-center justify-between p-4 border-b border-gray-100 transition-all hover:bg-gray-100 rounded-xl">
            <div class="flex flex-col">
                <span class="font-semibold text-gray-700">Laporan #{{ $report->id_report }}</span>
                <span class="text-[10px] text-gray-400">Kategori: {{ ucfirst($report->kategori_masalah) }}</span>
            </div>
            

            @if($report->status_verifikasi == 'disetujui')
                <div class="bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>Selesai
                </div>
            @elseif($report->status_verifikasi == 'ditolak')
                <div class="bg-red-100 text-red-800 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>Ditolak
                </div>
            @else
                <div class="bg-blue-100 text-blue-900 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>
                  Diproses
                </div>
            @endif
        </div>
         @empty
        <div class="text-center py-6">
            <p class="text-sm text-gray-400 italic">Belum ada laporan aktif dari perangkat ini.</p>
            <p class="text-[10px] text-gray-400 mt-1">*Laporan anonim hanya muncul sementara di dashboard ini.</p>
        </div>
        @endforelse
    </div>
  </div>
</div>

</div>


{{-- card motivasi & reminder --}}
<div id="card-container" class="p-3 sm:p-4 md:p-4 lg:p-5 gap-3 sm:gap-4 md:gap-4 lg:gap-5 mb-28 flex overflow-x-auto scroll-snap-x-mandatory scrollbar-hide 
        md:grid md:grid-cols-3 md:grid-rows-2 md:overflow-visible md:justify-items-center md:mx-auto md:max-w-5xl lg:max-w-6xl xl:max-w-7xl">
            
          <div class="card min-w-64 md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#541212] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
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

       
          <div class="card min-w-64 md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#3a1254] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
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

       
          <div class="card min-w-64 md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#125254] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
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

      
          <div class="card min-w-64 md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#125416] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
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

   
          <div class="card min-w-64 md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#4d1254] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
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


          <div class="card min-w-64 md:min-w-0 h-auto p-5 rounded-2xl border-2 border-[#544712] flex flex-col gap-3 items-center text-center font-bold scroll-snap-align-start
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

