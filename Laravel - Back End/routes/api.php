<?php

use App\Http\Controllers\Api;
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

Route::post('/auth/login', [Api\AuthController::class, 'login'])->middleware(['custom.throttle:10,1']);
Route::post('/auth/register', [Api\AuthController::class, 'register'])->middleware(['custom.throttle:10,1']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    // App Version
    Route::group([
        'prefix' => 'app-version',
    ], function () {
        Route::get('/', [Api\AppVersionController::class, 'index'])->middleware(['role:developer']);
        Route::post('/', [Api\AppVersionController::class, 'store'])->middleware(['role:developer']);
        Route::get('/{id}', [Api\AppVersionController::class, 'show'])->middleware(['role:developer'])->whereUuid('id');
        Route::put('/{id}', [Api\AppVersionController::class, 'update'])->middleware(['role:developer'])->whereUuid('id');
        Route::delete('/{id}', [Api\AppVersionController::class, 'destroy'])->middleware(['role:developer'])->whereUuid('id');
    });
    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/logout', [Api\AuthController::class, 'logout']);
        Route::get('/me', [Api\AuthController::class, 'me']);
        Route::put('/me', [Api\AuthController::class, 'update']);
        Route::put('/change-password', [Api\AuthController::class, 'changePassword']);
    });

    // Select List
    Route::group(['prefix' => 'select-list'], function () {
        Route::get('/role', [Api\SelectListController::class, 'role']);
        Route::get('/user', [Api\SelectListController::class, 'user']);
    });
});

// Helper
Route::group(['prefix' => 'helper'], function () {
    Route::get('/latest-version/{type}', [Api\HelperController::class, 'latestVersion']);
});

// Storage
Route::group([
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/storage/{path}', [Api\StorageController::class, 'show'])
        ->where('path', '(.*)?')
        ->name('api.storage.show');
});
