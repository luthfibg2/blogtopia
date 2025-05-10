<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Blogtopia - BEST Project Test</title>
</head>
<body class="dark:bg-night-300 min-h-screen h-screen flex flex-col">
    @if (!Request::is('login') && !Request::is('signup') && !Request::is('/'))
        @include('components.top-nav')
    @endif
    <div class="flex-grow items-center justify-center flex">
        @if (Request::is('/'))
            <h1 class="text-5xl text-center font-extrabold tracking-[0.8rem] mb-5 uppercase text-steel-500">blogtopia</h1>
        @else
            @yield('content')
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>