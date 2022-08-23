<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [AuthController::class, 'index'])->name('login.get');
Route::post('/', [AuthController::class, 'checkLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register.get');
Route::post('registration', [AuthController::class, 'checkRegistration'])->name('register.post');

Route::group(['middleware' => 'admin'], function () {
    Route::get('manage', [AuthController::class, 'manage']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

//Route::group(['middleware' => 'user'], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//});
