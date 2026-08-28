<x-layouts.app>
    <x-slot:title>Struktur Organisasi - Stasiun Geofisika Balikpapan</x-slot:title>

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
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Profil</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Struktur Organisasi</span>
                </div>
            </li>
        </ol>
    </div>

    <section class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">

            <div class="flex justify-center mb-20 relative">
                <div class="absolute h-20 w-px bg-slate-300 -bottom-20 left-1/2 hidden lg:block"></div>

                <div class="w-full max-w-sm">
                    <div
                        class="bg-white rounded-3xl shadow-xl overflow-hidden border-t-4 border-indigo-600 transition-transform hover:scale-105 duration-300">
                        <div class="p-8 text-center">
                            <div
                                class="size-24 bg-indigo-100 rounded-2xl mx-auto mb-6 flex items-center justify-center text-indigo-600">
                                <svg class="size-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 uppercase">Rasmid, M.Si</h3>
                            <p class="text-indigo-600 font-bold text-sm tracking-widest mt-1">KEPALA STASIUN GEOFISIKA
                            </p>
                        </div>
                        <div class="bg-slate-50 py-3 px-6 text-center border-t border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIP.
                                19XXXXXXXXXXXXXX</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 relative">
                <div class="absolute top-0 left-1/4 right-1/4 h-px bg-slate-300 -mt-10 hidden lg:block"></div>
                <div class="absolute top-0 left-1/4 h-10 w-px bg-slate-300 -mt-10 hidden lg:block"></div>
                <div class="absolute top-0 right-1/4 h-10 w-px bg-slate-300 -mt-10 hidden lg:block"></div>

                <div class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-10 w-1 bg-indigo-600 rounded-full"></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Sub Bagian Tata Usaha
                        </h4>
                    </div>

                    <div class="grid gap-4">
                        @php
                            $tataUsaha = ['Ayun Lestari, S.E', 'Nurgiantoro', 'Irena Damayanti, S.Kom'];
                        @endphp

                        @foreach ($tataUsaha as $nama)
                            <div
                                class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4 group hover:border-indigo-300 transition-colors">
                                <div
                                    class="size-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-500 transition-colors">
                                    <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="font-bold text-slate-700">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-10 w-1 bg-indigo-600 rounded-full"></div>
                        <h4 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Kelompok Jabatan
                            Fungsional
                        </h4>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        @php
                            $operasional = [
                                'Usni Samosir, S.T',
                                'Benny Hendrawanto, S.T',
                                'Catur Sih Utami, S.Si',
                                'Firmansyah, S.Kom',
                                'Mohammad Sholeh, S.Tr.Geof',
                                'Sucianty, S.Tr',
                                'Nur Eka Deviyanti, S.Tr',
                                'Muh. Alfatham Werdi P., S.Tr.Geof',
                                'Nur Baiti Febryana S., S.Tr',
                                'Abdul Arif, S.Tr.Inst',
                                'Hadrian Dama Galib, S.Tr.Inst',
                                'Ahmad N. Hidayat, S.Tr.Inst',
                                'Imam Tanthawi Anfasa, S.Tr.Geof',
                                'Nida Faiza, S.Tr.Geof',
                            ];
                        @endphp

                        @foreach ($operasional as $nama)
                            <div
                                class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex items-center gap-3 group hover:border-indigo-200 transition-colors">
                                <div
                                    class="size-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-500 transition-colors">
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-600 leading-tight">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layouts.app>
