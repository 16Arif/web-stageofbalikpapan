<?php

use App\Http\Controllers\GempaController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home_page');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/activity', [PostController::class, 'index'])->name('activity');
Route::get('/activity/author/{author:slug}', [PostController::class, 'byAuthor'])->name('posts.by-author');
Route::get('/activity/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/borneo-earthquakes', [GempaController::class, 'index'])->name('borneo-earthquakes');
Route::view('/ttm', 'pages.borneo-ttm')->name('ttm');
Route::view('/buletin', 'pages.buletin')->name('buletin');
Route::view('/organization', 'pages.organization')->name('organization');
Route::view('/education-hilal', 'pages.education-hilal')->name('education-hilal');
Route::view('/education-gerhana', 'pages.education-gerhana')->name('education-gerhana');
Route::view('/lightning-kalimantan', 'pages.lightning-kalimantan')->name('lightning-kalimantan');
Route::view('/pelayanan', 'pages.pelayanan')->name('pelayanan');

Route::livewire('/counter', 'livewire.counter');
