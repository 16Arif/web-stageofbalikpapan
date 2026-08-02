<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PetaPetirController extends Controller
{
    public function index(): View
    {
        return view('pages.geofisika.peta-petir');
    }
}
