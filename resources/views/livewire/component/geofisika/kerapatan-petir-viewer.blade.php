@assets
<script src="https://cdn.jsdelivr.net/npm/@panzoom/panzoom/dist/panzoom.min.js"></script>
@endassets

<div class="space-y-6">
    <!-- Top Bar: Header & Filter -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-gray-100">
        <div>
            <h2 class="text-lg md:text-xl font-semibold text-gray-800">Peta Kerapatan Petir</h2>
            @if ($this->activeMap)
                <p class="text-xs text-gray-500 mt-0.5">Periode aktif: {{ $this->activeMap->periode_bulan_tahun }}</p>
            @endif
        </div>

        @if (!empty($this->availableYears) && !empty($this->availableMonths))
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2">
                    <label for="year-select" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Tahun:</label>
                    <select 
                        id="year-select" 
                        wire:model.live="selectedYear" 
                        class="text-sm border-gray-200 text-gray-700 rounded-md focus:ring-blue-500 focus:border-blue-500 py-1.5 pl-3 pr-8 bg-white"
                    >
                        @foreach ($this->availableYears as $year)
                            <option value="{{ $year }}" wire:key="year-opt-{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label for="month-select" class="text-xs font-semibold text-gray-500 whitespace-nowrap">Bulan:</label>
                    <select 
                        id="month-select" 
                        wire:model.live="selectedMonth" 
                        class="text-sm border-gray-200 text-gray-700 rounded-md focus:ring-blue-500 focus:border-blue-500 py-1.5 pl-3 pr-8 bg-white"
                    >
                        @foreach ($this->availableMonths as $month)
                            <option value="{{ $month['value'] }}" wire:key="month-opt-{{ $month['value'] }}">{{ $month['label'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>

    <!-- Map Container (Alpine.js + Panzoom + Fullscreen) -->
    @if ($this->activeMap && $this->activeMap->map_image_url)
        <div x-data="{ isFullscreen: false }" class="relative max-w-5xl mx-auto w-full">
            <div 
                wire:key="map-container-{{ $this->activeMap->id }}"
                x-data="mapZoomer('{{ $this->activeMap->map_image_url }}')"
                x-effect="imageUrl = '{{ $this->activeMap->map_image_url }}'"
                :class="isFullscreen 
                    ? 'fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4' 
                    : 'relative overflow-hidden w-full h-[600px] bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center'"
                class="w-full transition-all duration-200"
            >
                <!-- Floating controls overlay (z-[60]) -->
                <div 
                    :class="isFullscreen ? 'fixed top-4 right-4 z-[60]' : 'absolute top-4 right-4 z-10'"
                    class="flex flex-col gap-2"
                >
                    <!-- Fullscreen Toggle -->
                    <button 
                        @click="isFullscreen = !isFullscreen" 
                        class="p-2 bg-white/90 hover:bg-white text-gray-700 rounded-lg shadow-sm border border-gray-200 transition backdrop-blur-md flex items-center justify-center w-9 h-9"
                        title="Toggle Layar Penuh"
                    >
                        <template x-if="!isFullscreen">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4h4M20 8V4h-4M4 16v4h4M20 16v4h-4" />
                            </svg>
                        </template>
                        <template x-if="isFullscreen">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </template>
                    </button>

                    <!-- Zoom In -->
                    <button 
                        @click="zoomIn()" 
                        class="p-2 bg-white/90 hover:bg-white text-gray-700 rounded-lg shadow-sm border border-gray-200 transition backdrop-blur-md flex items-center justify-center w-9 h-9"
                        title="Zoom In"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>

                    <!-- Zoom Out -->
                    <button 
                        @click="zoomOut()" 
                        class="p-2 bg-white/90 hover:bg-white text-gray-700 rounded-lg shadow-sm border border-gray-200 transition backdrop-blur-md flex items-center justify-center w-9 h-9"
                        title="Zoom Out"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                        </svg>
                    </button>

                    <!-- Reset Zoom -->
                    <button 
                        @click="resetZoom()" 
                        class="p-2 bg-white/90 hover:bg-white text-gray-700 rounded-lg shadow-sm border border-gray-200 transition backdrop-blur-md flex items-center justify-center w-9 h-9"
                        title="Reset Zoom"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4z M9 9h6v6H9z" />
                        </svg>
                    </button>
                </div>

                <!-- Panzoom Area (z-0) -->
                <div 
                    x-ref="panzoomArea" 
                    class="w-full h-full flex items-center justify-center cursor-grab active:cursor-grabbing relative z-0"
                >
                    <img 
                        src="{{ $this->activeMap->map_image_url }}" 
                        alt="Peta Kerapatan Petir - {{ $this->activeMap->periode_bulan_tahun }}" 
                        draggable="false"
                        oncontextmenu="return false;"
                        @load="onImageLoad()"
                        class="max-w-full max-h-full object-contain pointer-events-none select-none transition-transform"
                    >
                </div>

                <!-- Watermark Overlay (Only shown in Fullscreen, outside Panzoom Area, z-[55]) -->
                <div 
                    x-show="isFullscreen" 
                    x-transition 
                    class="absolute inset-0 z-[55] flex items-center justify-center opacity-30 pointer-events-none select-none overflow-hidden"
                >
                    <span class="text-4xl md:text-6xl font-extrabold text-white/40 -rotate-12 tracking-wider uppercase select-none pointer-events-none">
                        Stasiun Geofisika Balikpapan
                    </span>
                </div>

                <!-- Loading State Indicator overlay inside the map container -->
                <div wire:loading wire:target="selectedYear, selectedMonth" class="absolute inset-0 bg-white/60 backdrop-blur-[1px] flex items-center justify-center z-20">
                    <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <!-- Description -->
            @if ($this->activeMap->deskripsi)
                <div class="prose prose-sm max-w-none text-gray-600 mt-4 border-t border-gray-100 pt-4">
                    {!! $this->activeMap->deskripsi !!}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State Global -->
        <div wire:loading.remove wire:target="selectedYear, selectedMonth" class="w-full p-12 bg-gray-50/50 rounded-lg border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-center">
            <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
            </svg>
            <h3 class="text-base font-medium text-gray-500">
                Data Peta Kerapatan Petir belum tersedia.
            </h3>
        </div>

        <!-- Loading State Indicator overlay for empty state -->
        <div wire:loading wire:target="selectedYear, selectedMonth" class="w-full py-20 flex items-center justify-center">
            <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    @endif
</div>

@script
<script>
    Alpine.data('mapZoomer', (initialUrl) => ({
        panzoomInstance: null,
        imageUrl: initialUrl,

        init() {
            this.initPanzoom();

            this.$watch('imageUrl', (newVal) => {
                if (this.panzoomInstance) {
                    this.panzoomInstance.reset();
                }
            });

            this.$watch('isFullscreen', (newVal) => {
                setTimeout(() => {
                    if (this.panzoomInstance) {
                        this.panzoomInstance.reset();
                    }
                }, 50);
            });
        },

        initPanzoom() {
            const area = this.$refs.panzoomArea;
            if (!area) return;

            this.panzoomInstance = Panzoom(area, {
                maxScale: 5,
                startScale: 1,
                minScale: 0.1
            });

            area.parentElement.addEventListener('wheel', this.panzoomInstance.zoomWithWheel);
        },

        onImageLoad() {
            this.$nextTick(() => {
                if (this.panzoomInstance) {
                    this.panzoomInstance.reset();
                }
            });
        },

        zoomIn() {
            if (this.panzoomInstance) {
                this.panzoomInstance.zoomIn();
            }
        },

        zoomOut() {
            if (this.panzoomInstance) {
                this.panzoomInstance.zoomOut();
            }
        },

        resetZoom() {
            if (this.panzoomInstance) {
                this.panzoomInstance.reset();
            }
        }
    }));
</script>
@endscript

