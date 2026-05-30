<section id="activity-news" class="relative isolate overflow-hidden bg-white py-24 sm:py-32">
    <x-ui.decoration.blur-bg position="top" color="from-cyan-200 to-indigo-300" />

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="max-w-2xl lg:mx-0">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-600">Warta Geofisika</p>
                <h2 class="mt-3 text-4xl font-black tracking-tight text-gray-900 sm:text-5xl">Aktivitas dan Diseminasi Publik</h2>
                <p class="mt-4 text-lg leading-8 text-gray-500">
                    Informasi terkini mengenai kegiatan operasional, sosialisasi mitigasi, dan edukasi kebencanaan di
                    wilayah Balikpapan dan sekitarnya.
                </p>
            </div>
            <div class="shrink-0 mb-2">
                <a href="{{ route('activity') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                    Lihat Semua Berita
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-100 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @forelse($posts as $post)
            <article class="flex max-w-xl flex-col items-start justify-between group">
                <div class="flex items-center gap-x-4 text-xs">
                    <time datetime="{{ $post->published_at?->format('Y-m-d') }}" class="text-gray-500 font-mono">{{ $post->published_at?->translatedFormat('d M Y') }}</time>
                    @if($post->category)
                    <a href="{{ route('activity', ['category' => $post->category->slug]) }}" class="relative z-10 rounded-full bg-indigo-50 px-3 py-1.5 font-bold text-indigo-600 hover:bg-indigo-100 transition">
                        {{ $post->category->name }}
                    </a>
                    @endif
                </div>
                <div class="group relative grow">
                    <h3 class="mt-3 text-lg font-bold leading-6 text-gray-900 group-hover:text-indigo-600 transition line-clamp-2">
                        <a href="{{ route('posts.show', $post) }}">
                            <span class="absolute inset-0"></span>
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                        {{ $post->excerpt }}
                    </p>
                </div>
                @if($post->author)
                <div class="relative mt-8 flex items-center gap-x-4">
                    @if($post->author->photo)
                        <img src="{{ Storage::disk('public')->url($post->author->photo) }}" alt="{{ $post->author->name }}" class="size-10 rounded-full bg-slate-100 object-cover">
                    @else
                        <div class="size-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                            <svg class="size-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                    @endif
                    <div class="text-sm leading-6">
                        <p class="font-bold text-gray-900">
                            <a href="{{ route('posts.by-author', $post->author) }}">
                                <span class="absolute inset-0"></span>
                                {{ $post->author->name }}
                            </a>
                        </p>
                        <p class="text-gray-600 text-xs italic uppercase tracking-tighter line-clamp-1">{{ $post->author->bio ?? 'Penulis' }}</p>
                    </div>
                </div>
                @endif
            </article>
            @empty
            <div class="lg:col-span-3 rounded-[2rem] border border-slate-200 bg-slate-50 p-12 text-center shadow-sm">
                <p class="text-slate-500">Belum ada berita atau aktivitas terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>

    <x-ui.decoration.blur-bg position="bottom" color="from-blue-200 to-cyan-100" />
</section>
