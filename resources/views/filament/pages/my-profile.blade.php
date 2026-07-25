<x-filament-panels::page>
    {{-- Menggunakan tag form standar agar tidak ada eror komponen --}}
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
