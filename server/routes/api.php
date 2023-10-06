<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\UserController;

//Auth routes
Route::post('/signIn', [UserController::class, 'signIn']);
Route::post('/logIn', [UserController::class, 'login'])->name('login');

Route::get('/menu', [MenuController::class,'get']);
Route::get('/menu/{id}', [MenuController::class,'getById']);


// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('/commands/store', [CommandController::class, 'store']);
    Route::get('/commands/{phoneNumber}', [CommandController::class, 'getCommandsByUser']);

    Route::post('/logOut', [UserController::class, 'logOut']);
    Route::get('/verifyToken', [UserController::class, 'verifyToken']);
    Route::get('/verifyIfAdmin', [UserController::class, 'verifyIfAdmin']);


    Route::middleware('admin')->group(function () {
        Route::group(['prefix' => 'admin'], function() {
            Route::get('/commands/actives', [CommandController::class, 'getActives']);
            Route::put('/commands/changeStatus/{id}', [CommandController::class, 'changeStatus']);
            Route::post('/commands/byDate', [CommandController::class, 'getCommandByDate']);
            Route::get('/users', [UserController::class, 'get']);
        });

        Route::group(['prefix' => 'sudo'], function() {
            Route::get('/commands', [CommandController::class, 'get']);
        });
    });
});


