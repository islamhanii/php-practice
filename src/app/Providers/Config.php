<?php

namespace App\Providers;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'] ?? 'localhost',
                'port' => $env['DB_PORT'] ?? 3306,
                'name' => $env['DB_NAME'] ?? 'database',
                'user' => $env['DB_USER'] ?? 'root',
                'password' => $env['DB_PASSWORD'] ?? '',
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
            ],
        ];
    }

    /*----------------------------------------------------------------------------------------------*/

    public function __get(string $key): mixed
    {
        return $this->config[$key] ?? null;
    }
}
