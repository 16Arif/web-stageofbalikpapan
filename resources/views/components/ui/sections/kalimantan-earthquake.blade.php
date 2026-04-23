<section id="gempa-kalimantan" class="relative isolate overflow-hidden bg-slate-900 py-24 sm:py-32">
    <x-ui.decoration.blur-bg position="top" color="from-orange-600/20 to-red-900/20" />

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-red-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000">
                </div>
                <div class="relative overflow-hidden rounded-[2rem] bg-slate-800 border border-slate-700 shadow-2xl">
                    <img src="{{ asset('build/assets/img/gempa2104.jpeg') }}" alt="Peta Guncangan Kalimantan"
                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105">

                    <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                        <div class="bg-slate-900/80 backdrop-blur-md border border-slate-700 p-3 rounded-xl">
                            <p
                                class="text-[10px] font-mono text-orange-400 uppercase tracking-tighter leading-none mb-1">
                                Koordinat Titik</p>
                            <p class="text-xs font-bold text-white">6.12 LU - 116.56 BT</p>
                        </div>
                        <span
                            class="bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-full animate-pulse uppercase"></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-500 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    Update Lokal: Kalimantan
                </div>

                <h2 class="text-3xl md:text-5xl font-black text-white leading-tight">
                    225 km Timur Laut <br>
                    <span class="text-orange-500">BDRSRIBEGAWAN-BRUNEI </span>
                </h2>

                <div class="mt-10 grid grid-cols-2 gap-8 border-y border-slate-800 py-8">
                    <div>
                        <p class="text-slate-400 text-xs uppercase tracking-widest mb-2 font-bold">Magnitudo</p>
                        <p class="text-5xl font-black text-white italic">2.9 <span
                                class="text-xl font-normal not-italic text-slate-500">M</span></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs uppercase tracking-widest mb-2 font-bold">Kedalaman</p>
                        <p class="text-4xl font-black text-white">4 <span
                                class="text-lg font-normal text-slate-500 font-mono">km</span></p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="size-10 rounded-xl bg-slate-800 flex items-center justify-center text-orange-500 shrink-0">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase font-bold">Waktu Kejadian (WIB)</p>
                            <p class="text-slate-200 font-medium">21 April 2026 | 02:02:20</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="size-10 rounded-xl bg-slate-800 flex items-center justify-center text-orange-500 shrink-0">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase font-bold">Status Metadata</p>
                            <p class="text-slate-200 font-medium italic">Data diolah secara mandiri oleh Stasiun
                                Geofisika Balikpapan.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="#"
                        class="inline-flex items-center gap-2 text-sm font-bold text-orange-500 hover:text-orange-400 transition group">
                        Lihat Analisa Seismisitas
                        <svg class="size-4 transform group-hover:translate-x-1 transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-ui.decoration.blur-bg position="bottom" color="from-slate-800 to-slate-900" />
</section>
