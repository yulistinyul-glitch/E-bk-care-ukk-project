@extends('partials.app')

@section('content')
<section class="min-h-screen flex items-center justify-center py-12 px-4 font-['Poppins'] text-gray-800">
  
  <div class="relative w-full max-w-2xl">
    <div class="bg-linear-to-r from-blue-900 to-blue-700 rounded-t-3xl p-8 text-white shadow-lg relative">
      
      <a href="{{ route('siswa.home')}}" class="absolute top-6 right-6 hover:scale-110 duration-300 transition-all cursor-pointer bg-white/20 p-2 rounded-full cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor" d="m15.06 5.283l5.657 5.657a1.5 1.5 0 0 1 0 2.12l-5.656 5.658a1.5 1.5 0 0 1-2.122-2.122l3.096-3.096H4.5a1.5 1.5 0 0 1 0-3h11.535L12.94 7.404a1.5 1.5 0 0 1 2.122-2.121Z" />
        </svg>
      </a>

      <h2 class="text-2xl lg:text-3xl font-bold mb-2 flex items-center gap-3">
        <span>💡</span> Kotak saran E-BK Care
      </h2>
      <p class="text-blue-100 opacity-90 text-sm lg:text-base pr-10">
        Suaramu sangat berharga untuk kemajuan sekolah kita!
      </p>
    </div>

    <div class="bg-white shadow-2xl rounded-b-3xl p-6 lg:p-10 border-x border-b border-gray-100">
      <form action="{{ route('siswa.saran.store')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-6">
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Identitas Pengirim</label>
            <select name="is_anonymous" class="w-full p-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-900 bg-gray-50 outline-none text-sm transition-all">
              <option value="Tidak">Tetap Anonim (Rahasia)</option>
              <option value="Ya">Sertakan Nama</option>
            </select>
            <p class="text-[11px] text-gray-500 italic">*Pilih anonim jika ingin merasa lebih nyaman</p>
          </div>
          
          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Saran ditujukan untuk..</label>
            <select name="target" class="w-full p-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-900 outline-none bg-gray-50 text-sm transition-all">
              <option value="Wali Kelas">Wali Kelas</option>
              <option value="Guru/staf">Guru/ Staf pengajar</option>
              <option value="Kepala sekolah">Kepala sekolah</option>
              <option value="Organisasi">Organisasi (OSIS/MPK)</option>
              <option value="Fasilitas">Fasilitas</option>
            </select>
          </div>
        </div>
          
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700 italic">Apa yang bisa kami ditingkatkan?</label>
          <textarea name="message" rows="5" placeholder="Tuliskan kritik atau saranmu disini secara bijak ya..."
          class="w-full p-4 border border-gray-200 focus:ring-2 focus:ring-blue-900 outline-none bg-gray-50 transition-all rounded-xl resize-none"></textarea>
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-blue-900 text-white py-4 rounded-2xl font-bold
                                      flex justify-center items-center hover:bg-blue-800 hover:-translate-y-1 transition-all gap-3 shadow-lg shadow-blue-900/20 cursor-pointer">
            Kirim Saran ❤️
          </button>
          <div class="text-sm italic font-light text-gray-500 text-center mt-6 leading-relaxed">
            <p>"Saranmu adalah langkah awal perubahan besar"</p>
            <p class="font-medium text-gray-600">Terima kasih sudah peduli dengan lingkungan sekolah kita!</p>
          </div>
        </div>
      </form>

      @if ($errors->any())
        <div class="mt-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
          <ul class="list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>    
      @endif
    </div>
  </div>
</section>
@endsection