<?php

namespace App\Providers;

class View
{
    public static function render(string $path, array $params = [])
    {
        extract($params);

        require_once VIEW_PATH . $path . '.php';
    }
}