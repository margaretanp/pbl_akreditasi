<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth', 'verified', 'role:2'])->group(function () {
// });
Route::get('/validator/{any?}', function () {
    return view('app'); // app.blade.php akan load Vue SPA
})->where('any', '.*');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::prefix('anggota')->middleware(['role:5'])->group(function () {
//         Route::get('/dashboard', function () {
//             return view('Home.Dashboard');
//         });
//     });
// });

Route::get('/{any}', function () {
    return view('welcome');  // This returns your index blade file
})->where('any', '^(?!api).*$');  // This will match all routes except /api

// Route::middleware(['web', 'auth'])->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
// });

// Route::post('/locale', function (Request $request) {
//     $request->validate([
//         'locale' => 'required|in:en,id',
//     ]);

//     Session::put('locale', $request->locale);

//     return response()->json(['locale' => $request->locale]);
// });