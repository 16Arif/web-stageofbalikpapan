<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BuletinController;
use App\Http\Controllers\GempaController;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home_page');

Route::prefix('profil')->name('profil.')->group(function () {
    Route::view('/', 'pages.profil.profil')->name('profil');
    Route::view('/struktur-organisasi', 'pages.profil.struktur-organisasi')->name('organisasi');
});

Route::prefix('gempabumi')->name('gempabumi.')->group(function () {
    Route::get('/terkini', [GempaController::class, 'index'])->name('terkini');
    Route::view('/kalimantan', 'pages.gempabumi.kalimantan')->name('kalimantan');
    Route::view('/seismisitas', 'pages.gempabumi.seismisitas')->name('seismisitas');
    Route::view('/mitigasi', 'pages.gempabumi.mitigasi')->name('mitigasi');
});

Route::prefix('geofisika')->name('geofisika.')->group(function () {
    Route::view('/hilal', 'pages.geofisika.hilal')->name('hilal');
    Route::view('/gerhana', 'pages.geofisika.gerhana')->name('gerhana');
    Route::view('/petir', 'pages.geofisika.petir')->name('petir');
    Route::view('/peta-petir', 'pages.geofisika.peta-petir')->name('peta-petir');
    Route::view('/kerapatan-petir', 'pages.geofisika.kerapatan-petir')->name('kerapatan-petir');
});


Route::view('/ttm', 'pages.borneo-ttm')->name('ttm');

Route::prefix('publikasi')->name('publikasi.')->group(function () {
    Route::get('/buletin', [BuletinController::class, 'index'])->name('buletin');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{berita:slug}', [BeritaController::class, 'show'])->name('berita.show');
});
Route::view('/pelayanan', 'pages.pelayanan')->name('pelayanan');

Route::get('/sitemap-berita.xml', function () {
    $beritaTerkini = App\Models\Berita::latest('published_at')->get();

    return response()->view('sitemap', [
        'posts' => $beritaTerkini, // Jika file view sitemap masih menggunakan $posts
    ])->header('Content-Type', 'text/xml');
})->name('sitemap.berita');

Route::livewire('/counter', 'livewire.counter');
