<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'E-Counseling - E-BK Care')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<style>
.font-montserrat {
  font-family: 'Montserrat', sans-serif;
}
.font-poppins {
  font-family: 'Poppins', sans-serif;
}
</style>
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
