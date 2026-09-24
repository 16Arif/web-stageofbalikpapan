<header class="sticky top-0 inset-x-0 z-50 border-b border-slate-100 bg-white/95 backdrop-blur">
     <div class="max-w-7xl mx-auto px-6 lg:px-8">
         <nav aria-label="Global" class="flex items-center justify-between py-4">
             
             {{-- ==================== SISI KIRI: IDENTITAS ==================== --}}
             <div class="flex items-center gap-3">
                 @if(request()->routeIs('pelayanan*'))
                     {{-- Identitas Khusus Layanan --}}
                     <a href="{{ route('pelayanan') }}" wire:navigate class="-m-1.5 p-1.5 flex items-center gap-3 group">
                         <span class="sr-only">Portal Layanan Data BMKG Balikpapan</span>
                         <img src="{{ asset('images/logo-bmkg.png') }}" alt="Logo BMKG" class="h-9 sm:h-10 w-auto" />
                         <div>
                             <div class="flex items-center gap-2">
                                 <p class="text-xs sm:text-sm font-bold text-slate-900 leading-tight tracking-wide uppercase">Layanan Geofisika</p>
                             </div>
                             <p class="text-[11px] font-medium text-slate-500 leading-none mt-0.5">Stasiun Geofisika Balikpapan</p>
                         </div>
                     </a>
                 @else
                     {{-- Identitas Versi Umum --}}
                     <a href="{{ route('home_page') }}" class="-m-1.5 p-1.5 flex items-center gap-3">
                         <span class="sr-only">Stasiun Geofisika Balikpapan</span>
                         <img src="{{ asset('images/logo-bmkg.png') }}" alt="Logo BMKG" class="h-10 w-auto" />
                         <div class="hidden lg:block">
                             <p class="text-sm font-bold text-gray-900 leading-tight uppercase">Pusat Gempa Regional XI</p>
                             <p class="text-xs font-medium text-gray-500 leading-none">STASIUN GEOFISIKA BALIKPAPAN</p>
                         </div>
                     </a>
                 @endif
             </div>

             {{-- Tombol Mobile Hamburger --}}
             <div class="flex lg:hidden">
                 <button type="button" command="show-modal" commandfor="mobile-menu"
                     class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:bg-slate-50">
                     <span class="sr-only">Buka menu utama</span>
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                         aria-hidden="true" class="size-6">
                         <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                             stroke-linejoin="round" />
                     </svg>
                 </button>
             </div>

             {{-- ==================== SISI KANAN: NAVIGASI & USER ==================== --}}
             <div class="hidden lg:flex lg:items-center lg:gap-x-7">
                 @if(request()->routeIs('pelayanan*'))
                     {{-- Navigasi Versi Khusus Layanan --}}
                     <a href="{{ route('home_page') }}" wire:navigate
                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition-colors py-1 px-2.5 rounded-lg hover:bg-slate-50">                        
                         <span>Home</span>
                     </a>
                     <a href="{{ route('pelayanan') }}#katalog-layanan"
                        class="text-sm font-semibold {{ request()->routeIs('pelayanan') && !request()->routeIs('pelayanan.mekanisme') && !request()->routeIs('pelayanan.tarif') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }} transition-colors">
                         Katalog Layanan
                     </a>
                     <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                        class="text-sm font-semibold {{ request()->routeIs('pelayanan.mekanisme') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }} transition-colors">
                         Mekanisme & Syarat
                     </a>
                     <a href="{{ route('pelayanan.tarif') }}" wire:navigate
                        class="text-sm font-semibold {{ request()->routeIs('pelayanan.tarif') ? 'text-indigo-600 font-bold' : 'text-slate-700 hover:text-indigo-600' }} transition-colors">
                         Tarif PNBP
                     </a>
                 @else
                     {{-- Navigasi Versi Umum --}}
                     {{-- Dropdown Profil --}}
                     <div class="relative group">
                         <button
                             class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors cursor-pointer">
                             Profil
                             <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                             </svg>
                         </button>

                         <div
                             class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                             <div class="p-2">
                                 <a href="{{ route('profil.profil') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Profil UPT</a>
                                 <a href="{{ route('profil.organisasi') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Struktur Organisasi</a>
                             </div>
                         </div>
                     </div>

                     {{-- Dropdown Gempabumi --}}
                     <div class="relative group">
                         <button
                             class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors cursor-pointer">
                             Gempabumi
                             <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                             </svg>
                         </button>

                         <div
                             class="absolute left-0 mt-2 w-56 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                             <div class="p-2">
                                 <a href="{{ route('gempabumi.kalimantan') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gempa Kalimantan</a>
                                 <a href="{{ route('gempabumi.terkini') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gempa Terkini</a>
                                 <a href="{{ route('gempabumi.dirasakan') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gempabumi Dirasakan</a>
                                 <a href="{{ route('gempabumi.mitigasi') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Mitigasi Gempabumi</a>
                             </div>
                         </div>
                     </div>

                     {{-- Dropdown Geofisika --}}
                     <div class="relative group">
                         <button
                             class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors cursor-pointer">
                             Geofisika
                             <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                             </svg>
                         </button>

                     <div
                         class="absolute left-0 mt-2 w-[30rem] bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                         <div class="p-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3 pl-3">
                                        Geofisika Potensial</h4>
                                    <a href="{{ route('geofisika.kerapatan-petir') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Peta
                                        Kerapatan Petir</a>
                                    <a href="{{ route('geofisika.petir') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Sambaran
                                        Petir</a>
                                    <a href="{{ route('geofisika.petir-realtime') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Sambaran
                                        Petir Realtime</a>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3 pl-3">
                                        Tanda Waktu</h4>
                                    <a href="https://www.bmkg.go.id/tanda-waktu/almanak"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg"
                                        target="_blank" rel="noopener noreferrer">Almanak</a>
                                    <a href="{{ route('geofisika.gerhana') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gerhana</a>
                                    <a href="{{ route('geofisika.hilal') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Hilal</a>
                                    <a href="https://www.bmkg.go.id/tanda-waktu"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg"
                                        target="_blank" rel="noopener noreferrer">Tanda Waktu Nasional</a>
                                    <a href="https://www.bmkg.go.id/tanda-waktu/terbit-terbenam-matahari/7"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg"
                                        target="_blank" rel="noopener noreferrer">Terbit Terbenam Matahari</a>
                                </div>
                            </div>
                         </div>
                     </div>
                 </div>

                     {{-- Dropdown Publikasi --}}
                     <div class="relative group">
                         <button
                             class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors cursor-pointer">
                             Publikasi
                             <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                             </svg>
                         </button>

                         <div
                             class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                             <div class="p-2">
                                 <a href="{{ route('berita.index') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Berita</a>
                                 <a href="{{ route('publikasi.buletin') }}" wire:navigate
                                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Buletin</a>
                             </div>
                         </div>
                     </div>

                     {{-- Layanan --}}
                     <a href="{{ route('pelayanan') }}" wire:navigate
                        class="text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                         Layanan
                     </a>
                 @endif

                 {{-- User Dropdown Aktif (Jika Ada Sesi) --}}
                 @php
                     $activeUser = auth('applicant')->user() ?? auth()->user();
                 @endphp

                 @if($activeUser)
                     <div class="relative" x-data="{ open: false }">
                         <button @click="open = !open" @click.outside="open = false" type="button"
                             class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3.5 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition cursor-pointer">
                             <span class="w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-bold uppercase">
                                 {{ substr($activeUser->name, 0, 1) }}
                             </span>
                             <span class="max-w-[120px] truncate">{{ $activeUser->name }}</span>
                             <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                             </svg>
                         </button>
                         <div x-show="open" x-transition style="display: none;"
                             class="absolute right-0 mt-2 w-48 rounded-xl bg-white p-2 shadow-lg ring-1 ring-black/5 z-50">
                             <div class="px-3 py-2 border-b border-slate-100">
                                 <p class="text-xs text-slate-500">{{ auth('applicant')->check() ? 'Pemohon Data' : 'Petugas Stageof' }}</p>
                                 <p class="text-sm font-semibold text-slate-900 truncate">{{ $activeUser->email }}</p>
                             </div>
                             @if(auth('applicant')->check())
                                 <a href="{{ route('filament.pelayanan.pages.dashboard') }}"
                                     class="flex items-center gap-2 px-3 py-2 text-sm text-indigo-700 hover:bg-indigo-50 font-semibold rounded-lg transition mt-1">
                                     <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                     </svg>
                                     Portal Pelayanan
                                 </a>
                                 <a href="{{ route('filament.pelayanan.resources.permohonan-sayas.index') }}"
                                     class="flex items-center gap-2 px-3 py-2 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                     </svg>
                                     Permohonan Saya
                                 </a>
                             @else
                                 <a href="{{ route('pelayanan') }}" wire:navigate
                                     class="flex items-center gap-2 px-3 py-2 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition mt-1">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                     </svg>
                                     Layanan Data
                                 </a>
                             @endif
                             @if(auth()->check() && method_exists($activeUser, 'hasAnyRole') && $activeUser->hasAnyRole(['super_admin', 'admin', 'staff']))
                                 <a href="/admin-stageof"
                                     class="flex items-center gap-2 px-3 py-2 text-sm text-amber-700 hover:bg-amber-50 rounded-lg transition">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                     </svg>
                                     Panel Admin
                                 </a>
                             @endif
                             <form method="POST" action="{{ route('pelayanan.logout') }}">
                                 @csrf
                                 <button type="submit"
                                     class="w-full flex items-center gap-2 px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 rounded-lg transition text-left cursor-pointer">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                     </svg>
                                     Keluar
                                 </button>
                             </form>
                         </div>
                     </div>
                 @endif
             </div>

         </nav>
     </div>

     {{-- ==================== DRAWER MENU SELULER ==================== --}}
     <el-dialog>
         <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
             <div tabindex="0" class="fixed inset-0 focus:outline-none">
                 <el-dialog-panel
                     class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                     <div class="flex items-center justify-between">
                         @if(request()->routeIs('pelayanan*'))
                             <a href="{{ route('pelayanan') }}" class="-m-1.5 p-1.5 flex items-center gap-2.5">
                                 <img src="{{ asset('images/logo-bmkg.png') }}" alt="Logo BMKG" class="h-8 w-auto" />
                                 <div>
                                     <p class="text-xs font-bold text-slate-900 uppercase">Portal Layanan</p>
                                     <p class="text-[10px] text-slate-500">Stasiun Geofisika Balikpapan</p>
                                 </div>
                             </a>
                         @else
                             <a href="{{ route('home_page') }}" class="-m-1.5 p-1.5">
                                 <span class="sr-only">Stasiun Geofisika Balikpapan</span>
                                 <img src="{{ asset('images/logo-bmkg.png') }}" alt="Logo BMKG" class="h-8 w-auto" />
                             </a>
                         @endif
                         <button type="button" command="close" commandfor="mobile-menu"
                             class="-m-2.5 rounded-md p-2.5 text-gray-700">
                             <span class="sr-only">Tutup menu</span>
                             <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                 data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </button>
                     </div>

                     <div class="mt-6 flow-root">
                         <div class="-my-6 divide-y divide-gray-500/10">
                             <div class="space-y-2 py-6">
                                 @if(request()->routeIs('pelayanan*'))
                                     {{-- Menu Khusus Layanan Seluler --}}
                                     <a href="{{ route('home_page') }}" wire:navigate
                                         class="-mx-3 flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-indigo-600">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                         <span>Kembali ke Web Utama</span>
                                     </a>
                                     <a href="{{ route('pelayanan') }}#katalog-layanan"
                                         class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold {{ request()->routeIs('pelayanan') && !request()->routeIs('pelayanan.mekanisme') && !request()->routeIs('pelayanan.tarif') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-gray-900 hover:bg-indigo-50 hover:text-indigo-600' }}">
                                         Katalog Data
                                     </a>
                                     <a href="{{ route('pelayanan.mekanisme') }}" wire:navigate
                                         class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold {{ request()->routeIs('pelayanan.mekanisme') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-gray-900 hover:bg-indigo-50 hover:text-indigo-600' }}">
                                         Mekanisme Permohonan
                                     </a>
                                     <a href="{{ route('pelayanan.tarif') }}" wire:navigate
                                         class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold {{ request()->routeIs('pelayanan.tarif') ? 'text-indigo-600 bg-indigo-50 font-bold' : 'text-gray-900 hover:bg-indigo-50 hover:text-indigo-600' }}">
                                         Tarif PNBP
                                     </a>
                                 @else
                                     {{-- Menu Umum Seluler --}}
                                    <a href="{{ route('profil.profil') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Profil Instansi</a>
                                    <a href="{{ route('profil.organisasi') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Struktur Organisasi</a>
                                    <a href="{{ route('gempabumi.kalimantan') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Gempa Kalimantan</a>
                                    <a href="{{ route('gempabumi.terkini') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Gempa Terkini</a>
                                    <a href="{{ route('gempabumi.dirasakan') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Gempabumi Dirasakan</a>
                                    <a href="{{ route('gempabumi.mitigasi') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Mitigasi Gempabumi</a>
                                    <div class="pt-2">
                                        <p class="px-0 text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Geofisika Potensial</p>
                                        <a href="{{ route('geofisika.kerapatan-petir') }}"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Peta Kerapatan Petir</a>
                                        <a href="{{ route('geofisika.petir') }}"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Sambaran Petir</a>
                                        <a href="{{ route('geofisika.petir-realtime') }}"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Sambaran Petir Realtime</a>
                                    </div>
                                    <div class="pt-2">
                                        <p class="px-0 text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Tanda Waktu</p>
                                        <a href="https://www.bmkg.go.id/tanda-waktu/almanak" target="_blank" rel="noopener noreferrer"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Almanak</a>
                                        <a href="{{ route('geofisika.gerhana') }}"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Gerhana</a>
                                        <a href="{{ route('geofisika.hilal') }}"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Hilal</a>
                                        <a href="https://www.bmkg.go.id/tanda-waktu" target="_blank" rel="noopener noreferrer"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Tanda Waktu Nasional</a>
                                        <a href="https://www.bmkg.go.id/tanda-waktu/terbit-terbenam-matahari/7" target="_blank" rel="noopener noreferrer"
                                            class="-mx-3 block rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">Terbit Terbenam Matahari</a>
                                    </div>
                                    <a href="{{ route('berita.index') }}"
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Berita</a>
                                    <a href="{{ route('publikasi.buletin') }}" wire:navigate
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Buletin</a>
                                    <a href="{{ route('pelayanan') }}" wire:navigate
                                        class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Layanan Data</a>
                                 @endif
                             </div>

                             {{-- Autentikasi Pengguna Seluler --}}
                             @php
                                 $activeUserMobile = auth('applicant')->user() ?? auth()->user();
                             @endphp
                             @if($activeUserMobile)
                                 <div class="py-6 border-t border-gray-100">
                                     <div class="mb-3 px-1">
                                         <p class="text-xs text-slate-500">Masuk sebagai ({{ auth('applicant')->check() ? 'Pemohon Data' : 'Petugas' }})</p>
                                         <p class="text-sm font-bold text-slate-900 truncate">{{ $activeUserMobile->name }}</p>
                                         <p class="text-xs text-slate-600 truncate">{{ $activeUserMobile->email }}</p>
                                     </div>
                                     @if(auth('applicant')->check())
                                         <a href="{{ route('filament.pelayanan.pages.dashboard') }}"
                                             class="mb-2 flex items-center justify-center gap-2 rounded-xl bg-indigo-50 border border-indigo-200 px-4 py-2.5 text-sm font-semibold text-indigo-800 hover:bg-indigo-100 transition">
                                             Portal Pelayanan
                                         </a>
                                         <a href="{{ route('filament.pelayanan.resources.permohonan-sayas.index') }}"
                                             class="mb-2 flex items-center justify-center gap-2 rounded-xl bg-slate-100 border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition">
                                             Permohonan Saya
                                         </a>
                                     @endif
                                     @if(auth()->check() && method_exists($activeUserMobile, 'hasAnyRole') && $activeUserMobile->hasAnyRole(['super_admin', 'admin', 'staff']))
                                         <a href="/admin-stageof"
                                             class="mb-2 flex items-center justify-center gap-2 rounded-xl bg-amber-50 border border-amber-200 px-4 py-2.5 text-sm font-semibold text-amber-800 transition">
                                             Panel Admin
                                         </a>
                                     @endif
                                     <form method="POST" action="{{ route('pelayanan.logout') }}">
                                         @csrf
                                         <button type="submit"
                                             class="w-full flex items-center justify-center gap-2 rounded-xl bg-rose-50 border border-rose-200 px-4 py-2.5 text-sm font-semibold text-rose-700 hover:bg-rose-100 transition cursor-pointer">
                                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                             </svg>
                                             Keluar
                                         </button>
                                     </form>
                                 </div>
                             @endif
                         </div>
                     </div>
                 </el-dialog-panel>
             </div>
         </dialog>
     </el-dialog>
 </header>
