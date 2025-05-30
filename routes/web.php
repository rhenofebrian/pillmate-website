<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ObatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


// Form register & login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Submit form register & login
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
    Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');

    Route::get('/tambah-obat', [ObatController::class, 'index'])->name('tambah-obat');
    Route::post('/tambah-obat', [ObatController::class, 'store']) ->name('tambah-obat.store');
    Route::get('/riwayat', [ObatController::class, 'addedItem'])->name('riwayat');
    Route::post('/riwayat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/riwayat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');    

   
    Route::get('/profil', [AuthController::class, 'showProfile'])->name('profile');
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::put('/profil', [AuthController::class, 'updateProfile'])->name('profile.update');
    // Route::get('/profil/edit', [AuthController::class, 'edit'])->name('profil.edit');
});
