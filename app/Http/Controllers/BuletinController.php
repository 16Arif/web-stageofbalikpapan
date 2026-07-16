<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Buletin;
use Illuminate\View\View;

class BuletinController extends Controller
{
    public function index(): View
    {
        $buletins = Buletin::latest('published_at')->get();

        return view('pages.publikasi.buletin', [
            'buletins' => $buletins
        ]);
    }
}
