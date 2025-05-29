<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/chatbot', function () {
    return view('chatbot');
})->name('chatbot');

Route::get('/tambahObat', function () {
    return view('tambahObat');
})->name('tambahObat');

Route::get('/riwayat', function () {
    return view('riwayat');
})->name('riwayat');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');