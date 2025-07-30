<?php

require '../vendor/autoload.php';

use App\Providers\Route;

define('VIEW_PATH', __DIR__ . '/../views/');

require_once '../routes/web.php';

Route::dispatch();