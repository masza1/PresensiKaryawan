<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ],function () {
//     Route::post('login',[AuthController::class , 'login']);
//     Route::post('logout',[AuthController::class , 'logout']);
//     Route::post('refresh',[AuthController::class , 'refresh']);
//     Route::post('me',[AuthController::class , 'me']);
// });

Route::get('/attendances', [ApiController::class, 'index']);
