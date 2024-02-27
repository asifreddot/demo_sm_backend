<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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


// Public routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/social', [AuthController::class, 'socialLogin']);
Route::post('/auth/register', [AuthController::class, 'register']);


// Protected routes with 'auth:sanctum' middleware
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/profile', [UserController::class, 'info']);
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    // Admin-only routes
    Route::middleware(['restrictRole:admin'])->group(function () {
        // User-related routes
        Route::prefix('user')->group(function () {
            Route::get('/all', [UserController::class, 'index']);
            Route::get('/info/{id}', [UserController::class, 'info']);
            Route::post('/create', [UserController::class, 'store']);
            Route::post('/update', [UserController::class, 'update']);
        });

        // Task-related routes only for admin
        Route::prefix('task')->group(function () {
            Route::get('/all', [TaskController::class, 'index']);
            Route::get('/delete/{id}', [TaskController::class, 'destroy']);
        });
    });

    // Task-related routes for all users
    Route::prefix('task')->group(function () {
        Route::get('/list', [TaskController::class, 'list']);
        Route::post('/create', [TaskController::class, 'store']);
        Route::post('/batch-create', [TaskController::class, 'batchStore']);
        Route::post('/update', [TaskController::class, 'update']);
        Route::post('/change-status', [TaskController::class, 'changeStatus']);
    });

    // User-only routes
    Route::middleware(['restrictRole:user'])->group(function () {

    });

});
