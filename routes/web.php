<?php

use App\Http\Controllers\GempaController;
use App\Http\Controllers\PostController;
use App\Models\Post;
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

Route::get('/activity', [PostController::class, 'index'])->name('activity');
Route::get('/activity/author/{author:slug}', [PostController::class, 'byAuthor'])->name('posts.by-author');
Route::get('/activity/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::view('/ttm', 'pages.borneo-ttm')->name('ttm');
Route::view('/buletin', 'pages.buletin')->name('buletin');
Route::view('/pelayanan', 'pages.pelayanan')->name('pelayanan');

Route::get('/sitemap-posts.xml', function () {
    $posts = Post::published()->latestPublished()->get();

    return response()->view('sitemap', [
        'posts' => $posts,
    ])->header('Content-Type', 'text/xml');
})->name('sitemap.posts');

Route::livewire('/counter', 'livewire.counter');
