<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserApiController::class)
    ->prefix('user')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('store', 'store')->name('storeUser')
        ->withoutMiddleware('auth_sanctum');
        Route::put('update/{id}', 'update')->name('updateUser');
        Route::delete('destroy/{id}', 'destroy')->name('destroyUser');
    });

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });

Route::controller(TaskController::class)
    ->prefix('task')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('indexTask');
        Route::post('store', 'store')->name('storeTask');
        Route::get('show/{id}', 'show')->name('showTask');
        Route::put('update/{id}', 'update')->name('updateTask');
        Route::delete('destroy/{id}', 'destroy')->name('destroyTask');
    });
