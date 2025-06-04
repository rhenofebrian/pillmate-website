<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\ObatApiController;
use App\Http\Controllers\ChatbotApiController;

// Auth API
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout']);

// Profil
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthApiController::class, 'showProfile']);
    Route::put('/profile', [AuthApiController::class, 'updateProfile']);

    // Obat (sama dengan fitur tambah-obat dan riwayat)
    Route::get('/obat', [ObatApiController::class, 'index']); // Lihat daftar obat
    Route::post('/obat', [ObatApiController::class, 'store']); // Tambah obat
    Route::put('/obat/{id}', [ObatApiController::class, 'update']); // Edit
    Route::delete('/obat/{id}', [ObatApiController::class, 'destroy']); // Hapus

    // Chatbot
    Route::get('/chatbot', [ChatbotApiController::class, 'index']); // Riwayat/chat awal
    Route::post('/chatbot/send', [ChatbotApiController::class, 'sendMessage']);
});
