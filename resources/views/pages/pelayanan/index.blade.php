<x-layouts.app>
    <x-slot:title>Layanan Data Geofisika - Stasiun Geofisika Balikpapan</x-slot:title>

    {{-- CSS Khusus Animasi Entrance & Scroll Reveal Halaman Pelayanan --}}
    <style>
        /* Animasi Entrance Hero Section */
        @keyframes heroFadeInUp {
            0% {
                opacity: 0;
                transform: translateY(28px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroSubtleZoom {
            0% {
                transform: scale(1.08);
            }
            100% {
                transform: scale(1);
            }
        }

        .hero-bg-zoom {
            animation: heroSubtleZoom 1.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hero-anim-item {
            opacity: 0;
            animation: heroFadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .hero-delay-0 { animation-delay: 100ms; }
        .hero-delay-1 { animation-delay: 250ms; }
        .hero-delay-2 { animation-delay: 400ms; }
        .hero-delay-3 { animation-delay: 550ms; }
        .hero-delay-4 { animation-delay: 700ms; }

        /* Scroll Reveal Section */
        .service-reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .service-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .service-stagger-1 { transition-delay: 120ms; }
        .service-stagger-2 { transition-delay: 240ms; }
        .service-stagger-3 { transition-delay: 360ms; }

        /* Interaksi Hover Kartu Pasca-Reveal */
        .service-catalog-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
        }
        .service-reveal.revealed.service-catalog-card:hover {
            transform: translateY(-6px) !important;
            box-shadow: 0 16px 28px -6px rgba(15, 23, 42, 0.1), 0 8px 12px -4px rgba(15, 23, 42, 0.06);
            border-color: #818cf8;
        }

        @media (prefers-reduced-motion: reduce) {
            .hero-bg-zoom,
            .hero-anim-item {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
            .service-reveal {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
        }
    </style>

    {{-- 1. Hero Section Banner --}}
    <section class="relative isolate overflow-hidden bg-slate-950">
        {{-- Background Image Landscape --}}
        <img src="{{ asset('images/pelayanan-hero-bg.jpg') }}" 
             alt="Latar Belakang Layanan Geofisika" 
             class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center hero-bg-zoom" />

        {{-- Gradient Overlay for Contrast & Readability --}}
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#072d68] via-[#0b3e8e]/95 to-[#072d68]/50 sm:to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-16 sm:py-20 lg:py-24">
            <div class="max-w-2xl text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs text-xs font-semibold text-blue-200 uppercase tracking-widest mb-4 hero-anim-item hero-delay-0">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Pelayanan Data & Informasi Geofisika
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white uppercase drop-shadow-sm hero-anim-item hero-delay-1">
                    LAYANAN GEOFISIKA
                </h1>
                <h2 class="mt-2 text-lg sm:text-xl lg:text-2xl font-bold text-white/95 hero-anim-item hero-delay-2">
                    Stasiun Geofisika Balikpapan
                </h2>
                <p class="mt-3 text-sm sm:text-base text-blue-100/90 font-medium leading-relaxed hero-anim-item hero-delay-3">
                    Data Akurat, Informasi Cepat, Layanan Prima. Penyediaan data gempabumi dan informasi geofisika yang akuntabel dan berstandar nasional.
                </p>
                <div class="mt-6 flex flex-wrap items-center gap-3 hero-anim-item hero-delay-4">
                    <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate 
                       class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-xs sm:text-sm font-bold text-indigo-950 shadow-md hover:bg-blue-50 transition">
                        <span>Mekanisme Permohonan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.pages.dashboard') : route('pelayanan.login') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-white/10 border border-white/25 backdrop-blur-xs px-5 py-2.5 text-xs sm:text-sm font-bold text-white hover:bg-white/20 transition">
                        <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Portal Pemohon</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Katalog Produk dan Jasa Data Geofisika (4 Layanan Simetris & Minimalis) --}}
    <section id="katalog-layanan" class="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16 service-reveal">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200/60 text-indigo-700 text-xs font-bold uppercase tracking-widest mb-3">
                    Katalog Layanan Resmi
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Layanan Data Geofisika
                </h2>
                <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                    Penyediaan data dan jasa geofisika berstandar nasional berpedoman pada Peraturan Pemerintah (PP) No. 47 Tahun 2018 untuk keperluan perencanaan teknik sipil, verifikasi klaim asuransi, riset ilmiah, dan mitigasi bencana.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Kartu 1: Informasi Kegempaan --}}
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-2xs flex flex-col justify-between group service-reveal service-catalog-card">
                    <div>
                        <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h3 class="text-base font-bold text-slate-900 leading-snug">Informasi Kegempaan</h3>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 shrink-0">PP 47/2018</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4 line-clamp-3">
                            Penyediaan peta kegempaan regional dan peta percepatan tanah (PGA) untuk perencanaan konstruksi sipil tahan gempa serta keterangan kejadian gempabumi.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3.5 mb-5">
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Peta Kegempaan Regional</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Peta Percepatan Tanah (PGA)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Keterangan Kejadian Gempabumi</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-2 space-y-2">
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.resources.permohonan-sayas.create') : route('pelayanan.login') }}"
                           class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 text-xs font-bold text-slate-700 transition duration-150">
                            <span>Ajukan Permohonan</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                           class="inline-flex items-center justify-center gap-1 w-full py-1 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition">
                            <span>Lihat Detail</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Kartu 2: Data Sambaran Petir --}}
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-2xs flex flex-col justify-between group service-reveal service-stagger-1 service-catalog-card">
                    <div>
                        <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h3 class="text-base font-bold text-slate-900 leading-snug">Informasi Sambaran Petir</h3>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 shrink-0">PP 47/2018</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4 line-clamp-3">
                            Informasi presisi titik sambaran petir CG & IC berbasis sensor deteksi BMKG untuk verifikasi klaim asuransi dan audit instalasi proteksi petir.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3.5 mb-5">
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Surat Keterangan Petir (SKP)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Informasi Kejadian Petir Harian</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Peta Tingkat Kerawanan Petir</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-2 space-y-2">
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.resources.permohonan-sayas.create') : route('pelayanan.login') }}"
                           class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 text-xs font-bold text-slate-700 transition duration-150">
                            <span>Ajukan Permohonan</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                           class="inline-flex items-center justify-center gap-1 w-full py-1 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition">
                            <span>Lihat Detail</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Kartu 3: Kunjungan & Edukasi Mitigasi --}}
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-2xs flex flex-col justify-between group service-reveal service-stagger-2 service-catalog-card">
                    <div>
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h3 class="text-base font-bold text-slate-900 leading-snug">Kunjungan & Edukasi</h3>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 shrink-0">Tarif Rp 0,-</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4 line-clamp-3">
                            Fasilitas edukasi dan literasi mitigasi bencana geofisika bagi pelajar, mahasiswa, dan komunitas bersama BMKG Balikpapan.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3.5 mb-5">
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Wisata Edukasi Geofisika</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>BMKG Goes to School</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Narasumber Sosialisasi Kebencanaan</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-2 space-y-2">
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.resources.permohonan-sayas.create') : route('pelayanan.login') }}"
                           class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 text-xs font-bold text-slate-700 transition duration-150">
                            <span>Ajukan Kunjungan</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                           class="inline-flex items-center justify-center gap-1 w-full py-1 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition">
                            <span>Lihat Detail</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Kartu 4: Konsultasi Teknis Geofisika --}}
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-2xs flex flex-col justify-between group service-reveal service-stagger-3 service-catalog-card">
                    <div>
                        <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-5 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h3 class="text-base font-bold text-slate-900 leading-snug">Jasa Konsultasi Geofisika</h3>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 shrink-0">PP 47/2018</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4 line-clamp-3">
                            Informasi pendahuluan geofisika sebagai pendukung kegiatan proyek, survei rekayasa, dan kajian risiko seismotektonik kawasan IKN & Kaltim.
                        </p>
                        <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3.5 mb-5">
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Informasi Pendahuluan Proyek</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Kajian Seismotektonik Wilayah IKN</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Dukungan Riset Non-Komersial</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-2 space-y-2">
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.resources.permohonan-sayas.create') : route('pelayanan.login') }}"
                           class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-600 hover:text-white hover:border-indigo-600 text-xs font-bold text-slate-700 transition duration-150">
                            <span>Ajukan Konsultasi</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                           class="inline-flex items-center justify-center gap-1 w-full py-1 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition">
                            <span>Lihat Detail</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 5. Tanya Jawab Seputar Layanan (FAQ Accordion) --}}
    <section id="faq-pelayanan" class="py-16 bg-slate-50" x-data="{ activeFaq: null }">
        <div class="max-w-4xl mx-auto px-6 sm:px-8">
            <div class="text-center mb-12 service-reveal">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Bantuan & Informasi</span>
                <h2 class="mt-2 text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Pertanyaan yang Sering Diajukan (FAQ)
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600">
                    Jawaban praktis seputar prosedur permohonan data, legalisasi, dan layanan konsultasi geofisika.
                </p>
            </div>

            <div class="space-y-4 service-reveal service-stagger-1">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" 
                            @click="activeFaq = activeFaq === 1 ? null : 1" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-indigo-600 transition">
                        <span>Apakah data geofisika bisa didapatkan secara gratis untuk mahasiswa?</span>
                        <svg class="w-5 h-5 shrink-0 text-slate-400 transition-transform duration-300" 
                             :class="activeFaq === 1 ? 'rotate-180 text-indigo-600' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Ya, berdasarkan PP No. 47 Tahun 2018, mahasiswa yang sedang menempuh tugas akhir atau skripsi berhak mendapatkan tarif Rp 0,00 (Gratis) untuk data tertentu dengan syarat melampirkan Surat Pengantar dari Fakultas/Jurusan dan Proposal Penelitian yang sudah disetujui dosen pembimbing.
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" 
                            @click="activeFaq = activeFaq === 2 ? null : 2" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-indigo-600 transition">
                        <span>Bagaimana cara mengajukan Surat Keterangan Petir untuk klaim asuransi?</span>
                        <svg class="w-5 h-5 shrink-0 text-slate-400 transition-transform duration-300" 
                             :class="activeFaq === 2 ? 'rotate-180 text-indigo-600' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Pemohon (perusahaan atau perorangan) dapat mengajukan permohonan melalui portal layanan daring atau datang langsung ke kantor dengan melampirkan surat permohonan, mencantumkan tanggal/waktu kejadian, dan koordinat atau alamat lokasi terdampak secara spesifik. Petugas akan memverifikasi rekaman sensor petir dan menerbitkan surat keterangan resmi.
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" 
                            @click="activeFaq = activeFaq === 3 ? null : 3" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-indigo-600 transition">
                        <span>Berapa lama waktu yang dibutuhkan untuk proses penerbitan data?</span>
                        <svg class="w-5 h-5 shrink-0 text-slate-400 transition-transform duration-300" 
                             :class="activeFaq === 3 ? 'rotate-180 text-indigo-600' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Sesuai Standar Pelayanan (SLA) BMKG, estimasi proses verifikasi berkas dan penerbitan data adalah 1 hingga 3 hari kerja terhitung setelah berkas dinyatakan lengkap dan konfirmasi pembayaran PNBP telah diterima sistem Simponi.
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" 
                            @click="activeFaq = activeFaq === 4 ? null : 4" 
                            class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-bold text-slate-900 text-sm sm:text-base hover:text-indigo-600 transition">
                        <span>Bagaimana alur pembayaran tarif PNBP? Apakah bisa bayar tunai di kantor?</span>
                        <svg class="w-5 h-5 shrink-0 text-slate-400 transition-transform duration-300" 
                             :class="activeFaq === 4 ? 'rotate-180 text-indigo-600' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Untuk menjaga integritas dan transparansi bebas pungutan liar, <strong>petugas loket tidak menerima uang tunai</strong>. Pembayaran dilakukan secara mandiri menggunakan Kode Billing Simponi melalui transfer bank, ATM, internet banking, atau teller resmi yang terafiliasi dengan kas negara.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. Layanan Tatap Muka & Loket Geofisika --}}
    <section class="py-16 bg-white">
        <div class="max-w-3xl mx-auto px-6 sm:px-8">
            <div class="bg-white rounded-3xl p-7 sm:p-10 border border-slate-200/90 shadow-sm service-reveal">
                <div class="text-center">
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Layanan Tatap Muka</span>
                    <h2 class="mt-2 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        Loket Layanan Geofisika
                    </h2>
                    <p class="mt-3 text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl mx-auto">
                        Kunjungi loket pelayanan di gedung operasional kami untuk permohonan data langsung atau verifikasi dokumen fisik:
                    </p>
                </div>

                <div class="mt-8 space-y-4">
                    {{-- Jam Operasional Loket --}}
                    <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs sm:text-sm font-bold text-slate-900 uppercase tracking-wider">Jam Operasional Loket</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1.5 leading-relaxed">
                                Senin – Kamis: <span class="font-semibold text-slate-900">08.00 – 15.00 WITA</span> (Istirahat 12.00 – 13.00)
                            </p>
                            <p class="text-xs sm:text-sm text-slate-600 mt-0.5 leading-relaxed">
                                Jumat: <span class="font-semibold text-slate-900">08.00 – 15.30 WITA</span> (Istirahat 11.30 – 13.30)
                            </p>
                        </div>
                    </div>

                    {{-- Email Resmi Pelayanan --}}
                    <div class="p-5 sm:p-6 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start sm:items-center justify-between gap-4 flex-col sm:flex-row">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs sm:text-sm font-bold text-slate-900 uppercase tracking-wider">Email Resmi Pelayanan</h3>
                                <a href="mailto:stageof.balikpapan@bmkg.go.id" class="text-xs sm:text-sm text-indigo-600 font-bold mt-1 block hover:underline">
                                    stageof.balikpapan@bmkg.go.id
                                </a>
                            </div>
                        </div>
                        <a href="mailto:stageof.balikpapan@bmkg.go.id" 
                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition shadow-xs">
                            Kirim Email
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Script IntersectionObserver untuk Entrance Scroll Reveal --}}
    <script>
        (function() {
            function initServiceScrollReveal() {
                var elements = document.querySelectorAll('.service-reveal:not(.revealed)');
                if (!elements.length) return;

                if (!('IntersectionObserver' in window)) {
                    elements.forEach(function(el) {
                        el.classList.add('revealed');
                    });
                    return;
                }

                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.08,
                    rootMargin: '0px 0px -30px 0px'
                });

                elements.forEach(function(el) {
                    observer.observe(el);
                });
            }

            if (document.readyState === 'complete' || document.readyState === 'interactive') {
                setTimeout(initServiceScrollReveal, 60);
            } else {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(initServiceScrollReveal, 60);
                });
            }

            document.addEventListener('livewire:navigated', function() {
                setTimeout(initServiceScrollReveal, 60);
            });
        })();
    </script>

</x-layouts.app>
