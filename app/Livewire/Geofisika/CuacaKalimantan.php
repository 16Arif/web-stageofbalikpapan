<?php

declare(strict_types=1);

namespace App\Livewire\Geofisika;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class CuacaKalimantan extends Component
{
    /**
     * @var array<int, array<string, mixed>>
     */
    public array $weatherSummary = [];

    public function mount(): void
    {
        $this->weatherSummary = $this->fetchWeather();
    }

    public function placeholder(): string
    {
        return <<<'HTML'
        <div class="py-12 bg-white overflow-hidden border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div class="relative">
                        <p class="text-xs font-bold uppercase tracking-[0.3em] text-indigo-600">Ringkasan Cuaca</p>
                        <h2 class="mt-3 text-3xl font-black text-gray-900">Cuaca Kalimantan</h2>
                        <div class="absolute -bottom-2 left-0 h-1.5 w-16 rounded-full bg-indigo-600"></div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="h-8 w-32 bg-slate-100 rounded-full animate-pulse"></div>
                    </div>
                </div>
                <div class="flex gap-4 overflow-hidden py-4">
                    <div class="shrink-0 w-[260px] h-[280px] rounded-2xl bg-slate-100 animate-pulse"></div>
                    <div class="shrink-0 w-[260px] h-[280px] rounded-2xl bg-slate-100 animate-pulse"></div>
                    <div class="shrink-0 w-[260px] h-[280px] rounded-2xl bg-slate-100 animate-pulse"></div>
                    <div class="shrink-0 w-[260px] h-[280px] rounded-2xl bg-slate-100 animate-pulse"></div>
                    <div class="shrink-0 w-[260px] h-[280px] rounded-2xl bg-slate-100 animate-pulse"></div>
                </div>
            </div>
        </div>
        HTML;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function fetchWeather(): array
    {
        return Cache::remember('cuaca_kalimantan_section_styles', 1800, function (): array {
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

            try {
                $responses = Http::pool(function (Pool $pool) use ($cities): array {
                    return array_map(function ($city) use ($pool) {
                        return $pool->as($city['name'])
                            ->withoutVerifying()
                            ->timeout(4)
                            ->get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$city['adm4']}");
                    }, $cities);
                });
            } catch (\Throwable) {
                $responses = [];
            }

            $results = [];

            foreach ($cities as $city) {
                $cityResponse = $responses[$city['name']] ?? null;

                if (! $cityResponse instanceof Response || ! $cityResponse->successful()) {
                    $results[] = $this->fallbackCity($city['name']);

                    continue;
                }

                try {
                    $forecast = data_get($cityResponse->json(), 'data.0.cuaca.0.0');

                    if (! is_array($forecast)) {
                        $results[] = $this->fallbackCity($city['name']);

                        continue;
                    }

                    $desc = (string) ($forecast['weather_desc'] ?? 'Tidak tersedia');

                    $results[] = [
                        'name' => $city['name'],
                        'temp' => (string) ($forecast['t'] ?? '--'),
                        'desc' => $desc,
                        'time' => $forecast['local_datetime'] ?? null,
                        'icon' => $this->mapWeatherIcon($forecast['weather'] ?? null, $desc),
                        'styles' => $this->mapWeatherStyles($desc),
                    ];
                } catch (\Throwable) {
                    $results[] = $this->fallbackCity($city['name']);
                }
            }

            return $results;
        });
    }

    /**
     * @return array<string, string>
     */
    private function mapWeatherStyles(string $desc): array
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

    /**
     * @return array<string, mixed>
     */
    private function fallbackCity(string $name): array
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

    private function mapWeatherIcon(mixed $code, ?string $desc = null): string
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

    public function render(): View
    {
        return view('livewire.geofisika.cuaca-kalimantan');
    }
}
