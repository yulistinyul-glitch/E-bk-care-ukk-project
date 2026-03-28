<div class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-md z-50 lg:hidden">
    <nav class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-[0_8px_32px_0_rgba(31,38,135,0.15)] rounded-[2.5rem] p-2 flex justify-around items-center h-16 transition-all duration-500">
        
        <a href="{{ route('siswa.history') }}" 
           class="relative flex flex-col items-center justify-center w-12 h-12 rounded-2xl transition-all duration-300 {{ request()->routeIs('siswa.history') ? 'text-[#1A374D] -translate-y-1' : 'text-slate-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            @if(request()->routeIs('siswa.history'))
                <span class="absolute -bottom-1 w-1 h-1 bg-[#1A374D] rounded-full"></span>
            @endif
        </a>

        <a href="{{ route('siswa.home') }}" 
           class="relative flex items-center justify-center w-14 h-14 rounded-full transition-all duration-500 {{ request()->routeIs('siswa.home') ? 'bg-[#1A374D] text-white shadow-lg -translate-y-4 scale-110' : 'text-[#1A374D] bg-white/50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
        </a>

        <a href="{{ route('siswa.profile') }}" 
           class="relative flex flex-col items-center justify-center w-12 h-12 rounded-2xl transition-all duration-300 {{ request()->routeIs('siswa.profile') ? 'text-[#1A374D] -translate-y-1' : 'text-slate-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            @if(request()->routeIs('siswa.profile'))
                <span class="absolute -bottom-1 w-1 h-1 bg-[#1A374D] rounded-full"></span>
            @endif
        </a>

    </nav>
</div>

{{-- side bar --}}

<div class="hidden lg:flex fixed top-1/2 -translate-y-1/2 left-6 z-50">
  <aside id="sidebar-container" 
       class="py-4 px-3 rounded-4xl flex flex-col items-center border border-white/40 shadow-[0_8px_32px_0_rgba(31,38,135,0.15)] bg-white/60 backdrop-blur-xl transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] w-[72px] overflow-hidden group-sidebar"
       style="max-height: 80px;">
    
    <button id="logo-trigger" 
            class="relative flex-shrink-0 bg-[#1A374D] rounded-2xl w-12 h-12 shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-105 active:scale-95 z-20 focus:outline-none group">
        <div id="trigger-icon" class="text-white transition-transform duration-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12" id="line1"></line>
                <line x1="3" y1="6" x2="21" y2="6" id="line2"></line>
                <line x1="3" y1="18" x2="21" y2="18" id="line3"></line>
            </svg>
        </div>
    </button>

    <nav id="nav-content" 
         class="flex flex-col gap-4 mt-8 opacity-0 pointer-events-none transition-all duration-300 w-full items-center">
        
        <div class="relative group/item flex items-center justify-center w-full">
            <a href="{{ route('siswa.home')}}" 
               class="p-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('siswa.home') ? 'bg-[#1A374D] text-white shadow-md' : 'text-[#1A374D] hover:bg-white/50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </a>
            <span class="absolute left-16 scale-0 group-hover/item:scale-100 transition-all origin-left bg-[#1A374D] text-white text-[10px] font-bold px-3 py-1.5 rounded-xl shadow-xl whitespace-nowrap z-[60]">Beranda</span>
        </div>

        <div class="relative group/item flex items-center justify-center w-full">
            <a href="{{ route('siswa.profile')}}" 
               class="p-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('siswa.profile') ? 'bg-[#1A374D] text-white shadow-md' : 'text-[#1A374D] hover:bg-white/50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
            <span class="absolute left-16 scale-0 group-hover/item:scale-100 transition-all origin-left bg-[#1A374D] text-white text-[10px] font-bold px-3 py-1.5 rounded-xl shadow-xl whitespace-nowrap z-[60]">Profil Saya</span>
        </div>

        <div class="relative group/item flex items-center justify-center w-full">
            <a href="{{ route('siswa.history')}}" 
               class="p-3 rounded-2xl transition-all duration-300 {{ request()->routeIs('siswa.history') ? 'bg-[#1A374D] text-white shadow-md' : 'text-[#1A374D] hover:bg-white/50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </a>
            <span class="absolute left-16 scale-0 group-hover/item:scale-100 transition-all origin-left bg-[#1A374D] text-white text-[10px] font-bold px-3 py-1.5 rounded-xl shadow-xl whitespace-nowrap z-[60]">Riwayat</span>
        </div>

        <div class="h-px w-8 bg-[#1A374D]/10 my-2"></div>

        <div class="relative group/item flex items-center justify-center w-full">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" 
               class="p-3 rounded-2xl transition-all duration-300 text-red-500 hover:bg-red-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </a>
            <span class="absolute left-16 scale-0 group-hover/item:scale-100 transition-all origin-left bg-red-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-xl shadow-xl whitespace-nowrap z-[60]">Keluar</span>
        </div>
    </nav>
  </aside>
</div>

<form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>


<style>
nav a {
  -webkit-tap-highlight-color: transparent;
}

@keyframes slideUp{
  from{
    transform: translate(-50%, 100px);
    opacity: 0;
  }
  to {
    transform: translate(-50%, 0); opacity: 1;
  }
}

.fixed.bottom-6 {
  animation: : slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
}

@keyframes soft-bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-3px); }
}
.group:hover svg {
  animation: soft-bounce 0.5s ease infinite;
}
</style>

<script>
  const logoTrigger = document.getElementById('logo-trigger');
  const sidebarContainer = document.getElementById('sidebar-container');
  const navContent = document.getElementById('nav-content');
  const triggerIcon = document.getElementById('trigger-icon');

  logoTrigger.addEventListener('click', () => {
    const currentMaxHeight = sidebarContainer.style.maxHeight;

    if (currentMaxHeight === '80px' || currentMaxHeight === '') {
      sidebarContainer.style.maxHeight = '500px'; 
      sidebarContainer.classList.add('bg-white/80');
      
      triggerIcon.style.transform = 'rotate(90deg)';
      
      navContent.classList.remove('opacity-0', 'pointer-events-none');
      navContent.classList.add('opacity-100');
      setTimeout(() => {
          navContent.style.transform = 'translateY(0)';
      }, 50);
    } else {
      sidebarContainer.style.maxHeight = '80px';
      triggerIcon.style.transform = 'rotate(0deg)';
      
      navContent.classList.add('opacity-0', 'pointer-events-none');
      navContent.classList.remove('opacity-100');
      navContent.style.transform = 'translateY(20px)';
    }
  });
</script>