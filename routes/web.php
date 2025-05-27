<?php

use Illuminate\Support\Facades\Route;

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