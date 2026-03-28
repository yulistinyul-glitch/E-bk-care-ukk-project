@extends('partials.app')

@section('content')
    <section class="mx-auto font-['Poppins'] min-h-screen bg-gray-50 pb-20">
      <div class="relative pt-10 pb-5 px-4">
        {{-- Tombol Back --}}
        <button class="absolute top-3 right-4 hover:animate-bounce duration-300 transition-all">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
            <path fill="currentColor" d="m15.06 5.283l5.657 5.657a1.5 1.5 0 0 1 0 2.12l-5.656 5.658a1.5 1.5 0 0 1-2.122-2.122l3.096-3.096H4.5a1.5 1.5 0 0 1 0-3h11.535L12.94 7.404a1.5 1.5 0 0 1 2.122-2.121Z" />
          </svg>
        </button>
        
        {{-- Search Input --}}
        <div class="mx-auto max-w-md bg-white border-gray-200 border px-4 py-1.5 rounded-full shadow-md flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-gray-400">
            <path fill="currentColor" d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0s.41-1.08 0-1.49zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14" />
          </svg>
          <input type="text" id="search-input" class="w-full focus:outline-none text-sm p-2 bg-transparent" placeholder="Cari riwayat...">
        </div>
      </div>

      {{-- Tab Buttons --}}
      <div class="flex justify-center gap-4 mb-6 px-4">
        <button onclick="swichTab('jadwal')" id="btn-jadwal" class="tab-btn px-6 py-2 rounded-full text-sm font-medium transition-all duration-300">Jadwal</button>
        <button onclick="swichTab('report')" id="btn-report" class="tab-btn px-6 py-2 rounded-full text-sm font-medium transition-all duration-300">Self-Report</button>
      </div>

      <div class="mx-auto max-w-md px-4">
        <div id="list-container" class="space-y-4"></div>
        
        <div id="blank-history" class="hidden flex flex-col items-center justify-center py-20 text-center animate-fade-in">
          <img src="{{ asset('img/img1.png') }}" alt="No history" class="w-64 mb-6 mx-auto">
          <h2 class="text-lg font-bold text-gray-700 px-10">Pencarian tidak ditemukan</h2>
          <p class="text-sm text-gray-400 mt-2 px-6 italic">Belum ada data arsip untuk kategori ini.</p>
        </div>
      </div>
    </section>

    <style>
      .active-tab { background-color: #2563eb; color: white; box-shadow: 0 10px 15px -3px rgba(147, 197, 253, 0.5); }
      .inactive-tab { background-color: white; color: #9ca3af; border: 1px solid #e5e7eb; }
      
      @keyframes fadeIn{ from {opacity: 0; transform: translateY(10px);} to {opacity: 1; transform: translateY(0);} }
      .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>

    <script>
      console.log("Data Jadwal:", @json($riwayatJadwal));
      console.log("Data Report:", @json($riwayatReport));

      let currentTab = 'jadwal';
      const dataJadwal = @json($riwayatJadwal);
      const dataReport = @json($riwayatReport);

      function swichTab(type) {
        currentTab = type;
        renderList();
      }

      function renderList(filter = '') {
        const container = document.getElementById('list-container');
        const blankHistory = document.getElementById('blank-history');
        const btnJadwal = document.getElementById('btn-jadwal');
        const btnReport = document.getElementById('btn-report');

        container.innerHTML = "";
        blankHistory.classList.add('hidden');

        // Reset & Active Tab UI
        btnJadwal.className = 'tab-btn inactive-tab px-6 py-2 rounded-full text-sm font-medium transition-all';
        btnReport.className = 'tab-btn inactive-tab px-6 py-2 rounded-full text-sm font-medium transition-all';
        
        let activeData = currentTab === 'jadwal' ? dataJadwal : dataReport;
        document.getElementById(`btn-${currentTab}`).className = 'tab-btn active-tab px-6 py-2 rounded-full text-sm font-medium transition-all';

        // Filter data berdasarkan input search
        const filteredData = activeData.filter(item => 
            item.title.toLowerCase().includes(filter.toLowerCase())
        );

        if (filteredData.length === 0) {
          blankHistory.classList.remove('hidden');
          return;
        }

        filteredData.forEach(item => {
          const color = getStatusColor(item.status);
          container.innerHTML += `
            <div class="bg-white p-4 rounded-2xl shadow-sm border-l-4 ${color.border} animate-fade-in flex justify-between items-center transition-transform active:scale-95 mb-3">
              <div>
                <h3 class="font-bold text-gray-800 text-sm uppercase">${item.title}</h3>
                <p class="text-[11px] text-gray-500 mt-1">${item.date} ${item.time ? ' • ' + item.time + ' WIB' : ''}</p>
              </div>
              <span class="${color.bg} ${color.text} text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-wider">${item.status}</span>
            </div>
          `;
        });
      }

      function getStatusColor(status) {
  // Pakai .toLowerCase() supaya aman jika di DB huruf besar/kecil
  const s = status ? status.toLowerCase() : '';
  
  switch(s) {
    case 'selesai':
    case 'disetujui': 
      return { border: 'border-green-500', bg: 'bg-green-100', text: 'text-green-600' };
    case 'dibatalkan':
    case 'ditolak': 
      return { border: 'border-red-500', bg: 'bg-red-100', text: 'text-red-600' };
    case 'mendatang':
    case 'proses':
    case 'pending': // Tambahkan ini agar 'pending' punya warna
      return { border: 'border-blue-500', bg: 'bg-blue-100', text: 'text-blue-600' };
    default: 
      return { border: 'border-gray-300', bg: 'bg-gray-100', text: 'text-gray-500' };
  }
}

      // Event Listener Pencarian
      document.getElementById('search-input').addEventListener('input', (e) => {
          renderList(e.target.value);
      });

      window.onload = () => swichTab('jadwal');
    </script>
@endsection