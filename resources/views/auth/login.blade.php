<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&family=Qwigley&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        button, a { cursor: pointer; }
        input[type="text"], input[type="password"] { cursor: text; }

        .tab-active { color: white !important; }
        .tab-inactive { color: #6b7280 !important; }

        @keyframes bounce {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        @keyframes shake {
            0%,100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .animate-bounce-slow { animation: bounce 1s infinite; }
        .animate-shake { animation: shake 0.4s; }
    </style>
</head>

<body class="font-['Poppins'] min-h-screen flex items-center justify-center p-4"
      style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">

<div class="w-full max-w-md md:max-w-4xl flex flex-col md:flex-row md:gap-16 items-center p-4 md:p-8 md:border-2 md:border-white/40 md:rounded-[40px] md:backdrop-blur-sm ">

    <div class="text-center mb-10 md:mb-0 md:flex-1 flex flex-col justify-center ">
        <h1 class="text-[#1A374D] text-4xl md:text-5xl font-bold mb-4 uppercase">Heloo!!</h1>
        <p class="text-white text-xl font-medium leading-tight px-10">
            make sure your username and password are correct okay!
        </p>
    </div>

    <div class="bg-white w-full max-w-95 shadow-2xl rounded-4xl p-8 md:p-10">

        <h2 class="text-3xl text-center text-[#1A374D] font-bold text-md mb-3">Login</h2>

        @if(!isset($isStepTwo))
        <div class="mb-8">
            <h4 class="text-gray-500 font-semibold text-[10px] uppercase tracking-widest mb-3 ml-1">Choose Your Role</h4>
            <div class="relative bg-gray-100 p-1 rounded-2xl flex items-center h-14 overflow-hidden">
                <div id="sliding-bg" class="absolute top-1 left-1 bottom-1 w-[calc(50%-4px)] bg-[#1A374D] rounded-xl transition-all duration-500 cubic-bezier(0.4, 0, 0.2, 1) shadow-lg"></div>
                <button onclick="switchRole('siswa')" id="btn-siswa" class="relative flex-1 z-10 text-sm font-bold tab-active">Siswa</button>
                <button onclick="switchRole('guru')" id="btn-guru" class="relative flex-1 z-10 text-sm font-bold tab-inactive">Guru BK</button>
            </div>
        </div>
        @endif

        <!-- 🔥 TAMBAHAN: ERROR BACKEND -->
        @if ($errors->any())
            <input type="hidden" id="loginError" value="{{ $errors->first() }}">
        @endif

        <div id="form-siswa" class="space-y-4 transition-all duration-300">
            @if($errors->any())
                <div id="errorAlert" class="bg-red-100 text-red-600 p-3 rounded-xl text-xs mb-2">{{ $errors->first() }}</div>
            @endif
            @if(session('success'))
                <div class="bg-green-100 text-green-600 p-3 rounded-xl text-xs mb-2">{{ session('success') }}</div>
            @endif

            <form action="{{ route('siswa.login.submit')}}" method="POST" autocomplete="off" novalidate>
                @csrf
                <input type="hidden" name="role" value="siswa">

                <div class="mb-4">
                    <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Full name / NIPD</label>
                    <input type="text" name="username" required placeholder="type username here" autocomplete="off" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                </div>

                <div class="mb-2">
                    <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Password (NIPD for first login)</label>
                    <input type="password" name="password" required placeholder="Your password" autocomplete="new-password" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                </div>

                <div class="mb-6 text-right">
                    <a href="{{ route('siswa.forgot-password') }}" class="text-xs text-[#1A374D] font-bold hover:underline">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-2xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-xl">Login as student</button>
            </form>
        </div>

        <div id="form-guru" class="hidden space-y-4 transition-all duration-300">
            <form action="{{ route('gurubk.login.submit')}}" method="POST" autocomplete="off" novalidate>
                @csrf
                <input type="hidden" name="role" value="guru">

                <div class="mb-4">
                    <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Username</label>
                    <input type="text" name="username" placeholder="Your NIP" autocomplete="off" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                </div>

                <div class="mb-6">
                    <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Password</label>
                    <input type="password" name="password" placeholder="Teacher password" autocomplete="new-password" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                </div>

                <button type="submit" class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-2xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-xl">Login as teacher</button>
            </form>
        </div>

        <div class="border-t mt-6 pt-4">
            <p class="text-center text-xs text-gray-400">
                © {{ date('Y') }} 
                <span class="font-semibold">{{ config('app.name') }}</span> — 
                {{ config('app.footer') }}
            </p>
        </div>

    </div>
</div>

<!-- MODAL -->
<div id="alertModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div id="modalBox" class="bg-white rounded-4xl w-[260px] h-[220px] flex flex-col items-center justify-center text-center shadow-xl p-6">
        <div id="modalIcon" class="text-5xl mb-3 animate-bounce-slow">⚠️</div>
        <h3 id="modalTitle" class="font-bold text-lg text-[#1A374D] mb-1">Oops!</h3>
        <p id="modalText" class="text-sm text-gray-500">Pesan error</p>
    </div>
</div>

<script>
// 🔥 ERROR DATABASE
window.addEventListener("DOMContentLoaded", function () {
    const error = document.getElementById("loginError");

    if (error && error.value !== "") {
        setTimeout(() => {
            showModal("❌", "Login Gagal!", error.value);
        }, 300);
    }
});

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

function showModal(icon, title, message) {
    document.getElementById("modalIcon").innerText = icon;
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalText").innerText = message;

    const modal = document.getElementById("alertModal");
    const box = document.getElementById("modalBox");

    modal.classList.remove("hidden");
    modal.classList.add("flex");

    box.classList.add("animate-shake");
    setTimeout(() => box.classList.remove("animate-shake"), 400);

    setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }, 2500);
}

document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function(e) {
        const username = form.querySelector("input[name='username']");
        const password = form.querySelector("input[name='password']");

        if (!username.value.trim() || !password.value.trim()) {
            e.preventDefault();
            showModal("⚠️", "Oops!", "Harap isi semua field.");
        }
    });
});

// auto hide alert
document.querySelectorAll("input").forEach(input => {
    input.addEventListener("input", () => {
        const alertBox = document.getElementById("errorAlert");
        if (alertBox) alertBox.style.display = "none";
    });
});
</script>

</body>
</html>