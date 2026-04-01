
@extends('partials.app')

@section('content')
{{-- Header profile --}}
<div class="lg:ml-28 px-4 sm:px-6 lg:px-10 max-w-7xl mx-auto">


<div class="max-w-7xl mx-auto px-6 lg:px-10 font-['Poppins'] ">
  <div class="mx-auto  bg-[#1A374C] text-white p-5 rounded-b-[40px] shadow-lg">
     <div class="flex items-center gap-4 md:gap-4">
      <div class="w-24 h-24 md:w-20 md:h-20 text-black rounded-full flex items-center justify-center shrink-0 border-2 border-blue-400 overflow-hidden text-xs font-bold uppercase">
        <img src="{{ Auth::user()->siswa->foto ? asset('storage/profile_siswa/' . Auth::user()->siswa->foto) : asset('img/profile_default.jpg') }}" alt="Profile" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
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

@if ( $newMail )
<div class="max-w-5xl mx-auto mt-4 lg:px-10 px-6">
    <div class="relative overflow-hidden bg-white border-l-8 border-yellow-500 rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.05)] p-5 mb-6 animate-pulse-slow">

        <div class="relative flex flex-col md:flex-row items-center gap-5">
            <div class="flex items-center justify-center gap-3">
                <div class="shrink-0 w-12 h-12 bg-yellow-100 rounded-md flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h6 class="text-lg font-black text-yellow-500 flex items-center justify-center md:justify-start gap-2">
                    Peringatan Penting🚨
                </h6>
            </div>
            <p class="text-gray-600 text-sm">
              Kamu memiliki surat atau jadwal penting yang belum dibaca!
            </p>
            <div class="w-full md:w-auto">
                <a href="{{ route('siswa.kotaksurat.index') }}"
                   class="w-full md:w-auto bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-full shadow-lg transition-all active:scale-95">
                    Lihat Surat 
                </a>
            </div>
        </div>
    </div>
</div>
    
@endif

{{-- mood tracker --}}
<div class="max-w-md mx-auto p-6 font-['Poppins']">
    <h3 class="text-slate-800 font-extrabold mb-6 text-center text-xl tracking-tight">
        How are you feeling today? 
        <span class="block text-sm font-medium text-slate-400 mt-1">Don't be afraid to tell me</span>
    </h3>

    <section class="relative bg-white/70 backdrop-blur-xl border border-white/40 shadow-[0_8px_32px_0_rgba(31,38,135,0.07)] rounded-[2.5rem] py-6 px-2">
        <div class="flex justify-around items-center">
            
            <div class="group relative flex flex-col items-center">
                <button onclick="selectMood(event, 'sad', 'Sad? We are here to hear you. Wanna talk?')"
                    class="mood-btn relative p-3 rounded-2xl transition-all duration-500 hover:bg-blue-50 hover:scale-110 active:scale-95 grayscale hover:grayscale-0">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#3b82f6" stroke-width="1.5"/>
                        <path d="M8 14s1.5-2 4-2 4 2 4 2" stroke="#3b82f6" stroke-width="1.5" stroke-linecap="round"/>
                        <circle cx="9" cy="9" r="1" fill="#3b82f6"/>
                        <circle cx="15" cy="9" r="1" fill="#3b82f6"/>
                    </svg>
                </button>
                <span class="text-[10px] font-bold text-blue-400 opacity-0 group-hover:opacity-100 uppercase tracking-widest mt-2 transition-opacity">Sad</span>
            </div>

            <div class="group relative flex flex-col items-center">
                <button onclick="selectMood(event, 'happy', 'Glad to hear that! Hope your day stays awesome!')"
                    class="mood-btn relative p-3 rounded-2xl transition-all duration-500 hover:bg-yellow-50 hover:scale-110 active:scale-95 grayscale hover:grayscale-0">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#f59e0b" stroke-width="1.5"/>
                        <path d="M8 13s1.5 3 4 3 4-3 4-3" stroke="#f59e0b" stroke-width="1.5" stroke-linecap="round"/>
                        <circle cx="9" cy="9" r="1" fill="#f59e0b"/>
                        <circle cx="15" cy="9" r="1" fill="#f59e0b"/>
                    </svg>
                </button>
                <span class="text-[10px] font-bold text-yellow-500 opacity-0 group-hover:opacity-100 uppercase tracking-widest mt-2 transition-opacity">Happy</span>
            </div>

            <div class="group relative flex flex-col items-center">
                <button onclick="selectMood(event, 'flat', 'Feeling neutral? Sometimes silence is good.')"
                    class="mood-btn relative p-3 rounded-2xl transition-all duration-500 hover:bg-purple-50 hover:scale-110 active:scale-95 grayscale hover:grayscale-0">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#a855f7" stroke-width="1.5"/>
                        <line x1="8" y1="14" x2="16" y2="14" stroke="#a855f7" stroke-width="1.5" stroke-linecap="round"/>
                        <circle cx="9" cy="9" r="1" fill="#a855f7"/>
                        <circle cx="15" cy="9" r="1" fill="#a855f7"/>
                    </svg>
                </button>
                <span class="text-[10px] font-bold text-purple-500 opacity-0 group-hover:opacity-100 uppercase tracking-widest mt-2 transition-opacity">Flat</span>
            </div>

            <div class="group relative flex flex-col items-center">
                <button onclick="selectMood(event, 'angry', 'Deep breaths... Everything will be okay.')"
                    class="mood-btn relative p-3 rounded-2xl transition-all duration-500 hover:bg-red-50 hover:scale-110 active:scale-95 grayscale hover:grayscale-0">
                    <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#ef4444" stroke-width="1.5"/>
                        <path d="M8 16s1.5-1.5 4-1.5 4 1.5 4 1.5" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 10L7 8" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M15 10L17 8" stroke="#ef4444" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
                <span class="text-[10px] font-bold text-red-500 opacity-0 group-hover:opacity-100 uppercase tracking-widest mt-2 transition-opacity">Upset</span>
            </div>
        </div>
    </section>

    <div id="mood-status" class="hidden mt-6 overflow-hidden rounded-4xl border transition-all duration-500 ease-out transform scale-95 opacity-0">
        <div class="p-5 text-center flex flex-col items-center gap-3">
            <p id="status-text" class="text-sm font-semibold tracking-tight"></p>
        </div>
    </div>
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
    $scheduled = $scheduled ?? null;
@endphp
{{-- Container Utama --}}
<div class="my-6 mx-4 sm:my-8 sm:mx-6 lg:my-8 lg:mx-4 font-['Poppins']">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        {{-- SISI KIRI: Notif & Jadwal (Mobile: Order 2) --}}
        <div class="md:col-span-4 flex flex-col gap-5 order-2 md:order-1">
            <div class="flex items-center justify-between px-1">
                <p class="text-slate-500 text-xs md:text-sm font-semibold uppercase tracking-wider">Akses Cepat</p>
                <a href="{{ route('siswa.kotaksurat.index') }}" class="relative p-3 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all active:scale-90 cursor-pointer">
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
                
                @if ( $scheduled )
                    <div class="bg-linear-to-br from-blue-50 to-indigo-50 p-4 rounded-[1.8rem] border border-blue-100">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="bg-white p-2 rounded-xl shadow-sm">
                                <i class="fas fa-calendar-alt text-blue-500 text-xs"></i>
                            </div>
                            <p class="text-xs font-bold text-blue-900 uppercase">
                                {{ \Carbon\Carbon::parse($scheduled->scheduled_date)->format('d M Y') }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-1 ml-1">
                            <span class="text-[10px] text-blue-600 font-bold uppercase tracking-wide italic">
                                <i class="far fa-clock mr-1"></i> {{ $scheduled->scheduled_time }}
                            </span>
                            <span class="text-[10px] text-blue-500 font-medium truncate italic">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $scheduled->location_link }}
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
                <a href="{{ route('siswa.konseling.create') }}" class="flex flex-col items-center justify-center gap-2 p-5 bg-blue-50/50 hover:bg-blue-50 rounded-[2.5rem] border-2 border-dashed border-blue-100 transition-all active:scale-95 group cursor-pointer">
                    <div class="p-3 bg-white rounded-2xl shadow-sm text-blue-500 group-hover:rotate-12 transition-transform">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="16" y1="11" x2="22" y2="11"/></svg>
                    </div>
                    <p class="font-bold text-[10px] text-blue-900 uppercase tracking-tighter">Ajukan Jadwal</p>
                </a>

                <a href="{{ route('siswa.kirim-saran')}}" class="flex flex-col items-center justify-center gap-2 p-5 bg-emerald-50/50 hover:bg-emerald-50 rounded-[2.5rem] border-2 border-dashed border-emerald-100 transition-all active:scale-95 group text-emerald-600 cursor-pointer">
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
                    <span class="px-3 py-1 {{ $status['warna'] }} {{ $status['label'] }} rounded-full text-[10px] font-black uppercase italic tracking-widest">
                        {{ $status['teks'] }}
                    </span>
                </div>

               <div class="flex items-center gap-6 relative z-10">
                  {{-- Menampilkan angka total poin --}}
                  <div class="text-2xl font-black {{ $status['label'] }} tracking-tighter italic">
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

              @php
                  $targetRoute = $lastChat 
                      ? route('siswa.chat', $lastChat->konseling_id) 
                      : route('siswa.konseling.create'); // Sesuaikan nama route-mu di sini
              @endphp

              <form action="{{ $targetRoute }}" method="GET" class="mt-2">
                  <button class="group w-full bg-slate-900 hover:bg-black text-white py-5 flex items-center justify-center gap-3 rounded-4xl shadow-2xl transition-all hover:-translate-y-1 active:scale-95 cursor-pointer">
                      <span class="font-black tracking-[0.2em] text-xs uppercase">
                          {{ $lastChat ? 'Lanjutkan Chat' : 'Hubungi Mentor' }}
                      </span>
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

    <div class="mx-auto mt-6 font-['Poppins'] w-full max-w-4xl px-2">
        <div class="bg-white p-5 md:p-8 rounded-4xl shadow-xl border border-gray-100">
            
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-xl font-extrabold text-[#1A374C] relative inline-block">
                    Status Laporanmu
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-400 rounded-full opacity-50"></span>
                </h3>
            </div>

            <div class="mb-8 bg-blue-50 p-5 md:p-6 rounded-3xl border-2 border-dashed border-blue-200">
                <h4 class="text-xs md:text-sm font-bold text-blue-900 mb-4 flex items-center gap-2">
                    <span class="bg-blue-200 p-1.5 rounded-lg text-base">🔍</span> 
                    Lacak Laporan Manual
                </h4>
                
                <form action="{{ route('siswa.selfreport.check') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <div class="relative flex-1">
                        <input type="text" name="id_report" placeholder="Masukkan ID (SR-A1B2)" 
                            class="w-full p-3.5 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-blue-400 text-sm uppercase font-mono transition-all shadow-inner">
                    </div>
                    <button type="submit" class="bg-blue-900 text-white px-8 py-3.5 rounded-xl text-sm font-bold hover:bg-[#1A374C] hover:shadow-lg active:scale-95 transition-all duration-300">
                        Cek Status
                    </button>
                </form>
                <p class="text-[10px] text-blue-500 mt-3 italic font-medium">*Gunakan ID unik yang kamu dapatkan sesaat setelah mengirim laporan.</p>
            </div>

            {{-- List Laporan --}}
            <div class="space-y-3">
                @forelse ($reports as $report)
                <div class="group flex flex-col sm:flex-row items-start sm:items-center justify-between p-5 border border-gray-50 bg-gray-50/30 rounded-2xl transition-all hover:bg-white hover:shadow-md hover:border-blue-100">
                    
                    {{-- Info Laporan --}}
                    <div class="flex items-center gap-4 mb-3 sm:mb-0 w-full sm:w-auto">
                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-lg">
                            📄
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-bold text-[#1A374C] truncate">#{{ $report->id_report }}</span>
                            <span class="text-[11px] text-gray-500 font-medium">Kategori: <span class="text-blue-600">{{ ucfirst($report->kategori_masalah) }}</span></span>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <div class="w-full sm:w-auto flex justify-end">
                        @if($report->status_verifikasi == 'disetujui')
                            <div class="flex items-center gap-1.5 bg-green-50 text-green-700 px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-wider border border-green-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                Selesai
                            </div>
                        @elseif($report->status_verifikasi == 'ditolak')
                            <div class="flex items-center gap-1.5 bg-red-50 text-red-700 px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-wider border border-red-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                Ditolak
                            </div>
                        @else
                            <div class="flex items-center gap-1.5 bg-blue-900 text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"></path></svg>
                                Diproses
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <div class="text-4xl mb-3">👻</div>
                    <p class="text-sm text-gray-500 font-medium italic">Belum ada laporan aktif.</p>
                    <p class="text-[10px] text-gray-400 mt-1">*Laporan anonim tidak tersimpan permanen di sini.</p>
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

  @keyframes pulse-slow {
    0%, 100% { transform: scale(1); }
    50% {transform: scale(1.01); }
  }
  .animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
  }
</style>

{{-- script --}}
<script>
  function selectMood(event, type, message) {
    const btn = event.currentTarget;
    const statusDiv = document.getElementById('mood-status');
    const statusText = document.getElementById('status-text');
    const actionBtn = document.getElementById('action-btn');
    const allBtns = document.querySelectorAll('.mood-btn');

    const moodConfig = {
      'sad' : { bg: 'bg-blue-50', border: 'border-blue-100', text: 'text-blue-600', btn:'text-blue-600'},
      'happy' : { bg: 'bg-yell0w-50', border: 'border-yellow-100', text: 'text-yellow-700', btn: 'text-yellow-600'},
      'flat' : { bg: 'bg-purple-50', border: 'border-purple-100', text: 'text-purple-700', btn: 'text-purple-600'},
      'angry' : { bg: 'bg-red-50', border: 'border-red-100', text: 'text-red-700', btn: 'text-red-600'}
    };

    allBtns.forEach(b => {
      b.classList.add('grayscale');
      b.classList.remove('bg-white', 'shadow-xl', 'grayscale-0', 'scale-110');
    });

    btn.classList.remove('grayscale');
    btn.classList.add('grayscale-0', 'scale-110', 'bg-white', 'shadow-lg');

    // Configure Status Box
    const config = moodConfig[type];
    statusDiv.className = `mt-6 overflow-hidden rounded-[2rem] border transition-all duration-500 ${config.bg} ${config.border}`;
    statusText.innerText = message;
    statusText.className = `text-sm font-bold tracking-tight ${config.text}`;
    actionBtn.className = `px-6 py-2 rounded-full text-[11px] font-black uppercase tracking-[0.2em] bg-white shadow-sm hover:shadow-md transition-all active:scale-90 ${config.btn}`;

    // Show with animation
    statusDiv.classList.remove('hidden');
    setTimeout(() => {
        statusDiv.classList.add('scale-100', 'opacity-100');
    }, 10);
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

