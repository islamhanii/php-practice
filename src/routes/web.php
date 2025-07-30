<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Providers\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'singin']);