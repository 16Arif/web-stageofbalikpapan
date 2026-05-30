<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = null;
        $query = Post::query()
            ->with(['categoryRelation', 'authorRelation'])
            ->latest('published_at');

        if ($request->filled('category')) {
            $selectedCategory = Category::query()->where('slug', $request->string('category'))->first();

            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        return view('pages.posts.index', [
            'posts' => $query->get(),
            'categories' => Category::query()->orderBy('name')->get(),
            'selectedCategory' => $selectedCategory,
            'currentAuthor' => null,
            'pageTitle' => 'Berita & Aktivitas',
            'pageDescription' => 'Liputan kegiatan harian, sosialisasi, dan informasi penting dari Stasiun Geofisika Balikpapan.',
        ]);
    }

    public function show(Post $post)
    {
        $post->load(['categoryRelation', 'authorRelation']);

        return view('pages.posts.show', [
            'post' => $post,
        ]);
    }

    public function byAuthor(Author $author, Request $request)
    {
        $selectedCategory = null;
        $query = Post::query()
            ->with(['categoryRelation', 'authorRelation'])
            ->where('author_id', $author->id)
            ->latest('published_at');

        if ($request->filled('category')) {
            $selectedCategory = Category::query()->where('slug', $request->string('category'))->first();

            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        return view('pages.posts.index', [
            'posts' => $query->get(),
            'categories' => Category::query()->orderBy('name')->get(),
            'selectedCategory' => $selectedCategory,
            'currentAuthor' => $author,
            'pageTitle' => 'Post oleh ' . $author->name,
            'pageDescription' => 'Kumpulan berita dan aktivitas dari penulis yang dipilih.',
        ]);
    }
}
