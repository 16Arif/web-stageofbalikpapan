<x-layouts.app>
    <x-slot:title>{{ $berita->judul }} - Stageof Balikpapan</x-slot:title>

    <div class="bg-white py-12 md:py-20">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <a href="{{ route('publikasi.berita.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 mb-8 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar Berita
            </a>
            
            <header class="mb-10">
                <div class="flex items-center gap-3 text-sm mb-4">
                    <span class="font-bold text-indigo-600 uppercase tracking-widest">Berita</span>
                    <span class="text-slate-300">&bull;</span>
                    <span class="text-slate-500 font-medium flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ $berita->published_at ? $berita->published_at->translatedFormat('d F Y, H:i') : 'Draft' }}
                    </span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6">{{ $berita->judul }}</h1>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">
                        {{ substr($berita->penulis, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $berita->penulis }}</p>
                        <p class="text-xs text-slate-500">Penulis</p>
                    </div>
                </div>
            </header>

            @if($berita->gambar_thumbnail)
                <figure class="mb-10 rounded-3xl overflow-hidden shadow-lg border border-slate-100">
                    <img src="{{ asset('storage/' . $berita->gambar_thumbnail) }}" alt="{{ $berita->judul }}" class="w-full h-auto object-cover">
                </figure>
            @endif

            <article class="prose prose-slate prose-indigo max-w-none lg:prose-lg">
                {!! $berita->konten !!}
            </article>
        </div>
    </div>
</x-layouts.app>
