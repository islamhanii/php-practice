<?php

namespace App\Providers;

use App\Http\Exceptions\RouteNotFoundException;

class App
{
    private static DB $db;

    public function __construct(protected Config $config)
    {
        static::$db = new DB($config->db);
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function db(): DB
    {
        return static::$db;
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function run(): void
    {
        try {
            Route::dispatch();
        } catch (RouteNotFoundException $e) {
            http_response_code($e->getCode());
            View::render('errors/404', ['message' => $e->getMessage()]);
        } catch (\Throwable $e) {
            http_response_code((int)$e->getCode() ?: 500);
            echo $e->getMessage();
        }
    }
}
