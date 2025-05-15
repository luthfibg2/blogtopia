<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('create_post')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <title>Blogtopia - BEST Project Test</title>
</head>
<body class="dark:bg-night-300 min-h-screen h-screen flex flex-col">
    @if (!Request::is('login') && !Request::is('signup') && !Route::is('content.create')) 
        @include('components.top-nav')
    @endif
    <div class="flex-grow items-center justify-center flex">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
</body>
</html>