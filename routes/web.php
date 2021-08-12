<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\{ Route, Auth};


Auth::routes();




Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::view('/employee/create', 'createKaryawan');
    Route::post('/employee/store', [EmployeeController::class, 'create']);
    Route::get('/employee/{id}', [EmployeeController::class, 'show']);
    Route::post('/employee/{id}/update', [EmployeeController::class, 'updates']);
    Route::delete('/employee/delete', [EmployeeController::class, 'delete']);
    Route::get('/attendances', [AttendanceController::class, 'index']);
    Route::view('/attendances/create', 'createKaryawan');
    Route::post('/attendances/store', [AttendanceController::class, 'store']);
    Route::delete('/attendances/delete', [AttendanceController::class, 'delete']);
    Route::get('/overtime',[OvertimeController::class, 'index']);
    Route::post('/overtime/create',[OvertimeController::class, 'create']);
    Route::post('/overtime/update', [OvertimeController::class, 'update']);
    Route::delete('/overtime/delete', [OvertimeController::class, 'delete']);
    Route::post('/payroll/{work_date}', [SalaryController::class, 'store']);
    Route::get('/payroll/print-pdf/{id}', [SalaryController::class, 'print']);
});

Route::middleware(['auth','role:Staff|Supervisor'])->group(function () {
    Route::get('/payroll', [SalaryController::class, 'index'])->middleware(['auth', 'role:Staff|Supervisor']);
});


Route::middleware(['auth', 'role:Supervisor'])->group(function () {
    Route::patch('/payroll/{id}',[SalaryController::class, 'update']);
});