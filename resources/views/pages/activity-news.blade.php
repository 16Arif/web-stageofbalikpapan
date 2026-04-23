<x-layouts.app>
    <x-slot:title>Berita & Aktivitas - Stageof Balikpapan</x-slot:title>

    <section class="bg-white pt-16 pb-8 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-indigo-600 font-bold uppercase tracking-[0.2em] text-xs mb-3">Update Terkini</h2>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">Berita & <span
                            class="text-indigo-600">Aktivitas</span></h1>
                    <p class="mt-4 text-slate-500 text-lg">Liputan kegiatan harian, sosialisasi, dan informasi penting
                        dari Stasiun Geofisika Balikpapan.</p>
                </div>

                <div class="flex flex-wrap gap-2 pb-2">
                    <a href="#"
                        class="px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-bold shadow-md transition">Semua</a>
                    <a href="#"
                        class="px-4 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 text-xs font-bold border border-slate-200 transition">Sosialisasi</a>
                    <a href="#"
                        class="px-4 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 text-xs font-bold border border-slate-200 transition">Edukasi</a>
                    <a href="#"
                        class="px-4 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 text-xs font-bold border border-slate-200 transition">Internal</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-slate-50 relative isolate">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-100 to-white" />

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                @php
                    // Simulasi Data Berita
                    $news = [
                        [
                            'title' => 'Kunjungan Edukasi Siswa SMA ke Ruang Operasional',
                            'excerpt' =>
                                'Puluhan siswa antusias mempelajari cara kerja sensor seismograf dan sistem peringatan dini tsunami...',
                            'category' => 'Edukasi',
                            'date' => '24 Maret 2026',
                            'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=800',
                        ],
                        [
                            'title' => 'Pemeliharaan Rutin Jaringan SeisComP3 wilayah Kaltim',
                            'excerpt' =>
                                'Tim teknis memastikan seluruh jaringan komunikasi data gempa tetap stabil menjelang musim penghujan...',
                            'category' => 'Teknis',
                            'date' => '20 Maret 2026',
                            'img' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=800',
                        ],
                        [
                            'title' => 'Koordinasi Mitigasi Bencana Geofisika di Wilayah IKN',
                            'excerpt' =>
                                'BMKG terus berperan aktif dalam memberikan rekomendasi keselamatan bangunan terhadap potensi guncangan...',
                            'category' => 'Sosialisasi',
                            'date' => '15 Maret 2026',
                            'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800',
                        ],
                    ];
                @endphp

                @foreach ($news as $article)
                    <article
                        class="group flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-slate-200 hover:border-indigo-300 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div class="aspect-[16/10] overflow-hidden relative">
                            <img src="{{ $article['img'] }}" alt="Berita"
                                class="size-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur text-[10px] font-black uppercase tracking-widest text-indigo-600 rounded-full shadow-sm italic">
                                    {{ $article['category'] }}
                                </span>
                            </div>
                        </div>

                        <div class="p-8 flex flex-col grow">
                            <div
                                class="flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-tighter mb-4">
                                <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $article['date'] }}
                            </div>

                            <h3
                                class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors leading-tight mb-4">
                                <a href="#">{{ $article['title'] }}</a>
                            </h3>

                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ $article['excerpt'] }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-slate-50">
                                <a href="#"
                                    class="inline-flex items-center gap-2 text-xs font-black text-slate-900 uppercase tracking-widest hover:text-indigo-600 transition">
                                    Baca Selengkapnya
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach

            </div>

            <div class="mt-16 text-center">
                <button
                    class="px-8 py-4 bg-white border border-slate-200 rounded-2xl text-sm font-black text-slate-900 hover:bg-slate-50 transition shadow-sm">
                    Tampilkan Berita Lainnya
                </button>
            </div>
        </div>
    </section>
</x-layouts.app>
