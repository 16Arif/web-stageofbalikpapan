 <header class="sticky top-0 inset-x-0 z-50 border-b border-slate-100 bg-white/95 backdrop-blur">
     <div class="max-w-7xl mx-auto px-6 lg:px-8">
         <nav aria-label="Global" class="flex items-center justify-between py-5 lg:px-8">
             <div class="flex lg:flex-1">
                 <a href="{{ route('home_page') }}" class="-m-1.5 p-1.5 flex items-center gap-3">
                     <span class="sr-only">Stasiun Geofisika Balikpapan</span>

                     <img src="{{ asset('build/assets/img/logo-bmkg.png') }}" alt="Logo BMKG" class="h-10 w-auto" />

                     <div class="hidden lg:block">
                         <p class="text-sm font-bold text-gray-900 leading-tight uppercase">Pusat Gempa Regional
                             XI</p>
                         <p class="text-xs font-medium text-gray-500 leading-none">STASIUN GEOFISIKA BALIKPAPAN
                         </p>
                     </div>
                 </a>
             </div>
             <div class="flex lg:hidden">
                 <button type="button" command="show-modal" commandfor="mobile-menu"
                     class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:bg-slate-50">
                     <span class="sr-only">Open main menu</span>
                     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                         aria-hidden="true" class="size-6">
                         <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                             stroke-linejoin="round" />
                     </svg>
                 </button>
             </div>
             <div class="hidden lg:flex lg:gap-x-10">
                 <a href="{{ route('home_page') }}"
                     class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600 transition">Home</a>
                 <div class="relative group">
                     <button
                         class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                         Profil
                         <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                             </path>
                         </svg>
                     </button>

                     <div
                         class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                         <div class="p-2">

                             <a href="{{ route('about') }}" wire:navigate
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Tentang</a>
                             <a href="{{ route('organization') }}" wire:navigate
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Struktur
                                 Organisasi</a>
                         </div>
                     </div>
                 </div>
                 <div class="relative group">
                     <button
                         class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                         Gempabumi
                         <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                             </path>
                         </svg>
                     </button>

                     <div
                         class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                         <div class="p-2">
                             <a href="#"
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gempabumi
                                 Terkini</a>
                             <a href="#"
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gempabumi
                                 Dirasakan</a>
                             <hr class="my-1 border-gray-100">
                             <a href="{{ route('borneo-earthquakes') }}" wire:navigate
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gempabumi
                                 Kalimantan</a>
                         </div>
                     </div>
                 </div>
                 <div class="relative group">
                     <button
                         class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                         Geofisika
                         <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                             </path>
                         </svg>
                     </button>

                     <div
                         class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                         <div class="p-2">
                             <a href="{{ route('education-hilal') }}"
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Hilal
                             </a>
                             <a href="{{ route('education-gerhana') }}"
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Gerhana</a>
                             <a href="{{ route('lightning-kalimantan') }}"
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Sambaran
                                 Petir Kalimantan</a>
                             <a href="https://www.bmkg.go.id/tanda-waktu/terbit-terbenam-matahari/7"
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg"
                                 target="blank">Terbit Terbenam Matahari</a>
                         </div>
                     </div>
                 </div>
                 <div class="relative group">
                     <button
                         class="flex items-center gap-1 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                         Publikasi
                         <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                             </path>
                         </svg>
                     </button>

                     <div
                         class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                         <div class="p-2">
                             <a href="{{ route('buletin') }}" wire:navigate
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Buletin</a>
                             <a href="{{ route('activity') }}" wire:navigate
                                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg">Berita
                                 Aktifitas</a>
                         </div>
                     </div>
                 </div>
                 <a href="{{ route('pelayanan') }}" wire:navigate
                     class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600 transition">Pelayanan</a>
             </div>
         </nav>
     </div>
     <el-dialog>
         <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
             <div tabindex="0" class="fixed inset-0 focus:outline-none">
                 <el-dialog-panel
                     class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                     <div class="flex items-center justify-between">
                         <a href="#" class="-m-1.5 p-1.5">
                             <span class="sr-only">Your Company</span>
                             <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                                 alt="" class="h-8 w-auto" />
                         </a>
                         <button type="button" command="close" commandfor="mobile-menu"
                             class="-m-2.5 rounded-md p-2.5 text-gray-700">
                             <span class="sr-only">Close menu</span>
                             <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                 data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </button>
                     </div>
                     <div class="mt-6 flow-root">
                         <div class="-my-6 divide-y divide-gray-500/10">
                             <div class="space-y-2 py-6">
                                 <a href="{{ route('home_page') }}"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Home</a>
                                 <a href="{{ route('about') }}"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Profil</a>
                                 <a href="{{ route('borneo-earthquakes') }}"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Gempabumi</a>
                                 <a href="{{ route('activity') }}"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Publikasi</a>
                                 <a href="{{ route('pelayanan') }}"
                                     class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-indigo-50 hover:text-indigo-600">Pelayanan</a>
                             </div>
                         </div>
                     </div>
                 </el-dialog-panel>
             </div>
         </dialog>
     </el-dialog>
 </header>
