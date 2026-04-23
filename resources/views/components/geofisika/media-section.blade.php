<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

new class extends Component {
    public $gempaBento = null;
    public $weatherToday = [];

    public $selectedCity = '64.71.01.1001';

    public $cityOptions = [
        '64.71.01.1001' => 'Balikpapan Timur',
        '64.71.02.1001' => 'Balikpapan Barat',
        '64.71.03.1001' => 'Balikpapan Utara',
        '64.71.04.1001' => 'Balikpapan Tengah',
        '64.71.05.1001' => 'Balikpapan Selatan',
        '64.71.06.1001' => 'Balikpapan Kota',
    ];

    public function mount()
    {
        $this->fetchGempa();
        $this->weatherToday = $this->fetchWeatherDetail();
    }

    public function updatedSelectedCity()
    {
        $this->weatherToday = $this->fetchWeatherDetail();
    }

    private function fetchGempa()
    {
        $this->gempaBento = Cache::remember('bento_gempa', 120, function () {
            try {
                $response = Http::timeout(5)->get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');

                return $response->successful() ? data_get($response->json(), 'Infogempa.gempa') : null;
            } catch (\Exception $e) {
                return null;
            }
        });
    }

    private function fetchWeatherDetail()
    {
        return Cache::remember('cuaca_detail_' . $this->selectedCity, 1800, function () {
            try {
                $response = Http::withoutVerifying()
                    ->timeout(5)
                    ->get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$this->selectedCity}");

                if (!$response->successful()) {
                    return [];
                }

                $today = data_get($response->json(), 'data.0.cuaca.0', []);

                return collect($today)
                    ->map(function ($item) {
                        $desc = $item['weather_desc'] ?? 'Tidak tersedia';

                        return [
                            'time' => Carbon::parse($item['local_datetime'])->setTimezone('Asia/Makassar')->format('d M, H:i'),
                            'temp' => $item['t'] ?? '--',
                            'desc' => $desc,
                            'icon' => $this->mapWeatherIcon($item['weather'] ?? null, $desc),
                            'humidity' => $item['hu'] ?? '--',
                            'wind' => $item['ws'] ?? '--',
                        ];
                    })
                    ->toArray();
            } catch (\Exception $e) {
                return [];
            }
        });
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
        return view('components.geofisika.media-section', [
            'gempaBento' => $this->gempaBento,
            'weatherToday' => $this->weatherToday,
        ]);
    }
};
?>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<section id="publication" class="relative isolate bg-slate-50 py-24 sm:py-32 overflow-hidden">
    <x-ui.decoration.blur-bg position="center" color="from-indigo-100 to-blue-200" />

    <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8">
        <div class="text-center mb-16">
            <p class="mt-2 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl uppercase">Layanan Informasi
                Terkini</p>
        </div>

        <div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
            <div class="relative lg:row-span-2">
                <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>

                <div
                    class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-l-[2rem]">
                    <div class="px-6 pt-8 pb-4 sm:px-8 sm:pt-8 bg-white z-10 relative shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mb-1">Meteorologi
                                </p>
                                <p class="text-lg font-bold tracking-tight text-gray-950">Prakiraan Per Jam</p>
                            </div>
                        </div>

                        <div class="relative">
                            <select wire:model.live="selectedCity"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 text-slate-800 font-bold text-sm rounded-xl px-4 py-3 pr-8 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                @foreach ($cityOptions as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 flex-1 relative flex items-center p-6" x-data="{
                        interval: null,
                        startScroll() {
                            this.stopScroll();
                            this.interval = setInterval(() => {
                                let slider = this.$refs.slider;
                                if (!slider) return;
                    
                                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                                    slider.scrollTo({ left: 0, behavior: 'smooth' });
                                } else {
                                    slider.scrollBy({ left: 236, behavior: 'smooth' });
                                }
                            }, 3000);
                        },
                        stopScroll() {
                            if (this.interval) {
                                clearInterval(this.interval);
                                this.interval = null;
                            }
                        }
                    }"
                        x-init="startScroll()" @mouseenter="stopScroll()" @mouseleave="startScroll()"
                        @touchstart="stopScroll()" @touchend="startScroll()">
                        <div wire:loading wire:target="selectedCity"
                            class="absolute inset-0 z-50 flex flex-col items-center justify-center bg-slate-50/80 backdrop-blur-sm transition-all">
                            <svg class="animate-spin size-10 text-indigo-600 mb-3" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>

                            <span class="text-xs font-bold text-indigo-900 uppercase tracking-widest animate-pulse">
                                Memuat Cuaca...
                            </span>
                        </div>

                        <div x-ref="slider"
                            class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory scrollbar-hide w-full"
                            style="scroll-behavior: smooth;">
                            @forelse ($weatherToday as $item)
                                <div
                                    class="snap-center shrink-0 w-[220px] bg-slate-800 rounded-3xl p-5 shadow-xl flex flex-col border border-slate-700 transition-transform duration-300 hover:scale-[1.02]">
                                    <div class="text-center mb-6">
                                        <p class="text-xs text-slate-400 font-medium mb-4">{{ $item['time'] }} WITA</p>
                                        <span class="text-6xl drop-shadow-lg block mb-4">{{ $item['icon'] }}</span>
                                        <p class="text-sm font-bold text-white">{{ $item['desc'] }}</p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 mt-auto">
                                        <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                                            <p class="text-[10px] text-slate-400 mb-1 flex items-center gap-1.5">
                                                <span>Temp</span> Suhu
                                            </p>
                                            <p class="text-base font-black text-white">{{ $item['temp'] }}&deg;C</p>
                                        </div>

                                        <div class="bg-white/5 rounded-xl p-3 border border-white/5">
                                            <p class="text-[10px] text-slate-400 mb-1 flex items-center gap-1.5">
                                                <span>RH</span> Lembab
                                            </p>
                                            <p class="text-base font-black text-white">{{ $item['humidity'] }}%</p>
                                        </div>

                                        <div
                                            class="bg-white/5 rounded-xl p-3 border border-white/5 col-span-2 flex items-center justify-between">
                                            <div>
                                                <p class="text-[10px] text-slate-400 mb-1 flex items-center gap-1.5">
                                                    <span>WS</span> Kecepatan Angin
                                                </p>
                                                <p class="text-base font-black text-white">{{ $item['wind'] }} <span
                                                        class="text-xs font-normal text-slate-400">km/h</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="w-full text-center py-10 flex flex-col items-center justify-center">
                                    <svg class="size-10 text-slate-300 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm font-bold text-slate-500">Gagal memuat data</p>
                                    <p class="text-xs text-slate-400 mt-1">Silakan coba lagi nanti.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5 lg:rounded-l-[2rem]">
                </div>
            </div>

            <style>
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>

            <div class="relative max-lg:row-start-1">
                <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>

                <div
                    class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[2rem] p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <p class="text-[10px] font-bold text-amber-600 uppercase tracking-widest">Geofisika</p>
                            <p class="text-lg font-bold text-slate-900">Kerapatan Petir</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Live Monitoring</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 flex items-center gap-4">
                            <div
                                class="size-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 shadow-sm">
                                <svg class="size-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase leading-none mb-1">Total
                                    Sambaran</p>
                                <p class="text-2xl font-black text-slate-900">120 <span
                                        class="text-xs font-medium text-slate-400">Strikes</span></p>
                            </div>
                        </div>

                        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 flex items-center gap-4">
                            <div
                                class="size-12 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm">
                                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-500 uppercase leading-none mb-1">Status
                                    Wilayah</p>
                                <p class="text-lg font-black text-emerald-600 uppercase">Aman</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 rounded-xl bg-blue-50 border border-blue-100">
                        <p class="text-xs text-blue-800 leading-relaxed">
                            <strong>Info:</strong> Kerapatan petir terdeteksi dalam radius 50km dari Stasiun Geofisika
                            Balikpapan. Data diperbarui setiap 15 menit.
                        </p>
                    </div>
                </div>

                <div
                    class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5 max-lg:rounded-t-[2rem]">
                </div>
            </div>

            <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                <div class="absolute inset-px rounded-lg bg-white"></div>
                <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]">
                    <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                        <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest mb-1">Edukasi</p>
                        <p class="text-lg font-bold tracking-tight text-gray-950">Profil & Sosialisasi</p>
                    </div>
                    <div class="flex flex-1 items-center p-4 lg:pb-4">
                        <div
                            class="w-full aspect-video rounded-xl overflow-hidden bg-slate-200 shadow-sm border border-slate-100">
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/ZR13ukPdzsw"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm outline outline-black/5"></div>
            </div>

            <div class="relative lg:row-span-2" wire:poll.60s>
                <div class="absolute inset-px rounded-lg bg-white lg:rounded-r-[2rem]"></div>
                <div
                    class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-r-[2rem]">
                    <div class="px-8 pt-8">
                        <p class="text-[10px] font-bold text-orange-600 uppercase tracking-widest mb-1">Gempabumi
                            Terkini
                        </p>
                        <p class="text-lg font-bold tracking-tight text-gray-950">Gempa Nasional</p>
                        @if ($gempaBento)
                            <p class="mt-2 text-xs font-medium text-slate-600 leading-relaxed italic">
                                Mag:{{ $gempaBento['Magnitude'] }}, {{ $gempaBento['Wilayah'] }}
                            </p>
                        @endif
                    </div>
                    <div class="relative grow p-6">
                        @if ($gempaBento)
                            <div
                                class="relative h-full w-full rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                                <img src="https://data.bmkg.go.id/DataMKG/TEWS/{{ $gempaBento['Shakemap'] }}"
                                    class="size-full object-cover" alt="Shakemap gempa terbaru">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 flex gap-2">
                                    <span
                                        class="bg-red-600 text-[8px] text-white font-black px-2 py-0.5 rounded">BMKG</span>
                                    <span
                                        class="bg-white/90 text-[8px] text-slate-900 font-bold px-2 py-0.5 rounded">{{ $gempaBento['Jam'] }}</span>
                                </div>
                            </div>
                        @else
                            <div class="animate-pulse bg-slate-100 size-full rounded-2xl"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
