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
                <a href="{{ route('berita.index') }}"
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
                <article class="flex max-w-xl flex-col items-start justify-between group bg-white rounded-3xl p-4 sm:p-5 border border-slate-100 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300">
                    <div class="w-full">
                        <!-- Thumbnail Gambar Berita -->
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-100 mb-5">
                            @if($berita->thumbnail_url)
                                <img src="{{ $berita->thumbnail_url }}" alt="{{ $berita->judul }}" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-slate-800 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20M12 16v-4m0 0l-2 2m2-2l2 2" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="bg-indigo-600/90 backdrop-blur-sm text-white text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full shadow-sm">Berita</span>
                            </div>
                        </div>

                        <!-- Tanggal & Kategori -->
                        <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $berita->published_at?->format('Y-m-d') }}"
                                class="text-gray-500 font-mono">{{ $berita->published_at?->translatedFormat('d M Y') ?? 'Baru' }}</time>
                            <span class="text-slate-300">&bull;</span>
                            <span class="text-indigo-600 font-semibold">Publikasi UPT</span>
                        </div>

                        <!-- Judul & Konten Ringkas -->
                        <div class="group relative mt-3">
                            <h3 class="text-lg font-bold leading-snug text-gray-900 group-hover:text-indigo-600 transition line-clamp-2">
                                <a href="{{ route('berita.show', $berita->slug) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $berita->judul }}
                                </a>
                            </h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-gray-600">
                                {{ Str::limit(strip_tags($berita->konten), 120) }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Penulis -->
                    <div class="relative mt-6 flex items-center gap-x-3 pt-4 border-t border-slate-100 w-full">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold text-xs shrink-0">
                            {{ strtoupper(substr($berita->penulis ?? 'B', 0, 1)) }}
                        </div>
                        <div class="text-xs leading-none min-w-0">
                            <p class="font-bold text-gray-900 truncate">{{ $berita->penulis ?? 'Stasiun Geofisika Balikpapan' }}</p>
                            <p class="text-[11px] text-gray-500 mt-0.5">Penulis</p>
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
