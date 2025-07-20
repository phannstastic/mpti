<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\HomeController;

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'showMenuPage'])->name('menu.page');
Route::get('/galeri', [HomeController::class, 'showGalleryPage'])->name('gallery.page');