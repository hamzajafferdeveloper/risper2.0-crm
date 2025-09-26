<?php

use Illuminate\Support\Facades\Route;

Route::prefix("employee")->middleware('isEmployee')->name("employee.")->group(function () {
    Route::get("/dashboard", function () {
        return view("employee.dashboard");
    })->name("dashboard");
});
