<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\JenisKriteriaController;
use App\Http\Controllers\api\KriteriaController;
use App\Http\Controllers\api\RolesController;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\KomentarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('roles', RolesController::class);
    Route::apiResource('users', UsersController::class);
    Route::apiResource('kriteria', KriteriaController::class);
    Route::apiResource('jenis-kriteria', JenisKriteriaController::class);
    Route::apiResource('komentar', KomentarController::class);    
});
