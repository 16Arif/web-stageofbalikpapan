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
                        class="group flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-slate-200 hover:border-indigo-300 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div class="aspect-[16/10] overflow-hidden relative">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                class="size-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1 bg-white/90 backdrop-blur text-[10px] font-black uppercase tracking-widest text-indigo-600 rounded-full shadow-sm italic">
                                    {{ $post->categoryRelation?->name ?? $post->category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-8 flex flex-col grow">
                            <div
                                class="flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-tighter mb-4">
                                <svg class="size-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $post->date?->translatedFormat('d M Y') }}
                            </div>

                            <h3
                                class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors leading-tight mb-4">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h3>

                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ $post->excerpt }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-slate-50">
                                <a href="{{ route('posts.show', $post) }}"
                                    class="inline-flex items-center gap-2 text-xs font-black text-slate-900 uppercase tracking-widest hover:text-indigo-600 transition">
                                    Baca Selengkapnya
                                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 rounded-[2rem] border border-slate-200 bg-white p-10 text-center text-slate-500">
                        Belum ada postingan yang sesuai dengan filter ini.
                    </div>
                @endforelse

            </div>
        </div>
    </section>
</x-layouts.app>
