<?php

use App\Http\Controllers\AddressClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Platform\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('user')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });

    Route::prefix('client')->controller(ContactController::class)->group(function () {
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::get('/{id}', 'get');
        Route::post('/update/{id}', 'update');
        Route::get('/', 'index');
    });

    Route::prefix('address')->controller(AddressClientController::class)->group(function () {
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::get('/{id}', 'get');
        Route::post('/update/{id}', 'update');
        Route::get('/', 'index');
    });
});
