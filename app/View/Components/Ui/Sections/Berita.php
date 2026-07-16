<?php

namespace App\View\Components\Ui\Sections;

use App\Models\Berita as ModelBerita;
use Closure;
use Illuminate\Contracts\View\View;
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
        $beritaList = ModelBerita::latest('published_at')->take(3)->get();

        return view('components.ui.sections.berita', [
            'beritaList' => $beritaList,
        ]);
    }
}
