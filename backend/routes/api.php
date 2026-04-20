<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\PublicContentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('public')->group(function () {
        Route::get('/bootstrap', [PublicContentController::class, 'bootstrap']);
        Route::get('/home', [PublicContentController::class, 'home']);
        Route::get('/posts', [PublicContentController::class, 'posts']);
        Route::get('/posts/{slug}', [PublicContentController::class, 'showPost']);
        Route::post('/contact', [PublicContentController::class, 'contact'])->middleware('throttle:public-contact');
    });

    Route::prefix('admin')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:admin-login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/me', [AuthController::class, 'me']);
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/dashboard', DashboardController::class)->middleware('role:super-admin,content-admin,editor,viewer');
        });
    });
});

