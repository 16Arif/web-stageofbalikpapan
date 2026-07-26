<x-layouts.app>
    <x-slot:title>Buletin Geofisika PGR XI - Stageof Balikpapan</x-slot:title>

    <section class="relative isolate overflow-hidden bg-slate-950 py-16 md:py-24">
        <x-ui.decoration.blur-bg position="top" color="from-indigo-500/20 to-sky-500/20" />

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-sm mb-4">Publikasi Berkala</h2>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Buletin <span class="text-indigo-500">PGR XI</span></h1>
            <p class="mt-6 text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Kumpulan informasi aktivitas gempabumi dan petir di wilayah Pusat Gempa Regional XI yang diterbitkan secara berkala setiap bulan.
            </p>
        </div>
    </section>

    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <livewire:publikasi.buletin-list />
        </div>
    </section>
</x-layouts.app>
