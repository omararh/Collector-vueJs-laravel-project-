<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/getMenu', [MenuController::class,'get']);
