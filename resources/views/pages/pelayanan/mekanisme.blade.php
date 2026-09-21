<x-layouts.app>
    <x-slot:title>Mekanisme Permohonan Data - Stasiun Geofisika Balikpapan</x-slot:title>

    {{-- Hero Section --}}
    <section class="relative isolate overflow-hidden bg-slate-950 py-16 sm:py-20 border-b border-slate-800">
        {{-- Background Image Landscape --}}
        <img src="{{ asset('images/pelayanan-hero-bg.jpg') }}" 
             alt="Latar Belakang Mekanisme Permohonan" 
             class="absolute inset-0 -z-10 h-full w-full object-cover object-center opacity-40" />

        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-slate-950 via-slate-950/80 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            {{-- Breadcrumb Navigasi --}}
            <nav class="flex items-center gap-2 text-xs font-semibold text-blue-200 mb-6">
                <a href="{{ route('pelayanan') }}" wire:navigate class="hover:text-white transition">Layanan Geofisika</a>
                <span>/</span>
                <span class="text-white">Mekanisme Permohonan</span>
            </nav>

            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white uppercase">
                    Mekanisme Permohonan Data
                </h1>
                <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed">
                    Panduan resmi dan alur pengajuan permohonan data dan informasi geofisika secara daring (Online via Email) maupun tatap muka (Offline di Loket) di Stasiun Geofisika Balikpapan.
                </p>
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <a href="{{ route('pelayanan') }}#katalog-layanan" wire:navigate 
                       class="rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-xs font-bold text-white hover:bg-white/20 transition">
                        &larr; Lihat Katalog Data
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Alur Pelayanan (Online Email vs Offline Loket Balikpapan) --}}
    <section class="py-16 bg-white border-b border-slate-100" x-data="{ alurTab: 'online' }">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Pilihan Jalur Layanan</span>
                <h2 class="mt-2 text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Pilih Jalur Permohonan Anda
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Pengajuan data geofisika di Stasiun Geofisika Balikpapan dapat dilakukan secara fleksibel melalui pengiriman berkas daring via email resmi pelayanan, maupun kunjungan langsung ke loket kantor kami.
                </p>

                {{-- Tab Switcher --}}
                <div class="mt-8 inline-flex p-1 rounded-2xl bg-slate-100 border border-slate-200">
                    <button type="button" 
                            @click="alurTab = 'online'" 
                            :class="alurTab === 'online' ? 'bg-indigo-600 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                            class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200">
                        Alur Daring (Email Resmi)
                    </button>
                    <button type="button" 
                            @click="alurTab = 'offline'" 
                            :class="alurTab === 'offline' ? 'bg-indigo-600 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                            class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200">
                        Alur Kunjungan Tatap Muka (Loket)
                    </button>
                </div>
            </div>

            {{-- Alur Online / Email Steps --}}
            <div x-show="alurTab === 'online'" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="grid md:grid-cols-4 gap-6 relative">
                    {{-- Step 1 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            01
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Persiapan Berkas</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Menyiapkan surat permohonan resmi yang ditujukan kepada <strong>Kepala Stasiun Geofisika Balikpapan</strong>, kartu identitas, serta proposal/surat pengantar (jika tarif Rp 0,-).
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            02
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Kirim Pengajuan Email</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Mengirimkan berkas permohonan ke email resmi pelayanan: <span class="font-bold text-indigo-600">stageof.balikpapan@bmkg.go.id</span> disertai rincian parameter data yang diminta.
                        </p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            03
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Verifikasi & Billing Simponi</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Petugas memverifikasi ketersediaan teknis data dan menerbitkan kode billing PNBP Simponi Kemenkeu untuk pembayaran cashless (atau verifikasi kelayakan fasilitas tarif Rp 0,-).
                        </p>
                    </div>

                    {{-- Step 4 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            04
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Penerimaan Data Resmi</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Setelah konfirmasi pembayaran terverifikasi otomatis oleh sistem, file data resmi dan surat keterangan berlegalisir akan dikirimkan langsung ke email pemohon.
                        </p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="mailto:stageof.balikpapan@bmkg.go.id?subject=Permohonan%20Data%20Geofisika%20-%20Stasiun%20Geofisika%20Balikpapan" 
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold text-xs sm:text-sm uppercase tracking-wider hover:bg-indigo-500 transition shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Ajukan Permohonan via Email Resmi
                    </a>
                </div>
            </div>

            {{-- Alur Offline/Tatap Muka Steps --}}
            <div x-show="alurTab === 'offline'" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" style="display: none;">
                <div class="grid md:grid-cols-4 gap-6 relative">
                    {{-- Step 1 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            01
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Kunjungan ke Loket</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Datang langsung ke Gedung Operasional Stasiun Geofisika Balikpapan di Jl. Prona III No. 16, Sepinggan, Balikpapan Selatan.
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            02
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Buku Tamu & Formulir</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Mengisi buku tamu dan berkonsultasi mengenai spesifikasi parameter data geofisika yang dibutuhkan dengan petugas front office.
                        </p>
                    </div>

                    {{-- Step 3 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            03
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Penyetoran Billing Simponi</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Petugas mencetak kode billing Simponi. Pemohon menyetorkan tarif melalui bank, ATM, internet banking, atau teller resmi (bebas pungli/tunai).
                        </p>
                    </div>

                    {{-- Step 4 --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 text-center relative group hover:border-indigo-400 transition">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 text-white font-black text-base flex items-center justify-center mx-auto mb-4 shadow-sm">
                            04
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Penyerahan Data Resmi</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Petugas menyerahkan dokumen resmi bertanda tangan basah/elektronik atau menyalin data ke media penyimpanan pemohon.
                        </p>
                    </div>
                </div>

                <div class="mt-8 text-center text-xs sm:text-sm text-slate-500">
                    Loket dibuka setiap hari kerja: <strong>Senin - Kamis (08.00 - 15.00 WITA)</strong> dan <strong>Jumat (08.00 - 15.30 WITA)</strong>.
                </div>
            </div>
        </div>
    </section>

    {{-- Ketentuan Tarif PNBP & Syarat Tarif Rp 0,- --}}
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Ketentuan Biaya & Syarat</span>
                <h3 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    Tarif PNBP & Fasilitas Bebas Biaya (Rp 0,-)
                </h3>
                <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Besaran biaya tarif resmi layanan data geofisika berpedoman pada <strong>Peraturan Pemerintah (PP) Republik Indonesia Nomor 47 Tahun 2018</strong> tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang berlaku pada BMKG, serta <strong>Peraturan BMKG Nomor 12 Tahun 2019</strong>. 
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 items-start">
                {{-- Box 1: Layanan Bertarif PNBP Geofisika --}}
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm flex flex-col justify-between h-full">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-lg">
                                Rp
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Tarif Resmi PNBP Geofisika</h3>
                                <p class="text-sm text-slate-500">Untuk Komersial, Perusahaan, Asuransi, & Non-Pemerintah</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed mb-6">
                            Penerimaan disetorkan langsung ke Kas Negara menggunakan Kode Billing Simponi Kementerian Keuangan RI secara elektronik tanpa pungutan tambahan.
                        </p>

                        {{-- Rincian Tarif Resmi PP 47/2018 --}}
                        <div class="divide-y divide-slate-100 text-sm text-slate-700">
                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Informasi Kejadian Petir</span>
                                    <span class="text-xs text-slate-500">Per lokasi per hari</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 75.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Peta Tingkat Kerawanan Petir</span>
                                    <span class="text-xs text-slate-500">Per lokasi per tahun</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 200.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Informasi Geofisika untuk Klaim Asuransi</span>
                                    <span class="text-xs text-slate-500">Per lokasi per hari (SKP / Bukti Gempa)</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 185.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Peta Kegempaan</span>
                                    <span class="text-xs text-slate-500">Per provinsi per tahun</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 250.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Peta Percepatan Tanah</span>
                                    <span class="text-xs text-slate-500">Per provinsi per tahun</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 250.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Waktu Terbit dan Terbenam Matahari/Bulan</span>
                                    <span class="text-xs text-slate-500">Per lokasi per tahun</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 50.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Buku Peta Ketinggian Hilal / Almanak</span>
                                    <span class="text-xs text-slate-500">Per buku per tahun</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 150.000</span>
                            </div>

                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm sm:text-base block">Jasa Konsultasi Geofisika</span>
                                    <span class="text-xs text-slate-500">Pendukung Proyek / Survei Komersial (Per lokasi)</span>
                                </div>
                                <span class="font-extrabold text-slate-900 text-sm sm:text-base shrink-0">Rp 12.300.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs sm:text-sm text-slate-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Pembayaran resmi negara 100% cashless via Kode Billing Simponi.</span>
                        </div>
                        
                    </div>
                </div>

                {{-- Box 2: Fasilitas Tarif Rp 0,- (Gratis) --}}
                <div class="bg-white rounded-3xl p-8 border-2 border-emerald-200 shadow-sm relative overflow-hidden flex flex-col justify-between h-full">
                    <div class="absolute top-0 right-0 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-wider py-1 px-4 rounded-bl-xl">
                        Fasilitas Tarif Nol Rupiah
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-lg">
                                0
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">Tarif Rp 0,- (Bebas Biaya)</h3>
                                <p class="text-sm text-slate-500">Pendidikan, Penelitian Non-Komersial, & Kebencanaan</p>
                            </div>
                        </div>

                        <p class="text-sm text-slate-600 leading-relaxed mb-5">
                            BMKG mendukung penuh pengembangan ilmu pengetahuan serta penanggulangan bencana dengan membebaskan tarif PNBP bagi mahasiswa penyusun skripsi/tugas akhir dan kegiatan kemanusiaan.
                        </p>

                        <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-3.5">Persyaratan Dokumen Pengajuan Tarif Rp 0,-:</h4>
                        <ul class="space-y-3 text-sm text-slate-600 mb-6">
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span><strong>Surat Pengantar Resmi Kampus:</strong> Surat permohonan yang ditandatangani oleh Dekan, Pembantu Dekan, atau Ketua Program Studi.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span><strong>Proposal Penelitian / Skripsi:</strong> Salinan lembar proposal atau abstrak yang telah disetujui Dosen Pembimbing.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span><strong>Surat Pernyataan Bermaterai:</strong> Menyatakan data hanya digunakan untuk riset akademis, tidak untuk tujuan komersial atau diserahkan kepada pihak ketiga.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span><strong>Kartu Tanda Mahasiswa (KTM):</strong> Salinan KTM pemohon yang masih berlaku aktif pada semester berjalan.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-xs sm:text-sm text-emerald-800 leading-normal">
                        <strong>Kewajiban Pasca-Penelitian:</strong> Pemohon wajib menyerahkan 1 (satu) eksemplar salinan hasil karya ilmiah/skripsi/jurnal kepada Stasiun Geofisika Balikpapan setelah penelitian selesai.
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
