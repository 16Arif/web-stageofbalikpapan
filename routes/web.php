<?php

use App\Http\Controllers\GempaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // File ini ada di resources/views/pages/home.blade.php
    return view('pages.home'); 
})->name('home_page');

// Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::view('/activity', 'pages.activity-news')->name('activity');
Route::get('/borneo-earthquakes', [GempaController::class, 'index'])->name('borneo-earthquakes');
Route::view('/ttm', 'pages.borneo-ttm')->name('ttm');
Route::view('/buletin', 'pages.buletin')->name('buletin');
Route::view('/organization', 'pages.organization')->name('organization');
Route::view('/education-hilal', 'pages.education-hilal')->name('education-hilal');
Route::view('/education-gerhana', 'pages.education-gerhana')->name('education-gerhana');
Route::view('/lightning-kalimantan', 'pages.lightning-kalimantan')->name('lightning-kalimantan');
Route::view('/pelayanan', 'pages.pelayanan')->name('pelayanan');

Route::livewire('/counter', 'livewire.counter');
