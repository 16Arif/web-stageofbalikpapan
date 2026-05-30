<?php

namespace App\View\Components\Ui\Sections;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActivityNews extends Component
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
        $posts = Post::query()
            ->published()
            ->with(['category', 'author'])
            ->latestPublished()
            ->limit(3)
            ->get();

        return view('components.ui.sections.activity-news', [
            'posts' => $posts,
        ]);
    }
}
