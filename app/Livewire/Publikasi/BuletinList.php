<?php

declare(strict_types=1);

namespace App\Livewire\Publikasi;

use App\Models\Buletin;
use Illuminate\View\View;
use Livewire\Component;

class BuletinList extends Component
{
    public ?int $selectedYear = null;

    /** @var array<int> */
    public array $availableYears = [];

    public string $search = ''; // Properti baru untuk pencarian

    public function mount(): void
    {
        // Ambil daftar tahun yang tersedia dari database, urutkan dari terbaru
        $this->availableYears = Buletin::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        // Set default tahun ke tahun terbaru jika data tersedia
        if (count($this->availableYears) > 0) {
            $this->selectedYear = $this->availableYears[0];
        }
    }

    public function render(): View
    {
        $buletins = collect();

        if ($this->selectedYear !== null) {
            $query = Buletin::where('tahun', $this->selectedYear);

            // Jika ada input pencarian, filter berdasarkan judul
            if ($this->search !== '') {
                $query->where('title', 'like', '%'.$this->search.'%');
            }

            $buletins = $query->orderBy('bulan', 'desc')->get();
        }

        return view('livewire.publikasi.buletin-list', [
            'buletins' => $buletins,
        ]);
    }
}
