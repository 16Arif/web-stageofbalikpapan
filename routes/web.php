<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BuletinController;
use App\Http\Controllers\Frontend\PetaPetirController;
use App\Http\Controllers\GempaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Pelayanan\AuthController as PelayananAuthController;
use App\Livewire\Pelayanan\Auth\Login as PelayananLogin;
use App\Livewire\Pelayanan\Auth\Register as PelayananRegister;
use App\Livewire\Publikasi\BeritaList;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home_page');

Route::prefix('profil')->name('profil.')->group(function () {
    Route::view('/', 'pages.profil.profil')->name('profil');
    Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('organisasi');
});

Route::prefix('gempabumi')->name('gempabumi.')->group(function () {
    Route::get('/terkini', [GempaController::class, 'index'])->name('terkini');
    Route::get('/kalimantan', [GempaController::class, 'kalimantan'])->name('kalimantan');
    Route::view('/seismisitas', 'pages.gempabumi.seismisitas')->name('seismisitas');
    Route::view('/mitigasi', 'pages.gempabumi.mitigasi')->name('mitigasi');
});

Route::prefix('geofisika')->name('geofisika.')->group(function () {
    Route::view('/hilal', 'pages.geofisika.hilal')->name('hilal');
    Route::view('/gerhana', 'pages.geofisika.gerhana')->name('gerhana');
    Route::view('/petir', 'pages.geofisika.petir')->name('petir');
    Route::get('/peta-petir', [PetaPetirController::class, 'index'])->name('peta-petir');
    Route::view('/kerapatan-petir', 'pages.geofisika.kerapatan-petir')->name('kerapatan-petir');
});

Route::get('/peta-petir', [PetaPetirController::class, 'index'])->name('peta-petir.index');

Route::view('/ttm', 'pages.borneo-ttm')->name('ttm');

Route::prefix('publikasi')->name('publikasi.')->group(function () {
    Route::get('/buletin', [BuletinController::class, 'index'])->name('buletin');
});
Route::get('/berita', BeritaList::class)->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/publikasi/buletin/{buletin:slug}/baca', [BuletinController::class, 'baca'])->name('buletin.baca');
Route::view('/pelayanan', 'pages.pelayanan.index')->name('pelayanan');
Route::redirect('/login', '/pelayanan/login')->name('login');

Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
    Route::view('/mekanisme', 'pages.pelayanan.mekanisme')->name('mekanisme');

    Route::middleware('guest:applicant')->group(function () {
        Route::get('/login', PelayananLogin::class)->name('login');
        Route::get('/register', PelayananRegister::class)->name('register');
    });

    Route::post('/logout', [PelayananAuthController::class, 'logout'])->name('logout');
});

Route::get('/sitemap-berita.xml', function () {
    $beritaTerkini = Berita::latest('published_at')->get();

    return response()->view('sitemap', [
        'posts' => $beritaTerkini, // Jika file view sitemap masih menggunakan $posts
    ])->header('Content-Type', 'text/xml');
})->name('sitemap.berita');

