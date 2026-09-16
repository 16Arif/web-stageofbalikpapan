<?php

declare(strict_types=1);

namespace App\View\Components\Ui\Sections;

use App\Models\GempaKalimantan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class KalimantanEarthquake extends Component
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
        $cached = Cache::remember(GempaKalimantan::CACHE_KEY, 300, function () {
            return GempaKalimantan::query()
                ->active()
                ->latestEvent()
                ->take(5)
                ->get();
        });

        $gempa = $cached instanceof Collection ? $cached->first() : null;

        if (! $gempa) {
            $gempa = GempaKalimantan::query()
                ->active()
                ->latestEvent()
                ->first();
        }

        return view('components.ui.sections.kalimantan-earthquake', [
            'gempa' => $gempa,
        ]);
    }
}
