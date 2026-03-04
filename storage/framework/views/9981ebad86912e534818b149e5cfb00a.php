<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&family=Qwigley&display=swap" rel="stylesheet">

   <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

</head>
<body class="font-['Poppins'] min-h-screen flex items-center justify-center p-4"
      style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">

      <div class="w-full mx-auto flex flex-col md:flex-row items-center md:gap-16 p-8 max-w-md md:max-w-4xl md:backdrop-blur-sm ">
        <h1 class="text-4xl font-bold text-blue-950">HELO ADMIN!!</h1>
        <div id="" class="bg-white p-8 w-full max-w-95 shadow-2xl items-center text-blue-950 rounded-3xl">
          <form action="<?php echo e(route('admin.login.submit')); ?>" method="POST">
            <?php echo csrf_field(); ?>
              <?php if(session('error')): ?>
                    <div class="text-red-500 text-sm text-center bg-red-100 p-2 rounded-xl">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
                <div class="mb-4">
                  <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Username</label>
                  <input type="text" name="username" placeholder="type your username" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                </div>
                <div class="mb-6">
                  <label class="text-gray-700 text-xs font-bold mb-1 block ml-1">Password</label>
                  <input type="password" name="password" placeholder="Admin password" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-50 focus:border-[#1A374D] focus:outline-none transition-all text-sm">
                </div>
                <button type="submit" class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-2xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-xl">
                  Login 
                </button>
          </form>
        </div>
      </div>
  
</body>
</html><?php /**PATH C:\Users\lenovo\E-bk-care-ukk-project\resources\views/auth/loginAdmin.blade.php ENDPATH**/ ?>