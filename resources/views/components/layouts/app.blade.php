<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-bmkg2.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-bmkg2.png') }}">
    <title>{{ $title ?? config('app.name') }}</title>
    @if(isset($description))
    <meta name="description" content="{{ $description }}">
    @endif
    @if(isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @endif

    <meta property="og:title" content="{{ $title ?? config('app.name') }}">
    @if(isset($description))
    <meta property="og:description" content="{{ $description }}">
    @endif
    @if(isset($image))
    <meta property="og:image" content="{{ $image }}">
    @endif
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="{{ isset($isArticle) && $isArticle ? 'article' : 'website' }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? config('app.name') }}">
    @if(isset($description))
    <meta name="twitter:description" content="{{ $description }}">
    @endif
    @if(isset($image))
    <meta name="twitter:image" content="{{ $image }}">
    @endif

    {{ $schema ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @keyframes seismogram-move {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .animate-seismogram {
            display: flex;
            width: 200%;
            /* Lebar dua kali lipat untuk looping */
            animation: seismogram-move 10s linear infinite;
        }
    </style>

    @livewireStyles
</head>

<body class="bg-white font-sans text-gray-900 antialiased">
    <x-ui.time-navigation />
    <x-ui.navigation />
    <main> {{ $slot }} </main>

    <x-ui.footer />
    @livewireScripts
</body>

</html>
<script>
    function clockComponent() {
        return {
            dateTimeString: 'Memuat waktu...',
            initClock() {
                this.updateTime();
                // Update setiap 1000ms (1 detik)
                setInterval(() => this.updateTime(), 1000);
            },
            updateTime() {
                const now = new Date();

                // Format Tanggal
                const date = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // Format Jam dengan Detik
                const time = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit', // Menambahkan detik
                    hour12: false
                }).replace(/\./g, ':'); // Mengubah semua titik menjadi titik dua

                // Format Jam UTC (Baru)
                const utcTime = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false,
                    timeZone: 'UTC' // Memaksa format ke UTC
                }).replace(/\./g, ':');

                // Menggabungkan semuanya ke dalam satu string
                this.dateTimeString = `${date} | ${time} WITA | ${utcTime} UTC`;
            }
        }
    }
</script>
