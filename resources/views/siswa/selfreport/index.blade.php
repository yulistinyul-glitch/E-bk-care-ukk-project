@extends('partials.app')

@section('content')
  <section class="lg:ml-28 px-6 lg:px-10 max-w-7xl mx-auto mb-20 font-['Poppins']">
    <div class="bg-white shadow-md relative">
      <div class="bg-blue-950 text-white items-start mx-auto p-3">
        <h2 class="text-3xl">Self report</h2>
        <small>jangan takut bersuara, identitasmu terlindungi disini!</small>
      </div>
      <div class="text-sm text-gray-700 mx-auto p-3.5">
        <h4 class="font-bold">Halo!! selamat datang di self-report E-BK Care👋🏻</h4>
        <p class="mb-4">tolong di baca terlebih dahulu deskripsi yaa..</p>
        <p class="mb-4">Kami sangat amat berterimakasih dan mengapresiasi untuk kamu yang berani bersuara👏🏻, <br>
           Form ini dibuat khusus untuk kamu yang ingin melaporkan kejadian yang kurang nyaman <br>
           (seperti bullying atau hal tidak benar lainnya) yang menimpa dirimu atau temanmu.
        </p>
        <h4 class="font-bold mb-4">JANJI KAMI</h4>
        <ol class="mb-4">
          <li>- Identitasmu aman: Kami TIDAK merekam alamat email, nama, atau data pribadimu secara otomatis👁️‍🗨️.</li>
          <li>- Hanya bukti & cerita: Kami hanya menerima isi laporan dan bukti yang kamu kirimkan saja📁.</li>
          <li>- Kerahasiaan terjaga: Laporan ini hanya akan dibaca oleh tim kecil yang bertugas membantu menyelesaikan masalah ini secara bijak🙆🏻‍♀️.</li>
        </ol>
        <p>Kamu tidak sendirian Yuk, bantu buat sekolah kita jadi tempat yang lebih asik buat semua orang!❤️‍🩹❤️‍🩹</p>   
      </div>
        <span class="w-full bg-blue-950 h-1.5"></span>
      <form action="#" method="POST">
      @csrf
      <div class="mb-4 p-3.5">
        <label class="block text-sm font-medium text-gray-700 mb-2">Komitmen kejujuran</label>
        <div class="flex-col flex">
          <div>
            <input type="checkbox" id="konfirmasi" name="konfirmasi" required>
            <label for="konfirmasi" class="mb-2">"Saya dapat memastikan kejadian ini benar adanya"</label>
          </div>
          <div>
            <input type="checkbox" id="konfirmasi" name="konfirmasi" required>
            <label for="konfirmasi" class="mb-2">"Saya bersedia dan mengerti bahwa laporan yang kurang jelas atau kurang bukti mungkin tidak dapat diproses lebih lanjut"</label>
          </div>
        </div>
      </div>
         
        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
        <select name="kategori" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none" id="">
          <option value="Bullying">Bullying</option>
          <option value="Ancaman">Ancaman</option>
          <option value="Kekerasan">Kekerasan</option>
          <option value="Masalah digital">Masalah digital</option>
          <option value="Lingkungan sekolah">Lingkungan sekolah</option>
          <option value="Pelanggaran">Pelanggaran</option>
          <option value="Lainnya">Lainnya</option>
        </select>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2"></label>
        <textarea name="deskripsi" rows="4" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none"
        placeholder="Ceritakan sedikit masalahmu..."></textarea>
        @error('deskripsi')
          <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="w-full bg-[#1a374c] text-white py-4 rounded-full font-semibold hover:bg-slate-800 transition-all">
        Kirim permintaan
      </button>

    </form>
    </div>
  </section>
@endsection