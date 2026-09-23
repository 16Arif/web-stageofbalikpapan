<x-layouts.app>
    <x-slot:title>Sambaran Petir Realtime - Stasiun Geofisika Balikpapan</x-slot:title>

    {{-- Breadcrumb Minimalis --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-8 pb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-700">
            <li>
                <a href="{{ route('home_page') }}" class="hover:text-indigo-600 hover:underline transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-500">Geofisika</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-indigo-600 font-semibold">Sambaran Petir Realtime</span>
                </div>
            </li>
        </ol>
    </div>

    {{-- Main Container --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 pb-16">
        
        {{-- Header Page --}}
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Monitoring Sambaran Petir Realtime
            </h1>
            <p class="mt-2 text-sm sm:text-base text-slate-600 max-w-3xl leading-relaxed">
                Pemantauan aktivitas sambaran petir di wilayah Kalimantan dan sekitarnya menggunakan sensor <i>Lightning Detector</i> BMKG.
            </p>
        </div>

        @php
            $sensors = [
                ['name' => 'Balikpapan', 'desc' => 'Stageof Balikpapan', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stageof.balikpapan/', 'default' => true],
                ['name' => 'Berau', 'desc' => 'Stamet Kalimarau', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.kalimarau/'],
                ['name' => 'Sampit', 'desc' => 'Stamet H. Asan', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.sampit/'],
                ['name' => 'Tarakan', 'desc' => 'Stamet Tarakan', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.tarakan/'],
                ['name' => 'Pontianak', 'desc' => 'Stamet Supadio', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.pontianak/'],
                ['name' => 'Banjarmasin', 'desc' => 'Stamet Syamsudin Noor', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.banjarmasin/'],
                ['name' => 'Palangkaraya', 'desc' => 'Stamet Tjilik Riwut', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.palangkaraya/'],
                ['name' => 'Pangkalanbun', 'desc' => 'Stamet Iskandar', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.pangkalanbun/'],
                ['name' => 'Muara Teweh', 'desc' => 'Stamet Beringin', 'url' => 'https://simora.bmkg.go.id/petir_upt/petir_stamet.beringin/'],
            ];
        @endphp

        {{-- Pilihan Lokasi Sensor Petir (Dropdown) --}}
        <div class="mb-6 bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <label for="sensor-select" class="block text-xs sm:text-sm font-bold text-slate-800 uppercase tracking-wider mb-1">
                        Pilih Lokasi Sensor Lightning Detector
                    </label>
                    <p class="text-xs text-slate-500">Pilih stasiun pengamatan sensor petir di wilayah Kalimantan</p>
                </div>
                <div class="w-full sm:w-80">
                    <select id="sensor-select" 
                            class="w-full rounded-xl border border-slate-300 text-sm font-semibold text-slate-800 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-xs py-2.5 px-3 cursor-pointer">
                        @foreach($sensors as $sensor)
                            <option value="{{ $sensor['url'] }}" data-name="{{ $sensor['name'] }}" {{ !empty($sensor['default']) ? 'selected' : '' }}>
                                {{ $sensor['name'] }} {{ !empty($sensor['default']) ? '(Default)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- SIMORA Card Container --}}
        <div id="simora-card" class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden transition-all duration-300">
            
            {{-- Card Action Bar --}}
            <div class="px-5 py-4 bg-slate-900 text-white flex flex-wrap items-center justify-between gap-3 border-b border-slate-800">
                <div>
                    <h2 class="text-sm font-bold text-white tracking-wide">Peta Deteksi Sambaran Petir</h2>
                    <p class="text-xs text-slate-400" id="card-sensor-location">Lokasi Sensor: Balikpapan (Default)</p>
                </div>

                <div class="flex items-center gap-2">
                    {{-- Refresh Button --}}
                    <button type="button" 
                            id="btn-refresh-simora" 
                            title="Segarkan data peta"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium transition cursor-pointer border border-slate-700">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>Segarkan</span>
                    </button>

                    {{-- Fullscreen Toggle --}}
                    <button type="button" 
                            id="btn-fullscreen-simora" 
                            title="Tampilan layar penuh"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-medium transition cursor-pointer border border-slate-700">
                        <svg id="icon-maximize" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                        <svg id="icon-minimize" class="w-3.5 h-3.5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span id="label-fullscreen">Layar Penuh</span>
                    </button>

                    {{-- Open External Link --}}
                    <a id="btn-external-simora"
                       href="https://simora.bmkg.go.id/petir_upt/petir_stageof.balikpapan/" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       title="Buka portal SIMORA langsung di tab baru"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium transition shadow-sm">
                        <span>Tab Baru</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Iframe Container --}}
            <div class="relative w-full bg-slate-950 aspect-[4/3] sm:aspect-auto sm:h-[680px] lg:h-[780px]">
                
                {{-- Loading Skeleton / Spinner --}}
                <div id="simora-loading" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900 text-slate-300 gap-3 z-10">
                    <svg class="animate-spin h-9 w-9 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <p class="text-xs font-medium tracking-wide text-slate-400">Menghubungkan ke server SIMORA BMKG...</p>
                </div>

                {{-- Embedded SIMORA Iframe --}}
                <iframe 
                    id="simora-iframe"
                    src="https://simora.bmkg.go.id/petir_upt/petir_stageof.balikpapan/" 
                    class="w-full h-full border-0 relative z-20"
                    loading="lazy"
                    allowfullscreen
                    onload="document.getElementById('simora-loading').style.display='none';"
                ></iframe>
            </div>

            {{-- Card Footer --}}
            <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
                <div class="flex items-center gap-2">
                    <span>Sumber: Sistem Monitoring Operasional dan Riset Terpadu (SIMORA) BMKG</span>
                </div>
                <div class="text-[11px] text-slate-400">
                    Waktu pengamatan disajikan dalam Waktu Indonesia Bagian Tengah (WITA) / UTC+8
                </div>
            </div>
        </div>

        {{-- Panduan & Penjelasan Sambaran Petir --}}
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900">Sistem Deteksi Petir</h3>
                <p class="text-xs leading-relaxed text-slate-600">
                    Menggunakan instrumen <i>Lightning Detector</i> dengan teknologi sensor magnetik dan frekuensi radio untuk mendeteksi waktu kedatangan dan arah rambatan kilatan petir secara akurat.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900">Klasifikasi Sambaran</h3>
                <p class="text-xs leading-relaxed text-slate-600">
                    Memantau sambaran awan ke tanah (<i>Cloud-to-Ground</i> / CG) baik muatan positif maupun negatif, serta sambaran antaran awan (<i>Intra-Cloud</i> / IC) yang mengindikasikan intensitas awan Cumulonimbus (Cb).
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900">Mitigasi & Keselamatan</h3>
                <p class="text-xs leading-relaxed text-slate-600">
                    Informasi ini sangat krusial bagi operasional penerbangan, sektor industri energi, maritim, serta keselamatan publik saat beraktivitas di ruang terbuka ketika terjadi awan konvektif.
                </p>
            </div>
        </div>

    </section>

    {{-- Script interaktivitas kartu & pemilihan sensor via dropdown --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.getElementById('simora-card');
            const iframe = document.getElementById('simora-iframe');
            const loading = document.getElementById('simora-loading');
            const btnRefresh = document.getElementById('btn-refresh-simora');
            const btnFullscreen = document.getElementById('btn-fullscreen-simora');
            const btnExternal = document.getElementById('btn-external-simora');
            const iconMax = document.getElementById('icon-maximize');
            const iconMin = document.getElementById('icon-minimize');
            const labelFs = document.getElementById('label-fullscreen');
            const cardLocationLabel = document.getElementById('card-sensor-location');
            const sensorSelect = document.getElementById('sensor-select');

            // Ganti Lokasi Sensor via Dropdown Select
            if (sensorSelect && iframe) {
                sensorSelect.addEventListener('change', (e) => {
                    const selectedOption = e.target.options[e.target.selectedIndex];
                    const url = e.target.value;
                    const name = selectedOption.getAttribute('data-name');

                    if (!url) return;

                    // Tampilkan loading & ubah URL iframe
                    if (loading) loading.style.display = 'flex';
                    iframe.src = url;

                    // Update Tautan Tab Baru
                    if (btnExternal) btnExternal.href = url;

                    // Update Label Nama Lokasi pada Kartu
                    if (cardLocationLabel) cardLocationLabel.textContent = 'Lokasi Sensor: ' + name + (name === 'Balikpapan' ? ' (Default)' : '');
                });
            }

            // Segarkan iframe
            if (btnRefresh && iframe) {
                btnRefresh.addEventListener('click', () => {
                    if (loading) loading.style.display = 'flex';
                    iframe.src = iframe.src;
                });
            }

            // Toggle Layar Penuh
            if (btnFullscreen && card) {
                btnFullscreen.addEventListener('click', () => {
                    if (!document.fullscreenElement) {
                        card.requestFullscreen().then(() => {
                            iconMax.classList.add('hidden');
                            iconMin.classList.remove('hidden');
                            labelFs.textContent = 'Keluar';
                        }).catch(err => {
                            console.error('Error entering fullscreen:', err);
                        });
                    } else {
                        document.exitFullscreen().then(() => {
                            iconMax.classList.remove('hidden');
                            iconMin.classList.add('hidden');
                            labelFs.textContent = 'Layar Penuh';
                        });
                    }
                });

                document.addEventListener('fullscreenchange', () => {
                    if (!document.fullscreenElement) {
                        iconMax.classList.remove('hidden');
                        iconMin.classList.add('hidden');
                        labelFs.textContent = 'Layar Penuh';
                    }
                });
            }
        });
    </script>
</x-layouts.app>
