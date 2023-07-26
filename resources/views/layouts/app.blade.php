<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">

    <!-- Scripts -->
    @vite(['resources/front/css/app.css', 'resources/front/js/app.js'])

    @stack('styles')
</head>

<body>
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
