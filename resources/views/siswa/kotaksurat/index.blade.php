@extends('partials.app')

@section('content')

<div class="lg:ml-28 px-6 lg:px-10 max-w-7xl mx-auto mb-20 font-['Poppins']">
  {{-- header --}}
  <div class="py-6">
    <h2 class="text-2xl font-bold text-[#1A374C]">Kotak Pesan</h2>
    <p class="text-sm text-gray-500">Informasi Surat panggilan, Jadwal dan undangan konselingmu</p>
    <button class="absolute top-3 right-4 hover:animate-bounce duration-300 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
            <path fill="currentColor" d="m15.06 5.283l5.657 5.657a1.5 1.5 0 0 1 0 2.12l-5.656 5.658a1.5 1.5 0 0 1-2.122-2.122l3.096-3.096H4.5a1.5 1.5 0 0 1 0-3h11.535L12.94 7.404a1.5 1.5 0 0 1 2.122-2.121Z" />
        </svg>
    </button>
  </div>

  {{-- List pesan --}}
    <div class="space-y-4">
        @forelse($surat as $item)
            <div id="card-{{ $item->id }}"
                 onclick="showDetail('{{ $item->id }}', '{{ addslashes($item->subject) }}', {{ json_encode($item->message) }})"
                 class="bg-white border-2 {{ $item->is_read ? 'border-gray-100' : 'border-blue-400' }} p-5 rounded-3xl shadow-sm hover:shadow-md transition-all cursor-pointer flex items-center gap-4 group">
                
                <div class="p-3 {{ $item->is_read ? 'bg-gray-100 text-gray-400' : 'bg-blue-100 text-blue-600' }} rounded-2xl group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>

                <div class="flex-1">
                    <h4 class="font-bold text-[#1A374C] {{ $item->is_read ? 'opacity-70' : '' }}">{{ $item->subject }}</h4>
                    <p class="text-xs text-gray-500 truncate max-w-xs md:max-w-md">{{ $item->message }}</p>
                    <span class="text-[10px] text-gray-400 mt-1 block">{{ $item->created_at->diffForHumans() }}</span>
                </div>

                @if(!$item->is_read)
                  <div id="dot-{{ $item->id }}" class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                @endif
            </div>
        @empty
            <div class="text-center py-20">
                <img src="https://illustrations.popsy.co/blue/no-messages.svg" class="w-40 mx-auto opacity-50">
                <p class="text-gray-400 mt-4">Belum ada pesan untukmu saat ini.</p>
            </div>    
    @endforelse
  </div>
</div>

{{-- Modal popup detail --}}
<div id="modalDetail" class="fixed inset-0 z-99 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
  <div class="bg-white w-full max-w-md rounded-4xl overflow-hidden shadow-2xl animate-fade-in">
    <div class="bg-[#1A374C] p-6 text-white">
      <h3 id="modalSubject" class="text-lg font-bold">Detail Pesan</h3>
    </div>
    <div class="p-8">
     <p id="modalMessage" class="text-gray-600 leading-relaxed mb-6 whitespace-pre-line"></p>
      <div id="jadwalInfo" class="bg-blue-50 p-4 rounded-2xl mb-6 hidden">
          <p id="detailWaktu" class="text-sm text-blue-700"></p>
          <p id="detailLokasi" class="text-sm text-blue-700 font-semibold"></p>
      </div>
      <button onclick="closeModal()" class="w-full bg-[#1A374C] text-white py-4 rounded-2xl font-bold hover:bg-blue-900 transition-colors">
        Tutup & Tandai telah dibaca
      </button>
    </div>
  </div>
</div>

{{-- js --}}
<script>
 function showDetail(id, subject, message) {
    document.getElementById('modalSubject').innerText = subject;
    document.getElementById('modalMessage').innerText = message;
    document.getElementById('modalDetail').classList.remove('hidden');
    document.getElementById('modalDetail').classList.add('flex');
        
        fetch(`/siswa/mailbox/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const dot = document.getElementById(`dot-${id}`);
                const card = document.getElementById(`card-${id}`);
                if(dot) dot.remove();
                if(card) card.classList.replace('border-blue-400', 'border-gray-100');
            }
        });
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
        document.getElementById('modalDetail').classList.remove('flex');
    }
</script>
@endsection