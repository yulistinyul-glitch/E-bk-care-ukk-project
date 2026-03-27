@extends('partials.app')

@section('content')
<section class="min-h-screen flex items-center justify-center py-12 px-4 font-['Poppins'] text-gray-800">
  
  <div class="relative w-full max-w-2xl">
    
    <a href="{{ url()->previous() }}" class="absolute top-6 right-6 hover:animate-bounce duration-300 transition-all cursor-pointer text-white/80 hover:text-white bg-white/20 p-2 rounded-full z-10">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
        <path fill="currentColor" d="m15.06 5.283l5.657 5.657a1.5 1.5 0 0 1 0 2.12l-5.656 5.658a1.5 1.5 0 0 1-2.122-2.122l3.096-3.096H4.5a1.5 1.5 0 0 1 0-3h11.535L12.94 7.404a1.5 1.5 0 0 1 2.122-2.121Z" />
      </svg>
    </a>

    <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-t-3xl p-8 text-white shadow-lg relative">
      <h2 class="text-2xl lg:text-3xl font-bold mb-2 flex items-center gap-3">
        <span>📅</span> Ajukan Jadwal Konseling
      </h2>
      <p class="text-blue-100 opacity-90 text-sm lg:text-base">Atur waktu terbaikmu untuk bercerita bersama guru BK.</p>
    </div>

    <div class="bg-white shadow-xl rounded-b-3xl p-6 lg:p-10 border-x border-b border-gray-100">
      
      @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
          <ul class="list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>  
      @endif

      <form action="{{ route('siswa.konseling.store')}}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-6">
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Kategori Masalah</label>
            <select name="kategori" class="w-full p-3.5 rounded-xl border border-gray-100 focus:ring-2 focus:ring-blue-900 bg-gray-50 outline-none text-sm transition-all">
              <option value="Pribadi">Pribadi</option>
              <option value="Sosial">Sosial</option>
              <option value="Belajar">Belajar</option>
              <option value="Karir">Karir</option>
            </select>
          </div>
          
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Metode Konseling</label>
            <select name="pilihan_metode" class="w-full p-3.5 rounded-xl border border-gray-100 focus:ring-2 focus:ring-blue-900 outline-none bg-gray-50 text-sm transition-all">
              <option value="Offline">Tatap muka (Offline)</option>
              <option value="Online">Chat (Online)</option>
            </select>
          </div>
        </div>
          
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700 italic">Deskripsi Singkat</label>
          <textarea name="deskripsi" rows="4" placeholder="Ceritakan sedikit masalahmu agar kami bisa mempersiapkan bantuan terbaik..."
          class="w-full p-4 border border-gray-100 focus:ring-2 focus:ring-blue-900 outline-none bg-gray-50 transition-all rounded-xl resize-none"></textarea>
          @error('deskripsi')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
          @enderror
        </div>

        <div class="pt-4 text-center">
          <button type="submit" class="w-full bg-blue-900 text-white py-4 rounded-full font-bold
                                      flex justify-center items-center hover:bg-blue-800 hover:-translate-y-1 transition-all gap-3 shadow-lg shadow-blue-900/20">
            Kirim Permintaan 🚀
          </button>
          <p class="text-sm italic font-light text-gray-500 mt-6 leading-relaxed px-4">
            "Tenang, privasimu terjaga. Kami di sini untuk mendengarkan."
          </p>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection