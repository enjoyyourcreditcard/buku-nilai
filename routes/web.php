<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GuruAuthController;
use App\Http\Controllers\GuruController;

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

});