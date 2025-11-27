<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- BAGIAN 1: DAFTAR IMPORT (Letakkan di Paling Atas) ---
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RecommendationController; // <-- Ini yang barusan kita tambah

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- BAGIAN 2: ROUTE PUBLIK (Bisa diakses tanpa login) ---

// Route Login & Register
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']); // Opsional

// Route AI Rekomendasi (Kita taruh di luar middleware agar mudah dites di browser)
Route::get('/recommendations', [RecommendationController::class, 'index']); 


// --- BAGIAN 3: ROUTE PRIVATE (Harus Login / Punya Token) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Route Produk
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    
    // Route Transaksi
    Route::post('/checkout', [TransactionController::class, 'checkout']);
    
    // Route User Info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});