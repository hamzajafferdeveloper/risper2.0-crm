<?php

use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeadController;
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

    Route::prefix('leads')->name('leads.')->group(function () {
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::post('/store', [LeadController::class, 'store'])->name('store');
        Route::get('/{id}', [LeadController::class, 'show'])->name('show');
        Route::put('/{id}', [LeadController::class, 'update'])->name('update');
        Route::delete('/{id}', [LeadController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('deals')->name('deals.')->group(function () {
        Route::get('/', [DealController::class, 'index'])->name('index');
        Route::post('/store', [DealController::class, 'store'])->name('store');
        Route::get('/{id}', [DealController::class, 'show'])->name('show');
        Route::put('/{id}', [DealController::class, 'update'])->name('update');
        Route::delete('/{id}', [DealController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/company-settings', [SettingsController::class, 'index'])->name('index');
        Route::get('/business-address', [SettingsController::class, 'businessAddress'])->name('business-address');
        Route::get('/languages', [SettingsController::class, 'languages'])->name('languages');
        Route::get('/employees-designation', [SettingsController::class,'employeesDesignation'])->name('employees-designation');
        Route::get('/employment-types', [SettingsController::class, 'employmentTypes'])->name('employment-types');
        Route::get('/departments', [SettingsController::class, 'departments'])->name('departments');
        Route::get('/leads', [SettingsController::class, 'leads'])->name('leads');
    });

});
