@assets
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
@endassets

<div>
    <!-- Breadcrumb Minimalis -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-8 pb-4 mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-700">
            <li>
                <a href="/" class="hover:text-blue-600 hover:underline transition-colors">Home</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="hover:text-blue-600 hover:underline transition-colors cursor-pointer">Geofisika</span>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="h-4 w-4 flex-shrink-0 text-gray-400 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-900 font-medium">Kerapatan Petir</span>
                </div>
            </li>
        </ol>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-6xl mx-auto px-6 lg:px-8 pb-12 space-y-6">
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

    <!-- Map Container (Static) -->
    @if ($this->activeMap && $this->activeMap->map_image_url)
        <div class="relative max-w-5xl mx-auto w-full">
            <div 
                wire:key="map-container-{{ $this->activeMap->id }}"
                x-data="lightboxViewer()"
                class="relative overflow-hidden w-full bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center p-4"
            >
                <a 
                    href="{{ $this->activeMap->map_image_url }}" 
                    class="glightbox w-full flex justify-center" 
                    data-title="Peta Kerapatan Petir - {{ $this->activeMap->periode_bulan_tahun }}"
                >
                    <img 
                        src="{{ $this->activeMap->map_image_url }}" 
                        alt="Peta Kerapatan Petir - {{ $this->activeMap->periode_bulan_tahun }}" 
                        draggable="false"
                        oncontextmenu="return false;"
                        class="max-w-full h-auto object-contain select-none shadow-sm rounded hover:opacity-90 transition-opacity cursor-pointer"
                    >
                </a>

                <!-- Loading State Indicator overlay inside the map container -->
                <div wire:loading wire:target="selectedYear, selectedMonth" class="absolute inset-0 bg-white/60 backdrop-blur-[1px] flex items-center justify-center z-20 rounded-lg">
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
</div>

@script
<script>
    Alpine.data('lightboxViewer', () => ({
        lightbox: null,
        init() {
            this.$nextTick(() => {
                this.lightbox = GLightbox({
                    selector: '.glightbox',
                    zoomable: true,
                    touchNavigation: true,
                    closeButton: true,
                    descPosition: 'bottom'
                });
            });

            // Bersihkan instance saat re-render Livewire
            this.$cleanup(() => {
                if (this.lightbox) {
                    this.lightbox.destroy();
                }
            });
        }
    }));
</script>
@endscript
