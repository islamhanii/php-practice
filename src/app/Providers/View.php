<?php

namespace App\Providers;

use App\Http\Exceptions\ViewNotFoundException;

class View
{
    public static function render(string $path, array $params = []): void
    {
        $safeParams = (object) $params;
        $file = VIEW_PATH . $path . '.php';
        if (!file_exists($file)) {
            throw new ViewNotFoundException();
        }

        include $file;
    }
}