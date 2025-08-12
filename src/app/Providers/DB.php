<?php

namespace App\Providers;

use BadMethodCallException;
use PDO;
use PDOException;
use PDOStatement;

class DB
{
    private PDO $connection;
    private ?PDOStatement $statement = null;

    public function __construct(array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        $dsn = sprintf(
            '%s:host=%s;port=%d;dbname=%s;charset=utf8',
            $config['driver'],
            $config['host'],
            $config['port'],
            $config['name']
        );

        try {
            $this->connection = new PDO(
                $dsn,
                $config['user'],
                $config['password'],
                $config['options'] ?? $defaultOptions
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    /*----------------------------------------------------------------------------------------------*/

    public function prepare(string $sql): self
    {
        $this->statement = $this->connection->prepare($sql);
        return $this;
    }

    /*----------------------------------------------------------------------------------------------*/

    public function execute(array $params = []): bool
    {
        return $this->statement?->execute($params) ?? false;
    }

    /*----------------------------------------------------------------------------------------------*/

    public function fetch(): array
    {
        return $this->statement?->fetchAll() ?? [];
    }

    /*----------------------------------------------------------------------------------------------*/

    public function __call($name, $arguments)
    {
        if ($this->statement && method_exists($this->statement, $name)) {
            return call_user_func_array([$this->statement, $name], $arguments);
        }

        if (method_exists($this->connection, $name)) {
            return call_user_func_array([$this->connection, $name], $arguments);
        }

        throw new BadMethodCallException("Method $name does not exist");
    }
}
