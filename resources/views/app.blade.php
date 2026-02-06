<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BK Care</title>
    
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 pb-24 overflow-hidden"> 

    <main class="p-4">
        

        @yield('content')
    </main>

    <div class="pb-24 z-100">
      @include('partials.navbar')
    </div>
    

</body>
</html>