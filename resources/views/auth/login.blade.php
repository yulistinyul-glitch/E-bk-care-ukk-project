
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&family=Qwigley&display=swap" rel="stylesheet">

   @vite('resources/css/app.css')


</head>
<body class="font-['Poppins'] min-h-screen flex items-center justify-center p-4"
      style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">

 <div class="w-full max-w-md md:max-w-4xl flex flex-col 
            md:flex-row md:gap-16 items-center p-4 md:p-8 md:border-2
           md:border-white/40 md:rounded-[40px] md:backdrop-blur-sm ">

     <div class="text-center mb-10 md:mb-0 md:flex-1 flex flex-col justify-center ">
        <h1 class="text-[#1A374D] text-4xl md:text-5xl font-bold mb-4 uppercase">Heloo!!</h1>
        <p class="text-white text-xl font-medium leading-tight px-10">
                make sure your username and password are correct okay!
        </p>
    </div>

     <div class="bg-white w-full max-w-95 shadow-2xl rounded-4xl p-8 md:p-10">
        <h2 class="text-3xl text-center text-[#1A374D] font-bold text-md mb-3">Login</h2>

        <div class="mb-8">
                <h4 class="text-gray-500 font-semibold text-[10px] uppercase tracking-widest mb-3 ml-1">Choose Your Role</h4>
                <div class="relative bg-gray-100 p-1 rounded-2xl flex items-center h-14 overflow-hidden">
                    <div id="sliding-bg" class="absolute top-1 left-1 bottom-1 w-[calc(50%-4px)] bg-[#1A374D] rounded-xl transition-all duration-500 cubic-bezier(0.4, 0, 0.2, 1) shadow-lg"></div>
                    
                    <button onclick="switchRole('siswa')" id="btn-siswa" class="relative flex-1 z-10 text-sm font-bold tab-active">
                        Siswa
                    </button>
                    <button onclick="switchRole('guru')" id="btn-guru" class="relative flex-1 z-10 text-sm font-bold tab-inactive">
                        Guru BK
                    </button>
                </div>
            </div>

            <div id="form-siswa" class="space-y-4 transition-all duration-300">
                <form action="#" method="POST">
                    <div class="mb-4">
                        <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Username Siswa</label>
                        <input type="text" placeholder="Full name as username" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                    </div>
                    <div class="mb-6">
                        <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">NIPD</label>
                        <input type="password" placeholder="Type your NIPD" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                    </div>
                    <button type="submit" class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-2xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-xl">
                        Login as student
                    </button>
                </form>
            </div>

            <div id="form-guru" class="hidden space-y-4 transition-all duration-300">
                <form action="#" method="POST">
                    <div class="mb-4">
                        <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Username</label>
                        <input type="text" placeholder="Your NIP" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                    </div>
                    <div class="mb-6">
                        <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Password</label>
                        <input type="password" placeholder="Teacher password" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                    </div>
                    <button type="submit" class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-2xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-xl">
                        Login as teacher
                    </button>
                </form>
            </div>

        </div>
      </div>  
          
  </div>

  {{-- style --}}
  <style>
    .tab-active { 
      color: white !important;
      transition: color 0.3s ease;
     }

     .tab-inactive {
      color: #6b7280 !important;
      transition: color 0.3s ease;
     }
  </style>

  {{-- js --}}
  <script>
        function switchRole(role) {
            const slidingBg = document.getElementById('sliding-bg');
            const btnSiswa = document.getElementById('btn-siswa');
            const btnGuru = document.getElementById('btn-guru');
            const formSiswa = document.getElementById('form-siswa');
            const formGuru = document.getElementById('form-guru');

            if (role === 'siswa') {
                
                slidingBg.style.transform = 'translateX(0)';
                
                
                btnSiswa.className = 'relative flex-1 z-10 text-sm font-bold tab-active';
                btnGuru.className = 'relative flex-1 z-10 text-sm font-bold tab-inactive';

                
                formSiswa.classList.remove('hidden');
                formGuru.classList.add('hidden');
            } else {
               
                slidingBg.style.transform = 'translateX(100%)';
                            
                btnSiswa.className = 'relative flex-1 z-10 text-sm font-bold tab-inactive';
                btnGuru.className = 'relative flex-1 z-10 text-sm font-bold tab-active';

                formSiswa.classList.add('hidden');
                formGuru.classList.remove('hidden');
            }
        }
    </script>
  
</body>
</html>