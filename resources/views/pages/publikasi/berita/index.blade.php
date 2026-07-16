<x-layouts.app>
    <x-slot:title>Berita Terkini - Stageof Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-slate-950 py-16 md:py-24">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/20 to-sky-500/20" />
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-sm mb-4">Publikasi</h2>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Berita <span class="text-indigo-500">Terkini</span></h1>
            <p class="mt-6 text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Informasi dan aktivitas terbaru dari Pusat Gempa Regional XI Stasiun Geofisika Balikpapan.
            </p>
        </div>
    </section>

    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($beritaList as $berita)
                    <a href="{{ route('publikasi.berita.show', $berita->slug) }}" class="group bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
                        <div class="aspect-video bg-slate-100 relative overflow-hidden">
                            @if($berita->gambar_thumbnail)
                                <img src="{{ asset('storage/' . $berita->gambar_thumbnail) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-slate-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20M12 16v-4m0 0l-2 2m2-2l2 2" /></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Berita</span>
                                <span class="text-slate-300">&bull;</span>
                                <span class="text-xs font-medium text-slate-500">{{ $berita->published_at ? $berita->published_at->translatedFormat('d M Y') : 'Draft' }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $berita->judul }}</h3>
                            <p class="mt-3 text-sm text-slate-600 line-clamp-3">
                                {{ Str::limit(strip_tags($berita->konten), 120) }}
                            </p>
                            <div class="mt-auto pt-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                    {{ substr($berita->penulis, 0, 1) }}
                                </div>
                                <span class="text-xs font-medium text-slate-700">{{ $berita->penulis }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full p-12 text-center bg-white rounded-3xl border border-slate-200">
                        <p class="text-slate-500 font-medium">Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            @if($beritaList->hasPages())
                <div class="mt-16">
                    {{ $beritaList->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
