<?php

use App\Http\Controllers\AddressClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Platform\HomeController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\ProductController;
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

    Route::prefix('clients')->controller(ClientController::class)->group(function () {
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::get('/{client}', 'get');
        Route::post('/update/{client}', 'update');
        Route::get('/', 'index');
    });

    Route::prefix('address')->controller(AddressClientController::class)->group(function () {
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::get('/get/{address}', 'get');
        Route::post('/update/{address}', 'update');
        Route::get('/{client}', 'index');
    });

    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::get('/{product}', 'get');
        Route::post('/update/{product}', 'update');
        Route::get('/', 'index');
    });

    Route::prefix('prices')->controller(PricesController::class)->group(function () {
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::get('/get/{price}', 'get');
        Route::post('/update/{price}', 'update');
        Route::get('/{client}', 'index');
    });
});
