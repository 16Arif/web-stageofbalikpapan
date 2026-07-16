<?php

namespace App\Livewire\Geofisika;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

new class extends Component {
    public $weatherSummary = [];

    public function mount()
    {
        $this->weatherSummary = $this->fetchWeather();
    }

    private function fetchWeather()
    {
        return Cache::remember('cuaca_kalimantan_section_styles', 1800, function () {
            $cities = [
                ['name' => 'Balikpapan', 'adm4' => '64.71.01.1001'],
                ['name' => 'Samarinda', 'adm4' => '64.72.01.1001'],
                ['name' => 'Bontang', 'adm4' => '64.74.01.1001'],
                ['name' => 'Kab Berau', 'adm4' => '64.03.05.1004'],
                ['name' => 'Banjarmasin', 'adm4' => '63.71.05.1001'],
                ['name' => 'Banjarbaru', 'adm4' => '63.06.07.2004'],
                ['name' => 'Pontianak', 'adm4' => '61.71.06.1002'],
                ['name' => 'Singkawang', 'adm4' => '61.72.01.1001'],
                ['name' => 'Palangkaraya', 'adm4' => '62.71.01.1001'],
                ['name' => 'Sampit', 'adm4' => '61.04.16.1004'],
                ['name' => 'Tarakan', 'adm4' => '65.71.04.1001'],
                ['name' => 'Tanjung Selor', 'adm4' => '65.01.05.2009'],
            ];

            $results = [];

            foreach ($cities as $city) {
                try {
                    $response = Http::withoutVerifying()
                        ->timeout(5)
                        ->get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$city['adm4']}");

                    if (! $response->successful()) {
                        $results[] = $this->fallbackCity($city['name']);
                        continue;
                    }

                    $forecast = data_get($response->json(), 'data.0.cuaca.0.0');

                    if (! is_array($forecast)) {
                        $results[] = $this->fallbackCity($city['name']);
                        continue;
                    }

                    $desc = $forecast['weather_desc'] ?? 'Tidak tersedia';

                    $results[] = [
                        'name' => $city['name'],
                        'temp' => $forecast['t'] ?? '--',
                        'desc' => $desc,
                        'time' => $forecast['local_datetime'] ?? null,
                        'icon' => $this->mapWeatherIcon($forecast['weather'] ?? null, $desc),
                        'styles' => $this->mapWeatherStyles($desc),
                    ];
                } catch (\Throwable $e) {
                    $results[] = $this->fallbackCity($city['name']);
                }
            }

            return $results;
        });
    }

    private function mapWeatherStyles($desc)
    {
        $descLower = strtolower($desc);

        if (str_contains($descLower, 'cerah berawan')) {
            return [
                'card' => 'bg-gradient-to-br from-amber-400 to-amber-600',
                'text' => 'text-slate-950',
                'pill' => 'bg-black/10',
            ];
        }

        if (str_contains($descLower, 'cerah')) {
            return [
                'card' => 'bg-gradient-to-br from-white via-yellow-50 to-white',
                'text' => 'text-slate-950',
                'pill' => 'bg-slate-200/50',
            ];
        }

        if (str_contains($descLower, 'berawan')) {
            return [
                'card' => 'bg-gradient-to-br from-slate-400 to-slate-600',
                'text' => 'text-white',
                'pill' => 'bg-white/20',
            ];
        }

        if (str_contains($descLower, 'hujan') || str_contains($descLower, 'petir')) {
            return [
                'card' => 'bg-gradient-to-br from-slate-700 to-slate-900',
                'text' => 'text-white',
                'pill' => 'bg-white/20',
            ];
        }

        return [
            'card' => 'bg-gradient-to-br from-[#6b66d6] to-[#825fb3]',
            'text' => 'text-white',
            'pill' => 'bg-white/20',
        ];
    }

    private function fallbackCity($name)
    {
        $desc = 'Tidak tersedia';

        return [
            'name' => $name,
            'temp' => '--',
            'desc' => $desc,
            'time' => null,
            'icon' => "\u{26C5}",
            'styles' => $this->mapWeatherStyles($desc),
        ];
    }

    private function mapWeatherIcon($code, $desc = null)
    {
        $map = [
            '0' => "\u{2600}\u{FE0F}",
            '1' => "\u{26C5}",
            '2' => "\u{26C5}",
            '3' => "\u{2601}\u{FE0F}",
            '4' => "\u{2601}\u{FE0F}",
            '5' => "\u{1F32B}\u{FE0F}",
            '10' => "\u{1F32B}\u{FE0F}",
            '45' => "\u{1F32B}\u{FE0F}",
            '60' => "\u{1F327}\u{FE0F}",
            '61' => "\u{1F327}\u{FE0F}",
            '63' => "\u{1F327}\u{FE0F}",
            '80' => "\u{1F327}\u{FE0F}",
            '95' => "\u{26C8}\u{FE0F}",
            '97' => "\u{26C8}\u{FE0F}",
        ];

        $code = (string) $code;

        if (isset($map[$code])) {
            return $map[$code];
        }

        $desc = strtolower((string) $desc);

        if (str_contains($desc, 'petir') || str_contains($desc, 'guntur')) {
            return "\u{26C8}\u{FE0F}";
        }

        if (str_contains($desc, 'hujan')) {
            return "\u{1F327}\u{FE0F}";
        }

        if (str_contains($desc, 'kabut') || str_contains($desc, 'asap') || str_contains($desc, 'berdebu')) {
            return "\u{1F32B}\u{FE0F}";
        }

        if (str_contains($desc, 'berawan')) {
            return "\u{2601}\u{FE0F}";
        }

        if (str_contains($desc, 'cerah')) {
            return "\u{2600}\u{FE0F}";
        }

        return "\u{26C5}";
    }

    public function render()
    {
        return view('components.geofisika.cuaca-kalimantan');
    }
};
?>

<div class="py-12 bg-white overflow-hidden border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{
        isPaused: false,
        resumeTimer: null,
        weatherItems: @js($weatherSummary),
        formatForecastTime(value) {
            if (! value) {
                return 'Data prakiraan';
            }

            const parsed = new Date(value);

            if (Number.isNaN(parsed.getTime())) {
                return 'Data prakiraan';
            }

            return parsed.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
            }).replace('.', ':') + ' WITA';
        },
        manualScroll(direction) {
            this.isPaused = true;
            this.$refs.viewport.scrollBy({ left: direction * 280, behavior: 'smooth' });

            if (this.resumeTimer) {
                clearTimeout(this.resumeTimer);
            }

            this.resumeTimer = setTimeout(() => {
                this.isPaused = false;
            }, 4000);
        }
    }">
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

                    <button type="button" @click="manualScroll(-1)"
                        class="inline-flex size-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-600">
                        <span class="sr-only">Geser ke kiri</span>
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button" @click="manualScroll(1)"
                        class="inline-flex size-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-indigo-200 hover:text-indigo-600">
                        <span class="sr-only">Geser ke kanan</span>
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-ref="viewport" @mouseenter="isPaused = true" @mouseleave="isPaused = false"
            class="relative overflow-x-auto overflow-y-hidden py-4 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
            <div class="animate-marquee flex gap-4 whitespace-nowrap"
                :style="`animation-play-state: ${isPaused ? 'paused' : 'running'};`">
                <template x-for="(item, index) in weatherItems" :key="`primary-${index}`">
                    <div
                        class="shrink-0 w-[260px] rounded-2xl border border-black/5 p-8 text-center shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                        :class="[item.styles.card, item.styles.text]">
                        <h3 class="mb-3 text-sm font-bold tracking-wide opacity-90" x-text="item.name"></h3>
                        <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.18em] opacity-70"
                            x-text="formatForecastTime(item.time)"></p>

                        <div class="mb-6 flex justify-center text-7xl drop-shadow-lg">
                            <span x-text="item.icon"></span>
                        </div>

                        <div class="mb-2 text-4xl font-black tracking-tighter">
                            <span x-text="item.temp"></span>&deg;<span class="text-2xl font-semibold"
                                :class="item.styles.text === 'text-white' ? 'opacity-80' : 'opacity-60'">C</span>
                        </div>

                        <div class="inline-block rounded-full px-4 py-1.5 text-xs font-medium backdrop-blur-sm"
                            :class="item.styles.pill">
                            <span x-text="item.desc"></span>
                        </div>
                    </div>
                </template>

                <template x-if="weatherItems.length === 0">
                    <div class="w-full py-12 text-center text-slate-500">
                        Memuat data cuaca wilayah Kalimantan...
                    </div>
                </template>

                <template x-for="(item, index) in weatherItems" :key="`duplicate-${index}`">
                    <div
                        class="shrink-0 w-[260px] rounded-2xl border border-black/5 p-8 text-center shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                        :class="[item.styles.card, item.styles.text]">
                        <h3 class="mb-3 text-sm font-bold tracking-wide opacity-90" x-text="item.name"></h3>
                        <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.18em] opacity-70"
                            x-text="formatForecastTime(item.time)"></p>

                        <div class="mb-6 flex justify-center text-7xl drop-shadow-lg">
                            <span x-text="item.icon"></span>
                        </div>

                        <div class="mb-2 text-4xl font-black tracking-tighter">
                            <span x-text="item.temp"></span>&deg;<span class="text-2xl font-semibold"
                                :class="item.styles.text === 'text-white' ? 'opacity-80' : 'opacity-60'">C</span>
                        </div>

                        <div class="inline-block rounded-full px-4 py-1.5 text-xs font-medium backdrop-blur-sm"
                            :class="item.styles.pill">
                            <span x-text="item.desc"></span>
                        </div>
                    </div>
                </template>
            </div>
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
</style>
