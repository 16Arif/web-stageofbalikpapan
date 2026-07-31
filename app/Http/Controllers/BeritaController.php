<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritaList = Berita::latest('published_at')->paginate(9);

        return view('pages.publikasi.berita.index', [
            'beritaList' => $beritaList,
        ]);
    }

    public function show(string $slug): View
    {
        $berita = Berita::where('slug', $slug)->where('is_publish', true)->firstOrFail();
        $berita->incrementViews();

        $beritaLainnya = Berita::where('id', '!=', $berita->id)
            ->where('is_publish', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.publikasi.berita.show', [
            'berita' => $berita,
            'beritaLainnya' => $beritaLainnya,
        ]);
    }
}
