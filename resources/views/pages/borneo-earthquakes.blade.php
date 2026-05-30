<x-layouts.app>
    <x-slot:title>Data Gempabumi Kalimantan - Stageof Balikpapan</x-slot:title>

    @php
        $fallbackLatestEarthquake = [
            'date' => '21 April 2026',
            'time' => '02:02:20 WIB',
            'magnitude' => '2.9',
            'depth' => '4 km',
            'region' => '225 km Timur Laut BDRSRIBEGAWAN - BRUNEI',
            'coordinates' => '6.12 LU - 116.56 BT',
            'shakemap' => asset('build/assets/img/gempa2104.jpeg'),
        ];

        $earthquake = array_merge($fallbackLatestEarthquake, $latestEarthquake ?? []);
    @endphp

    <section class="relative isolate overflow-hidden bg-slate-950 py-16">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/10 to-slate-950" />
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-2xl">
                <h2 class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-xs mb-4">Monitoring Lokal</h2>
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight">Gempabumi <span
                        class="text-indigo-500">Kalimantan</span></h1>
                <p class="mt-6 text-lg text-slate-300 leading-relaxed">
                    Daftar aktivitas gempabumi di wilayah Pulau Kalimantan berdasarkan hasil analisa Stasiun Geofisika
                    Balikpapan.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-8 flex items-center gap-4">
                <span class="relative flex h-3 w-3 rounded-full bg-red-500"></span>
                <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">Kejadian Terakhir</h3>
            </div>

            <div
                class="grid lg:grid-cols-5 gap-8 items-center bg-slate-900 p-6 md:p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">

                <div class="lg:col-span-2 relative group">
                    <div
                        class="relative overflow-hidden rounded-[1.5rem] bg-slate-800 border border-slate-700 shadow-inner">
                        <img src="{{ $earthquake['shakemap'] }}"
                            alt="Peta shakemap gempabumi terbaru"
                            class="w-full h-auto object-cover opacity-90">
                        <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                            <div class="bg-slate-900/90 backdrop-blur-md border border-slate-700 p-2 rounded-lg">
                                <p class="text-[9px] font-mono text-indigo-400 uppercase leading-none mb-1">Koordinat
                                </p>
                                <p class="text-[10px] font-bold text-white">{{ $earthquake['coordinates'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3 flex flex-col">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span
                            class="px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-black uppercase tracking-widest">Update:
                            {{ $earthquake['date'] }}</span>
                    </div>

                    <h2 class="text-2xl md:text-4xl font-black text-white leading-tight">
                        {{ $earthquake['region'] }}
                    </h2>

                    <div class="mt-8 grid grid-cols-2 gap-6 border-y border-slate-800 py-6">
                        <div>
                            <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Magnitudo</p>
                            <p class="text-4xl font-black text-white italic">{{ $earthquake['magnitude'] }} <span
                                    class="text-lg font-normal not-italic text-slate-600">M</span></p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Kedalaman</p>
                            <p class="text-3xl font-black text-white">{{ $earthquake['depth'] }}</p>
                        </div>
                    </div>

                    <div class="mt-6 text-slate-400 text-xs flex flex-col gap-1">
                        <p><strong>Waktu:</strong> {{ $earthquake['date'] }} | {{ $earthquake['time'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-10">
                <h3 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">Riwayat Aktivitas Terkini
                </h3>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Waktu (WIB)</th>
                                <th
                                    class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Mag</th>
                                <th
                                    class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                    Kedlmn</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Lokasi & Wilayah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @php
                                $history = [
                                    [
                                        'date' => '21 Apr 2026',
                                        'time' => '02:02:20',
                                        'mag' => '2.9',
                                        'dep' => '4 km',
                                        'area' => '225 km Timur Laut BDRSRIBEGAWAN-BRUNEI',
                                        'loc' => '6.12 LU - 116.56 BT',
                                    ],
                                    [
                                        'date' => '20 Apr 2026',
                                        'time' => '18:09:38',
                                        'mag' => '4.2',
                                        'dep' => '10 km',
                                        'area' => '76 km Selatan BERAU-KALTIM',
                                        'loc' => '1.39 LU - 117.55 BT',
                                    ],
                                    [
                                        'date' => '20 Apr 2026',
                                        'time' => '14:31:36',
                                        'mag' => '2.6',
                                        'dep' => '15 km',
                                        'area' => '56 km Utara BONTANG-KALTIM',
                                        'loc' => '0.62 LU - 117.56 BT',
                                    ],
                                    [
                                        'date' => '20 Apr 2026',
                                        'time' => '11:30:06',
                                        'mag' => '2.8',
                                        'dep' => '3 km',
                                        'area' => '19 km Barat Daya TABALONG-KALSEL',
                                        'loc' => '2.01 LS - 115.47 BT',
                                    ],
                                    [
                                        'date' => '20 Apr 2026',
                                        'time' => '11:24:47',
                                        'mag' => '3.0',
                                        'dep' => '2 km',
                                        'area' => '19 km Barat Laut BALANGAN-KALSEL',
                                        'loc' => '2.17 LS - 115.55 BT',
                                    ],
                                ];
                            @endphp

                            @foreach ($history as $data)
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
