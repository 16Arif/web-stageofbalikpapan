<?php

declare(strict_types=1);

namespace App\View\Components\Ui\Sections;

use App\Models\Berita as ModelBerita;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Berita extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $beritaList = Cache::remember('home_latest_berita', 1800, function () {
            return ModelBerita::query()
                ->published()
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view('components.ui.sections.berita', [
            'beritaList' => $beritaList,
        ]);
    }
}
