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

Route::get('/', [\App\Http\Controllers\MainController::class, 'showMainPage'])->name('main');

Route::get('/service/{id}', [\App\Http\Controllers\ServiceController::class, 'showServicePage'])->name('service');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogIn'])->name('login');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'showAdminPage'])->name('admin');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'doLogOut'])->name('logout');
});