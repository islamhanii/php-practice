<?php

use App\Http\Controllers\HomeController;
use App\Providers\Route;

Route::get('/{name}', [HomeController::class, 'index']);