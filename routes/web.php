<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\{ Route, Auth};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('employee', EmployeeController::class);