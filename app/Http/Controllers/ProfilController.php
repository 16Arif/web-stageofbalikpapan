<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ProfilController extends Controller
{
    public function strukturOrganisasi(): View
    {
        $pegawais = Cache::remember(Pegawai::CACHE_KEY, now()->addDay(), function () {
            return Pegawai::query()
                ->active()
                ->hierarchicalOrder()
                ->get()
                ->groupBy('kategori');
        });

        $kupt = $pegawais->get(Pegawai::KATEGORI_KUPT)?->first();
        $tataUsaha = $pegawais->get(Pegawai::KATEGORI_TATA_USAHA, collect());
        $fungsional = $pegawais->get(Pegawai::KATEGORI_FUNGSIONAL, collect());

        return view('pages.profil.struktur-organisasi', compact('kupt', 'tataUsaha', 'fungsional'));
    }
}
