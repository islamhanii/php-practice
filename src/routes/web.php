<?php

use App\Http\Controllers\HomeController;
use App\Providers\Route;

Route::get('/', [HomeController::class, 'index']);