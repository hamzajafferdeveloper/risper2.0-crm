<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('isAdmin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('show');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/company-settings', [SettingsController::class, 'index'])->name('index');
        Route::get('/business-address', [SettingsController::class, 'businessAddress'])->name('business-address');
    });

});
