@extends('partials.app')

@section('content')
<section class="lg:ml-28 px-4 lg:px-10 max-w-4xl mx-auto mb-20 font-['Poppins'] text-gray-800">

  <div class="bg-linear-to-r from-blue-900 to-blue-800 rounded-t-3xl p-8 text-white shadow-lg">
    <h2 class="text-3xl font-bold mb-2 flex items-center gap-2">
      <span>💡</span> Kotak saran E-BK Care
    </h2>
    <p class="text-blue-100 opacity-90">Suaramu sangat berharga untuk kemajuan dan kenyamanan sekolah kita!</p>
  </div>

  <div class="bg-white shadow-xl rounded-b-3xl p-6 lg:p-10 border-x border-b border-gray-100">
    <form action="{{ route('siswa.saran.store')}}" method="POST" enctype="multipart/form-data" class="space-y-8">
      @csrf
      <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700">
            <select name="is_anonymous" id="" class="w-full p-3.5 rounded-xl border border-gray-100 focus:ring-2 focus:ring-blue-950 bg-gray-50 outline-none text-sm">
              <option value="Tidak">Tetap Anonim (Rahasia)</option>
              <option value="Ya">Sertakan Nama</option>
            </select>
            <p class="text-[11px] text-gray-600 italic opacity-95">*Pilih anonim jika ingin merasa lebih nyaman</p>
          </label>
        </div>
        
        <div class="space-y-2">
          <label for="" class="block text-sm font-semibold text-gray-700">Saran ditujukan untuk..</label>
          <select name="target" id="" class="w-full p-3.5 rounded-xl border border-gray-100 focus:ring-2 focus:ring-blue-950 outline-none bg-gray-50 text-sm">
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
          <textarea name="message" id="" rows="5" placeholder="Tuliskan kritik atau saranmu disini secara bijak ya..."
          class="w-full p-4 border border-gray-100 focus:ring-2 focus:ring-blue-900 outline-none bg-gray-50 transition-all rounded-xl"></textarea>
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-blue-900 text-white py-4 rounded-full font-bold
                                        flex justify-center items-center hover:bg-blue-600 hover:-translate-y-1 transition-all gap-3">
            Kirim Saran ❤️
          </button>
          <p class="text-sm italic font-light text-gray-500 text-center mt-5">
            "Saranmu adalah langkah awal perubahan besar" <br>
            Terima kasih sudah peduli dengan lingkungan sekola kita!!
          </p>
        </div>
    </form>

    @if ($errors-> any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>    
    @endif
  </div>
</section>