<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Forget password</title>
   @vite('resources/css/app.css')
</head>
<body class="">
  <div class="min-h-screen flex items-center justify-center p-6" 
     style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">
    
    <div class="w-full max-w-md md:max-w-4xl flex flex-col md:flex-row md:gap-16 items-center p-4 md:p-8 md:border-2 md:border-white/40 md:rounded-[40px] md:backdrop-blur-sm">
        
        <div class="text-center mb-5 md:mb-0 md:flex-1">
            <h1 class="text-[#1A374D] text-4xl md:text-5xl font-bold mb-4">Create new password</h1>
            <p class="text-white text-lg font-medium leading-tight px-10">
                Don't forget your new password! 🧠 Make sure to keep it somewhere safe so you won't need to reset it again later.
            </p>
        </div>

        <div class="bg-white w-full md:flex-1 p-8 md:p-10 rounded-[40px] shadow-2xl">
            <h2 class="text-center text-3xl font-bold text-black mb-10">{{ $title }}</h2>

            <form action="{{ route('password.save')}}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id}}">
                <input type="hidden" name="type" value="{{ $type}}">

                @if ($type == 'first_login')
                    <div class="mb-4">
                        <label for="" class="block mb-2 font-bold text-gray-700 ">Email Aktif</label>
                        
                        <input type="email" name="email" required class="w-full p-3 rounded-xl border-2 border-black 
                                    focus:outline-none focus:ring-2 focus:ring-blue-400" 
                                    placeholder="Masukan email untuk pemulihan password">
                                    <p class="text-xs text-gray-400 mt-1">*Email ini akan digunakan jika kamu lupa password di kemudian hari</p>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-black font-bold mb-2 ml-1">New password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 mb-3 rounded-xl border-2 border-black focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Enter your new password">
                </div> 
                <div class="mb-6">       
                    <label class="block text-black font-bold mb-2 mt-4 ml-1">Confirm password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Repeat your password">
                </div>      
              


                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-3xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-lg">
                      Confirm Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>