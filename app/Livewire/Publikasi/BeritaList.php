<?php

declare(strict_types=1);

namespace App\Livewire\Publikasi;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BeritaList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $beritas = Berita::query()
            ->where('is_publish', true)
            ->when($this->search !== '', function (Builder $query): void {
                $query->where(function (Builder $q): void {
                    $q->where('judul', 'like', '%'.$this->search.'%')
                        ->orWhere('konten', 'like', '%'.$this->search.'%');
                });
            })
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.publikasi.berita-list', [
            'beritas' => $beritas,
        ])->layout('components.layouts.app')
            ->title('Berita Terkini - Stageof Balikpapan');
    }
}
