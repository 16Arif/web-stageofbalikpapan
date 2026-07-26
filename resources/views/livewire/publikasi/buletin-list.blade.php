<div>
    <!-- Kontrol Atas: Filter Tahun & Kolom Pencarian -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        
        <!-- Filter Tahun (Pills/Tabs) -->
        <div class="flex flex-wrap gap-2">
            @foreach($availableYears as $year)
                <button 
                    wire:click="$set('selectedYear', {{ $year }})"
                    class="px-4 py-2 rounded-full font-semibold transition duration-200 ease-in-out
                    {{ $selectedYear === $year ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                >
                    {{ $year }}
                </button>
            @endforeach
        </div>

        <!-- Kolom Pencarian -->
        <div class="w-full md:w-72 relative">
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari judul buletin..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm"
            >
            <!-- Ikon Kaca Pembesar -->
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        
    </div>

    <!-- Loading State Indicator -->
    <div wire:loading wire:target="selectedYear, search" class="w-full text-center py-8">
        <span class="text-gray-500 font-medium animate-pulse">Memuat data...</span>
    </div>

    <!-- Grid Card Buletin -->
    <div wire:loading.remove wire:target="selectedYear, search">
        @if($buletins->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($buletins as $buletin)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 leading-snug">
                            {{ $buletin->title }}
                        </h3>
                        
                        <a href="{{ route('buletin.baca', $buletin->slug) }}" target="_blank" 
                           class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka File
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center text-gray-500">
                @if(!empty($search))
                    Tidak ada buletin yang cocok dengan pencarian "<strong>{{ $search }}</strong>" pada tahun {{ $selectedYear }}.
                @else
                    Belum ada buletin untuk tahun {{ $selectedYear }}.
                @endif
            </div>
        @endif
    </div>
</div>
