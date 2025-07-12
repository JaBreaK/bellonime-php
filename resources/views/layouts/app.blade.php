<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bellonime')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-200">

    {{-- Panggil file navbar.blade.php --}}
    @include('layouts.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Panggil file footer.blade.php --}}
    @include('layouts.footer')

</body>
</html>