<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BK Care</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;900&family=Poppins:wght@400;500;600;700&family=Qwigley&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="bg-white m-0 p-0"> 

    <main>
        @yield('content')
    </main>

    <div class="fixed bottom-0 left-0 right-0 z-50">
        @include('partials.navbar')
    </div>
    

</body>
</html>