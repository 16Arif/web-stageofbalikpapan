<div>
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
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Publikasi</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Berita Terkini</span>
                </div>
            </li>
        </ol>
    </div>

    <!-- Main Content Section -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            
            <!-- Search bar -->
            <div class="mb-12 max-w-md mx-auto">
                <label for="search" class="sr-only">Cari Berita</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="search" id="search" placeholder="Cari berita berdasarkan judul..." class="block w-full rounded-2xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 shadow-sm transition duration-150">
                </div>
            </div>

            @if(count($beritas) > 0)
                @php
                    $beritaUtama = $beritas->first();
                @endphp

                <!-- Hero Section (1 Berita Utama) -->
                <div class="mb-16">
                    <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="group block bg-white rounded-[2rem] overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                        <div class="grid lg:grid-cols-12 gap-0">
                            <!-- Image Container -->
                            <div class="lg:col-span-7 aspect-video lg:aspect-auto lg:h-[480px] bg-slate-100 relative overflow-hidden">
                                @if($beritaUtama->thumbnail_url)
                                    <img src="{{ $beritaUtama->thumbnail_url }}" alt="{{ $beritaUtama->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-slate-800 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20M12 16v-4m0 0l-2 2m2-2l2 2" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-6 left-6">
                                    <span class="bg-indigo-600 text-white text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-md">Berita Terkini</span>
                                </div>
                            </div>
                            <!-- Text Content Container -->
                            <div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 mb-4 text-xs font-semibold text-slate-500">
                                        <span class="text-indigo-600 font-extrabold uppercase tracking-wider">Berita Utama</span>
                                        <span>&bull;</span>
                                        <span>{{ $beritaUtama->published_at ? $beritaUtama->published_at->translatedFormat('d M Y') : 'Draft' }}</span>
                                    </div>
                                    <h2 class="text-2xl lg:text-3xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-3 leading-tight">
                                        {{ $beritaUtama->judul }}
                                    </h2>
                                    <p class="mt-4 text-slate-600 text-sm leading-relaxed line-clamp-4">
                                        {!! Str::limit(strip_tags($beritaUtama->konten), 150) !!}
                                    </p>
                                </div>
                                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            {{ substr($beritaUtama->penulis, 0, 1) }}
                                        </div>
                                        <span class="text-xs font-semibold text-slate-700">{{ $beritaUtama->penulis }}</span>
                                    </div>
                                    <span class="text-xs font-bold text-indigo-600 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Pembatas & Judul Berita Lainnya -->
                @if(count($beritas) > 1)
                    <div class="border-t border-slate-200/60 pt-12 mb-8">
                        <h3 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20" />
                            </svg>
                            Berita Lainnya
                        </h3>
                    </div>
                @endif

                <!-- Grid Section (Berita Lanjutan) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($beritas->skip(1) as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="group bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
                            <!-- Thumbnail -->
                            <div class="h-48 bg-slate-100 relative overflow-hidden shrink-0">
                                @if($item->thumbnail_url)
                                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-slate-800 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20M12 16v-4m0 0l-2 2m2-2l2 2" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <!-- Card Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Berita</span>
                                    <span class="text-slate-300">&bull;</span>
                                    <span class="text-xs font-medium text-slate-500">{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : 'Draft' }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">{{ $item->judul }}</h3>
                                <p class="mt-3 text-sm text-slate-600 line-clamp-3">
                                    {!! Str::limit(strip_tags($item->konten), 120) !!}
                                </p>
                                <div class="mt-auto pt-6 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                        {{ substr($item->penulis, 0, 1) }}
                                    </div>
                                    <span class="text-xs font-medium text-slate-700">{{ $item->penulis }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Paginasi -->
                @if($beritas->hasPages())
                    <div class="mt-16">
                        {{ $beritas->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="p-16 text-center bg-white rounded-[2rem] border border-slate-200 max-w-xl mx-auto shadow-sm">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20M12 16v-4m0 0l-2 2m2-2l2 2" /></svg>
                    </div>
                    <p class="text-slate-700 font-bold text-lg">Belum ada berita yang dipublikasikan saat ini</p>
                    <p class="text-slate-400 text-sm mt-1">Silakan periksa kembali beberapa saat lagi untuk informasi terbaru.</p>
                </div>
            @endif

        </div>
    </section>
</div>
