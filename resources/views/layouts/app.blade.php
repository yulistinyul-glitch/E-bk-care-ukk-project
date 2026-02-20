<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'E-Counseling - E-BK Care')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&family=Qwigley&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    /* Hindari !important pada .container jika temanmu pakai Bootstrap Grid */
    body, html {
      overflow-x: hidden;
      width: 100%;
    }

    .font-qwigley {
      font-family: 'Qwigley', cursive;
      display: inline-block;
    }
  </style>
</head>

<body>
  @include('layouts.navbar')

  <main>
    @yield('content')
  </main>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000, 
      once: true,     
    });
  </script>
</body>
</html>