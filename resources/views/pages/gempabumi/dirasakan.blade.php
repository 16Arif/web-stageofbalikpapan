<x-layouts.app>
    <x-slot:title>Gempabumi Dirasakan - Stasiun Geofisika Balikpapan</x-slot:title>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-8 pb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-700">
            <li>
                <a href="{{ route('home_page') }}" class="hover:text-indigo-600 hover:underline transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="hover:text-indigo-600 hover:underline transition-colors cursor-pointer">Gempabumi</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-semibold">Gempabumi Dirasakan</span>
                </div>
            </li>
        </ol>
    </div>

    {{-- Sorotan Kejadian Gempa Dirasakan Terkini --}}
    <section class="py-12 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <span class="relative flex h-3.5 w-3.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-amber-500"></span>
                    </span>
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 uppercase tracking-tight">
                        Kejadian Gempabumi Dirasakan Terakhir
                    </h1>
                </div>
                <div class="inline-flex items-center gap-1.5 text-xs text-slate-500 font-medium bg-white px-3 py-1.5 rounded-full border border-slate-200 shadow-xs">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    <span>Sumber Data: BMKG Pusat</span>
                </div>
            </div>

            @if ($gempaTerkiniDirasakan)
                <div class="grid lg:grid-cols-5 gap-8 bg-slate-900 p-6 md:p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
                    {{-- Panel Informasi Kiri --}}
                    <div class="lg:col-span-2 flex flex-col justify-between rounded-[1.8rem] bg-slate-800/80 border border-slate-700/60 p-6 relative">
                        <div>
                            <div class="inline-flex items-center gap-2 mb-4">
                                <span class="px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/20 text-amber-300 text-[10px] font-black uppercase tracking-widest">
                                    Gempa Dirasakan
                                </span>
                            </div>

                            <p class="text-[11px] font-mono text-indigo-300 uppercase tracking-wider mb-1">Pusat Gempa</p>
                            <h2 class="text-xl md:text-2xl font-black text-white leading-snug">
                                {{ $gempaTerkiniDirasakan['region'] }}
                            </h2>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-700/60 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-900/60 p-3 rounded-xl border border-slate-700/40">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Magnitudo</p>
                                    <p class="text-2xl md:text-3xl font-black text-amber-400">
                                        {{ $gempaTerkiniDirasakan['magnitude'] }}
                                        <span class="text-xs font-normal text-slate-400">M</span>
                                    </p>
                                </div>
                                <div class="bg-slate-900/60 p-3 rounded-xl border border-slate-700/40">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Kedalaman</p>
                                    <p class="text-2xl md:text-3xl font-black text-white">
                                        {{ $gempaTerkiniDirasakan['depth'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="bg-slate-900/60 p-3 rounded-xl border border-slate-700/40 flex items-center justify-between text-xs">
                                <span class="text-slate-400 font-mono">Koordinat</span>
                                <span class="font-bold text-white font-mono">{{ $gempaTerkiniDirasakan['lintang'] }} - {{ $gempaTerkiniDirasakan['bujur'] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Panel Informasi Kanan --}}
                    <div class="lg:col-span-3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-4 border-b border-slate-800 text-xs text-slate-400">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="size-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Waktu Kejadian:
                                </span>
                                <span class="font-bold text-white text-sm">
                                    {{ $gempaTerkiniDirasakan['date'] }} | {{ $gempaTerkiniDirasakan['time'] }}
                                </span>
                            </div>

                            <div class="mt-6">
                                <p class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-3">
                                    Wilayah Dirasakan (Skala MMI):
                                </p>
                                <div class="bg-slate-800/60 border border-slate-700/50 rounded-2xl p-5">
                                    <p class="text-white text-base md:text-lg font-semibold leading-relaxed">
                                        {{ $gempaTerkiniDirasakan['felt'] }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 p-4 rounded-xl bg-indigo-950/40 border border-indigo-500/20 text-indigo-200 text-xs leading-relaxed flex items-start gap-3">
                                <svg class="size-5 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <strong class="text-white">Catatan Skala MMI:</strong>
                                    Skala Intensitas MMI (Modified Mercalli Intensity) menggambarkan dampak dan kekuatan guncangan gempa yang dirasakan oleh manusia, benda, dan bangunan di lokasi tertentu.
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="{{ route('gempabumi.terkini') }}" wire:navigate
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white text-xs font-bold transition">
                                <span>Lihat Gempa Terkini (M &gt; 5.0)</span>
                                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                            <a href="{{ route('gempabumi.mitigasi') }}" wire:navigate
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/30 text-amber-300 text-xs font-bold transition">
                                <span>Panduan Mitigasi Gempabumi</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm">
                    <p class="text-slate-500">Data gempabumi dirasakan sedang tidak dapat dimuat atau belum tersedia dari server BMKG.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Tabel Riwayat Gempa Dirasakan --}}
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">
                        Daftar 15 Gempabumi Dirasakan Terkini
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Pembaruan otomatis dari data resmi BMKG pusat untuk gempa yang dirasakan masyarakat di seluruh Indonesia.
                    </p>
                </div>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-slate-200 shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">
                                    Waktu Kejadian (WIB)
                                </th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center whitespace-nowrap">
                                    Magnitudo
                                </th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center whitespace-nowrap">
                                    Kedalaman
                                </th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[200px]">
                                    Pusat Gempabumi
                                </th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[280px]">
                                    Wilayah Dirasakan (Skala MMI)
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($listGempaDirasakan as $gempa)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap border-r border-slate-50">
                                        <p class="text-sm font-bold text-slate-900">{{ $gempa['date'] }}</p>
                                        <p class="text-xs text-slate-500 font-mono">{{ $gempa['time'] }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center justify-center size-10 rounded-xl {{ (float) ($gempa['magnitude'] ?? 0) >= 5.0 ? 'bg-rose-50 text-rose-600 border border-rose-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }} font-black text-sm">
                                            {{ $gempa['magnitude'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm font-bold text-slate-700 whitespace-nowrap">
                                        {{ $gempa['depth'] }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-black text-slate-900 leading-snug">{{ $gempa['region'] }}</p>
                                        <p class="text-[11px] text-slate-400 font-mono mt-1">
                                            {{ $gempa['lintang'] }} - {{ $gempa['bujur'] }} ({{ $gempa['coordinates'] }})
                                        </p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="inline-block bg-slate-100 text-slate-800 px-3.5 py-2 rounded-xl text-xs font-semibold leading-relaxed border border-slate-200/80">
                                            {{ $gempa['felt'] }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500 text-sm">
                                        Belum ada data gempabumi dirasakan yang dapat ditampilkan saat ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Edukasi Skala MMI --}}
            <div class="mt-12 bg-slate-50 rounded-3xl p-6 md:p-8 border border-slate-200">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <svg class="size-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tingkatan Skala Intensitas Gempabumi (MMI)
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                        <span class="font-black text-indigo-600 uppercase text-xs">Skala I - II MMI</span>
                        <p class="text-slate-600 mt-1">Guncangan tidak dirasakan atau hanya dirasakan oleh beberapa orang dalam keadaan tenang/diam.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                        <span class="font-black text-emerald-600 uppercase text-xs">Skala III MMI</span>
                        <p class="text-slate-600 mt-1">Getaran dirasakan nyata dalam rumah seakan ada truk yang berlalu.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                        <span class="font-black text-amber-600 uppercase text-xs">Skala IV MMI</span>
                        <p class="text-slate-600 mt-1">Dirasakan oleh orang banyak dalam rumah, pintu/jendela berderik, dinding berbunyi.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                        <span class="font-black text-orange-600 uppercase text-xs">Skala V MMI</span>
                        <p class="text-slate-600 mt-1">Dirasakan hampir semua penduduk, orang banyak terbangun, barang-barang terpelanting.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                        <span class="font-black text-rose-600 uppercase text-xs">Skala VI MMI</span>
                        <p class="text-slate-600 mt-1">Guncangan dirasakan oleh semua orang, kebanyakan kaget dan lari keluar, plester dinding jatuh.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-slate-200/80">
                        <span class="font-black text-red-700 uppercase text-xs">Skala &ge; VII MMI</span>
                        <p class="text-slate-600 mt-1">Terjadi kerusakan ringan hingga parah pada konstruksi bangunan bergantung ketahanan strukturnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
