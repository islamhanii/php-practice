<?php

use App\Http\Controllers\TransactionController;
use App\Providers\Route;

Route::get('/', [TransactionController::class, 'index']);
Route::post('/', [TransactionController::class, 'upload']);