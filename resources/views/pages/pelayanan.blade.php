<x-layouts.app>
    <x-slot:title>Pusat Pelayanan Terpadu - Stageof Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-white pt-20 pb-16 border-b border-slate-100">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-100 to-white" />
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-indigo-600 font-bold uppercase tracking-[0.3em] text-xs mb-4">Public Services</h2>
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 leading-tight">Layanan Data & <span
                    class="text-indigo-600">Informasi</span></h1>
            <p class="mt-6 text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Komitmen kami dalam menyediakan data Geofisika yang akurat dan akuntabel untuk mendukung keselamatan,
                penelitian, dan pembangunan nasional.
            </p>
        </div>
    </section>

    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl transition duration-300">
                    <div
                        class="size-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3 uppercase tracking-tight">Data Gempabumi</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Peta seismisitas, katalog gempa merusak, dan
                        analisa struktur untuk keperluan konstruksi/riset.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl transition duration-300">
                    <div
                        class="size-12 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3 uppercase tracking-tight">Data Petir</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Data titik sambaran presisi (strike) dan peta
                        kerapatan petir untuk klaim asuransi atau proteksi aset.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl transition duration-300">
                    <div
                        class="size-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3 uppercase tracking-tight">Tanda Waktu</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Informasi hilal, gerhana, dan kalender astronomi
                        untuk instansi pemerintah atau lembaga keagamaan.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl transition duration-300">
                    <div
                        class="size-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-3 uppercase tracking-tight">Goes to School</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Layanan kunjungan sekolah atau sosialisasi
                        mitigasi bencana geofisika secara berkelompok/instansi.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-2xl font-black text-slate-900 uppercase">Prosedur Permintaan Data</h2>
                <p class="text-slate-500 mt-2">Alur resmi pengambilan data melalui skema PNBP (Penerimaan Negara Bukan
                    Pajak).</p>
            </div>

            <div class="relative">
                <div class="hidden lg:block absolute top-12 left-0 w-full h-0.5 bg-slate-100 -z-10"></div>

                <div class="grid lg:grid-cols-4 gap-12">
                    <div class="text-center group">
                        <div
                            class="size-16 bg-white border-4 border-slate-50 shadow-sm rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:border-indigo-500 transition-colors duration-500">
                            <span class="text-xl font-black text-slate-900">01</span>
                        </div>
                        <h4 class="font-bold text-slate-900 mb-2 uppercase text-xs tracking-widest">Permohonan</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed px-4">Mengajukan surat resmi atau mengisi
                            formulir permintaan data di kantor/online.</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="size-16 bg-white border-4 border-slate-50 shadow-sm rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:border-indigo-500 transition-colors duration-500">
                            <span class="text-xl font-black text-slate-900">02</span>
                        </div>
                        <h4 class="font-bold text-slate-900 mb-2 uppercase text-xs tracking-widest">Verifikasi</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed px-4">Petugas memverifikasi ketersediaan
                            data dan menghitung tarif sesuai PP yang berlaku.</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="size-16 bg-white border-4 border-slate-50 shadow-sm rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:border-indigo-500 transition-colors duration-500">
                            <span class="text-xl font-black text-slate-900">03</span>
                        </div>
                        <h4 class="font-bold text-slate-900 mb-2 uppercase text-xs tracking-widest">Pembayaran</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed px-4">Pemohon melakukan pembayaran PNBP
                        </p>
                        {{-- <p> melalui bank (Kode Billing Simponi).</p> --}}
                    </div>

                    <div class="text-center group">
                        <div
                            class="size-16 bg-white border-4 border-slate-50 shadow-sm rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:border-indigo-500 transition-colors duration-500">
                            <span class="text-xl font-black text-slate-900">04</span>
                        </div>
                        <h4 class="font-bold text-slate-900 mb-2 uppercase text-xs tracking-widest">Selesai</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed px-4">Data diserahkan kepada pemohon dalam
                            format resmi (Digital/Hardcopy).</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-indigo-900 rounded-t-[3rem] text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h3 class="text-3xl font-black mb-6 uppercase italic tracking-tight">Butuh Konsultasi <br> <span
                            class="text-indigo-400">Lebih Lanjut?</span></h3>
                    <p class="text-indigo-100/70 text-sm leading-relaxed mb-10">
                        Tim pelayanan kami siap membantu Anda dalam menentukan jenis data yang paling sesuai dengan
                        kebutuhan teknis atau riset Anda. Hubungi kami melalui saluran resmi berikut:
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="size-12 bg-white/10 rounded-2xl flex items-center justify-center text-indigo-300">
                                <svg class="size-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.815 9.815 0 0012.04 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest">WhatsApp
                                    Pelayanan</p>
                                <p class="font-bold">+62 853-4637-8948</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="size-12 bg-white/10 rounded-2xl flex items-center justify-center text-indigo-300">
                                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest">Email Resmi
                                </p>
                                <p class="font-bold">stageof.balikpapan@bmkg.go.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 p-10 rounded-[2.5rem] border border-white/10 backdrop-blur-sm text-center">
                    <h4 class="text-lg font-bold mb-4">Akses PTSP BMKG</h4>
                    <p class="text-xs text-indigo-200 leading-relaxed mb-8">
                        Anda juga dapat mengajukan permohonan data secara mandiri melalui portal Pelayanan Terpadu Satu
                        Pintu (PTSP) BMKG Pusat.
                    </p>
                    <a href="https://ptsp.bmkg.go.id" target="_blank"
                        class="inline-block w-full py-4 bg-white text-indigo-900 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-50 transition shadow-xl">
                        Kunjungi Portal PTSP
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
