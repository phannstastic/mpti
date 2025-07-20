<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController; // <-- Tambahkan ini

Route::post('/orders', [OrderController::class, 'store']); // <-- Tambahkan ini

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});