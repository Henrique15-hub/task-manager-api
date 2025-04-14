<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index');
    Route::get('users/{id}', 'show');
    Route::post('users/store', 'store')->name('store');
    Route::put('users/update/{id}', 'update');
    Route::delete('users/delete/{id}', 'destroy');
});

Route::controller(AuthUserController::class)->group(function () {
    Route::post('users/login', 'login');
    Route::post('users/logout', 'logout')->middleware('auth:sanctum');
});

Route::controller(TasksController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('tasks', 'index');
    Route::post('tasks/create', 'store');
    Route::get('tasks/{id}', 'show');
    Route::post('tasks/update/{id}', 'update');
    Route::delete('tasks/delete/{id}', 'destroy');
});
