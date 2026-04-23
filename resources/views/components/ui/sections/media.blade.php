<section id="media" class="relative isolate bg-slate-50 py-24 sm:py-32 overflow-hidden">
    <x-ui.decoration.blur-bg position="center" color="from-indigo-100 to-blue-200" />

    <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-base font-bold text-indigo-600 uppercase tracking-widest">Dashboard Data</h2>
            <p class="mt-2 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl uppercase">Layanan Informasi
                Real-time</p>
        </div>

        <div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">

            <div class="relative lg:row-span-2">
                <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>
                <div
                    class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-l-[2rem]">
                    <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10">
                        <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mb-2">Geofisika</p>
                        <p class="mt-2 text-lg font-bold tracking-tight text-gray-950">Kerapatan Petir</p>
                        <p class="mt-2 max-w-lg text-sm/6 text-gray-600">Monitoring sambaran petir wilayah Balikpapan
                            dan sekitarnya dalam 24 jam terakhir.</p>
                    </div>
                    <div class="relative min-h-[120px] w-full grow flex items-center justify-center p-6">
                        <div
                            class="w-full bg-slate-900 rounded-2xl p-4 aspect-square flex flex-col items-center justify-center border border-slate-800 shadow-inner">
                            <div class="relative size-32">
                                <div class="absolute inset-0 rounded-full border border-indigo-500/30 animate-ping">
                                </div>
                                <div class="absolute inset-4 rounded-full border border-indigo-500/50"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="size-12 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                        <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <p class="text-2xl font-black text-white italic">120 <span
                                        class="text-xs font-normal text-slate-400 not-italic">Strikes</span></p>
                                <p class="text-[10px] text-emerald-400 font-mono uppercase tracking-tighter">Status:
                                    Normal</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5 lg:rounded-l-[2rem]">
                </div>
            </div>

            <div class="relative max-lg:row-start-1">
                <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>
                <div
                    class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[2rem]">
                    <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                        <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1">Meteorologi</p>
                        <p class="text-lg font-bold tracking-tight text-gray-950">Cuaca Balikpapan</p>
                        <div class="mt-4 flex items-center gap-4">
                            <span class="text-4xl">⛅</span>
                            <div>
                                <p class="text-2xl font-black text-slate-900 leading-none">28°C</p>
                                <p class="text-xs text-slate-500">Cerah Berawan</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 items-center justify-center px-8 lg:pb-2">
                        <div class="w-full h-px bg-slate-100"></div>
                    </div>
                </div>
                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5 max-lg:rounded-t-[2rem]">
                </div>
            </div>

            <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                <div class="absolute inset-px rounded-lg bg-white"></div>
                <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]">
                    <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                        <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-1">Edukasiuj</p>
                        <p class="text-lg font-bold tracking-tight text-gray-950">Profil & Sosialisasi</p>
                    </div>
                    <div class="flex flex-1 items-center p-4 lg:pb-4">
                        <div
                            class="w-full aspect-video rounded-xl overflow-hidden bg-slate-200 shadow-sm border border-slate-100">
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/ZR13ukPdzsw"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5"></div>
            </div>

            <div class="relative lg:row-span-2">
                <div class="absolute inset-px rounded-lg bg-white lg:rounded-r-[2rem]"></div>
                <div
                    class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-r-[2rem]">
                    <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                        <p class="text-[10px] font-bold text-orange-600 uppercase tracking-widest mb-1">Seismologi</p>
                        <p class="text-lg font-bold tracking-tight text-gray-950">Gempabumi Dirasakan</p>
                        <p class="mt-2 text-xs/5 text-gray-600">Info Gempa Mag:3.0, 2.01 LS - 116.29 BT, Tenggara
                            PASER-KALTIM.</p>
                    </div>
                    <div class="relative min-h-[120px] w-full grow p-6">
                        <div class="relative h-full w-full rounded-2xl overflow-hidden border border-slate-200 group">
                            <img src="{{ asset('build/assets/img/gempa.jpeg') }}" alt="Peta Gempa"
                                class="size-full object-cover transition-transform group-hover:scale-110 duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-3 left-3">
                                <span
                                    class="bg-red-600 text-[10px] text-white font-bold px-2 py-1 rounded">TERKINI</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5 lg:rounded-r-[2rem]">
                </div>
            </div>

        </div>
    </div>
</section>
