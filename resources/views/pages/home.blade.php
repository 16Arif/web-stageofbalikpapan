<x-layouts.app>
    <x-slot:title>BMKG - Stasiun Geofisika Balikpapan</x-slot:title>
    <x-ui.sections.hero />
    <x-ui.sections.kalimantan-earthquake />
    @livewire('geofisika.cuaca-kalimantan')
    @livewire('geofisika.media-section')

    <x-ui.sections.activity-news />
    <x-ui.sections.partners />
</x-layouts.app>
