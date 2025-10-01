<?php

use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LanguageController;
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
        Route::get('/employees-designation', [SettingsController::class, 'employeesDesignation'])->name('employees-designation');
        Route::get('/employment-types', [SettingsController::class, 'employmentTypes'])->name('employment-types');
        Route::get('/departments', [SettingsController::class, 'departments'])->name('departments');
        Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
        Route::get('/lead-source', [SettingsController::class, 'leadSource'])->name('lead-source');
        Route::get('lead-pipline', [SettingsController::class, 'leadPipline'])->name('lead-pipline');
        Route::get('/deal-categories', [SettingsController::class, 'dealCategories'])->name('deal-categories');
        Route::get('/deal-agents', [SettingsController::class, 'dealAgents'])->name('deal-agents');
        Route::get('/employees', [SettingsController::class, 'employees'])->name('employees');

        Route::get('/all-lead-pipline', [LeadController::class, 'allLeadPipline'])->name('lead-pipline.all');
        Route::get('/all-deal-stages-by-piplines', [LeadController::class,'dealStages'])->name('deal-stages.byPipeline');

        Route::prefix('language')->name('languages.')->group(function () {
            Route::post('all', [LanguageController::class, 'store'])->name('store');
        });

        Route::post('store-deal-agents', [DealController::class, 'storeDealAgent'])->name('deal-agents.store');
        Route::post('store-lead-pipline', [LeadController::class, 'storePipline'])->name('lead-pipline.store');
        Route::post('update-default-pipline', [LeadController::class,'updateDefaultPipline'])->name('pipelines.setDefault');
        Route::post('store-deal-stages', [LeadController::class, 'storeDealStage'])->name('deal-stages.store');
        Route::post('update-default-stage', [LeadController::class,'updateDefaultStage'])->name('deal-stages.setDefault');
    });

    Route::prefix('deal-categories')->name('deal-categories.')->group(function () {
        Route::get('all', [DealController::class, 'allCategory'])->name('all');
        Route::post('add', [DealController::class, 'addCategory'])->name('store');
    });

    Route::prefix('lead-source')->name('lead-sources.')->group(function () {
        Route::get('all', [LeadController::class, 'allSource'])->name('all');
        Route::post('add', [LeadController::class, 'addSource'])->name('store');
    });

});
