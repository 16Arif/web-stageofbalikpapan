<x-layouts.app>
    <x-slot:title>Edukasi Mitigasi Gempabumi - Stasiun Geofisika Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-slate-950 py-20">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/20 to-slate-900" />
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-xs mb-4">Edukasi Publik</h2>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Mitigasi <span
                    class="text-indigo-500">Gempabumi</span></h1>
            <p class="mt-6 text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Pahami langkah-langkah keselamatan sebelum, sesaat, dan setelah terjadinya gempabumi untuk melindungi
                diri dan keluarga.
            </p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h3 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Kenali Ancaman dan Persiapkan
                    Diri</h3>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('images/poster-mitigasi.png') }}" alt="Poster Mitigasi Gempabumi"
                        class="w-full max-w-2xl mx-auto rounded-2xl shadow-xl border border-slate-100">
                </div>
                <div class="space-y-6 text-slate-600 leading-relaxed text-lg">
                    <p>
                        <strong>Gempabumi</strong> adalah guncangan yang terjadi di permukaan bumi akibat pelepasan
                        energi dari dalam secara tiba-tiba. Mengingat letak geografis Indonesia yang berada di cincin
                        api pasifik, ancaman gempabumi dapat terjadi kapan saja.
                    </p>
                    <p>
                        Kesiapsiagaan adalah kunci utama. Pastikan Anda mengetahui rute evakuasi di tempat kerja maupun
                        tempat tinggal Anda, menyimpan nomor darurat penting, dan memahami prinsip dasar perlindungan:
                        <em>Drop, Cover, Hold on</em> (Merunduk, Lindungi Kepala, dan Berpegangan).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-12 text-center">
                <div
                    class="inline-flex items-center justify-center size-16 rounded-full bg-pink-100 text-pink-600 mb-4">
                    <svg class="size-8" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Update Edukasi dari Instagram
                    Kami</h3>
                <p class="mt-4 text-slate-500">Ikuti informasi grafis dan panduan ringkas mitigasi dari laman resmi
                    kami.</p>
            </div>

            <div class="flex justify-center w-full overflow-hidden rounded-2xl">
                <!-- Instagram Embed -->
                <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DQ5NrRhDHE7/"
                    data-instgrm-version="14"
                    style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                </blockquote>
                <script async src="//www.instagram.com/embed.js"></script>
            </div>
        </div>
    </section>
</x-layouts.app>
