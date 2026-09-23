<x-layouts.app>
    <x-slot:title>Tarif PNBP Layanan BMKG - Stasiun Geofisika Balikpapan</x-slot:title>

    {{-- Hero Section Banner --}}
    <section class="relative isolate overflow-hidden bg-slate-950 py-16 sm:py-20 border-b border-slate-800">
        <img src="{{ asset('images/pelayanan-hero-bg.jpg') }}" 
             alt="Latar Belakang Tarif PNBP" 
             class="absolute inset-0 -z-10 h-full w-full object-cover object-center opacity-35" />

        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-slate-950 via-slate-950/85 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            {{-- Breadcrumb Navigasi --}}
            <nav class="flex items-center gap-2 text-xs font-semibold text-blue-200 mb-6">
                <a href="{{ route('pelayanan') }}" wire:navigate class="hover:text-white transition">Layanan Geofisika</a>
                <span>/</span>
                <span class="text-white">Tarif PNBP</span>
            </nav>

            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 backdrop-blur-xs text-xs font-semibold text-blue-200 uppercase tracking-widest mb-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Peraturan Pemerintah No. 47 Tahun 2018
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white uppercase drop-shadow-sm">
                    Jenis Layanan & Tarif PNBP
                </h1>
                <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                    Daftar resmi Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak (PNBP) yang berlaku pada Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) berpedoman pada <strong>PP No. 47 Tahun 2018</strong>.
                </p>
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate 
                       class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-xs sm:text-sm font-bold text-white shadow-md hover:bg-indigo-700 transition">
                        <span>Mekanisme Permohonan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.pages.dashboard') : route('pelayanan.login') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-white/10 border border-white/25 backdrop-blur-xs px-5 py-2.5 text-xs sm:text-sm font-bold text-white hover:bg-white/20 transition">
                        <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Portal Pemohon Daring</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Interactive Content Section (Alpine.js Filter & Search) --}}
    <section class="py-12 sm:py-16 bg-slate-50 min-h-screen" 
             x-data="{
                search: '',
                selectedCategory: 'all',
                categories: [
                    { id: 'all', label: 'Semua Layanan' },
                    { id: 'geofisika_priority', label: 'Prioritas Geofisika', badge: 'Utama' },
                    { id: 'informasi', label: 'I. Informasi MKG' },
                    { id: 'konsultasi', label: 'II. Jasa Konsultasi' },
                    { id: 'kalibrasi', label: 'III. Jasa Kalibrasi' },
                    { id: 'penggunaan_alat', label: 'IV. Penggunaan Alat' },
                    { id: 'stmkg', label: 'V. STMKG' },
                    { id: 'diklat', label: 'VI. Diklat MKG' },
                    { id: 'gedung', label: 'VII. Sewa Gedung' },
                ],
                services: [
                    {{-- I. INFORMASI METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA --}}
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Informasi Cuaca untuk Penerbangan', unit: 'per route unit', price: '4% dari biaya navigasi penerbangan', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Informasi Cuaca untuk Pelayaran', unit: 'per route per hari', price: 'Rp 250.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Informasi Cuaca untuk Pelabuhan', unit: 'per lokasi per hari', price: 'Rp 225.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Informasi Cuaca untuk Pengeboran Lepas Pantai', unit: 'per dokumen per lokasi per hari', price: 'Rp 330.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Analisis dan Prakiraan Hujan Bulanan (Agro Industri)', unit: 'per buku', price: 'Rp 65.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Prakiraan Musim Kemarau (Agro Industri)', unit: 'per buku', price: 'Rp 230.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Prakiraan Musim Hujan (Agro Industri)', unit: 'per buku', price: 'Rp 230.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Atlas Kesesuaian Agroklimat', unit: 'per buku', price: 'Rp 470.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Atlas Normal Temperatur Periode 1981-2010', unit: 'per buku', price: 'Rp 1.500.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Atlas Windrose Wilayah Indonesia Periode 1981-2010', unit: 'per buku', price: 'Rp 1.500.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus MKG', name: 'Atlas Curah Hujan di Indonesia Rata-rata 1981-2010', unit: 'per buku', price: 'Rp 1.500.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Particulate Matter (PM10) Mingguan', unit: 'per stasiun per tahun', price: 'Rp 70.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Particulate Matter (PM2.5) Mingguan', unit: 'per stasiun per tahun', price: 'Rp 70.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Sulfur Dioksida (SO2) Mingguan', unit: 'per stasiun per tahun', price: 'Rp 60.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Nitrogen Oksida (NOx) Mingguan', unit: 'per stasiun per tahun', price: 'Rp 60.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Ozon (O3) Mingguan', unit: 'per stasiun per tahun', price: 'Rp 60.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Karbon Monoksida (CO) Mingguan', unit: 'per stasiun per tahun', price: 'Rp 60.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Karbon Dioksida (CO2) Mingguan', unit: 'per sampel', price: 'Rp 80.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Kualitas Udara Industri', name: 'Methan (CH4) Mingguan', unit: 'per sampel', price: 'Rp 80.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Perencanaan Konstruksi Sipil', name: 'Peta Kegempaan Regional', unit: 'per provinsi per tahun', price: 'Rp 250.000,00', isGeo: true },
                    { cat: 'informasi', sub: 'Perencanaan Konstruksi Sipil', name: 'Peta Percepatan Tanah (PGA - Peak Ground Acceleration)', unit: 'per provinsi per tahun', price: 'Rp 250.000,00', isGeo: true },
                    { cat: 'informasi', sub: 'Klaim Asuransi', name: 'Informasi Cuaca Ekstrem / Meteorologi untuk Klaim Asuransi', unit: 'per lokasi per hari', price: 'Rp 175.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Klaim Asuransi', name: 'Informasi Kejadian Gempabumi / Geofisika untuk Klaim Asuransi', unit: 'per lokasi per hari', price: 'Rp 185.000,00', isGeo: true },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Informasi Cuaca Khusus untuk Olahraga', unit: 'per lokasi per hari', price: 'Rp 100.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Informasi Cuaca Khusus Komersial Outdoor/Indoor', unit: 'per lokasi per hari', price: 'Rp 100.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Informasi Radar Cuaca (per 10 Menit)', unit: 'per data per lokasi', price: 'Rp 70.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Peta Spasial Informasi Maritim', unit: 'per peta per bulan', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Peta Spasial Potensi Energi Angin', unit: 'per peta per bulan', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Peta Spasial Potensi Energi Radiasi Matahari', unit: 'per peta per bulan', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Peta Spasial Iklim Lingkungan', unit: 'per peta per bulan', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Kerentanan Perubahan Iklim', unit: 'per peta per bulan', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Particulate Matter (PM10) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Particulate Matter (PM2.5) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Sulfur Dioksida (SO2) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Nitrogen Oksida (NOx) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Ozon (O3) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Karbon Monoksida (CO) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Karbon Dioksida (CO2) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Methan (CH4) Otomatis', unit: 'per stasiun per tahun', price: 'Rp 110.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Total Suspended Particulate (TSP)', unit: 'per stasiun per tahun', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Khusus Permintaan', name: 'Kimia Air Hujan', unit: 'per stasiun per tahun', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'informasi', sub: 'Informasi Petir & Proteksi', name: 'Informasi Kejadian Sambaran Petir (CG & IC)', unit: 'per lokasi per hari', price: 'Rp 75.000,00', isGeo: true },

                    {{-- II. JASA KONSULTASI METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA --}}
                    { cat: 'konsultasi', sub: 'Konsultasi Meteorologi', name: 'Informasi Meteorologi Khusus Pendukung Proyek, Survei, dan Penelitian Komersial', unit: 'per lokasi', price: 'Rp 3.750.000,00', isGeo: false },
                    { cat: 'konsultasi', sub: 'Konsultasi Klimatologi', name: 'Analisis Iklim Khusus Proyek Komersial', unit: 'per lokasi', price: 'Rp 9.500.000,00', isGeo: false },
                    { cat: 'konsultasi', sub: 'Konsultasi Geofisika', name: 'Informasi Pendahuluan di Bidang Geofisika untuk Proyek, Survei, dan Penelitian Komersial', unit: 'per lokasi', price: 'Rp 12.300.000,00', isGeo: true },

                    {{-- III. JASA KALIBRASI ALAT METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA --}}
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Barometer Aneroid', unit: 'per unit', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Barometer Air Raksa', unit: 'per unit', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Barograph', unit: 'per unit', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Thermometer Bola Basah / Kering / Maksimum / Minimum', unit: 'per unit', price: 'Rp 285.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Thermometer Tanah', unit: 'per unit', price: 'Rp 280.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Thermometer Apung / Rumput / Minimum Rumput', unit: 'per unit', price: 'Rp 285.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Thermohygrograph (2 Sensor)', unit: 'per unit', price: 'Rp 735.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Portable Weather Station (PWS) (5 Sensor)', unit: 'per unit', price: 'Rp 2.570.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Hygrometer (Kelembaban Udara)', unit: 'per unit', price: 'Rp 450.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Campbell Stokes', unit: 'per unit', price: 'Rp 205.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Panci Penguapan', unit: 'per unit', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Alat Penguapan Lengkap', unit: 'per unit', price: 'Rp 2.020.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Cup Counter Anemometer', unit: 'per unit', price: 'Rp 1.150.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Psychrometer Assman (2 Sensor)', unit: 'per unit', price: 'Rp 570.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Actinograph', unit: 'per unit', price: 'Rp 205.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Penakar Hujan Observatorium (Obs)', unit: 'per unit', price: 'Rp 210.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Penakar Hujan Hellman', unit: 'per unit', price: 'Rp 265.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Penakar Hujan Tipping Bucket', unit: 'per unit', price: 'Rp 270.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Theodolite', unit: 'per unit', price: 'Rp 200.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Mekanik Konvensional', name: 'Pyranometer', unit: 'per unit', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Elektronik Otomatis', name: 'Anemometer (2 Sensor)', unit: 'per unit', price: 'Rp 1.235.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Elektronik Otomatis', name: 'Digital Hand Anemometer', unit: 'per unit', price: 'Rp 1.150.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Elektronik Otomatis', name: 'Digital Barometer', unit: 'per unit', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Automatic Weather Station (AWS) (5 Sensor)', unit: 'per unit', price: 'Rp 2.240.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Automatic Weather Station (AWS) (6 - 7 Sensor)', unit: 'per unit', price: 'Rp 2.640.000,00 - Rp 3.040.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Automatic Weather Station (AWS) (11 Sensor)', unit: 'per unit', price: 'Rp 4.775.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Marine Automatic Weather Station (MAWS) (9 Sensor)', unit: 'per unit', price: 'Rp 3.475.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Automatic Weather Observation System (AWOS) (9 Sensor)', unit: 'per unit', price: 'Rp 4.790.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Agroclimate Automatic Weather System (AAWS) (11 - 32 Sensor)', unit: 'per unit', price: 'Rp 4.360.000,00 - Rp 6.600.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Sensor Runway Visual Range (RVR)', unit: 'per unit', price: 'Rp 800.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Teknologi Canggih', name: 'Ceilometer (AWOS)', unit: 'per unit', price: 'Rp 950.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Alat Standar', name: 'Barometer Standar', unit: 'per unit', price: 'Rp 1.180.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Alat Standar', name: 'Thermometer Standar', unit: 'per unit', price: 'Rp 920.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Alat Standar', name: 'Hygrometer Standar', unit: 'per unit', price: 'Rp 2.010.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Alat Standar', name: 'Anemometer Standar', unit: 'per unit', price: 'Rp 1.650.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Portable Analog Seismograph', unit: 'per unit', price: 'Rp 1.500.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Short Period Seismograph (SPS-1 & SPS-3)', unit: 'per unit', price: 'Rp 1.500.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Portable Digital Seismograph (3 Komponen)', unit: 'per unit', price: 'Rp 1.750.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Digital Broadband Seismograph (3 Komponen)', unit: 'per unit', price: 'Rp 1.750.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Digital Accelerograph (3 Komponen)', unit: 'per unit', price: 'Rp 1.750.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Gravimeter', unit: 'per unit', price: 'Rp 4.450.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Alat Geofisika', name: 'Terrameter SAS 1000 (Geolistrik)', unit: 'per unit', price: 'Rp 280.000,00', isGeo: true },
                    { cat: 'kalibrasi', sub: 'Ukur Kelistrikan MKG', name: 'Multi Meter & Clamp Meter', unit: 'per unit', price: 'Rp 260.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Ukur Kelistrikan MKG', name: 'Grounding Tester', unit: 'per unit', price: 'Rp 300.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Ukur Kelistrikan MKG', name: 'Oscilloscope & Frequency Counter', unit: 'per unit', price: 'Rp 1.000.000,00', isGeo: false },
                    { cat: 'kalibrasi', sub: 'Ukur Kelistrikan MKG', name: 'Function Generator', unit: 'per unit', price: 'Rp 1.900.000,00', isGeo: false },

                    {{-- IV. JASA PENGGUNAAN ALAT METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA --}}
                    { cat: 'penggunaan_alat', sub: 'Sederhana Mekanik', name: 'Barometer Aneroid / Air Raksa', unit: 'per minggu', price: 'Rp 60.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Mekanik', name: 'Barograph & Campbell Stokes', unit: 'per minggu', price: 'Rp 70.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Mekanik', name: 'Thermometer Tanah / Thermohygrograph', unit: 'per minggu', price: 'Rp 55.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Mekanik', name: 'Portable Weather Station (PWS)', unit: 'per minggu', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Mekanik', name: 'Cup Counter Anemometer', unit: 'per minggu', price: 'Rp 35.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Mekanik', name: 'Psychrometer Assman & Actinograph', unit: 'per minggu', price: 'Rp 45.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Elektronik', name: 'Anemometer Otomatis', unit: 'per minggu', price: 'Rp 190.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Elektronik', name: 'Digital Hand Anemometer', unit: 'per minggu', price: 'Rp 90.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Elektronik', name: 'Digital Barometer', unit: 'per minggu', price: 'Rp 160.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Sederhana Elektronik', name: 'Teropong Rukyat (Low Grade)', unit: 'per hari per unit', price: 'Rp 230.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Portable Automatic Weather Station (PAWS)', unit: 'per minggu', price: 'Rp 700.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Portable Marine AWS (PMAWS)', unit: 'per minggu', price: 'Rp 700.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Thermal Imager', unit: 'per hari', price: 'Rp 150.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'System Grounding Tester', unit: 'per hari', price: 'Rp 200.000,00', isGeo: false },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Proton Magnetograph', unit: 'per hari per unit', price: 'Rp 400.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Portable Digital Short Period Seismograph', unit: 'per hari per unit', price: 'Rp 640.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Portable Digital Broadband Seismograph', unit: 'per hari per unit', price: 'Rp 970.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Portable Digital Broadband Accelerograph', unit: 'per hari per unit', price: 'Rp 735.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Mikrotremor Array (Survei Bahaya Gempa)', unit: 'per hari per unit', price: 'Rp 4.000.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Mikrotremor Civil Engineering (Uji Resonansi Bangunan)', unit: 'per hari per unit', price: 'Rp 680.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Multichannel Analysis of Surface Wave (MASW)', unit: 'per hari per unit', price: 'Rp 1.750.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Gravimeter', unit: 'per hari per unit', price: 'Rp 600.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'GPS Geodesi Presisi Tinggi', unit: 'per hari per unit', price: 'Rp 270.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Deklinasi dan Inklinasi Magnetometer', unit: 'per hari per unit', price: 'Rp 400.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Magnetotellurik 5 CH', unit: 'per hari', price: 'Rp 4.000.000,00', isGeo: true },
                    { cat: 'penggunaan_alat', sub: 'Teknologi Canggih & Geofisika', name: 'Teropong Rukyat High Grade', unit: 'per hari per unit', price: 'Rp 400.000,00', isGeo: true },

                    {{-- V. JASA PENYELENGGARAAN SEKOLAH TINGGI METEOROLOGI KLIMATOLOGI DAN GEOFISIKA --}}
                    { cat: 'stmkg', sub: 'Pendidikan Kedinasan', name: 'Uang Pendaftaran dan Seleksi Masuk STMKG', unit: 'per orang', price: 'Rp 75.000,00', isGeo: false },
                    { cat: 'stmkg', sub: 'Pendidikan Kedinasan', name: 'SPP Tetap STMKG dari Instansi Lain', unit: 'per orang per semester', price: 'Rp 4.500.000,00', isGeo: false },

                    {{-- VI. JASA PENYELENGGARAN PENDIDIKAN DAN PELATIHAN --}}
                    { cat: 'diklat', sub: 'Diklat Teknis & Sertifikasi', name: 'Diklat Teknis/Fungsional/Sertifikasi MKG Nonpegawai BMKG (10 hari, min. 30 org)', unit: 'per orang', price: 'Rp 5.500.000,00', isGeo: false },
                    { cat: 'diklat', sub: 'Diklat Teknis & Sertifikasi', name: 'Modul Diklat Bidang Meteorologi, Klimatologi, atau Geofisika', unit: 'per buku', price: 'Rp 100.000,00', isGeo: false },

                    {{-- VII. JASA PENGGUNAAN GEDUNG & RUANG --}}
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Ruang Aula (Termasuk AC & Penerangan)', unit: 'per 8 jam', price: 'Rp 1.500.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Tambahan Penggunaan Ruang Aula', unit: 'per jam', price: 'Rp 200.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Ruang Sinema', unit: 'per 8 jam', price: 'Rp 1.500.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Tambahan Penggunaan Ruang Sinema', unit: 'per jam', price: 'Rp 200.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Ruang Kelas', unit: 'per 8 jam per ruang', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Tambahan Penggunaan Ruang Kelas', unit: 'per jam per ruang', price: 'Rp 50.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Ruang Komputer', unit: 'per 8 jam', price: 'Rp 400.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Tambahan Penggunaan Ruang Komputer', unit: 'per jam', price: 'Rp 50.000,00', isGeo: false },
                    { cat: 'gedung', sub: 'Sewa Fasilitas BMKG', name: 'Kamar Asrama', unit: 'per orang per hari', price: 'Rp 225.000,00', isGeo: false },
                ],
                get filteredServices() {
                    return this.services.filter(item => {
                        const matchCat = (this.selectedCategory === 'all') || 
                                         (this.selectedCategory === 'geofisika_priority' && item.isGeo) ||
                                         (this.selectedCategory === item.cat);
                        
                        const query = this.search.toLowerCase().trim();
                        const matchQuery = !query || 
                                           item.name.toLowerCase().includes(query) || 
                                           item.sub.toLowerCase().includes(query) ||
                                           item.unit.toLowerCase().includes(query) ||
                                           item.price.toLowerCase().includes(query);
                        
                        return matchCat && matchQuery;
                    });
                }
             }">

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
            
            {{-- Banner Edukasi: Fasilitas Tarif Rp 0,- (Gratis untuk Mahasiswa & Kebencanaan) --}}
            <div class="mb-10 rounded-3xl bg-gradient-to-br from-emerald-50 via-teal-50/90 to-sky-100/90 p-7 sm:p-8 shadow-lg border border-teal-200/60 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-teal-300/15 rounded-full blur-2xl"></div>
                <div class="absolute -left-6 -top-6 w-32 h-32 bg-emerald-200/20 rounded-full blur-2xl"></div>
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
                    <div class="max-w-3xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100/80 border border-emerald-300/50 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Fasilitas Tarif Rp 0,00 (Gratis)</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-black tracking-tight text-slate-900">
                            Apakah Mahasiswa & Lembaga Riset Dikenakan Biaya?
                        </h3>
                        <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Berdasarkan <strong>Pasal 10 & 11 PP No. 47 Tahun 2018</strong>, penyediaan data dan informasi dapat dikenakan <strong>Tarif Rp 0,00 (Nol Rupiah)</strong> untuk kegiatan kenegaraan, penanggulangan bencana, riset akademis mahasiswa (skripsi/tesis), serta instansi pemerintah yang memiliki MoU/PKS resmi dengan BMKG.
                        </p>
                    </div>
                    <div class="shrink-0 flex flex-col sm:flex-row lg:flex-col gap-3">
                        <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-teal-600 text-white font-bold text-xs sm:text-sm hover:bg-teal-700 transition shadow-sm">
                            <span>Syarat Tarif Rp 0,-</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.resources.permohonan-sayas.create') : route('pelayanan.login') }}"
                           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white border border-teal-200 text-teal-800 font-bold text-xs sm:text-sm hover:bg-teal-50 transition shadow-sm">
                            <span>Ajukan Permohonan</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Filter & Search Panel --}}
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm mb-8">
                
                {{-- Search Box & Counter --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    <div class="relative w-full sm:max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               x-model="search"
                               placeholder="Cari jenis layanan, alat, atau tarif (cth: petir, gempa, seismograph)..." 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 text-xs sm:text-sm text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition outline-none" />
                        <button type="button" 
                                x-show="search.length > 0" 
                                @click="search = ''"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold self-end sm:self-center">
                        <span>Menampilkan:</span>
                        <span class="px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-700 font-bold" x-text="filteredServices.length + ' Layanan'"></span>
                    </div>
                </div>

                {{-- Category Pill Switcher --}}
                <div class="pt-6">
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-slate-200">
                        <template x-for="cat in categories" :key="cat.id">
                            <button type="button" 
                                    @click="selectedCategory = cat.id"
                                    :class="selectedCategory === cat.id ? 'bg-indigo-600 text-white shadow-sm ring-2 ring-indigo-600/30' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition cursor-pointer shrink-0">
                                <span x-text="cat.label"></span>
                                <template x-if="cat.badge">
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-extrabold uppercase bg-amber-400 text-slate-950" x-text="cat.badge"></span>
                                </template>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Table of Services and Tariffs --}}
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden mb-14 sm:mb-16">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 font-bold uppercase tracking-wider text-[11px]">
                                <th class="py-4 px-4 sm:px-6 w-14 text-center">No</th>
                                <th class="py-4 px-4 sm:px-6">Jenis Penerimaan Negara Bukan Pajak (PNBP)</th>
                                <th class="py-4 px-4 sm:px-6 w-48 sm:w-56 text-center">Satuan</th>
                                <th class="py-4 px-4 sm:px-6 w-48 sm:w-56 text-right">Tarif Resmi</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <template x-for="(item, index) in filteredServices" :key="index">
                                <tr class="hover:bg-indigo-50/30 transition group">
                                    {{-- No --}}
                                    <td class="py-3.5 px-4 sm:px-6 text-center text-slate-400 font-semibold" x-text="index + 1"></td>
                                    
                                    {{-- Jenis Layanan --}}
                                    <td class="py-3.5 px-4 sm:px-6">
                                        <div class="flex items-start gap-2">
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition" x-text="item.name"></span>
                                                    <template x-if="item.isGeo">
                                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-200">
                                                            Geofisika
                                                        </span>
                                                    </template>
                                                </div>
                                                <span class="text-[11px] text-slate-500 font-medium block mt-0.5" x-text="item.sub"></span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Satuan --}}
                                    <td class="py-3.5 px-4 sm:px-6 text-center text-slate-600 font-medium whitespace-nowrap" x-text="item.unit"></td>

                                    {{-- Tarif --}}
                                    <td class="py-3.5 px-4 sm:px-6 text-right whitespace-nowrap">
                                        <span class="font-black text-slate-900" x-text="item.price"></span>
                                    </td>


                                </tr>
                            </template>

                            {{-- Empty State jika tidak ditemukan data --}}
                            <tr x-show="filteredServices.length === 0">
                                <td colspan="4" class="py-16 text-center text-slate-500">
                                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-bold text-slate-800">Layanan tidak ditemukan</p>
                                    <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci pencarian lain atau pilih kategori "Semua Layanan".</p>
                                    <button type="button" @click="search = ''; selectedCategory = 'all'" class="mt-4 px-4 py-2 rounded-xl bg-indigo-50 text-indigo-700 font-bold text-xs hover:bg-indigo-100 transition">
                                        Reset Filter
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Table Footer Summary Note --}}
                <div class="p-5 sm:p-6 bg-slate-50/80 border-t border-slate-200 text-xs text-slate-500 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <p class="leading-relaxed">
                        * Seluruh pembayaran tarif PNBP wajib disetorkan ke Kas Negara melalui <strong>Kode Billing Simponi Kemenkeu</strong> (Cashless). Petugas dilarang menerima uang tunai.
                    </p>

                </div>
            </div>

            {{-- Bottom CTA Section --}}
            <div class="mt-12 text-center">
                <h3 class="text-lg sm:text-xl font-bold text-slate-900 mb-2">Butuh Bantuan Seputar Permohonan Data?</h3>
                <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto mb-6">
                    Pelajari mekanisme dan tata cara permohonan data geofisika atau langsung hubungi petugas kami melalui jalur layanan daring.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate 
                       class="px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold text-xs sm:text-sm hover:bg-slate-50 shadow-xs transition">
                        Panduan & Mekanisme Permohonan
                    </a>
                    <a href="{{ auth('applicant')->check() ? route('filament.pelayanan.pages.dashboard') : route('pelayanan.login') }}" 
                       class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold text-xs sm:text-sm hover:bg-indigo-700 shadow-md transition">
                        Masuk ke Portal Pemohon
                    </a>
                </div>
            </div>

        </div>
    </section>
</x-layouts.app>
