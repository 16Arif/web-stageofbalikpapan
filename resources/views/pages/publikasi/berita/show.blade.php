<x-layouts.app>
    <x-slot:hasCustomMeta>true</x-slot:hasCustomMeta>

    @push('meta')
        {{-- SEO Meta Tags Standar --}}
        <title>{{ $berita->judul }} | UPT Stasiun Geofisika Balikpapan</title>
        <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 150) }}">

        {{-- Open Graph Meta Tags (Untuk WhatsApp, Facebook, Telegram) --}}
        <meta property="og:title" content="{{ $berita->judul }}">
        <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 150) }}">
        <meta property="og:image" content="{{ $berita->thumbnail_url }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">

        {{-- Twitter Card (Untuk X / Twitter) --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $berita->judul }}">
        <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 150) }}">
        <meta name="twitter:image" content="{{ $berita->thumbnail_url }}">
    @endpush

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-8 pb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-700">
            <li>
                <a href="/" class="hover:text-blue-600 hover:underline transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Publikasi</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <a href="{{ route('berita.index') }}" class="hover:text-blue-600 hover:underline transition-colors">Berita</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Detail Berita</span>
                </div>
            </li>
        </ol>
    </div>

    <div class="bg-white py-8 md:py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <a href="{{ route('berita.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 mb-8 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Berita
            </a>
            
            <header class="mb-10">
                <div class="flex items-center gap-3 text-sm mb-4">
                    <span class="font-bold text-indigo-600 uppercase tracking-widest">Berita</span>
                    <span class="text-slate-300">&bull;</span>
                    <span class="text-slate-500 font-medium flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $berita->published_at ? $berita->published_at->translatedFormat('d F Y, H:i') : 'Draft' }}
                    </span>
                    <span class="text-slate-300">&bull;</span>
                    <span class="text-slate-500 font-medium flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ number_format($berita->views_count, 0, ',', '.') }} kali dilihat
                    </span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6">{{ $berita->judul }}</h1>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                        {{ substr($berita->penulis, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $berita->penulis }}</p>
                        <p class="text-xs text-slate-500">Penulis</p>
                    </div>
                </div>
            </header>

            @if($berita->thumbnail_url)
                <figure class="mb-10 rounded-3xl overflow-hidden shadow-lg border border-slate-100">
                    <img src="{{ $berita->thumbnail_url }}" alt="{{ $berita->judul }}" class="w-full h-auto object-cover">
                </figure>
            @endif

            <article class="prose prose-slate prose-indigo max-w-none lg:prose-lg">
                {!! $berita->konten !!}
            </article>
        </div>

        @if(count($beritaLainnya) > 0)
            <div class="max-w-6xl mx-auto px-6 lg:px-8 mt-16 pt-16 border-t border-slate-100">
                <h3 class="text-2xl font-black text-slate-900">Berita Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    @foreach($beritaLainnya as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="group bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 flex flex-col">
                            <div class="h-48 bg-slate-100 relative overflow-hidden shrink-0">
                                @if($item->thumbnail_url)
                                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}" class="object-cover w-full h-48 rounded-t-lg transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-slate-800 flex items-center justify-center rounded-t-lg text-white/30 text-xs">
                                        BMKG
                                    </div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <span class="text-xs font-semibold text-slate-400 mb-2 block">{{ $item->published_at ? $item->published_at->translatedFormat('d F Y') : 'Draft' }}</span>
                                <h4 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">{{ $item->judul }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
