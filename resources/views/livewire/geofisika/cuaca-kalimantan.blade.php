<div class="py-12 bg-white overflow-hidden border-t border-slate-100"
    x-data="{
        scroll(dir) {
            $refs.viewport.scrollBy({ left: dir * 300, behavior: 'smooth' });
        }
    }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="relative">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-600">Ringkasan Cuaca</p>
                <h2 class="mt-3 text-3xl font-black text-gray-900">Cuaca Kalimantan</h2>
                <div class="absolute -bottom-2 left-0 h-1.5 w-16 rounded-full bg-indigo-600"></div>
            </div>

            <div class="flex flex-col gap-3 lg:items-end">
                <a href="https://www.bmkg.go.id/cuaca/prakiraan-cuaca/64" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-indigo-600 transition hover:bg-indigo-100">
                    Info Cuaca Selengkapnya
                </a>

                <div class="flex flex-wrap items-center gap-3 lg:justify-end">
                    <div
                        class="flex items-center gap-1.5 rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-indigo-600 shadow-sm">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-xs font-bold">{{ now()->timezone('Asia/Makassar')->format('H:i') }} WITA</span>
                    </div>

                    <button type="button" @click="scroll(-1)"
                        class="inline-flex size-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-600 active:scale-95">
                        <span class="sr-only">Geser ke kiri</span>
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button" @click="scroll(1)"
                        class="inline-flex size-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-600 active:scale-95">
                        <span class="sr-only">Geser ke kanan</span>
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-ref="viewport"
            class="group/marquee relative overflow-x-auto overflow-y-hidden py-4 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
            <div class="animate-marquee flex gap-4 whitespace-nowrap group-hover/marquee:[animation-play-state:paused]">
                
                @forelse ($weatherSummary as $item)
                    <div
                        class="shrink-0 w-[260px] rounded-2xl border border-black/5 p-8 text-center shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl {{ $item['styles']['card'] }} {{ $item['styles']['text'] }}">
                        <h3 class="mb-3 text-sm font-bold tracking-wide opacity-90">{{ $item['name'] }}</h3>
                        <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.18em] opacity-70">
                            {{ $item['time'] ? \Carbon\Carbon::parse($item['time'])->timezone('Asia/Makassar')->format('H:i') . ' WITA' : 'Data prakiraan' }}
                        </p>

                        <div class="mb-6 flex justify-center text-7xl drop-shadow-lg">
                            <span>{{ $item['icon'] }}</span>
                        </div>

                        <div class="mb-2 text-4xl font-black tracking-tighter">
                            <span>{{ $item['temp'] }}</span>&deg;<span class="text-2xl font-semibold {{ $item['styles']['text'] === 'text-white' ? 'opacity-80' : 'opacity-60' }}">C</span>
                        </div>

                        <div class="inline-block rounded-full px-4 py-1.5 text-xs font-medium backdrop-blur-sm {{ $item['styles']['pill'] }}">
                            <span>{{ $item['desc'] }}</span>
                        </div>
                    </div>
                @empty
                    <div class="w-full py-12 text-center text-slate-500">
                        Memuat data cuaca wilayah Kalimantan...
                    </div>
                @endforelse

                @if (!empty($weatherSummary))
                    @foreach ($weatherSummary as $item)
                        <div
                            class="shrink-0 w-[260px] rounded-2xl border border-black/5 p-8 text-center shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl {{ $item['styles']['card'] }} {{ $item['styles']['text'] }}"
                            aria-hidden="true">
                            <h3 class="mb-3 text-sm font-bold tracking-wide opacity-90">{{ $item['name'] }}</h3>
                            <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.18em] opacity-70">
                                {{ $item['time'] ? \Carbon\Carbon::parse($item['time'])->timezone('Asia/Makassar')->format('H:i') . ' WITA' : 'Data prakiraan' }}
                            </p>

                            <div class="mb-6 flex justify-center text-7xl drop-shadow-lg">
                                <span>{{ $item['icon'] }}</span>
                            </div>

                            <div class="mb-2 text-4xl font-black tracking-tighter">
                                <span>{{ $item['temp'] }}</span>&deg;<span class="text-2xl font-semibold {{ $item['styles']['text'] === 'text-white' ? 'opacity-80' : 'opacity-60' }}">C</span>
                            </div>

                            <div class="inline-block rounded-full px-4 py-1.5 text-xs font-medium backdrop-blur-sm {{ $item['styles']['pill'] }}">
                                <span>{{ $item['desc'] }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-260px * 12 - 1rem * 12));
            }
        }

        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 60s linear infinite;
        }

        .animate-marquee:hover,
        .group\/marquee:hover .animate-marquee {
            animation-play-state: paused;
        }
    </style>
</div>
