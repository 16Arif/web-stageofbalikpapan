<section id="gempa-kalimantan" class="relative isolate overflow-hidden bg-white py-16 sm:py-20">
    <x-ui.decoration.blur-bg position="top" color="from-[#0ea5e9]/20 to-[#4f46e5]/20" />

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="relative group">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-sky-500 to-indigo-600 rounded-[2.25rem] blur opacity-20 group-hover:opacity-40 transition duration-1000">
            </div>
            <div
                class="relative grid gap-8 overflow-hidden rounded-[2rem] border border-slate-800 bg-slate-950 p-6 shadow-xl lg:grid-cols-[minmax(0,0.92fr)_minmax(0,1.08fr)] lg:p-8">
                <div class="relative overflow-hidden rounded-[1.5rem] border border-slate-800 bg-slate-900">
                    <img src="{{ asset('build/assets/img/gempa2104.jpeg') }}" alt="Peta Guncangan Kalimantan"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

                    <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                        <div class="bg-slate-950/90 backdrop-blur-md border border-slate-700 p-3 rounded-xl">
                            <p
                                class="text-[10px] font-bold text-indigo-400 uppercase tracking-[0.2em] leading-none mb-1">
                                Koordinat Titik</p>
                            <p class="text-xs font-bold text-white">6.12 LU - 116.56 BT</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold uppercase tracking-widest mb-6">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    Update Lokal: Kalimantan
                </div>

                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-white leading-tight">
                    225 km Timur Laut <br>
                    <span class="text-indigo-600">BDRSRIBEGAWAN-BRUNEI </span>
                </h2>

                <div class="mt-8 grid grid-cols-2 gap-6 border-y border-slate-800 py-6">
                    <div>
                        <p class="text-slate-400 text-xs uppercase tracking-widest mb-2 font-bold">Magnitudo</p>
                        <p class="text-3xl md:text-4xl font-black text-white italic">2.9 <span
                                class="text-xl font-normal not-italic text-slate-500">M</span></p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs uppercase tracking-widest mb-2 font-bold">Kedalaman</p>
                        <p class="text-[1.9rem] md:text-4xl font-black text-white">4 <span
                                class="text-lg font-normal text-slate-500 font-mono">km</span></p>
                    </div>
                </div>

                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-4">
                        <div
                            class="size-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 shrink-0">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-[0.18em]">Waktu Kejadian (WIB)</p>
                            <p class="text-white font-medium">21 April 2026 | 02:02:20</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="size-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 shrink-0">
                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold tracking-[0.18em]">Status Metadata</p>
                            <p class="text-slate-100 font-medium italic">Data diolah secara mandiri oleh Stasiun
                                Geofisika Balikpapan.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="#"
                        class="inline-flex items-center gap-2 text-sm font-bold text-indigo-400 hover:text-indigo-300 transition group">
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

    <x-ui.decoration.blur-bg position="bottom" color="from-[#38bdf8]/10 to-[#6366f1]/10" />
</section>
