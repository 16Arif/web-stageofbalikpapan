<?php

declare(strict_types=1);

namespace App\Livewire\Component\Geofisika;

use App\Models\PetaKerapatanPetir;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class KerapatanPetirViewer extends Component
{
    public string $selectedYear = '';

    public string $selectedMonth = '';

    public function mount(): void
    {
        $latestMap = PetaKerapatanPetir::where('is_active', true)
            ->orderBy('periode', 'desc')
            ->first();

        if ($latestMap) {
            $this->selectedYear = $latestMap->periode->format('Y');
            $this->selectedMonth = $latestMap->periode->format('m');
        } else {
            $this->selectedYear = now()->format('Y');
            $this->selectedMonth = now()->format('m');
        }
    }

    public function updatedSelectedYear(string $value): void
    {
        unset($this->availableMonths, $this->activeMap);

        $months = $this->availableMonths;
        if (! empty($months)) {
            $monthValues = array_column($months, 'value');
            if (! in_array($this->selectedMonth, $monthValues, true)) {
                $this->selectedMonth = $months[0]['value'];
            }
        } else {
            $this->selectedMonth = '';
        }
    }

    public function updatedSelectedMonth(string $value): void
    {
        unset($this->activeMap);
    }

    #[Computed]
    public function availableYears(): array
    {
        return PetaKerapatanPetir::where('is_active', true)
            ->orderBy('periode', 'desc')
            ->get()
            ->map(fn ($map) => (string) $map->periode->format('Y'))
            ->unique()
            ->values()
            ->toArray();
    }

    #[Computed]
    public function availableMonths(): array
    {
        if (! $this->selectedYear) {
            return [];
        }

        return PetaKerapatanPetir::where('is_active', true)
            ->whereYear('periode', (int) $this->selectedYear)
            ->orderBy('periode', 'desc')
            ->get()
            ->map(fn ($map) => [
                'value' => $map->periode->format('m'),
                'label' => $map->periode->translatedFormat('F'),
            ])
            ->unique('value')
            ->values()
            ->toArray();
    }

    #[Computed]
    public function activeMap(): ?PetaKerapatanPetir
    {
        if ($this->selectedYear && $this->selectedMonth) {
            $map = PetaKerapatanPetir::where('is_active', true)
                ->whereYear('periode', (int) $this->selectedYear)
                ->whereMonth('periode', (int) $this->selectedMonth)
                ->first();

            if ($map) {
                return $map;
            }
        }

        return PetaKerapatanPetir::where('is_active', true)
            ->orderBy('periode', 'desc')
            ->first();
    }

    public function render(): View
    {
        return view('livewire.component.geofisika.kerapatan-petir-viewer');
    }
}
