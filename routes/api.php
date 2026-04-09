<?php

use Illuminate\Http\Request;
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

use App\Http\Controllers\Api\V1\AuthController;

Route::prefix('v1')->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register'])
            ->middleware('throttle:5,1');
        Route::post('login', [AuthController::class, 'login'])
            ->middleware('throttle:5,1');
        
        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::get('me', [AuthController::class, 'me']);
        });
    });

    // Other resources (books, authors, publishers)
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('books', \App\Http\Controllers\Api\V1\BookController::class);
        Route::apiResource('authors', \App\Http\Controllers\Api\V1\AuthorController::class);
        Route::apiResource('publishers', \App\Http\Controllers\Api\V1\PublisherController::class);
    });
});
