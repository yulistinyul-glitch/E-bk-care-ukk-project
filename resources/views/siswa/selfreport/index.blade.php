@extends('partials.app')

@section('content')
<section class="lg:ml-28 px-4 lg:px-10 max-w-4xl mx-auto mb-20 font-['Poppins'] text-gray-800">

  <div class="bg-linear-to-r from-blue-900 to-blue-800 rounded-t-3xl p-8 text-white shadow-lg">
    <h2 class="text-3xl font-bold mb-2 flex items-center gap-2">
      <span>🛡️</span> Self Report E-BK Care
    </h2>
    <p class="text-blue-100 opacity-90">Jangan takut bersuara, identitasmu terlindungi sepenuhnya disini!</p>
  </div>

  <div class="bg-white shadow-sm rounded-b-3xl p-6 lg:p-10 mb-5 border-x border-b border-gray-100">
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-xl mb-10">
      <h4 class="font-bold text-blue-900 mb-2 text-lg">Halo! Terimakasih sudah berani melapor 👋🏻</h4>
      <p class="text-sm leading-relaxed mb-4 text-blue-800">
        Form ini adalah ruang amanmu. Kami sangat menghargai keberanianmu untuk membantu menciptakan sekolah yang lebih nyaman!
      </p>
      <div class="grid md:grid-cols-3 gap-4 mt-4">
        <div class="bg-white p-3 rounded-lg shadow-sm">
          <span class="block text-xl mb-1">👁️‍🗨️</span>
          <p class="text-[11px] font-semibold uppercase text-gray-500">Identitas Aman</p>
          <p class="text-[12px]">Data Pribadi tidak direkam otomatis</p>
        </div>
        <div class="bg-white p-3 rounded-lg shadow-sm">
          <span class="block text-xl mb1">📁</span>
          <p class="text-[11px] font-semibold uppercase text-gray-600">Hanya bukti</p>
          <p class="text-[12px]">Hanya fokus pada cerita dan bukti yang diberikan.</p>
        </div>
        <div class="bg-white p-3 rounded-lg shadow-sm">
          <span class="block text-xl mb-1">🙆🏻‍♀️</span>
          <p class="text-[11px] font-semibold uppercase text-gray-500">Tim terpercaya</p>
          <p class="text-[12px]">Hanya dibaca tim khusus yang bijak</p>
        </div>
      </div>
    </div>
  </div>

  <form action="{{ route('siswa.selfreport.store')}}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <div class="space-y-4">
      <h3 class="font-bold text-lg border-b pb-2">
          1. Konfirmasi kejujuran!
      </h3>
      <div class="space-y-3">
        <label for="" class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 hover:bg-gray-50 cursor-pointer transition">
          <input type="checkbox" name="" required class="mt-1 w-5 h-5 rounded border-gray-300 text-blue-400 focus:ring-blue-500">
          <span class="text-sm">Saya memastikan kejadian ini benar adanya tanpa ada rekayasa</span>
        </label>
        <label class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 hover:bg-gray-50 cursor-pointer transition">
          <input type="checkbox" name="" required class="mt-1 w-5 h-5 rounded border-gray-300 text-blue-400 focus:ring-blue-500">
          <span class="text-sm">Saya mengerti dan menerima, apabila bukti laporan kurang dan tidak jelas sumbernya akan sulit diproses lebih lanjut atau bahkan ditolak.</span>
        </label>
      </div>
    </div>

    <div class="space-y-4">
      <h3 class="font-bold text-lg borded-b pb-2">
        2. Detail Kejadian
      </h3>

      <div class="grid md:grid-cols-2 gap-4">
        <div class="space-y-2">
          <label class="text-sm font-semibold text-gray-700">Kaategori Masalah</label>
          <select name="kategori_masalah" required id="" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-gray-50">
            <option value="Bullying">Bullying</option>
            <option value="Ancaman">Ancaman</option>
            <option value="Kekerasan">Kekerasan</option>
            <option value="Masalah digital">Masalah digital</option>
            <option value="Lingkungan sekolah">Lingkungan Sekolah</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>

        <div class="space-y-2">
          <label for="" class="text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
          <select name="lokasi" required id="" class="w-full p-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-gray-50">
            <option value="Kelas">Ruang Kelas</option>
            <option value="Kantin">Kantin</option>
            <option value="Toilet">Toilet</option>
            <option value="Area belakang"> Area belakang</option>
            <option value="Medsos">Media sosial</option>
          </select>
        </div>
      </div>

      <div class="space-y-2">
        <label for="" class="text-sm font-semibold text-gray-700">Kapan kejadiannya terjadi?</label>
        <p class="text-xs text-gray-500 italic mb-2">Contoh: "Kemarin saat jam istirahat" atau "Tadi pagi saat jam 8"</p>
        <textarea name="waktu_kejadian" required id="" rows="2" class="w-full p-4 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50" placeholder="Ceritakan waktu singkatnya..."></textarea>
      </div>
    </div>

    <div class="space-y-4">
      <h3 class="font-bold text-lg border-b pb-2 text-red-600">3. Ceritakan Kisahmu</h3>
      <div class="space-y-2">
        <label class="text-sm font-medium text-gray-600">Apa yang terjadi? (Gunakan bahasa santai saja, yang penting jelas)</label>
        <textarea name="isi_laporan" required rows="5" class="w-full p-4 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50" placeholder="Tulis di sini..."></textarea>
      </div>

      <div class="space-y-2">
        <label class="text-sm font-medium text-gray-600">Siapa pelakunya? (Sebutkan nama atau ciri-cirinya)</label>
         <textarea name="pelaku" required rows="3" class="w-full p-4 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none bg-gray-50" placeholder="Contoh: Budi kelas 10 atau kakak kelas pakai jaket hitam..."></textarea>
      </div>
    </div>

     <div class="space-y-4">
        <h3 class="font-bold text-lg border-b pb-2">4. Lampirkan Bukti</h3>
        <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50">
          <input type="file" id="pilih-file" name="bukti" class="hidden" required>
          <label for="pilih-file" class="cursor-pointer">
            <span class="text-4xl block mb-2">📸</span>
            <span class="text-sm font-medium text-blue-600">Klik untuk upload foto atau dokumen</span>
            <p class="text-xs text-gray-400 mt-1">Maksimal file 5MB (JPG, PNG, PDF)</p>
          </label>
        </div>
      </div>

      <div class="bg-gray-50 p-6 rounded-2xl space-y-4 border border-gray-100">
        <h3 class="font-bold text-md text-gray-700">Opsi Tambahan: Apakah kamu bersedia dihubungi?</h3>
        <p class="text-xs text-gray-500">Kami sangat menghormati jika kamu ingin tetap anonim.</p>
        <div class="flex flex-col gap-3">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="radio" name="anonim" value="ya" class="w-4 h-4 text-blue-600" checked>
            <span class="text-sm italic text-gray-600">"Tidak, saya ingin tetap anonim sepenuhnya"</span>
          </label>
          <label class="flex flex-col gap-2">
            <div class="flex items-center gap-3 cursor-pointer">
              <input type="radio" name="anonim" value="tidak" class="w-4 h-4 text-blue-600">
              <span class="text-sm">"Ya, silakan hubungi saya di:"</span>
            </div>
            <input type="text" name="kontak_pengirim" placeholder="ID LINE / No. WhatsApp" class="ml-7 p-2 rounded-lg border border-gray-200 text-sm outline-none focus:ring-2 focus:ring-blue-400">
          </label>
        </div>
      </div>

      <button type="submit" class="w-full bg-blue-900 text-white py-4 rounded-2xl font-bold text-lg shadow-lg hover:bg-blue-800 transform hover:-translate-y-1 transition-all">
        Kirim Laporan ❤️‍🩹
      </button>
      <p class="text-center text-xs text-gray-400 mt-4 italic">Sekolah adalah tempat belajar yang aman. Kamu sudah melakukan hal yang benar.</p>
  </form>

  @if(session('success_report'))
<div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl">
        <div class="text-5xl mb-4">🎉</div>
        <h3 class="text-xl font-bold text-gray-800">Laporan Terkirim!</h3>
        <p class="text-sm text-gray-500 mt-2">Simpan kode di bawah ini untuk memantau status laporanmu secara anonim:</p>
        
        <div class="bg-blue-50 border-2 border-dashed border-blue-200 rounded-2xl p-4 my-5">
            <span class="text-2xl font-mono font-bold text-blue-900 tracking-widest">
                {{ session('success_report') }}
            </span>
        </div>

        <button onclick="this.parentElement.parentElement.remove()" class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold">
            Saya Sudah Mencatatnya
        </button>
    </div>
</div>
@endif
</section>
@endsection