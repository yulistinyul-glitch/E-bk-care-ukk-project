@extends('partials.app')

@section('content')

<div class="min-h-screen bg-gray-50 flex justify-center items-start pb-20">
  <div class="w-full bg-white min-h-screen shadow-lg overflow-hidden relative font-sans">
    
     <div class="relative h-64 md:h-56 bg-[#1e3a52] flex justify-center items-center md:items-end overflow-hidden">
      <div class="absolute inset-0 opacity-20 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/school-supplies.png')]"></div>
      
       <div class="relative z-20 flex flex-col md:flex-row items-center md:items-end gap-0 md:gap-6 pb-0 lg:pb-10">
        <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden bg-gray-300 relative shrink-0">
          <img src="{{ Auth::user()->siswa->foto ? asset('storage/profile_siswa/' . Auth::user()->siswa->foto) : asset('img/guruProfile.jpg') }}" 
             class="w-full h-full object-cover">
          <div class="absolute top-2 right-4 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
        </div>

         <div class="hidden md:flex flex-col justify-end pb-1">
          <h1 class="text-xl font-bold text-white uppercase tracking-wide">
             {{ Auth::user()->siswa->nama_siswa ?? 'Nama siswa'}}
          </h1>
          <p class="text-blue-100 text-sm font-semibold mt-1">STUDENT</p>
          <p class="text-blue-100 font-bold mt-1">
            {{ Auth::user()->username }} / {{ Auth::user()->siswa->NISN ?? 'Tidak terdeteksi'}}
          </p>
          <button onclick="openEditPhotoModal()" class="underline text-sm mt-2 text-white">Edit profile🪄</button>
        </div>
      </div>

      <div class="md:hidden absolute bottom-0 w-full leading-0 ">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 80px; width: 100%;">
          <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
        </svg>
      </div>
    </div>

   <div class="text-center md:hidden mt-4">
      <h1 class="text-2xl font-bold text-[#1e3a52] uppercase tracking-wide">
        {{ Auth::user()->siswa->nama_siswa ?? 'Nama siswa'}}
      </h1>
      <p class="text-gray-500 text-sm font-semibold mt-1">STUDENT</p>
      <p class="text-[#1e3a52] font-bold mt-1">
        {{ Auth::user()->siswa->NIPD ?? 'Tidak terdeteksi'}} / {{ Auth::user()->siswa->NISN ?? 'Tidak terdeteksi'}}
      </p>
      <button onclick="openEditPhotoModal()" class="underline text-sm mt-2 text-blue-950">Edit profile🪄</button>
    </div>

    <div class="lg:ml-28 px-6 lg:px-10 py-6 max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6 items-stretch justify-center">
        
        <div class="w-full lg:w-1/2 flex flex-col">
            <h2 class="font-bold lg:text-2xl text-md uppercase text-[#1e3a52] mb-4 flex items-center gap-2">
                <span class="bg-[#1e3a52] w-2 h-8 rounded-full"></span>
                Biodata Siswa
            </h2>
            <div class="bg-[#1e3a52] rounded-3xl p-6 text-white shadow-xl grow flex flex-col justify-between border-2 border-[#a8cae6]/20">
                <div class="grid grid-cols-1 gap-4">
                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">NIS / NISN</span>
                        <p class="text-sm md:text-base font-semibold">
                            {{ Auth::user()->siswa->NIPD ?? 'Tidak terdeteksi'}} / {{ Auth::user()->siswa->NISN ?? 'tidak terdeteksi'}}
                        </p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Kelas</span>
                        <p class="text-sm md:text-base font-semibold">
                            {{ Auth::user()->siswa->kelas->nama_kelas ?? 'tidak terdeteksi'}}
                        </p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Jenis Kelamin</span>
                        <p class="text-sm md:text-base font-semibold">
                            {{ Auth::user()->siswa->JK}}
                        </p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Tempat, Tanggal Lahir</span>
                        <p class="text-sm md:text-base font-semibold">
                            {{ Auth::user()->siswa->tempat_lahir}}, {{Auth::user()->siswa->tanggal_lahir}}
                        </p>
                    </div>

                    <div class="group border-b border-gray-600 pb-2 transition-all hover:border-blue-400">
                        <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Alamat Lengkap</span>
                        <p class="text-sm md:text-base font-semibold leading-snug">
                            {{ Auth::user()->siswa->alamat ?? 'tidak terdeteksi'}}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="group border-b border-gray-600 pb-2">
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Wali Kelas</span>
                            <p class="text-xs md:text-sm font-semibold italic">
                                {{ Auth::user()->siswa->kelas->walikelas->nama_guru ?? 'tidak terdeteksi'}}
                            </p>
                        </div>
                        {{-- <div class="group border-b border-gray-600 pb-2">
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider">Nama Orang Tua</span>
                            <p class="text-xs md:text-sm font-semibold">MR. Edwards</p>
                        </div> --}}
                    </div>

                    <div class="flex gap-6 mt-2">
                        <div>
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider block">Phone</span>
                            <p class="text-sm font-semibold text-green-400">
                                +62-{{ Auth::user()->siswa->no_telp ?? 'Belum ada'}}
                            </p>
                        </div>
                        <div>
                            <span class="text-[10px] text-blue-300 font-bold uppercase tracking-wider block">Email</span>
                            <p class="text-sm font-semibold">
                                {{ Auth::user()->email}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col">
            <h2 class="font-bold lg:text-2xl text-md uppercase text-transparent mb-4 hidden lg:block select-none">Spacer</h2> <div class="bg-[#a8cae6] rounded-3xl p-6 shadow-xl grow flex flex-col border-2 border-white">
                <div class="flex justify-between items-start">
                    <h3 class="text-[#1e3a52] font-black text-xl md:text-2xl uppercase italic">Point Pelanggaran</h3>
                    <span class="bg-white/60 text-[#1e3a52] text-[10px] font-bold px-4 py-1 rounded-full border border-white uppercase shadow-sm">
                        {{ \Carbon\Carbon::now()->translatedFormat('F') }}
                    </span>
                </div>

                <p class="text-[#1e3a52] text-sm md:text-base italic text-center font-bold leading-tight mt-4 opacity-80">
                    "Setiap tindakan punya harga, pastikan kamu sanggup membayarnya."
                </p>

                <div class="flex flex-col items-center justify-center grow gap-4 mt-4">
                    <img src="{{ asset('img/img1.png') }}" alt="" class="h-24 md:h-32 object-contain drop-shadow-lg">
                    <label id="label-point" class="text-sm font-bold text-center px-4"></label>

                    <div class="w-full max-w-sm mx-auto p-4 bg-white/40 rounded-3xl border border-white shadow-inner">
                        <h2 class="text-center mb-4 text-[10px] font-bold text-slate-700 tracking-widest uppercase">Status Pelanggaran</h2>
                        <div class="relative w-full aspect-2/1 flex items-center justify-center">
                            <svg class="w-full h-full drop-shadow-sm" viewBox="0 0 100 50">
                                <path d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke="#cbd5e1" stroke-width="8" stroke-linecap="round" />
                                <path id="progress-bar" d="M 10 50 A 40 40 0 0 1 90 50" fill="none" stroke-width="8" stroke-linecap="round" stroke-dasharray="0 125" class="transition-all duration-1000 ease-out" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-end pb-1">
                                <span id="point-text" class="text-xl md:text-3xl font-black text-slate-800 leading-none">{{ Auth::user()->siswa->total_poin ?? 0 }}/100</span>
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
  <div id="editPhotoModal" class="fixed inset-0 z-999 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-[#1e3a52]/60 backdrop-blur-md" onclick="closeEditPhotoModal()"></div>

    <div id="modalContent" 
         class="relative bg-white w-full max-w-sm rounded-[3rem] shadow-2xl border-4 border-[#B1D0E0] overflow-hidden transform transition-all scale-90 opacity-0 duration-300">
        <div class="bg-[#1e3a52] p-8 text-center text-white">
            <h3 class="text-xl font-bold uppercase tracking-widest">Ganti Foto</h3>
            <p class="text-[10px] text-blue-200 mt-1 uppercase font-medium">Hanya foto profil yang bisa diubah</p>
        </div>
        @if(session('success'))
            <div class="fixed top-5 right-5 z-9999 bg-emerald-500 text-white px-6 py-3 rounded-2xl shadow-2xl font-bold animate-bounce">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="fixed top-5 right-5 z-9999 bg-red-500 text-white px-6 py-3 rounded-2xl shadow-2xl font-bold">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('siswa.update_foto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-8 flex flex-col items-center">
                <div class="w-32 h-32 rounded-full border-4 border-[#669FC9] overflow-hidden bg-gray-100 shadow-inner mb-6">
                    <img id="photoPreview" 
                         src="{{ Auth::user()->siswa->foto ? asset('storage/profile_siswa/' . Auth::user()->siswa->foto) : asset('img/guruProfile.jpg') }}" 
                         alt="Preview" class="w-full h-full object-cover">
                </div>

                <input type="file" name="foto" id="photoInput" class="hidden" accept="image/*" onchange="previewImage(event)">
                
                <label for="photoInput" class="cursor-pointer bg-[#669FC9] hover:bg-[#1A374D] text-white font-bold py-3 px-8 rounded-full transition-all shadow-lg active:scale-95 text-xs uppercase tracking-widest mb-2">
                    Pilih File Baru
                </label>
                <span class="text-[9px] text-gray-400 font-bold uppercase italic tracking-widest">Maksimal 2MB (JPG/PNG)</span>
            </div>

            <div class="p-6 bg-gray-50 flex gap-3 justify-center border-t border-gray-100">
                <button type="button" onclick="closeEditPhotoModal()" class="px-5 py-2 text-gray-400 font-bold text-[10px] uppercase hover:text-gray-600 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-8 py-2 bg-[#1e3a52] text-white rounded-full font-bold text-[10px] hover:bg-blue-900 transition-all shadow-md uppercase">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>  
     
{{-- css, js --}}
<style>
    @keyframes shake {
        0% { transform: translate(1px, 1px) rotate(0deg);}
        10 points { transform: translate(-1px, -2px) rotate(-1deg); }
        20% { transform: translate(-3px, 0px) rotate(1deg); }
        30% { transform: translate(3px, 2px) rotate(0deg); }
        40% { transform: translate(1px, -1px) rotate(1deg); }
        50% { transform: translate(-1px, 2px) rotate(-1deg); }
        60% { transform: translate(-3px, 1px) rotate(0deg); }
        70% { transform: translate(3px, 1px) rotate(-1deg); }
        80% { transform: translate(-1px, -1px) rotate(1deg); }
        90% { transform: translate(1px, 2px) rotate(0deg); }
        100% { transform: translate(1px, -2px) rotate(-1deg); }
    }

    .shake-danger{
        animation: shake 0.5s;
        animation-iteration-count: infinite;
    }
</style>

<script>
  const poinSiswa = {{ Auth::user()->siswa->total_poin ?? 0 }}; 
  
  const progressBar = document.getElementById('progress-bar');
  const pointsText = document.getElementById('point-text');
  const statusLabel = document.getElementById('status-label');
  const labelPoint = document.getElementById('label-point');
  const speedoContainer = progressBar.closest('svg'); 

  const displayPoin = poinSiswa > 100 ? 100 : poinSiswa;
  const strokeValue = (displayPoin * 125) / 100;
  
  setTimeout(() => {
    progressBar.setAttribute('stroke-dasharray', `${strokeValue} 125`);
  }, 300);

  if (poinSiswa <= 25) {
    progressBar.style.stroke = "#10b981"; 
    statusLabel.innerText = "Aman";
    statusLabel.className = "mt-1 text-[9px] font-black uppercase tracking-tighter px-3 py-0.5 rounded-full bg-white shadow-sm border text-emerald-600";
    labelPoint.innerText = "Pertahankan perilakumu yang baik ya! ✨";
  } 
  else if (poinSiswa <= 50) {
    progressBar.style.stroke = "#f59e0b"; 
    statusLabel.innerText = "Peringatan";
    statusLabel.className = "mt-1 text-[9px] font-black uppercase tracking-tighter px-3 py-0.5 rounded-full bg-white shadow-sm border text-amber-500";
    labelPoint.innerText = "Hati-hati, jangan ditambah lagi poinnya ya! 😰";
  } 
  else if (poinSiswa <= 80) {
    progressBar.style.stroke = "#f97316"; 
    statusLabel.innerText = "Waspada";
    statusLabel.className = "mt-1 text-[9px] font-black uppercase tracking-tighter px-3 py-0.5 rounded-full bg-white shadow-sm border text-orange-500";
    labelPoint.innerText = "Segera konsultasi dengan Guru BK sebelum terlambat! ⚠️";
  } 
  else {
    //(POIN > 80)
    progressBar.style.stroke = "#ef4444"; 
    statusLabel.innerText = "Bahaya";
    statusLabel.className = "mt-1 text-[9px] font-black uppercase tracking-tighter px-3 py-0.5 rounded-full bg-white shadow-sm border text-red-600";
    labelPoint.innerText = "Tolong perbaiki perilaku kamu, sanksi berat menanti! 😭";
    
    speedoContainer.classList.add('shake-danger');
  }

  pointsText.innerText = `${poinSiswa}/100`;

  function openEditPhotoModal() {
    const modal = document.getElementById('editPhotoModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        document.getElementById('modalContent').classList.remove('scale-90', 'opacity-0');
        document.getElementById('modalContent').classList.add('scale-100', 'opacity-100');
    }, 10);
  }

  function closeEditPhotoModal() {
    const modalContent = document.getElementById('modalContent');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-90', 'opacity-0');
    setTimeout(() => {
        document.getElementById('editPhotoModal').classList.replace('flex', 'hidden');
    }, 300);
  }

  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('photoPreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>



</div>
@endsection