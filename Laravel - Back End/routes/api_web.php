<?php

use App\Http\Controllers\ApiWeb;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Master
    Route::group(['prefix' => 'master'], function () {
        // User
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [ApiWeb\MasterUserController::class, 'index'])->middleware(['role:admin']);
            Route::post('/', [ApiWeb\MasterUserController::class, 'store'])->middleware(['role:admin']);
            Route::get('/{id}', [ApiWeb\MasterUserController::class, 'show'])->middleware(['role:admin'])->whereUuid('id');
            Route::put('/{id}', [ApiWeb\MasterUserController::class, 'update'])->middleware(['role:admin'])->whereUuid('id');
            Route::put('/{id}/change-status', [ApiWeb\MasterUserController::class, 'changeStatus'])->middleware(['role:admin'])->whereUuid('id');
            Route::put('/{id}/reset-password', [ApiWeb\MasterUserController::class, 'resetPassword'])->middleware(['role:admin'])->whereUuid('id');
        });
        // Product
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [ApiWeb\MasterProductController::class, 'index'])->middleware(['role:admin']);
            Route::post('/', [ApiWeb\MasterProductController::class, 'store'])->middleware(['role:admin']);
            Route::get('/{id}', [ApiWeb\MasterProductController::class, 'show'])->middleware(['role:admin'])->whereUuid('id');
            Route::post('/{id}/update', [ApiWeb\MasterProductController::class, 'update'])->middleware(['role:admin'])->whereUuid('id');
            Route::delete('/{id}', [ApiWeb\MasterProductController::class, 'delete'])->middleware(['role:admin'])->whereUuid('id');
        });
    });
});
