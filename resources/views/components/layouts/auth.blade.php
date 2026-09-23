<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bmkg2.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-bmkg2.png') }}">
    
    <title>{{ $title ?? 'Masuk - Layanan Data Stasiun Geofisika Balikpapan' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="h-full bg-slate-50 font-sans text-slate-800 antialiased selection:bg-blue-600 selection:text-white">
    <main class="h-full">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
