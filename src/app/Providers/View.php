<?php

namespace App\Providers;

use App\Http\Exceptions\ViewNotFoundException;

class View
{
    private static function convertArrayValuesToObject(&$array)
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = (object)$value;
                self::convertArrayValuesToObject($value);
            }
        }

        return $array;
    }

    public static function render(string $path, array $params = []): void
    {
        $safeParams = (object) self::convertArrayValuesToObject($params);

        $file = VIEW_PATH . $path . '.php';
        if (!file_exists($file)) {
            throw new ViewNotFoundException();
        }

        include $file;
    }
}
