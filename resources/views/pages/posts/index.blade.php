<x-layouts.app>
    <x-slot:title>{{ $pageTitle ?? 'Berita & Aktivitas' }} - Stageof Balikpapan</x-slot:title>

    <section class="bg-white pt-16 pb-8 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-indigo-600 font-bold uppercase tracking-[0.2em] text-xs mb-3">Update Terkini</h2>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">{{ $pageTitle ?? 'Berita & Aktivitas' }}</h1>
                    <p class="mt-4 text-slate-500 text-lg">{{ $pageDescription ?? 'Liputan kegiatan harian, sosialisasi, dan informasi penting dari Stasiun Geofisika Balikpapan.' }}</p>
                </div>

                @php
                    $baseRoute = $currentAuthor ? route('posts.by-author', $currentAuthor) : route('activity');
                @endphp

                <div class="flex flex-wrap gap-2 pb-2">
                    <a href="{{ $baseRoute }}"
                        class="px-4 py-2 rounded-full text-xs font-bold border transition {{ $selectedCategory ? 'bg-white border-slate-200 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600' : 'bg-indigo-600 border-indigo-600 text-white shadow-md' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ $baseRoute }}?category={{ $category->slug }}"
                            class="px-4 py-2 rounded-full text-xs font-bold border transition {{ $selectedCategory?->is($category) ? 'bg-indigo-600 border-indigo-600 text-white shadow-md' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-indigo-50 hover:text-indigo-600' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-slate-50 relative isolate">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-100 to-white" />

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                @forelse ($posts as $post)
                    <article
                        class="group relative flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-slate-200 hover:border-indigo-300 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div class="aspect-[16/10] overflow-hidden relative">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy"
                                class="size-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-4 left-4 z-10">
                                @if($post->categoryRelation)
                                <a href="{{ route('activity', ['category' => $post->categoryRelation->slug]) }}"
                                    class="px-3 py-1 bg-white/90 backdrop-blur text-[10px] font-black uppercase tracking-widest text-indigo-600 rounded-full shadow-sm italic hover:bg-indigo-600 hover:text-white transition">
                                    {{ $post->categoryRelation->name }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="p-8 flex flex-col grow">
                            <div class="flex items-center gap-4 text-slate-400 text-[10px] font-bold uppercase tracking-tighter mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $post->published_at?->translatedFormat('d M Y') }}
                                </div>
                                @if($post->authorRelation)
                                <a href="{{ route('posts.by-author', $post->authorRelation) }}" class="flex items-center gap-2 hover:text-indigo-600 transition relative z-10">
                                    <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $post->authorRelation->name }}
                                </a>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors leading-tight mb-4 line-clamp-2">
                                <a href="{{ route('posts.show', $post) }}" class="before:absolute before:inset-0">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ $post->excerpt }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-slate-50 relative z-10">
                                <span class="inline-flex items-center gap-2 text-xs font-black text-indigo-600 uppercase tracking-widest group-hover:translate-x-2 transition-transform">
                                    Baca Selengkapnya
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 rounded-[2.5rem] border border-slate-200 bg-white p-12 text-center shadow-sm flex flex-col items-center justify-center">
                        <div class="size-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 mb-4">
                            <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">Belum Ada Postingan</h3>
                        <p class="text-slate-500 max-w-sm mx-auto mb-6">Kami belum menemukan berita atau aktivitas yang sesuai dengan kriteria yang Anda cari.</p>
                        @if($selectedCategory || $currentAuthor)
                            <a href="{{ route('activity') }}" class="px-6 py-2.5 bg-indigo-50 text-indigo-600 font-bold text-sm rounded-full hover:bg-indigo-600 hover:text-white transition">Hapus Filter</a>
                        @endif
                    </div>
                @endforelse

            </div>

            @if($posts->hasPages())
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
