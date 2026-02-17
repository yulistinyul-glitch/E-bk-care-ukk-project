@extends('app')

@section('content')

<div class="min-h-screen bg-gray-50 flex justify-center items-start pb-20">
  <div class="w-full bg-white min-h-screen shadow-lg overflow-hidden relative font-sans">
    
     <div class="relative h-64 md:h-56 bg-[#1e3a52] flex justify-center items-center md:items-end overflow-hidden">
      <div class="absolute inset-0 opacity-20 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/school-supplies.png')]"></div>
      
       <div class="relative z-20 flex flex-col md:flex-row items-center md:items-end gap-0 md:gap-6 pb-0 lg:pb-10">
        <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-gray-300 relative shrink-0">
          <img src="https://via.placeholder.com/150" alt="Martin Edwards" class="w-full h-full object-cover">
          <div class="absolute top-2 right-4 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
        </div>

         <div class="hidden md:flex flex-col justify-end pb-1">
          <h1 class="text-xl font-bold text-white uppercase tracking-wide">Martin Edwards</h1>
          <p class="text-blue-100 text-sm font-semibold mt-1">STUDENT</p>
          <p class="text-blue-100 font-bold mt-1">0000123/23240001</p>
        </div>
      </div>

      <div class="md:hidden absolute bottom-0 w-full leading-[0]">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 80px; width: 100%;">
          <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
        </svg>
      </div>
    </div>

   <div class="text-center md:hidden mt-4">
      <h1 class="text-2xl font-bold text-[#1e3a52] uppercase tracking-wide">Martin Edwards</h1>
      <p class="text-gray-500 text-sm font-semibold mt-1">STUDENT</p>
      <p class="text-[#1e3a52] font-bold mt-1">0000123/23240001</p>
    </div>

    <div class="lg:ml-28 md:items-center px-6 lg:px-10 py-6 max-w-7xl mx-auto flex flex-col items-center justify-center">
    <div class="px-6 mt-6 w-full md:w-3xl">
      <h2 class="font-bold text-[#1e3a52] mb-2">Biodata Siswa</h2>
      <div class="bg-[#1e3a52] rounded-2xl p-6 text-white shadow-md">
        <div class="space-y-4">
          <div class="border-b border-gray-500 pb-1">
            <span class="text-sm font-bold block">Class</span>
          </div>
          <div class="border-b border-gray-500 pb-1">
            <span class="text-sm font-bold block">JK</span>
          </div>
          <div class="border-b border-gray-500 pb-1">
            <span class="text-sm font-bold block">addres</span>
          </div>
          <div class="border-b border-gray-500 pb-1">
            <span class="text-sm font-bold block">phone</span>
          </div>
          <div class="border-b border-gray-500 pb-1">
            <span class="text-sm font-bold block">emails</span>
          </div>
        </div>
      </div>
    </div>

    {{-- point pelanggaran --}}
    <div class="px-6 mt-6 pb-10 w-full md:w-3xl">
      <div class="bg-[#a8cae6] rounded-3xl p-6 shadow-md">

        <div class="flex justify-between items-start">
          <div>
            <h3 class="text-white font-bold text-2xl">Point Pelanggaran</h3>
            <p class="text-white text-md font-semibold leading-tight mt-1 opacity-90">
              Setiap tindakan punya harga, pastikan kamu sanggup membayarnya.
            </p>
          </div>
          <span class="bg-white/40 text-white text-xs px-4 py-1 rounded-full border border-white/50">
            Februari
          </span>
        </div>

       
        <div class="flex flex-col lg:flex-row items-center justify-center px-8 gap-6 mt-6 md:gap-8">
         <img src="img/img1.png" alt="" class=" h-20 md:h-40 object-cover">

         {{-- bar pelanggaran --}}
         <div class="w-full max-w-sm mx-auto p-4 md:p-8 bg-white/20 rounded-3xl border border-white shadow-xl">
          <h2 class="text-center mb-6 text-sm md:text-base font-bold text-slate-600 tracking-wide uppercase">STATUS PELANGGARAN</h2>

          <div class="relative w-full aspect-[2/1] flex items-center justify-center">
            <svg class="w-full h-full drop-shadow-sm" viewBox="0 0 100 50">
              <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#e5e7eb" stroke-width="7" stroke-linecap="round"
              />
              <path id="progress-bar" d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke-width="7" stroke-linecap="round" stroke-dasharray="18.75 125"  class="transition-all duration-1000 ease-out" style="stroke: #10b981;" 
              />
            </svg>

            <div class="absolute inset-0 flex flex-col items-center justify-end pb-2">
              <div class="flex flex-col items-center">
               <span id="point-text" class="text-md md:text-3xl font-black text-slate-800 leading-none">5/100</span>
               <span id="status-label" class="mt-1 text-[10px] sm:text-xs md:text-sm font-bold uppercase tracking-widest px-3 py-1 rounded-full bg-white shadow-sm border">aman</span>  
              </div>
            </div>
          </div>
         </div>
          

      </div>
    </div>

    <script>
  // Logika untuk Dashboard: Nilai ini nantinya diambil dari Database/Backend
  const poinSiswa = 5; 
  
  const progressBar = document.getElementById('progress-bar');
  const pointsText = document.getElementById('points-text');
  const statusLabel = document.getElementById('status-label');

  // Kalkulasi stroke-dasharray (Max keliling setengah lingkaran ini adalah 125)
  const strokeValue = (poinSiswa * 125) / 100;
  progressBar.setAttribute('stroke-dasharray', `${strokeValue} 125`);

  // Logika Warna dan Label sesuai permintaan anda
  if (poinSiswa <= 25) {
    progressBar.style.stroke = "#10b981"; // Hijau (Aman)
    statusLabel.innerText = "Aman";
    statusLabel.className = "text-sm font-semibold text-emerald-600 uppercase";
  } else if (poinSiswa <= 50) {
    progressBar.style.stroke = "#f59e0b"; // Kuning (Peringatan)
    statusLabel.innerText = "Peringatan";
    statusLabel.className = "text-sm font-semibold text-amber-500 uppercase";
  } else {
    progressBar.style.stroke = "#ef4444"; // Merah (Bahaya)
    statusLabel.innerText = "Bahaya";
    statusLabel.className = "text-sm font-semibold text-red-600 uppercase";
  }

  pointsText.innerText = `${poinSiswa}/100`;
</script>

{{-- 
{{-- tombol testing 
<div class="flex justify-center gap-3 mt-4 mb-10">
  <button onclick="tambahPoin(10)"
          class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition">
    +10
  </button>

  <button onclick="resetPoin()"
          class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 transition">
    Reset
  </button>
</div>

<script>
  let poin = 0;
  const maxPoin = 100;

  function updateGauge() {
    const gauge = document.getElementById("gauge");
    const pointText = document.getElementById("pointText");
    
    if (!gauge || !pointText) return;

    let persen = poin / maxPoin;
    let derajat = persen * 180;

    let warna = '#22c55e';
    if (poin > 70) {
      warna = '#dc2626';
    } else if (poin > 30) {
      warna = '#eab308';
    }

    gauge.style.background = `conic-gradient(from 270deg, ${warna} 0deg, ${warna} ${derajat}deg, #e5e7eb ${derajat}deg, #e5e7eb 180deg, transparent 180deg)`;
    
    pointText.innerText = `${poin}/${maxPoin}`;
  }

  window.tambahPoin = function(jumlah) {
    poin += jumlah;
    if (poin > maxPoin) poin = maxPoin;
    updateGauge();
  }

  window.resetPoin = function() {
    poin = 0;
    updateGauge();
  }

  document.addEventListener("DOMContentLoaded", function () {
    updateGauge();
  });
</script> --}}


</div>
@endsection