<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choose Role - E-BK Care</title>
  @vite('resources/css/app.css')
</head>
<body class="antialiased">
  <div class="min-h-screen w-full flex items-center justify-center p-4 md:p-8" 
       style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">
    
    <div class="bg-white w-full max-w-[500px] p-6 sm:p-10 rounded-[30px] md:rounded-[40px] shadow-2xl">
        
        <h2 class="text-center text-2xl sm:text-3xl font-bold text-black mb-8 sm:mb-10">
          Choose your role
        </h2>

        <div class="space-y-4">
            
            <a href="{{route('login', 'Siswa')}}" 
               class="flex gap-6 w-full items-center justify-center bg-[#1A374D] text-white font-bold p-5 rounded-xl hover:bg-[#2c4e66] transition-all duration-300 ease-out hover:-translate-y-2 hover:shadow-lg active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 256 256">
                    <path fill="currentColor" d="m227.79 52.62l-96-32a11.85 11.85 0 0 0-7.58 0l-96 32A12 12 0 0 0 20 63.37a6 6 0 0 0 0 .63v80a12 12 0 0 0 24 0V80.65l23.71 7.9a67.92 67.92 0 0 0 18.42 85A100.36 100.36 0 0 0 46 209.44a12 12 0 1 0 20.1 13.11C80.37 200.59 103 188 128 188s47.63 12.59 61.95 34.55a12 12 0 1 0 20.1-13.11a100.36 100.36 0 0 0-40.18-35.92a67.92 67.92 0 0 0 18.42-85l39.5-13.17a12 12 0 0 0 0-22.76Zm-99.79-8L186.05 64L128 83.35L70 64ZM172 120a44 44 0 1 1-81.06-23.71l33.27 11.09a11.9 11.9 0 0 0 7.58 0l33.27-11.09A43.85 43.85 0 0 1 172 120" />
                </svg>
                <span class="text-lg sm:text-xl">Login as Student</span>
            </a>

            <a href="{{route('login', 'GuruBK')}}" 
               class="flex gap-6 w-full items-center justify-center bg-[#406882] text-white font-bold p-5 rounded-xl hover:bg-[#1A374D] transition-all duration-300 ease-out hover:-translate-y-2 hover:shadow-lg active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 256 256">
                    <path fill="currentColor" d="M216 40H40a16 16 0 0 0-16 16v144a16 16 0 0 0 16 16h13.39a8 8 0 0 0 7.23-4.57a48 48 0 0 1 86.76 0a8 8 0 0 0 7.23 4.57H216a16 16 0 0 0 16-16V56a16 16 0 0 0-16-16M104 168a32 32 0 1 1 32-32a32 32 0 0 1-32 32m112 32h-56.57a64 64 0 0 0-13.16-16H192a8 8 0 0 0 8-8V80a8 8 0 0 0-8-8H64a8 8 0 0 0-8 8v96a8 8 0 0 0 6 7.75A63.7 63.7 0 0 0 48.57 200H40V56h176Z" />
                </svg>
                <span class="text-lg sm:text-xl">Login as Teacher</span>
            </a>

            <a href="{{route('login', 'Admin')}}" 
               class="flex gap-6 w-full items-center justify-center border-2 border-[#1A374D] text-[#1A374D] font-bold p-4 rounded-xl hover:bg-gray-100 transition-all active:scale-95">
                <span class="text-md">Login as Admin</span>
            </a>

        </div>
    </div>
  </div>
</body>
</html>