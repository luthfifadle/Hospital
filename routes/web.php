<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\rumahsakitController;
use App\Http\Controllers\pasienController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('/login-auth', [mainController::class, 'loginAuth']);

Route::post('/rumah-sakit/delete', [rumahsakitController::class, 'delete']);
Route::resource('rumah-sakit', rumahsakitController::class);

Route::post('/pasien/delete', [pasienController::class, 'delete']);
Route::resource('pasien', pasienController::class);
