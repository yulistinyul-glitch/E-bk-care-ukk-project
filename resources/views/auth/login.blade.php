{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      max-width: 900px;
      width: 100%;
    }

    .login-card {
      border-radius: 30px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .btn-custom {
      background-color: #1A374D;
      color: white;
      border-radius: 30px;
      padding: 12px;
      font-weight: bold;
    }

    .btn-custom:hover {
      background-color: #2c4e66;
      color: white;
    }
  </style>
</head>
<body>

<div class="container login-container">
  <div class="row align-items-center">

    <div class="col-md-6 text-center text-md-start text-white mb-4 mb-md-0">
      <h1 class="fw-bold text-dark text-uppercase">Heloo!!</h1>
      <p class="fs-5">
        make sure your username and password are correct okay!
      </p>
    </div>

    <div class="col-md-6">
      <div class="card p-4 login-card">
        <h3 class="text-center fw-bold mb-4">Log in</h3>

        <form action="{{ route('login.process') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-bold">Username</label>
            <input type="text" name="username" class="form-control" placeholder="type your username here">
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password" class="form-control" placeholder="type your password here">
          </div>

          <div class="text-end mb-3">
            <a href="auth.forgot" class="text-muted small">Forgot password?</a>
          </div>

          <button type="submit" class="btn btn-custom w-100">
            Login
          </button>

        </form>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
   @vite('resources/css/app.css')
</head>
<body class="">
  <div class="min-h-screen flex items-center justify-center p-6" 
     style="background: linear-gradient(to bottom, #FFFFFF, #A9CCE7, #669FC9, #7BA0B4, #1A374D);">
    
    <div class="w-full max-w-md md:max-w-4xl flex flex-col md:flex-row md:gap-16 items-center p-4 md:p-8 md:border-2 md:border-white/40 md:rounded-[40px] md:backdrop-blur-sm ">
        
        <div class="text-center mb-5 md:mb-0 md:flex-1 flex flex-col justify-center ">
            <h1 class="text-[#1A374D] text-4xl md:text-5xl font-bold mb-4 uppercase">Heloo!!</h1>
            <p class="text-white text-xl font-medium leading-tight px-10">
                make sure your username and password are correct okay!
            </p>
        </div>

        <div class="bg-white w-full md:flex-1 p-8 md:p-10 rounded-[40px] shadow-3xl md:shrink-0">
            <h2 class="text-center text-3xl font-bold text-black mb-10">Log in</h2>

<form action="{{ route('login.process') }}" method="POST" class="space-y-6">
    @csrf

    <div>
        <label class="block text-black font-bold mb-2 ml-1">Username</label>
        <input type="text" 
               name="username"
               class="w-full px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:ring-2 focus:ring-blue-400"
               placeholder="type your username here">
    </div>

    <div class="relative">
        <label class="block text-black font-bold mb-2 ml-1">Password</label>
        <input type="password" 
               name="password"
               class="w-full px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:ring-2 focus:ring-blue-400"
               placeholder="type your password here">
        <div class="text-right mt-2">
            <a href="{{ route('password.request') }}" class="text-gray-400 text-sm hover:underline">
                Forgot password?
            </a>
        </div>
    </div>

    <div class="pt-4">
        <button type="submit" 
                class="w-full bg-[#1A374D] text-white font-bold py-4 rounded-3xl hover:bg-[#2c4e66] transition-all transform active:scale-95 shadow-lg">
            Login
        </button>
    </div>
</form>
        </div>
    </div>
</div>
</body>
</html>
