<x-layouts.app>
    <x-slot:title>Informasi Hilal - Stasiun Geofisika Balikpapan</x-slot:title>

    <!-- Breadcrumb Minimalis -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-8 pb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-700">
            <li>
                <a href="/" class="hover:text-blue-600 hover:underline transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Geofisika</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Info Hilal</span>
                </div>
            </li>
        </ol>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="mb-16">
                <h3 class="text-2xl font-black text-slate-900 mb-6 border-l-4 border-indigo-600 pl-4">Apa Itu Hilal?
                </h3>
                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div class="text-slate-600 leading-relaxed space-y-4 text-sm md:text-base">
                        <p>
                            Secara astronomis, <strong>Hilal</strong> adalah bulan sabit muda yang pertama kali tampak
                            setelah terjadinya konjungsi (Ijtima') antara Bulan dan Matahari.
                        </p>
                        <p>
                            Hilal merupakan penanda beralihnya satu bulan ke bulan berikutnya dalam sistem kalender
                            Hijriah. Karena bentuknya yang sangat tipis dan cahaya matahari yang masih dominan di ufuk
                            barat, pengamatannya memerlukan ketelitian tinggi dan bantuan alat optik.
                        </p>
                    </div>
                    <div
                        class="bg-slate-100 rounded-3xl p-4 flex items-center justify-center border border-slate-200 shadow-inner">
                        <div class="text-center italic">
                            <p class="text-[10px] text-slate-400 font-mono uppercase tracking-widest mb-4">Diagram
                                Geometri Hilal</p>
                            <div
                                class="size-40 rounded-full border-2 border-dashed border-slate-300 flex items-center justify-center">
                                <span class="text-slate-300 text-xs text-center px-4">Ilustrasi Posisi Bulan &amp;
                                    Matahari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-slate-100 mb-16">

            <div class="mb-16">
                <h3 class="text-2xl font-black text-slate-900 mb-6 border-l-4 border-indigo-600 pl-4">Kriteria
                    Visibilitas (Neo-MABIMS)</h3>
                <p class="text-slate-600 mb-8 text-sm md:text-base leading-relaxed">
                    Di Indonesia, penentuan awal bulan menggunakan kriteria yang disepakati oleh Menteri Agama Brunei
                    Darussalam, Indonesia, Malaysia, dan Singapura (MABIMS). Sejak tahun 2022, Indonesia menerapkan
                    kriteria baru sebagai berikut:
                </p>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xs font-bold text-indigo-600 uppercase mb-2">Tinggi Hilal</p>
                        <p class="text-3xl font-black text-slate-900">Minimal 3°</p>
                        <p class="text-xs text-slate-500 mt-2 italic">Ketinggian minimal di atas ufuk saat matahari
                            terbenam.</p>
                    </div>
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xs font-bold text-indigo-600 uppercase mb-2">Sudut Elongasi</p>
                        <p class="text-3xl font-black text-slate-900">Minimal 6,4°</p>
                        <p class="text-xs text-slate-500 mt-2 italic">Jarak sudut antara pusat piringan Bulan dan
                            Matahari.</p>
                    </div>
                </div>
            </div>

            <div class="mb-16 p-8 bg-indigo-900 rounded-[2.5rem] text-white">
                <h3 class="text-2xl font-black mb-6">Metode Pengamatan BMKG</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <div class="size-10 bg-indigo-500/30 rounded-lg flex items-center justify-center mb-4">
                            <span class="font-bold">01</span>
                        </div>
                        <h4 class="font-bold mb-2 text-indigo-300 uppercase text-xs tracking-widest">Alat Optik</h4>
                        <p class="text-xs text-indigo-100/70 leading-relaxed">Menggunakan teleskop komputerisasi yang
                            terhubung dengan sistem deteksi citra digital.</p>
                    </div>
                    <div>
                        <div class="size-10 bg-indigo-500/30 rounded-lg flex items-center justify-center mb-4">
                            <span class="font-bold">02</span>
                        </div>
                        <h4 class="font-bold mb-2 text-indigo-300 uppercase text-xs tracking-widest">Pengolahan Citra
                        </h4>
                        <p class="text-xs text-indigo-100/70 leading-relaxed">Cahaya hilal diproses secara digital untuk
                            meningkatkan kontras terhadap cahaya latar belakang langit.</p>
                    </div>
                    <div>
                        <div class="size-10 bg-indigo-500/30 rounded-lg flex items-center justify-center mb-4">
                            <span class="font-bold">03</span>
                        </div>
                        <h4 class="font-bold mb-2 text-indigo-300 uppercase text-xs tracking-widest">Diseminasi</h4>
                        <p class="text-xs text-indigo-100/70 leading-relaxed">Hasil pengamatan langsung dikirimkan ke
                            Kementerian Agama RI sebagai bahan Sidang Isbat.</p>
                    </div>
                </div>
            </div>

            <div class="bg-indigo-50 rounded-3xl p-8 border border-indigo-100">
                <h4 class="font-bold text-indigo-900 mb-4 flex items-center gap-2">
                    <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tahukah Anda?
                </h4>
                <p class="text-sm text-indigo-800 leading-relaxed italic">
                    BMKG melakukan pengamatan hilal sebanyak 12 kali dalam setahun, bukan hanya saat menjelang Ramadan,
                    Syawal, dan Dzulhijjah. Hal ini dilakukan untuk menguji akurasi kriteria dan membangun basis data
                    klimatologi visibilitas hilal di Indonesia.
                </p>
            </div>

        </div>
    </section>
</x-layouts.app>
