<x-layouts.app>
    <x-slot:title>Buletin Geofisika PGR XI - Stageof Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-slate-900 py-16 md:py-24">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/20 to-blue-800/20" />

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-sm mb-4">Publikasi Berkala</h2>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Buletin <span class="text-indigo-500">PGR
                    XI</span></h1>
            <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Kumpulan informasi aktivitas gempabumi dan petir di wilayah Pusat Gempa Regional XI yang diterbitkan
                secara berkala setiap bulan.
            </p>
        </div>
    </section>

    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-4">
                <div class="flex items-center gap-2 bg-white p-1 rounded-xl shadow-sm border border-slate-200">
                    <button
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold shadow-sm">Terbaru</button>
                    <button
                        class="px-4 py-2 text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-bold transition">2026</button>
                    <button
                        class="px-4 py-2 text-slate-600 hover:bg-slate-50 rounded-lg text-sm font-bold transition">2025</button>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" placeholder="Cari edisi buletin..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm text-sm">
                    <svg class="absolute left-3 top-3 size-4 text-slate-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @php
                    // Data Dummy untuk testing tampilan
                    $buletins = [
                        ['month' => 'Februari', 'year' => '2026', 'ver' => 'Edisi 02'],
                        ['month' => 'Januari', 'year' => '2026', 'ver' => 'Edisi 01'],
                        ['month' => 'Desember', 'year' => '2025', 'ver' => 'Edisi 12'],
                        ['month' => 'November', 'year' => '2025', 'ver' => 'Edisi 11'],
                        ['month' => 'Oktober', 'year' => '2025', 'ver' => 'Edisi 10'],
                    ];
                @endphp

                @foreach ($buletins as $item)
                    <div
                        class="group bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                        <div
                            class="aspect-[3/4] bg-slate-100 relative overflow-hidden flex items-center justify-center p-8">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/10 to-transparent"></div>
                            <div
                                class="w-full h-full border-4 border-white shadow-lg bg-indigo-900 rounded-lg flex flex-col items-center justify-center text-center p-4">
                                <span class="text-white/40 text-[8px] font-bold uppercase tracking-widest mb-2">BMKG PGR
                                    XI</span>
                                <p class="text-white text-xs font-black uppercase leading-tight">Buletin Geofisika</p>
                                <div class="my-4 h-px w-8 bg-indigo-400"></div>
                                <p class="text-indigo-300 text-[10px] font-bold">{{ $item['month'] }}
                                    {{ $item['year'] }}</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <span
                                class="text-[10px] font-bold text-indigo-600 uppercase tracking-tighter">{{ $item['ver'] }}</span>
                            <h3 class="text-slate-900 font-bold mt-1">Edisi {{ $item['month'] }} {{ $item['year'] }}
                            </h3>

                            <div class="mt-6">
                                <a href="#"
                                    class="flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-indigo-600 text-white py-3 rounded-2xl text-xs font-bold transition-colors group">
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Unduh PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="mt-16 flex justify-center">
                <nav class="flex items-center gap-2">
                    <a href="#"
                        class="size-10 flex items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition">
                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <span class="px-4 font-bold text-slate-900">1</span>
                    <a href="#"
                        class="size-10 flex items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition">
                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </section>

</x-layouts.app>
