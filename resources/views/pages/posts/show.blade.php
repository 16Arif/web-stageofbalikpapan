<x-layouts.app>
    <x-slot:title>{{ $post->title }} - Stageof Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-slate-950 py-16 md:py-20">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/20 to-slate-950" />

        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <a href="{{ route('activity') }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-indigo-300 transition hover:text-indigo-200">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Berita
            </a>

            <div class="mt-8">
                <a href="{{ route('activity', ['category' => $post->categoryRelation?->slug]) }}"
                    class="inline-flex rounded-full bg-indigo-500/10 px-4 py-2 text-xs font-black uppercase tracking-[0.22em] text-indigo-300 transition hover:bg-indigo-500/20">
                    {{ $post->categoryRelation?->name ?? $post->category }}
                </a>
                <h1 class="mt-5 text-4xl font-black leading-tight text-white md:text-5xl">
                    {{ $post->title }}
                </h1>
                <div class="mt-6 flex flex-col gap-3 text-sm text-slate-300 md:flex-row md:flex-wrap md:items-center md:gap-6">
                    <p>
                        <span class="font-bold text-white">Penulis:</span>
                        <a href="{{ route('posts.by-author', $post->authorRelation) }}"
                            class="font-medium text-indigo-300 transition hover:text-indigo-200">
                            {{ $post->authorRelation?->name ?? $post->author }}
                        </a>
                    </p>
                    <p><span class="font-bold text-white">Waktu:</span> {{ $post->published_at?->format('d F Y, H:i') }} WITA</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <div class="overflow-hidden rounded-[2rem] border border-slate-200 shadow-sm">
                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-auto w-full object-cover">
            </div>

            <article class="mx-auto mt-10 max-w-3xl">
                <p class="text-lg leading-8 text-slate-500">
                    {{ $post->excerpt }}
                </p>

                <div class="mt-10 space-y-6 text-base leading-8 text-slate-700">
                    @foreach (preg_split("/\r\n|\n|\r/", $post->content) as $paragraph)
                        @continue(blank(trim($paragraph)))
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </article>
        </div>
    </section>
</x-layouts.app>
