<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()
            ->published()
            ->with(['category', 'author', 'categoryRelation', 'authorRelation'])
            ->latestPublished();

        $selectedCategory = $this->applyCategoryFilter($query, $request);

        return view('pages.posts.index', [
            'posts' => $query->paginate(9)->withQueryString(),
            'categories' => Category::query()->orderBy('name')->get(),
            'selectedCategory' => $selectedCategory,
            'currentAuthor' => null,
            'pageTitle' => 'Berita & Aktivitas',
            'pageDescription' => 'Liputan kegiatan harian, sosialisasi, dan informasi penting dari Stasiun Geofisika Balikpapan.',
            'metaTitle' => 'Berita & Aktivitas - Stageof Balikpapan',
            'metaDescription' => 'Liputan kegiatan harian, sosialisasi, dan informasi penting dari Stasiun Geofisika Balikpapan.',
            'canonicalUrl' => route('activity'),
        ]);
    }

    public function show(Post $post)
    {
        abort_unless($post->isPublished(), 404);

        $post->load(['category', 'author', 'categoryRelation', 'authorRelation']);

        $relatedPosts = Post::query()
            ->published()
            ->with(['category', 'author', 'categoryRelation', 'authorRelation'])
            ->when(
                $post->category_id,
                fn (Builder $query) => $query->where('category_id', $post->category_id),
                fn (Builder $query) => $query->whereRaw('1 = 0'),
            )
            ->whereKeyNot($post->getKey())
            ->latestPublished()
            ->limit(3)
            ->get();

        return view('pages.posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'metaTitle' => ($post->meta_title ?: $post->title) . ' - Stageof Balikpapan',
            'metaDescription' => $post->meta_description ?: $post->excerpt,
            'canonicalUrl' => route('posts.show', $post),
            'metaImage' => $post->image_url,
        ]);
    }

    public function byAuthor(Author $author, Request $request)
    {
        $query = Post::query()
            ->published()
            ->with(['category', 'author', 'categoryRelation', 'authorRelation'])
            ->forAuthor($author)
            ->latestPublished();

        $selectedCategory = $this->applyCategoryFilter($query, $request);

        return view('pages.posts.index', [
            'posts' => $query->paginate(9)->withQueryString(),
            'categories' => Category::query()->orderBy('name')->get(),
            'selectedCategory' => $selectedCategory,
            'currentAuthor' => $author,
            'pageTitle' => 'Post oleh ' . $author->name,
            'pageDescription' => 'Kumpulan berita dan aktivitas dari penulis yang dipilih.',
            'metaTitle' => 'Post oleh ' . $author->name . ' - Stageof Balikpapan',
            'metaDescription' => 'Kumpulan berita dan aktivitas dari ' . $author->name . ' di Stasiun Geofisika Balikpapan.',
            'canonicalUrl' => route('posts.by-author', $author),
        ]);
    }

    private function applyCategoryFilter(Builder $query, Request $request): ?Category
    {
        $categorySlug = $request->query('category');

        if (! is_string($categorySlug) || blank($categorySlug)) {
            return null;
        }

        $selectedCategory = Category::query()
            ->where('slug', $categorySlug)
            ->first();

        if (! $selectedCategory) {
            $query->whereRaw('1 = 0');

            return null;
        }

        $query->forCategory($selectedCategory);

        return $selectedCategory;
    }
}
