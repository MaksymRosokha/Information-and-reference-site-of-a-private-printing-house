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
Route::get('/service/{id}/search={text}', [\App\Http\Controllers\ServiceController::class, 'search'])
    ->name('searchServices');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogIn'])->name('login');

Route::get('/post-page={page}', [\App\Http\Controllers\MainController::class, 'showAnotherPostsPage'])
    ->name('showAnotherPostsPage');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'showAdminPage'])->name('admin');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'doLogOut'])->name('logout');

    Route::post('/create_service', [\App\Http\Controllers\AdminController::class, 'createService'])
        ->name('create_service');
    Route::post('/update_service', [\App\Http\Controllers\AdminController::class, 'updateService'])
        ->name('update_service');
    Route::post('/delete_service', [\App\Http\Controllers\AdminController::class, 'deleteService'])
        ->name('delete_service');

    Route::post('/create_product', [\App\Http\Controllers\AdminController::class, 'createProduct'])
        ->name('create_product');
    Route::post('/update_product', [\App\Http\Controllers\AdminController::class, 'updateProduct'])
        ->name('update_product');
    Route::post('/delete_product', [\App\Http\Controllers\AdminController::class, 'deleteProduct'])
        ->name('delete_product');

    Route::post('/create_post', [\App\Http\Controllers\AdminController::class, 'createPost'])
        ->name('create_post');
    Route::post('/update_post', [\App\Http\Controllers\AdminController::class, 'updatePost'])
        ->name('update_post');
    Route::post('/delete_post', [\App\Http\Controllers\AdminController::class, 'deletePost'])
        ->name('delete_post');
});