<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Buletin;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BuletinController extends Controller
{
    public function index(): View
    {
        return view('pages.publikasi.buletin');
    }

    public function baca(Buletin $buletin): RedirectResponse
    {
        // Tambah 1 ke kolom views
        $buletin->increment('views');

        // Redirect ke file PDF di storage
        return redirect(asset('storage/'.$buletin->file_path));
    }
}
