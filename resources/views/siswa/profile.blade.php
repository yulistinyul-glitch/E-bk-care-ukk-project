@extends('partials.app')

@section('content')

<div class="min-h-screen bg-gray-50 flex justify-center items-start pb-20">
  <div class="w-full bg-white min-h-screen shadow-lg overflow-hidden relative font-sans">
    
     <div class="relative h-64 md:h-56 bg-[#1e3a52] flex justify-center items-center md:items-end overflow-hidden">
      <div class="absolute inset-0 opacity-20 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/school-supplies.png')]"></div>
      
       <div class="relative z-20 flex flex-col md:flex-row items-center md:items-end gap-0 md:gap-6 pb-0 lg:pb-10">
        <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-gray-300 relative shrink-0">
          <img src="{{ asset('img/profile.jpg') }}" alt="Martin Edwards" class="w-full h-full object-cover">
          <div class="absolute top-2 right-4 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
        </div>

         <div class="hidden md:flex flex-col justify-end pb-1">
          <h1 class="text-xl font-bold text-white uppercase tracking-wide">Martin Edwards</h1>
          <p class="text-blue-100 text-sm font-semibold mt-1">STUDENT</p>
          <p class="text-blue-100 font-bold mt-1">0000123/23240001</p>
          <button onclick="openEditPhotoModal()" class="underline text-sm mt-2 text-white">Edit profile🪄</button>
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
      <button onclick="openEditPhotoModal()" class="underline text-sm mt-2 text-blue-950">Edit profile🪄</button>
    </div>

    <div class="lg:ml-28 px-6 lg:px-10 py-6 max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6 items-stretch justify-center">
        
        <div class="w-full lg:w-1/2 flex flex-col">
            <h2 class="font-bold lg:text-2xl text-md uppercase text-[#1e3a52] mb-4 flex items-center gap-2">
                <span class="bg-[#1e3a52] w-2 h-8 rounded-full"></span>
                Biodata Siswa
            </h2>
            <div class="bg-[#1e3a52] rounded-3xl p-6 text-white shadow-xl flex-grow flex flex-col justify-between border-2 border-[#a8cae6]/20">
                <div class="grid grid-cols-1 gap-4">
                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">NIS / NISN</span>
                        <p class="text-sm md:text-base font-semibold">0000123 / 23240001</p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Kelas</span>
                        <p class="text-sm md:text-base font-semibold">XII Teknik Informatika 1</p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Jenis Kelamin</span>
                        <p class="text-sm md:text-base font-semibold">Laki-laki</p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Tempat, Tanggal Lahir</span>
                        <p class="text-sm md:text-base font-semibold">Bandung, 12 Januari 2007</p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Alamat Lengkap</span>
                        <p class="text-sm md:text-base font-semibold leading-snug">Jl. Kenangan No. 40, Cileunyi, Jawa Barat</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="group border-b border-gray-600 pb-2">
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Wali Kelas</span>
                            <p class="text-xs md:text-sm font-semibold italic">Bpk. Neil aderson, S.Pd</p>
                        </div>
                        <div class="group border-b border-gray-600 pb-2">
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Nama Orang Tua</span>
                            <p class="text-xs md:text-sm font-semibold">MR. Edwards</p>
                        </div>
                    </div>

                    <div class="flex gap-6 mt-2">
                        <div>
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider block">Phone</span>
                            <p class="text-sm font-semibold text-green-400">+62 812-3456-7890</p>
                        </div>
                        <div>
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider block">Email</span>
                            <p class="text-sm font-semibold">martin.ed@student.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col">
            <h2 class="font-bold lg:text-2xl text-md uppercase text-transparent mb-4 hidden lg:block select-none">Spacer</h2> <div class="bg-[#a8cae6] rounded-3xl p-6 shadow-xl flex-grow flex flex-col border-2 border-white">
                <div class="flex justify-between items-start">
                    <h3 class="text-[#1e3a52] font-black text-xl md:text-2xl uppercase italic">Point Pelanggaran</h3>
                    <span class="bg-white/60 text-[#1e3a52] text-[10px] font-bold px-4 py-1 rounded-full border border-white uppercase shadow-sm">
                        Februari
                    </span>
                </div>

                <p class="text-[#1e3a52] text-sm md:text-base italic text-center font-bold leading-tight mt-4 opacity-80">
                    "Setiap tindakan punya harga, pastikan kamu sanggup membayarnya."
                </p>

                <div class="flex flex-col items-center justify-center flex-grow gap-4 mt-4">
                    <img src="{{ asset('img/img1.png') }}" alt="" class="h-24 md:h-32 object-contain drop-shadow-lg">
                    <label id="label-point" class="text-sm font-bold text-center px-4"></label>

                    <div class="w-full max-w-sm mx-auto p-4 bg-white/40 rounded-3xl border border-white shadow-inner">
                        <h2 class="text-center mb-4 text-[10px] font-bold text-slate-700 tracking-widest uppercase">Status Pelanggaran</h2>
                        <div class="relative w-full aspect-[2/1] flex items-center justify-center">
                            <svg class="w-full h-full drop-shadow-sm" viewBox="0 0 100 50">
                                <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#cbd5e1" stroke-width="8" stroke-linecap="round" />
                                <path id="progress-bar" d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke-width="8" stroke-linecap="round" stroke-dasharray="0 125" class="transition-all duration-1000 ease-out" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-end pb-1">
                                <span id="point-text" class="text-xl md:text-3xl font-black text-slate-800 leading-none">75/100</span>
                                <span id="status-label" class="mt-1 text-[9px] font-black uppercase tracking-tighter px-3 py-0.5 rounded-full bg-white shadow-sm border"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
      <div class="items-center justify-center flex mx-auto my-7 lg:hidden">
       <button class="text-md font-['Poppins'] text-red-500 bg-transparent p-4 rounded-full border-2 border-red-500 hover:border-white hover:text-white hover:bg-red-500">LOGOUT</button>
      </div>

    {{-- popup edit profile siswa --}}
    <section id="editPhotoModal" class="fixed inset-0 z-100 hidden items-center justify-center p-4">
      <div class="absolute inset-0 backdrop-blur-sm shadow-inner bg-[#1e3a52]/40 rounded-2xl"></div>

      <div class="relative bg-white w-full max-w-sm rounded-2xl shadow-2xl border-2 overflow-hidden transform transition-all scale-300" id="modalContent">
        <h3 class="text-xl font-bold uppercase tracking-wider">Edit Profile</h3>
        <p class="text-xs text-blue-300 mt-1 italic">Hanya foto yang bisa diubah</p>

        <button onclick="closedEdit()" class="absolute top-4 right-6 text-white/50 hover:text-white transition-colors text-2xl font-bold">
        &times;
      </button>
      </div>

      <div class="p-8 flex flex-col items-center">
            <div class="relative group">
                <div class="w-32 h-32 rounded-full border-4 border-[#669FC9] overflow-hidden bg-gray-100 shadow-md">
                    <img id="photoPreview" src="https://via.placeholder.com/150" alt="Preview" class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black/20 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            <input type="file" id="photoInput" class="hidden" accept="image/*" onchange="previewImage(event)">
            
            <label for="photoInput" class="mt-6 cursor-pointer bg-[#669FC9] hover:bg-[#1A374D] text-white font-bold py-2 px-6 rounded-full transition-all shadow-lg active:scale-95 text-sm uppercase tracking-widest">
                Pilih Foto Baru
            </label>

            <p class="mt-4 text-[10px] text-gray-400 text-center uppercase font-bold italic tracking-tighter">Format: JPG, PNG (Max 2MB)</p>
        </div>

        <div class="p-6 bg-gray-50 flex gap-3 justify-center">
            <button onclick="closeEditPhotoModal()" class="px-6 py-2 border-2 border-gray-300 text-gray-500 rounded-full font-bold text-xs hover:bg-gray-100 transition-all uppercase tracking-widest">
                Batal
            </button>
            <button class="px-6 py-2 bg-[#1e3a52] text-white rounded-full font-bold text-xs hover:bg-blue-900 transition-all shadow-lg uppercase tracking-widest">
                Simpan Perubahan
            </button>
        </div>
    </div>

    </section>
       

    <script>
  
  const poinSiswa = 75; 
  
  const progressBar = document.getElementById('progress-bar');
  const pointsText = document.getElementById('points-text');
  const statusLabel = document.getElementById('status-label');
  const labelPoint = document.getElementById('label-point');

  
  const strokeValue = (poinSiswa * 125) / 100;
  progressBar.setAttribute('stroke-dasharray', `${strokeValue} 125`);


  if (poinSiswa <= 25) {
    progressBar.style.stroke = "#10b981"; // Hijau (Aman)
    statusLabel.innerText = "Aman";
    statusLabel.className = "text-sm font-semibold text-emerald-600 uppercase";
    labelPoint.innerText = "Jangan di ulangi lagi ya🫤!";
    labelPoint.className = "text-sm md:text-base font-bold text-slate-800 opacity-90 text-center ";
  } else if (poinSiswa <= 50) {
    progressBar.style.stroke = "#f59e0b"; // Kuning (Peringatan)
    statusLabel.innerText = "Peringatan";
    statusLabel.className = "text-sm font-semibold text-amber-500 uppercase";
    labelPoint.innerText = "Segera konsultasi dengan guru BK ya😰!";
    labelPoint.className = "text-sm md:text-base font-bold text-slate-800 opacity-90 text-center ";
  } else {
    progressBar.style.stroke = "#ef4444"; // Merah (Bahaya)
    statusLabel.innerText = "Bahaya";
    statusLabel.className = "text-sm font-semibold text-red-600 uppercase";
    labelPoint.innerText = "Tolong perbaiki perilaku kamu, jangan sampai kena sanksi yang lebih berat ya😭!";
    labelPoint.className = "text-sm md:text-base font-bold text-slate-800 opacity-90 text-center ";
  }

  pointsText.innerText = `${poinSiswa}/100`;

  // Fungsi untuk membuka modal edit foto
  const modal = document.getElementById('editPhotoModal');
  const modalContent = document.getElementById('modalContent');
  const photoPreview = document.getElementById('photoPreview'); 

  function openEditPhotoModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
      modalContent.classList.remove('scale-95', 'opacity-0');
      modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
  }

  function closeEditPhotoModal() {
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
      modal.classList.remove('flex');
      modal.classList.add('hidden');
    }, 300);
  }

  function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        photoPreview.src = e.target.result;
      }
      reader.readAsDataURL(file);
    }
  } 

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      closeEditPhotoModal();
    }
  });
</script>



</div>
@endsection