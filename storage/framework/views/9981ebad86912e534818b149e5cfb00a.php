<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

```
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

<style>
    button, a, input, label { cursor: pointer; }

    @keyframes bounce {
        0%,100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    @keyframes shake {
        0%,100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .animate-bounce-slow { animation: bounce 1s infinite; }
    .animate-shake { animation: shake 0.4s; }
</style>
```

</head>

<body class="font-['Poppins'] min-h-screen flex items-center justify-center p-4 bg-cover bg-center"
      style="background-image: url('<?php echo e(asset('img/admin.jpg')); ?>');">

```
<!-- Overlay -->
<div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

<div class="relative w-full max-w-3xl flex flex-col md:flex-row rounded-3xl overflow-hidden shadow-2xl bg-white/90 backdrop-blur">

    <!-- LEFT -->
<div class="relative w-full md:w-1/2 h-[350px] md:h-auto bg-gradient-to-br from-[#0f2027] via-[#3f6d7c] to-[#3e748b] text-white">
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-8">

        <img src="<?php echo e(asset('img/logo_ebk-careGold.png')); ?>" 
             class="w-14 h-14 rounded-xl shadow-lg border border-white/30 mb-4">

        <!-- TITLE -->
        <h1 class="text-md md:text-2xl font-bold leading-snug">
            Website Bimbingan <br> & Konseling
        </h1>

        <!-- GARIS -->
        <div class="w-20 h-[2px] bg-white/70 my-3 rounded-full"></div>

        <!-- PARAGRAF -->
        <p class="text-sm md:text-sm font-light italic text-white/80 leading-relaxed max-w-xs">
            “Solusi digital terintegrasi untuk mendukung perkembangan akademik 
            dan psikososial siswa.”
        </p>

    </div>
</div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 p-8 text-blue-950">

        <h2 class="text-2xl font-bold text-center mb-1 text-[#1A374D]">
            <?php echo e(config('app.name')); ?>

        </h2>

        <p class="text-center text-sm text-gray-400 mb-6">
            Login sebagai Admin
        </p>

        <form id="loginForm" action="<?php echo e(route('admin.login.submit')); ?>" method="POST" autocomplete="off">
            <?php echo csrf_field(); ?>

            <?php if($errors->has('username')): ?>
                <input type="hidden" id="loginError" value="<?php echo e($errors->first('username')); ?>">
            <?php endif; ?>

            <!-- Username -->
             <div class="mb-4">
                    <label class="text-xs font-bold mb-1 block">Username</label>
                    <input id="username" type="text" name="username"
                        placeholder="type your username"
                        autocomplete="new-username"
                        value=""
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none text-sm">
                </div>

                <div class="mb-6">
                    <label class="text-xs font-bold mb-1 block">Password</label>
                    <input id="password" type="password" name="password"
                        placeholder="Admin password"
                        autocomplete="new-password"
                        value=""
                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none text-sm">
                </div>

            <!-- Button -->
            <button type="submit" id="loginBtn"
                class="w-full flex items-center justify-center gap-2 bg-[#1A374D] text-white text-sm font-bold py-3 rounded-2xl hover:bg-[#2c4e66] transition-all duration-300 active:scale-95 shadow-lg">

                <span id="btnText">MASUK SEKARANG</span>

                <svg id="loadingIcon" class="hidden w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                    <path fill="white" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </button>

            <!-- Footer -->
            <div class="border-t mt-6 pt-4">
                <p class="text-center text-xs text-gray-400">
                    © <?php echo e(date('Y')); ?> 
                    <span class="font-semibold"><?php echo e(config('app.name')); ?></span> — 
                    <?php echo e(config('app.footer')); ?>

                </p>
            </div>

        </form>
    </div>
</div>

<!-- MODAL -->
<div id="alertModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div id="modalBox"
        class="bg-white rounded-4xl w-[280px] h-[240px] flex flex-col items-center justify-center text-center shadow-xl p-6">

        <div id="modalIcon" class="text-6xl mb-4 animate-bounce-slow">⚠️</div>
        <h3 id="modalTitle" class="font-bold text-xl text-[#1A374D] mb-2">Oops!</h3>
        <p id="modalText" class="text-sm text-gray-500">Pesan error</p>
    </div>
</div>

<script>
const form = document.getElementById("loginForm");

form.addEventListener("submit", function(e) {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!username || !password) {
        e.preventDefault();
        showModal("⚠️", "Oops!", "Silahkan isi username dan password.");
        return;
    }

    const btn = document.getElementById("loginBtn");
    const text = document.getElementById("btnText");
    const loading = document.getElementById("loadingIcon");

    if (btn.disabled) {
        e.preventDefault();
        return;
    }

    btn.disabled = true;
    text.innerText = "Loading...";
    loading.classList.remove("hidden");
    btn.classList.add("opacity-70", "cursor-not-allowed");
});

window.addEventListener("DOMContentLoaded", function () {
    const error = document.getElementById("loginError");

    if (error && error.value !== "") {
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";

        setTimeout(() => {
            showModal("❌", "Login Gagal!", error.value);
        }, 300);
    }
});

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

document.getElementById("alertModal").addEventListener("click", function(e) {
    if (e.target === this) {
        this.classList.add("hidden");
        this.classList.remove("flex");
    }
});
</script>
```

</body>
</html>
<?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/auth/loginAdmin.blade.php ENDPATH**/ ?>