{{-- Navbar & Hero Container --}}
<div class="relative w-full min-h-screen bg-cover bg-center bg-no-repeat overflow-hidden flex flex-col"
     style="background-image: url('{{ asset('img/hero.jpg') }}');">
    
    {{-- Overlay Blur --}}
    <div class="absolute inset-0 bg-white/40 backdrop-blur-[2px] z-0"></div>

    {{-- Desktop Header --}}
    <header class="hidden md:flex flex-col items-center justify-center bg-white/70 py-4 gap-4 relative z-50 shadow-sm">
        <button class="absolute top-5 right-6 px-6 py-2 text-white bg-[#1A374D] text-sm font-bold rounded-full hover:bg-blue-900 transition-colors">LOGIN</button>
        <div class="w-20 h-20 rounded-full bg-white border-2 border-blue-950 flex items-center justify-center shadow-md">
            <p class="text-center font-bold text-[#1A374D]">LOGO</p>
        </div>

        <nav class="flex gap-16 text-[#1A374D] font-bold text-lg">
            <a href="/" class="relative group">BERANDA<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span></a>
            <a href="/about" class="relative group">TENTANG KAMI<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span></a>
            <a href="/artikel" class="relative group">ARTIKEL<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span></a>
            <a href="/layanan" class="relative group">LAYANAN<span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#1A374D] transition-all duration-300 group-hover:w-full"></span></a>
        </nav>
    </header>

    {{-- Mobile Nav (Toggle & Sidebar) --}}
    <button id="menu-toggle" class="fixed top-5 left-5 z-[110] bg-blue-950 p-3 rounded-full text-white md:hidden">
        <svg id="icon-open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
        <svg id="icon-close" class="h-6 w-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
    </button>
    <div id="mobile-sidebar" class="fixed top-0 left-0 z-[100] h-screen p-6 bg-blue-950/95 backdrop-blur-md w-64 md:hidden transform -translate-x-full transition-transform duration-300 pt-24">
        <nav class="flex flex-col gap-6 text-white">
            <h3 class="text-2xl font-['Qwigley'] text-blue-200 border-b border-white/20 pb-4">E-BK CARE</h3>
            <a href="/" class="text-lg font-medium">BERANDA</a>
            <a href="/about" class="text-lg font-medium">TENTANG KAMI</a>
            <a href="/artikel" class="text-lg font-medium">ARTIKEL</a>
            <a href="/layanan" class="text-lg font-medium">LAYANAN</a>
        </nav>
    </div>

    {{-- Content Hero --}}
    <div class="relative z-10 flex-grow flex flex-col justify-center items-center text-center px-6 md:items-start md:text-left md:pl-20">
        <h1 class="text-5xl lg:text-7xl font-['Qwigley'] text-blue-950 leading-tight" data-aos="fade-right">
            Your safety is our priority,<br>Your voice is your power
        </h1>
        <p class="mt-4 text-[#1A374D] md:text-white font-['Poppins'] font-semibold text-base md:text-xl max-w-2xl drop-shadow-sm" data-aos="fade-up" data-aos-delay="200">
            We ensure that your identity remains strictly confidential while providing you the platform to speak up. You are never alone in this journey.
        </p>
        <a href="#artikel" id="btn-see-more" class="mt-8 px-8 py-3 border-2 border-[#1A374D] md:border-white rounded-full flex text-[#1A374D] md:text-white font-bold text-lg gap-3 items-center hover:bg-white hover:text-blue-950 transition-all duration-300">
            See more 
            <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </a>
    </div>
</div>

<script>
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggleBtn = document.getElementById('menu-toggle');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    let isMenuOpen = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
            
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            
            toggleBtn.classList.remove('left-5');
            toggleBtn.classList.add('left-[45%]', 'sm:left-[45%]'); 
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
            
            toggleBtn.classList.remove('left-[45%]', 'sm:left-[45%]');
            toggleBtn.classList.add('left-5');

            setTimeout(() => {
                if (!isMenuOpen) overlay.classList.add('hidden');
            }, 300);
        }
    }

    toggleBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);
</script>