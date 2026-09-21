<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;

class AuthenticateApplicant extends FilamentAuthenticate
{
    /**
     * Tentukan URL pengalihan ketika pemohon belum terautentikasi.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function redirectTo($request): ?string
    {
        return route('pelayanan.login');
    }
}
