<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CommandController;

Route::get('/menu', [MenuController::class,'get']);
Route::get('/menu/{id}', [MenuController::class,'getById']);

Route::get('/commands', [CommandController::class, 'get']);
Route::post('/commands/store', [CommandController::class, 'store']);
Route::get('/commands/actives', [CommandController::class, 'getActives']);
Route::put('/commands/changeStatus/{id}', [CommandController::class, 'changeStatus']);


