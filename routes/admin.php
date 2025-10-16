<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BusinessAddressController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DealController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeDesignationController;
use App\Http\Controllers\Admin\EmploymentTypeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('employee/get-dropdown-data', [EmployeeController::class, 'getEditDropdown'])->name('employee.get-dropdown');


Route::prefix('admin')->middleware('isAdmin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name(name: 'show');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('index');
        Route::post('/store', [ClientController::class, 'store'])->name('store');
        Route::get('/{id}', [ClientController::class, 'show'])->name(name: 'show');
        Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ClientController::class, 'update'])->name('update');
        Route::delete('/{id}', [ClientController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('leads')->name('leads.')->group(function () {
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::get('/{id}', [LeadController::class, 'show'])->name(name: 'show');
        Route::post('/store', [LeadController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LeadController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LeadController::class, 'update'])->name('update');
        Route::delete('/{id}', [LeadController::class, 'destroy'])->name('destroy');
        Route::post('/update-stage', [LeadController::class, 'updateDealStage'])->name('updateStage');

    });

    Route::prefix('deals')->name('deals.')->group(function () {
        // Route::get('/', [DealController::class, 'index'])->name('index');
        Route::post('/store', [DealController::class, 'store'])->name('store');
        Route::get('/{id}', [DealController::class, 'show'])->name('show');
        Route::put('/{id}', [DealController::class, 'update'])->name('update');
        Route::delete('/{id}', [DealController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/company-settings', [SettingsController::class, 'index'])->name('index');
        Route::get('/business-address', [SettingsController::class, 'businessAddress'])->name('business-address');
        Route::get('/employees-designation', [SettingsController::class, 'employeesDesignation'])->name('employees-designation');
        Route::get('/employment-types', [SettingsController::class, 'employmentTypes'])->name(name: 'employment-types');
        Route::get('/departments', [SettingsController::class, 'departments'])->name('departments');
        Route::get('/leads', [SettingsController::class, 'leads'])->name('leads');
        Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
        Route::get('/lead-pipline', [SettingsController::class, 'leadPipline'])->name('lead-pipline');
        Route::get('/employees', [SettingsController::class, 'employees'])->name('employees');

        Route::get('/all-lead-pipline', [LeadController::class, 'allLeadPipline'])->name('lead-pipline.all');
        Route::get('/all-deal-stages-by-piplines', [LeadController::class, 'dealStages'])->name('deal-stages.byPipeline');

        Route::prefix('deal-agents')->group(function () {
            Route::get('/', [DealController::class, 'dealAgents'])->name('deal-agents');
            Route::get('/{id}/edit', [DealController::class, 'editdealAgent']);
            Route::put('/{id}', [DealController::class, 'updateDealAgent'])->name('deal-agents.update');
            Route::delete('/{id}', [DealController::class, 'deleteDealAgent'])->name('deal-agents.delete');
        });



        Route::prefix('language')->name('languages.')->group(function () {
            Route::post('all', [LanguageController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [LanguageController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LanguageController::class, 'update'])->name('destroy');
            Route::delete('/{id}', [LanguageController::class, 'destroy'])->name('destroy');
        });

        Route::post('/store-deal-agents', [DealController::class, 'storeDealAgent'])->name('deal-agents.store');
        Route::post('/store-lead-pipline', [LeadController::class, 'storePipline'])->name('lead-pipline.store');
        Route::post('/update-default-pipline', [LeadController::class, 'updateDefaultPipline'])->name('pipelines.setDefault');
        Route::post('/update-default-stage', [LeadController::class, 'updateDefaultStage'])->name('deal-stages.setDefault');
    });

    Route::prefix('deal-categories')->name('deal-categories.')->group(function () {
        Route::get('/all', [DealController::class, 'allCategory'])->name('all');
        Route::post('/add', [DealController::class, 'addCategory'])->name('store');
        Route::put('/{id}', [DealController::class, 'updateCategory'])->name('update');
        Route::delete('/{id}', [DealController::class, 'deleteCategory'])->name('delete');
    });

    Route::prefix('deal-stages')->name('deal-stages.')->group(function () {
        Route::get('/', [DealController::class, 'dealStage'])->name('all');
        Route::get('/{id}/edit', [DealController::class, 'editDealStage']);
        Route::post('/store', [LeadController::class, 'storeDealStage'])->name('store');
        Route::put('/{id}', [LeadController::class, 'updateStage'])->name('update');
        Route::delete('/{id}', [LeadController::class, 'deleteDealStage'])->name('delete');

    });

    Route::prefix('lead-source')->name('lead-sources.')->group(function () {
        Route::get('/all', [LeadController::class, 'allSource'])->name('all');
        Route::post('/add', [LeadController::class, 'addSource'])->name('store');
        Route::put('/{id}', [LeadController::class, 'updateSource'])->name('update');
        Route::delete('/{id}', [LeadController::class, 'deleteSource'])->name('delete');

    });

    Route::prefix('departments')->name('departments.')->group(function () {
        Route::post('/add', [DepartmentController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/{id}', [DepartmentController::class, 'destroy'])->name('delete');
    });

    Route::prefix('employee-designations')->name('employee-designations.')->group(function () {
        Route::post('/add', [EmployeeDesignationController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EmployeeDesignationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EmployeeDesignationController::class, 'update'])->name('update');
        Route::delete('/{id}', [EmployeeDesignationController::class, 'destroy'])->name('delete');
    });

    Route::prefix('employment-types')->name('employment-types.')->group(function () {
        Route::post('/add', [EmploymentTypeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EmploymentTypeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EmploymentTypeController::class, 'update'])->name('update');
        Route::delete('/{id}', [EmploymentTypeController::class, 'destroy'])->name('delete');
    });

    Route::prefix('business-addresses')->name('business-addresses.')->group(function () {
        Route::post('/add', [BusinessAddressController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BusinessAddressController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BusinessAddressController::class, 'update'])->name('update');
        Route::delete('/{id}', [BusinessAddressController::class, 'destroy'])->name('delete');
    });

    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::post('/add', [BannerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}', [BannerController::class, 'destroy'])->name('delete');
    });



    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::post('/add', [ProjectController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('delete');
    });

});
