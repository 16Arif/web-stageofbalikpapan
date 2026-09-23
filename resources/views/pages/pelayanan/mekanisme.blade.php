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

    {{-- Alur Pelayanan Daring (Portal Layanan) --}}
    <section class="py-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Alur Pelayanan</span>
                <h2 class="mt-2 text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Langkah Pengajuan Permohonan Data
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                    Ikuti empat langkah sederhana berikut untuk mengajukan permohonan data geofisika secara daring melalui portal layanan resmi Stasiun Geofisika Balikpapan.
                </p>
            </div>

            {{-- Stepper Visual 4 Langkah --}}
            <div class="relative">
                {{-- Garis Penghubung Horizontal (Desktop) --}}
                <div class="hidden md:block absolute top-[52px] left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-indigo-200 via-indigo-300 to-indigo-200 z-0"></div>

                <div class="grid md:grid-cols-4 gap-8 md:gap-6 relative z-10">
                    {{-- Step 1: Lihat Katalog Layanan --}}
                    <div class="flex flex-col items-center text-center group">
                        <div class="relative mb-5">
                            <div class="w-[104px] h-[104px] rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100 border-2 border-indigo-200 flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:border-indigo-400 transition-all duration-300">
                                {{-- Icon: Katalog / Buku --}}
                                <svg class="w-11 h-11 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div class="absolute -top-2 -left-2 w-8 h-8 rounded-lg bg-indigo-600 text-white font-black text-sm flex items-center justify-center shadow-md">
                                1
                            </div>
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Lihat Katalog Layanan</h4>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">
                            Telusuri katalog data geofisika yang tersedia untuk menentukan jenis informasi yang Anda butuhkan beserta rincian tarif PNBP resminya.
                        </p>
                        <a href="{{ route('pelayanan') }}#katalog-layanan" wire:navigate
                           class="mt-auto inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800 transition group/link">
                            <span>Buka Katalog</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- Step 2: Siapkan Berkas --}}
                    <div class="flex flex-col items-center text-center group">
                        <div class="relative mb-5">
                            <div class="w-[104px] h-[104px] rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 border-2 border-amber-200 flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:border-amber-400 transition-all duration-300">
                                {{-- Icon: Dokumen / Berkas --}}
                                <svg class="w-11 h-11 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div class="absolute -top-2 -left-2 w-8 h-8 rounded-lg bg-amber-500 text-white font-black text-sm flex items-center justify-center shadow-md">
                                2
                            </div>
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Siapkan Berkas Pendukung</h4>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">
                            Siapkan surat permohonan resmi ditujukan kepada <strong>Kepala Stasiun Geofisika Balikpapan</strong>, kartu identitas, serta proposal/surat pengantar (jika pengajuan tarif Rp 0,-).
                        </p>
                        <a href="{{ route('pelayanan.mekanisme') }}#ketentuan-biaya" wire:navigate
                           class="mt-auto inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-800 transition group/link">
                            <span>Lihat Syarat Berkas</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- Step 3: Login / Registrasi --}}
                    <div class="flex flex-col items-center text-center group">
                        <div class="relative mb-5">
                            <div class="w-[104px] h-[104px] rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 border-2 border-emerald-200 flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:border-emerald-400 transition-all duration-300">
                                {{-- Icon: Login / Portal --}}
                                <svg class="w-11 h-11 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                            </div>
                            <div class="absolute -top-2 -left-2 w-8 h-8 rounded-lg bg-emerald-500 text-white font-black text-sm flex items-center justify-center shadow-md">
                                3
                            </div>
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Login / Registrasi Portal</h4>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">
                            Masuk ke akun portal layanan Anda. Jika belum memiliki akun, lakukan registrasi terlebih dahulu untuk mengakses formulir pengajuan permohonan data secara daring.
                        </p>
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.pages.dashboard') : route('pelayanan.login') }}"
                           class="mt-auto inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-800 transition group/link">
                            <span>{{ auth('applicant')->check() ? 'Masuk Portal' : 'Login / Daftar' }}</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- Step 4: Ajukan Permohonan --}}
                    <div class="flex flex-col items-center text-center group">
                        <div class="relative mb-5">
                            <div class="w-[104px] h-[104px] rounded-2xl bg-gradient-to-br from-rose-50 to-rose-100 border-2 border-rose-200 flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:border-rose-400 transition-all duration-300">
                                {{-- Icon: Kirim / Submit --}}
                                <svg class="w-11 h-11 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                </svg>
                            </div>
                            <div class="absolute -top-2 -left-2 w-8 h-8 rounded-lg bg-rose-500 text-white font-black text-sm flex items-center justify-center shadow-md">
                                4
                            </div>
                        </div>
                        <h4 class="text-base font-bold text-slate-900 mb-2">Ajukan Permohonan Data</h4>
                        <p class="text-sm text-slate-600 leading-relaxed mb-4">
                            Isi formulir permohonan data di dalam portal, unggah berkas pendukung, lalu submit. Petugas akan memverifikasi dan memproses data yang Anda butuhkan.
                        </p>
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.resources.permohonan-sayas.create') : route('pelayanan.login') }}"
                           class="mt-auto inline-flex items-center gap-1.5 text-xs font-bold text-rose-600 hover:text-rose-800 transition group/link">
                            <span>Ajukan Sekarang</span>
                            <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Info Tambahan Jalur Alternatif --}}
            <div class="mt-12 rounded-2xl bg-slate-50 border border-slate-200 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-slate-200 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 mb-1">Alternatif: Permohonan via Email atau Tatap Muka</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Selain melalui portal daring, Anda juga dapat mengajukan permohonan data melalui email resmi ke <a href="mailto:stageof.balikpapan@bmkg.go.id" class="font-bold text-indigo-600 hover:underline">stageof.balikpapan@bmkg.go.id</a>, atau kunjungan langsung ke loket kantor Stasiun Geofisika Balikpapan di Jl. Prona III No. 16, Sepinggan, Balikpapan Selatan. Loket dibuka setiap hari kerja: <strong>Senin – Kamis (08.00 – 15.00 WITA)</strong> dan <strong>Jumat (08.00 – 15.30 WITA)</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Ketentuan Tarif PNBP & Syarat Tarif Rp 0,- --}}
    <section id="ketentuan-biaya" class="py-16 bg-slate-50">
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
