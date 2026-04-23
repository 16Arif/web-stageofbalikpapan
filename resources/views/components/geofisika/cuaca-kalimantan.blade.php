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

                    $cuaca = data_get($response->json(), 'data.0.cuaca.0.0');

                    if (! is_array($cuaca)) {
                        $results[] = $this->fallbackCity($city['name']);
                        continue;
                    }

                    $desc = $cuaca['weather_desc'] ?? 'Tidak tersedia';

                    $results[] = [
                        'name' => $city['name'],
                        'temp' => $cuaca['t'] ?? '--',
                        'desc' => $desc,
                        'icon' => $this->mapWeatherIcon($cuaca['weather'] ?? null, $desc),
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
            'icon' => '⛅',
            'styles' => $this->mapWeatherStyles($desc),
        ];
    }

    private function mapWeatherIcon($code, $desc = null)
    {
        $map = [
            '0' => '☀️',
            '1' => '⛅',
            '2' => '⛅',
            '3' => '☁️',
            '4' => '☁️',
            '5' => '🌫️',
            '10' => '🌫️',
            '45' => '🌫️',
            '60' => '🌧️',
            '61' => '🌧️',
            '63' => '🌧️',
            '80' => '🌧️',
            '95' => '⛈️',
            '97' => '⛈️',
        ];

        $code = (string) $code;

        if (isset($map[$code])) {
            return $map[$code];
        }

        $desc = strtolower((string) $desc);

        if (str_contains($desc, 'petir') || str_contains($desc, 'guntur')) {
            return '⛈️';
        }

        if (str_contains($desc, 'hujan')) {
            return '🌧️';
        }
        if (str_contains($desc, 'hujan_ringan')) {
            return '🌧️';
        }

        if (str_contains($desc, 'kabut') || str_contains($desc, 'asap') || str_contains($desc, 'berdebu')) {
            return '🌫️';
        }

        if (str_contains($desc, 'berawan')) {
            return '☁️';
        }

        if (str_contains($desc, 'cerah')) {
            return '☀️';
        }

        return '⛅';
    }

    public function render()
    {
        return view('components.geofisika.cuaca-kalimantan');
    }
};
?>

<div class="py-12 bg-white overflow-hidden border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8">
            <div class="relative">
                <h2 class="text-3xl font-black text-slate-800">Cuaca Kalimantan</h2>
                <div class="absolute -bottom-2 left-0 h-1.5 w-16 bg-[#00a8e8] rounded-full"></div>
            </div>

            <div
                class="flex items-center gap-1.5 px-3 py-1.5 border border-blue-200 rounded-lg text-blue-600 bg-blue-50/50 shadow-sm">
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-xs font-bold">{{ now()->timezone('Asia/Makassar')->format('H:i') }} WITA</span>
            </div>
        </div>

        <div class="relative flex overflow-hidden group py-4 cursor-pointer">
            <div class="flex gap-4 animate-marquee whitespace-nowrap">
                @forelse ($weatherSummary as $item)
                    <div
                        class="shrink-0 w-[260px] rounded-2xl p-8 text-center shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-black/5 {{ $item['styles']['card'] }} {{ $item['styles']['text'] }}">
                        <h3 class="font-bold text-sm tracking-wide mb-6 opacity-90">{{ $item['name'] }}</h3>

                        <div class="text-7xl drop-shadow-lg mb-6 flex justify-center">
                            {{ $item['icon'] }}
                        </div>

                        <div class="text-4xl font-black mb-2 tracking-tighter">
                            {{ $item['temp'] }}&deg;<span
                                class="text-2xl font-semibold {{ $item['styles']['text'] === 'text-white' ? 'opacity-80' : 'opacity-60' }}">C</span>
                        </div>

                        <div
                            class="text-xs font-medium rounded-full py-1.5 px-4 inline-block backdrop-blur-sm {{ $item['styles']['pill'] }}">
                            {{ $item['desc'] }}
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-12 text-slate-500">
                        Memuat data cuaca wilayah Kalimantan...
                    </div>
                @endforelse

                @if (count($weatherSummary) > 0)
                    @foreach ($weatherSummary as $item)
                        <div
                            class="shrink-0 w-[260px] rounded-2xl p-8 text-center shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-black/5 {{ $item['styles']['card'] }} {{ $item['styles']['text'] }}">
                            <h3 class="font-bold text-sm tracking-wide mb-6 opacity-90">{{ $item['name'] }}</h3>

                            <div class="text-7xl drop-shadow-lg mb-6 flex justify-center">
                                {{ $item['icon'] }}
                            </div>

                            <div class="text-4xl font-black mb-2 tracking-tighter">
                                {{ $item['temp'] }}&deg;<span
                                    class="text-2xl font-semibold {{ $item['styles']['text'] === 'text-white' ? 'opacity-80' : 'opacity-60' }}">C</span>
                            </div>

                            <div
                                class="text-xs font-medium rounded-full py-1.5 px-4 inline-block backdrop-blur-sm {{ $item['styles']['pill'] }}">
                                {{ $item['desc'] }}
                            </div>
                        </div>
                    @endforeach
                @endif
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
            transform: translateX(calc(-260px * {{ count($weatherSummary) }} - 1rem * {{ count($weatherSummary) }}));
        }
    }

    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee {{ count($weatherSummary) > 0 ? count($weatherSummary) * 5 : 30 }}s linear infinite;
    }

    .group:hover .animate-marquee {
        animation-play-state: paused !important;
    }
</style>
