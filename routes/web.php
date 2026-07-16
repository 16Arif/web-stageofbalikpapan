<?php

use App\Http\Controllers\GempaController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home_page');

Route::view('/profil', 'pages.profil')->name('profil');

Route::get('/activity', [PostController::class, 'index'])->name('activity');
Route::get('/activity/author/{author:slug}', [PostController::class, 'byAuthor'])->name('posts.by-author');
Route::get('/activity/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/borneo-earthquakes', [GempaController::class, 'index'])->name('borneo-earthquakes');
Route::view('/ttm', 'pages.borneo-ttm')->name('ttm');
Route::view('/buletin', 'pages.buletin')->name('buletin');
Route::view('/struktur-organisasi', 'pages.struktur-organisasi')->name('struktur-organisasi');
Route::view('/geofisika/hilal', 'pages.geofisika.hilal')->name('geofisika.hilal');
Route::view('/geofisika/gerhana', 'pages.geofisika.gerhana')->name('geofisika.gerhana');
Route::view('/geofisika/petir', 'pages.geofisika.petir')->name('geofisika.petir');
Route::view('/geofisika/peta-petir', 'pages.geofisika.peta-petir')->name('geofisika.peta-petir');
Route::view('/geofisika/kerapatan-petir', 'pages.geofisika.kerapatan-petir')->name('geofisika.kerapatan-petir');
Route::view('/pelayanan', 'pages.pelayanan')->name('pelayanan');

Route::get('/sitemap-posts.xml', function () {
    $posts = Post::published()->latestPublished()->get();

    return response()->view('sitemap', [
        'posts' => $posts,
    ])->header('Content-Type', 'text/xml');
})->name('sitemap.posts');

Route::livewire('/counter', 'livewire.counter');
