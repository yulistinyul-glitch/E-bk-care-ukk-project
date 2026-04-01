@extends('partials.app')

@section('content')
<div class="lg:ml-28 px-6 lg:px-10 max-w-7xl mx-auto mb-20 font-['Poppins']">
    {{-- header --}}
   <div class="py-8 flex items-center gap-4">
    <a href="{{ route('siswa.home') }}" class="group flex items-center justify-center w-12 h-12 bg-white border border-gray-200 rounded-2xl shadow-sm hover:bg-[#1A374C] hover:border-[#1A374C] transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-[#1A374C] group-hover:text-white transition-colors">
            <path d="m15 18-6-6 6-6"/>
        </svg>
    </a>

    <div>
        <h2 class="text-2xl font-bold text-[#1A374C]">Kotak Pesan</h2>
        <p class="text-sm text-gray-500">Informasi Surat panggilan, Jadwal dan undangan konselingmu</p>
    </div>
   </div>

    {{-- List pesan --}}
    <div class="grid gap-4 md:grid-cols-1 lg:grid-cols-2">
        @forelse ($surat as $item)
        <div id="card-{{ $item->id }}" 
             onclick="showDetail('{{ $item->id }}', '{{ addslashes($item->subject) }}', {{ json_encode($item->message) }}, '{{ $item->created_at->format('d M Y, H:i') }}')"
             class="relative bg-white border {{ $item->is_read ? 'border-gray-100' : 'border-l-4 border-l-blue-600 border-gray-200' }} p-6 rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer flex items-start gap-5 group">

            <div class="shrink-0 p-4 {{ $item->is_read ? 'bg-gray-50 text-gray-400' : 'bg-blue-50 text-blue-600' }} rounded-2xl group-hover:rotate-12 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start mb-1">
                    <h4 class="font-bold text-lg text-[#1A374C] truncate {{ $item->is_read ? 'text-gray-500' : '' }}">
                        {{ $item->subject }}
                    </h4>
                    <span class="text-[10px] font-medium text-gray-400 whitespace-nowrap ml-2 italic">
                        {{ $item->created_at->diffForHumans() }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed">
                    {{ $item->message }}
                </p>
            </div>

            @if(!$item->is_read)
                <span id="dot-{{ $item->id }}" class="absolute top-4 right-4 flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                </span>
            @endif
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <img src="{{ asset('img/img1.png') }}" alt="Tidak ada pesan" class="mx-auto mb-4 w-40 opacity-50">
            <p class="text-gray-500 font-medium">Kotak suratmu masih kosong</p>
        </div>
        @endforelse
    </div>
</div>

@if (isset($item->file_pdf))
<a href="{{ asset('storage/generated_surats/' .$item->file_pdf) }}" target="_blank" class="mb-4 w-full bg-blue-100 text-blue-700 py-4 rounded-2xl font-bold text-center flex items-center justify-center gap-2 hover:bg-blue-200 transition-all">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
    </svg>
    Lihat Lampiran PDF
</a>   
@endif

{{-- Modal popup detail --}}
<div id="modalDetail" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-[#1A374C]/40 backdrop-blur-md transition-opacity duration-300">
    <div class="bg-white w-full max-w-lg rounded-[2.5rem] overflow-hidden shadow-2xl transform transition-all animate-pop-up">
        <div class="relative bg-[#1A374C] p-8 text-white">
            <button onclick="closeModal()" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="flex items-center gap-4 mb-2">
                <span class="px-3 py-1 bg-blue-500/30 text-blue-200 text-[10px] font-bold rounded-full uppercase tracking-widest">Surat Resmi</span>
                <span id="modalDate" class="text-xs text-white/60"></span>
            </div>
            <h3 id="modalSubject" class="text-2xl font-black leading-tight"></h3>
        </div>
        
        <div class="p-8">
            <div class="text-gray-600 leading-loose mb-8">
                <p id="modalMessage" class="whitespace-pre-line text-base"></p>
            </div>
            
            <button onclick="closeModal()" class="w-full bg-[#1A374C] text-white py-5 rounded-[1.5rem] font-bold text-lg hover:bg-blue-900 hover:shadow-lg active:scale-95 transition-all flex items-center justify-center gap-2">
                <span>Tandai Selesai</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes pop-up {
        0% { opacity: 0; transform: scale(0.9) translateY(20px); }
        100% { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-pop-up {
        animation: pop-up 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
function showDetail(id, subject, message, date) {
    document.getElementById('modalSubject').innerText = subject;
    document.getElementById('modalMessage').innerText = message;
    document.getElementById('modalDate').innerText = date;
    
    const modal = document.getElementById('modalDetail');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

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
            if(card) {
                card.classList.remove('border-l-4', 'border-l-blue-600', 'border-gray-200');
                card.classList.add('border-gray-100');
                const title = card.querySelector('h4');
                if(title) title.classList.add('text-gray-500');
            }
        }
    })
    .catch(err => console.error("Error reading message:", err));
}

function closeModal() {
    const modal = document.getElementById('modalDetail');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection