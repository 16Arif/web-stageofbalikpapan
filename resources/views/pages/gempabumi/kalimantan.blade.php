<x-layouts.app>
    <x-slot:title>Gempa Kalimantan - Stasiun Geofisika Balikpapan</x-slot:title>

    <!-- TODO: Hubungkan dengan Filament Admin untuk mengelola $gempaTerkini dan $listGempa -->
    @php
        // Data hardcoded sementara untuk MVP
        $gempaTerkini = [
            'date' => '15 Mei 2026',
            'time' => '14:30:00 WIB',
            'magnitude' => '4.2',
            'depth' => '10 km',
            'region' => 'Pusat Gempa Berada di Darat 25 km Barat Daya PASER',
            'coordinates' => '1.92 LS - 116.12 BT',
            'shakemap' => asset('images/dummy-map.jpg'), // Placeholder
        ];

        $listGempa = [
            [
                'date' => '15 Mei 2026',
                'time' => '14:30:00',
                'mag' => '4.2',
                'dep' => '10 km',
                'area' => '25 km Barat Daya PASER - KALTIM',
                'loc' => '1.92 LS - 116.12 BT',
            ],
            [
                'date' => '10 Mei 2026',
                'time' => '08:15:22',
                'mag' => '3.5',
                'dep' => '5 km',
                'area' => '40 km Timur Laut MAHAKAM ULU - KALTIM',
                'loc' => '0.85 LU - 115.65 BT',
            ],
            [
                'date' => '02 Mei 2026',
                'time' => '22:10:05',
                'mag' => '4.0',
                'dep' => '12 km',
                'area' => '15 km Tenggara TABALONG - KALSEL',
                'loc' => '2.15 LS - 115.42 BT',
            ],
        ];
    @endphp

    <section class="relative isolate overflow-hidden bg-slate-950 py-16">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/10 to-slate-950" />
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl">
                <h2 class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-xs mb-4">Pemantauan Lokal</h2>
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight">Gempa <span
                        class="text-indigo-500">Kalimantan</span></h1>
                <p class="mt-6 text-lg text-slate-300 leading-relaxed">
                    Daftar aktivitas gempabumi yang terjadi di wilayah Pulau Kalimantan dan sekitarnya, hasil analisis Stasiun Geofisika
                    Balikpapan.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-8 flex items-center gap-4">
                <span class="relative flex h-3 w-3 rounded-full bg-indigo-500">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                </span>
                <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">Kejadian Terakhir</h3>
            </div>

            <div
                class="grid lg:grid-cols-5 gap-8 items-center bg-slate-900 p-6 md:p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">

                <div class="lg:col-span-2 relative group">
                    <div
                        class="relative overflow-hidden rounded-[1.5rem] bg-slate-800 border border-slate-700 shadow-inner flex items-center justify-center aspect-square md:aspect-auto h-full min-h-64">
                        <div class="text-center text-slate-500 p-4">
                            <svg class="size-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs uppercase tracking-widest font-bold">Peta Shakemap</p>
                        </div>
                        <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                            <div class="bg-slate-900/90 backdrop-blur-md border border-slate-700 p-2 rounded-lg">
                                <p class="text-[9px] font-mono text-indigo-400 uppercase leading-none mb-1">Koordinat
                                </p>
                                <p class="text-[10px] font-bold text-white">{{ $gempaTerkini['coordinates'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3 flex flex-col">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span
                            class="px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-black uppercase tracking-widest">Pembaruan:
                            {{ $gempaTerkini['date'] }}</span>
                    </div>

                    <h2 class="text-2xl md:text-4xl font-black text-white leading-tight">
                        {{ $gempaTerkini['region'] }}
                    </h2>

                    <div class="mt-8 grid grid-cols-2 gap-6 border-y border-slate-800 py-6">
                        <div>
                            <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Magnitudo</p>
                            <p class="text-4xl font-black text-white italic">{{ $gempaTerkini['magnitude'] }} <span
                                    class="text-lg font-normal not-italic text-slate-600">M</span></p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Kedalaman</p>
                            <p class="text-3xl font-black text-white">{{ $gempaTerkini['depth'] }}</p>
                        </div>
                    </div>

                    <div class="mt-6 text-slate-400 text-xs flex flex-col gap-1">
                        <p><strong>Waktu Kejadian:</strong> {{ $gempaTerkini['date'] }} | {{ $gempaTerkini['time'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-10 flex justify-between items-end">
                <h3 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">Riwayat Kejadian Lokal
                </h3>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Waktu Kejadian (WITA/WIB)</th>
                                <th
                                    class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Magnitudo</th>
                                <th
                                    class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Kedalaman</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Lokasi &amp; Wilayah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($listGempa as $data)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap border-r border-slate-50">
                                        <p class="text-sm font-bold text-slate-900">{{ $data['date'] }}</p>
                                        <p class="text-[10px] text-slate-500 font-mono">{{ $data['time'] }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span
                                            class="inline-flex items-center justify-center size-9 rounded-lg {{ $data['mag'] >= 4 ? 'bg-red-50 text-red-600' : 'bg-slate-100 text-slate-600' }} font-black text-sm">
                                            {{ $data['mag'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm font-bold text-slate-700">
                                        {{ $data['dep'] }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-black text-slate-900">{{ $data['area'] }}</p>
                                        <p class="text-[10px] text-slate-400 font-mono mt-1 italic">{{ $data['loc'] }}
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 text-sm">
                                        Belum ada data historis yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
