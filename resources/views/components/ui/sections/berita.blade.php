<section id="activity-news" class="relative isolate overflow-hidden bg-white py-24 sm:py-32">
    <x-ui.decoration.blur-bg position="top" color="from-cyan-200 to-indigo-300" />

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="max-w-2xl lg:mx-0">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-600">Publikasi</p>
                <h2 class="mt-3 text-4xl font-black tracking-tight text-gray-900 sm:text-5xl">Berita Terkini</h2>
                <p class="mt-4 text-lg leading-8 text-gray-500">
                    Informasi terkini mengenai kegiatan operasional, sosialisasi mitigasi, dan edukasi kebencanaan di
                    wilayah Balikpapan dan sekitarnya.
                </p>
            </div>
            <div class="shrink-0 mb-2">
                <a href="{{ route('publikasi.berita.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                    Lihat Semua Berita
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>

        <div
            class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-100 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @forelse($beritaList as $berita)
                <article class="flex max-w-xl flex-col items-start justify-between group">
                    <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="{{ $berita->published_at?->format('Y-m-d') }}"
                            class="text-gray-500 font-mono">{{ $berita->published_at?->translatedFormat('d M Y') }}</time>
                        <a href="{{ route('publikasi.berita.index') }}"
                            class="relative z-10 rounded-full bg-indigo-50 px-3 py-1.5 font-bold text-indigo-600 hover:bg-indigo-100 transition">
                            Berita
                        </a>
                    </div>
                    <div class="group relative grow">
                        <h3
                            class="mt-3 text-lg font-bold leading-6 text-gray-900 group-hover:text-indigo-600 transition line-clamp-2">
                            <a href="{{ route('publikasi.berita.show', $berita) }}">
                                <span class="absolute inset-0"></span>
                                {{ $berita->judul }}
                            </a>
                        </h3>
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                            {{ Str::limit(strip_tags($berita->konten), 120) }}
                        </p>
                    </div>
                    
                    <div class="relative mt-8 flex items-center gap-x-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold text-sm">
                            {{ substr($berita->penulis, 0, 1) }}
                        </div>
                        <div class="text-sm leading-6">
                            <p class="font-bold text-gray-900">
                                {{ $berita->penulis }}
                            </p>
                            <p class="text-gray-600">Penulis</p>
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="lg:col-span-3 rounded-[2rem] border border-slate-200 bg-slate-50 p-12 text-center shadow-sm">
                    <p class="text-slate-500">Belum ada berita atau aktivitas terbaru.</p>
                </div>
            @endforelse
        </div>
    </div>

    <x-ui.decoration.blur-bg position="bottom" color="from-blue-200 to-cyan-100" />
</section>
