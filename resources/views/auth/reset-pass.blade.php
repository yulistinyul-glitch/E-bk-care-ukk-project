<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reset your password</title>
   @vite('resources/css/app.css')
</head>
<body class="">
  <div class="min-h-screen flex items-center justify-center p-6" 
     style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">
    
    <div class="w-full max-w-md md:max-w-4xl flex flex-col md:flex-row md:gap-16 items-center p-4 md:p-8 md:border-2 md:border-white/40 md:rounded-[40px] md:backdrop-blur-sm ">
        
        <div class="text-center mb-5 md:mb-0 md:flex-1 flex flex-col justify-center ">
            <h1 class="text-[#1A374D] text-4xl md:text-5xl font-bold mb-4 uppercase">Reset your password</h1>
            <p class="text-white text-xl font-medium leading-tight px-10">
                 Don't forget your new password!🧠 <br> Make sure to keep it somewhere safe so you won't need to reset it again later.
            </p>
        </div>

        <div class="bg-white w-full md:flex-1 p-8 md:p-10 rounded-[40px] shadow-3xl md:shrink-0">
          

            <form action="#" class="space-y-6">
                <div>
                    <label class="block text-black font-bold mb-2 ml-1">New Passwors</label>
                    <input type="text" 
                           class="w-full px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="type your new password here">
                </div>

                <div class="relative">
                    <label class="block text-black font-bold mb-2 ml-1">Password</label>
                    <input type="password" 
                           class="w-full px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Repeat your password">
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-3xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-lg">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>