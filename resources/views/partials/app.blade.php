<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BK Care</title>
    
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 m-0 p-0"> 

    <main>
        @yield('content')
    </main>

    <div class="fixed bottom-0 left-0 right-0 z-50">
        @include('partials.navbar')
    </div>
    

</body>
</html>