<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pelayanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Logout pengguna dari sesi customer.
     */
    public function logout(Request $request): RedirectResponse
    {
        if (Auth::guard('applicant')->check()) {
            Auth::guard('applicant')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pelayanan')->with('status', 'Anda telah berhasil keluar dari akun pemohon.');
    }
}
