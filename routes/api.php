<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\AuthUserController;
use GuzzleHttp\Middleware;

//Rotas de criação de usuarios
Route::controller(UserController::class)->group(function (){
    Route::get('users', 'index');
    Route::get('users/{id}', 'show');
    Route::post('users/store','store')->name('store');
    Route::put('users/update/{id}','update');
    Route::delete('users/delete/{id}','destroy');
});


//Rotas de autenticação de usuarios
Route::controller(AuthUserController::class)->group(function () {
    Route::post('users/login','login');
    Route::post('users/register', 'register');
    Route::post('users/logout', 'logout')->middleware('auth:sanctum');
});




//Rotas das tarefas
Route::controller(TasksController::class)->middleware('auth:sanctum')->group(function (){
    Route::get('tasks','index');
    Route::post('tasks/create', 'store');
    Route::get('tasks/{id}', 'show');
    Route::post('tasks/update/{id}', 'update');
    Route::delete('tasks/delete/{id}', 'destroy');
});
