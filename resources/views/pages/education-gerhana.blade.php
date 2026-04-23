<x-layouts.app>
    <x-slot:title>Edukasi Gerhana - Stageof Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-slate-950 py-20">
        <x-ui.decoration.blur-bg position="top" color="from-purple-900/20 to-slate-900" />
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center border-b border-slate-800/50 pb-16">
            <h2 class="text-purple-400 font-bold uppercase tracking-[0.3em] text-xs mb-4">Fenomena Astronomi</h2>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Mekanisme <span
                    class="text-purple-500">Gerhana</span></h1>
            <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Memahami peristiwa tertutupnya sebuah benda langit oleh benda langit lainnya dalam tata surya kita.
            </p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">

            <div class="mb-20">
                <div class="flex items-center gap-4 mb-8">
                    <div class="size-12 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
                        <svg class="size-7" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 italic uppercase">Gerhana Matahari</h3>
                </div>

                <div class="grid md:grid-cols-2 gap-12">
                    <div class="space-y-6 text-slate-600 leading-relaxed">
                        <p>
                            Gerhana Matahari terjadi ketika <strong>Bulan berada di antara Bumi dan Matahari</strong>,
                            sehingga menutup sebagian atau seluruh cahaya Matahari di langit Bumi.
                        </p>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-900 mb-3 uppercase text-xs tracking-wider">Tipe Gerhana
                                Matahari:</h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex gap-3"><span class="text-amber-500 font-bold">•</span>
                                    <strong>Total:</strong> Matahari tertutup sepenuhnya oleh Bulan.</li>
                                <li class="flex gap-3"><span class="text-amber-500 font-bold">•</span>
                                    <strong>Cincin:</strong> Bulan berada di titik terjauh, menyisakan pinggiran cahaya.
                                </li>
                                <li class="flex gap-3"><span class="text-amber-500 font-bold">•</span>
                                    <strong>Sebagian:</strong> Hanya sebagian piringan Matahari yang tertutup.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center">

                        <p class="mt-4 text-[10px] text-center text-slate-400 font-mono uppercase tracking-widest">Skema
                            Posisi Matahari-Bulan-Bumi</p>
                    </div>
                </div>
            </div>

            <hr class="border-slate-100 mb-20">

            <div class="mb-20">
                <div class="flex items-center gap-4 mb-8">
                    <div class="size-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg class="size-7" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M10 2c-1.82 0-3.53.5-5 1.35C7.99 5.08 10 8.3 10 12s-2.01 6.92-5 8.65C6.47 21.5 8.18 22 10 22c5.52 0 10-4.48 10-10S15.52 2 10 2z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 italic uppercase">Gerhana Bulan</h3>
                </div>

                <div class="grid md:grid-cols-2 gap-12">
                    <div class="order-2 md:order-1 flex flex-col justify-center">
                        <div
                            class="aspect-video bg-slate-900 rounded-3xl flex items-center justify-center overflow-hidden border border-slate-800">
                            <div class="text-center">
                                <div class="size-20 bg-red-900/50 rounded-full blur-xl mx-auto mb-4"></div>
                                <p class="text-[10px] text-slate-500 font-mono uppercase tracking-widest">Visualisasi
                                    Blood Moon</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 md:order-2 space-y-6 text-slate-600 leading-relaxed">
                        <p>
                            Gerhana Bulan terjadi ketika <strong>Bumi berada di antara Matahari dan Bulan</strong>.
                            Cahaya Matahari terhalang oleh Bumi sehingga Bulan masuk ke dalam bayang-bayang Bumi.
                        </p>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-900 mb-3 uppercase text-xs tracking-wider">Tipe Gerhana
                                Bulan:</h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex gap-3"><span class="text-indigo-500 font-bold">•</span>
                                    <strong>Total:</strong> Bulan masuk sepenuhnya ke bayangan Umbra (inti).</li>
                                <li class="flex gap-3"><span class="text-indigo-500 font-bold">•</span>
                                    <strong>Sebagian:</strong> Hanya sebagian Bulan yang masuk ke Umbra.</li>
                                <li class="flex gap-3"><span class="text-indigo-500 font-bold">•</span>
                                    <strong>Penumbra:</strong> Bulan hanya masuk ke bayangan samar (luar).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-red-50 rounded-[2.5rem] p-10 border border-red-100">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="shrink-0">
                        <div
                            class="size-20 rounded-full bg-red-600 flex items-center justify-center text-white shadow-lg shadow-red-200">
                            <svg class="size-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xl font-black text-red-900 mb-2 uppercase italic">Peringatan Keamanan Pengamatan
                        </h4>
                        <p class="text-red-800 leading-relaxed text-sm md:text-base">
                            Jangan pernah melihat <strong>Gerhana Matahari</strong> secara langsung dengan mata
                            telanjang tanpa pelindung. Radiasi intens matahari dapat menyebabkan kerusakan permanen pada
                            retina (Solar Retinopathy). Gunakan kacamata khusus gerhana dengan filter ND5 atau metode
                            proyeksi lubang jarum.
                        </p>
                        <p class="text-red-700/70 text-[10px] mt-4 font-bold uppercase tracking-widest italic">*Gerhana
                            Bulan aman dilihat dengan mata telanjang.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-layouts.app>
