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

    public function show(Berita $berita): View
    {
        return view('pages.publikasi.berita.show', [
            'berita' => $berita,
        ]);
    }
}
