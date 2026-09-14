<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        {{-- Menggunakan inline style 2rem (32px) agar proporsional tanpa konflik kompilasi Tailwind --}}
        <div style="margin-top: 2rem;">
            <x-filament::button type="submit">
                Perbarui Kata Sandi
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
