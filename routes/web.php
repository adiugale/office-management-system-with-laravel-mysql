<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect()->route('companies.index');
});

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);