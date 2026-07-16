<?php

use App\Http\Controllers\Auth\GuruAuthController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
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
    return redirect('/guru/login');
});

Route::get('/guru/login', [GuruAuthController::class, 'index'])
    ->name('guru.login');

Route::post('/guru/login', [GuruAuthController::class, 'authenticate'])
    ->name('guru.authenticate');

Route::post('/guru/logout', [GuruAuthController::class, 'logout'])
    ->name('guru.logout');

Route::middleware('guru')->group(function () {
    Route::get('/guru', [GuruController::class, 'index']);

    Route::get(
        '/mapel/{mapel}/import',
        [MapelController::class, 'importForm']
    )->name('mapel.import');

    Route::post(
        '/mapel/{mapel}/import',
        [MapelController::class, 'importStore']
    )->name('mapel.import.store');

    Route::resource('mapel', MapelController::class);
});

Route::get('/siswa/login', [SiswaAuthController::class, 'index'])
    ->name('siswa.login');

Route::post('/siswa/login', [SiswaAuthController::class, 'authenticate'])
    ->name('siswa.authenticate');

Route::post('/siswa/logout', [SiswaAuthController::class, 'logout'])
    ->name('siswa.logout');

Route::middleware('siswa')->group(function () {

    Route::get('/siswa', [SiswaController::class, 'index']);
    
});