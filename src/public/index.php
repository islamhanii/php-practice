<?php

require '../vendor/autoload.php';

use App\Providers\Route;

require_once '../routes/web.php';

Route::dispatch();