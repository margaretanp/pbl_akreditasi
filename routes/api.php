<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DetailKriteriaController;
use App\Http\Controllers\api\JenisKriteriaController;
use App\Http\Controllers\api\KriteriaController;
use App\Http\Controllers\api\RolesController;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\ValidasiController;
use App\Http\Controllers\DashboardController;
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

//Submit ke Direktur
Route::post('/submit-direktur', [KriteriaController::class, 'submitToDirektur']);

//Tampilkan Status Tiap Isian
Route::get('/detail-kriteria/by-user', [DetailKriteriaController::class, 'byUser']);

// Login tidak perlu middleware
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Authenticated-only routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'currentUser']);

    // Master data & user
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('users', UsersController::class);

    // Kriteria dan relasinya
    Route::apiResource('kriteria', KriteriaController::class);
    Route::apiResource('jenis-kriteria', JenisKriteriaController::class);
    Route::apiResource('detail-kriteria', DetailKriteriaController::class);
    Route::post('/kriteria/{id}/merge', [KriteriaController::class, 'generateMergedPdf']);
    Route::put('/kriteria/{id}/reject', [KriteriaController::class, 'reject']);


    // Validasi oleh validator
    Route::apiResource('validator', ValidasiController::class);
    Route::put('/validator/validate', [ValidasiController::class, 'validasi']);

    // Dashboard routes
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/dashboard/dosen', [DashboardController::class, 'dosenDashboard']);
    // Route::get('/dashboard/kajur', [DashboardController::class, 'kajurDashboard']);
    // Route::get('/dashboard/direktur', [DashboardController::class, 'direkturDashboard']);
});
