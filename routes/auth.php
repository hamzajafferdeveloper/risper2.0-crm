<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('isGuest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});
