<x-layouts.app>
    <x-slot:title>Gempa Kalimantan - Stasiun Geofisika Balikpapan</x-slot:title>

    <!-- Breadcrumb -->
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
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Gempabumi</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Gempabumi Kalimantan</span>
                </div>
            </li>
        </ol>
    </div>

    <section class="py-12 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="mb-8 flex items-center gap-4">
                <span class="relative flex h-3 w-3 rounded-full bg-indigo-500">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                </span>
                <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">Kejadian Terakhir</h3>
            </div>

            @if ($gempaTerkini)
                <div
                    class="grid lg:grid-cols-5 gap-8 items-center bg-slate-900 p-6 md:p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">

                    <div class="lg:col-span-2 relative group">
                        <div
                            class="relative overflow-hidden rounded-[1.5rem] bg-slate-800 border border-slate-700 shadow-inner flex items-center justify-center aspect-square md:aspect-auto h-full min-h-64">
                            @if ($gempaTerkini->peta_gempa_url)
                                <img src="{{ $gempaTerkini->peta_gempa_url }}"
                                    alt="Peta Kejadian Gempabumi {{ $gempaTerkini->wilayah }}"
                                    class="w-full h-full object-cover rounded-[1.5rem]">
                            @else
                                <div class="text-center text-slate-500 p-4">
                                    <svg class="size-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs uppercase tracking-widest font-bold">Peta Gempa</p>
                                </div>
                            @endif

                            <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                                <div class="bg-slate-900/90 backdrop-blur-md border border-slate-700 p-2 rounded-lg">
                                    <p class="text-[9px] font-mono text-indigo-400 uppercase leading-none mb-1">Koordinat
                                    </p>
                                    <p class="text-[10px] font-bold text-white">{{ $gempaTerkini->koordinat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3 flex flex-col">
                        <div class="inline-flex items-center gap-2 mb-4">
                            <span
                                class="px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-black uppercase tracking-widest">Pembaruan:
                                {{ $gempaTerkini->formatted_date }}</span>
                        </div>

                        <h2 class="text-2xl md:text-4xl font-black text-white leading-tight">
                            {{ $gempaTerkini->keterangan ?: $gempaTerkini->wilayah }}
                        </h2>

                        <div class="mt-8 grid grid-cols-2 gap-6 border-y border-slate-800 py-6">
                            <div>
                                <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Magnitudo</p>
                                <p class="text-4xl font-black text-white italic">{{ number_format((float) $gempaTerkini->magnitudo, 1) }} <span
                                        class="text-lg font-normal not-italic text-slate-600">M</span></p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest">Kedalaman</p>
                                <p class="text-3xl font-black text-white">{{ $gempaTerkini->kedalaman }}</p>
                            </div>
                        </div>

                        <div class="mt-6 text-slate-400 text-xs flex flex-col gap-1">
                            <p><strong>Waktu Kejadian:</strong> {{ $gempaTerkini->formatted_datetime }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-slate-900 p-8 md:p-12 rounded-[2.5rem] shadow-2xl text-center text-slate-400">
                    <svg class="size-16 mx-auto mb-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Gempabumi Terkini</h3>
                    <p class="text-sm max-w-md mx-auto text-slate-400">Data kejadian gempabumi di wilayah Kalimantan belum tersedia atau belum dipublikasikan.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-2">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 uppercase italic tracking-tight">Riwayat Kejadian Lokal</h3>
                    <p class="text-xs text-slate-500 mt-1">Menampilkan 5 data kejadian gempabumi terakhir di wilayah Kalimantan.</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    Waktu Kejadian (WIB)</th>
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
                                        <p class="text-sm font-bold text-slate-900">{{ $data->formatted_date }}</p>
                                        <p class="text-[10px] text-slate-500 font-mono">{{ $data->formatted_time }}</p>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span
                                            class="inline-flex items-center justify-center size-9 rounded-lg {{ (float) $data->magnitudo >= 4.0 ? 'bg-red-50 text-red-600' : 'bg-slate-100 text-slate-600' }} font-black text-sm">
                                            {{ number_format((float) $data->magnitudo, 1) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm font-bold text-slate-700">
                                        {{ $data->kedalaman }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-black text-slate-900">{{ $data->wilayah }}</p>
                                        <p class="text-[10px] text-slate-400 font-mono mt-1 italic">{{ $data->koordinat }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 text-sm">
                                        Belum ada data historis gempabumi yang tersedia.
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
