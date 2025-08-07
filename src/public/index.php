<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Providers\App;
use App\Providers\Config;

define('VIEW_PATH', __DIR__ . '/../views/');

require_once '../routes/web.php';

$app = new App(new Config($_ENV));
$app->run();
