<?php

namespace App\Providers;

abstract class Model
{
    protected DB $db;
    protected string $table;
    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = App::db();
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function find(int $id): ?array
    {
        self::$db->prepare(sprintf("SELECT * FROM %s WHERE %s = :id", self::$table, self::$primaryKey));
        self::$db->bind(':id', $id);
        $result = self::$db->fetch();

        return $result ?: null;
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function all(): array
    {
        self::$db->prepare(sprintf("SELECT * FROM %s", self::$table));
        return self::$db->fetchAll();
    }

    /*----------------------------------------------------------------------------------------------*/

    protected static function create(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

        self::$db->prepare(sprintf("INSERT INTO %s (%s) VALUES (%s)", self::$table, $columns, $placeholders));

        return self::$db->execute($data);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected static function update(int $id, array $data): bool
    {
        $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

        self::$db->prepare(sprintf("UPDATE %s SET %s WHERE %s = :id", self::$table, $setClause, self::$primaryKey));
        $data['id'] = $id;

        return self::$db->execute($data);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected static function delete(int $id): bool
    {
        self::$db->prepare(sprintf("DELETE FROM %s WHERE %s = :id", self::$table, self::$primaryKey));
        self::$db->bind(':id', $id);

        return self::$db->execute();
    }

    /*----------------------------------------------------------------------------------------------*/

    protected static function insert(array $records): bool
    {
        if (empty($records)) {
            return false;
        }

        $columns = implode(', ', array_keys($records[0]));

        $rowPlaceholders = [];
        $bindValues = [];

        foreach ($records as $record) {
            $placeholders = '(' . implode(', ', array_fill(0, count($record), '?')) . ')';
            $rowPlaceholders[] = $placeholders;

            foreach ($record as $value) {
                $bindValues[] = $value;
            }
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES %s",
            self::$table,
            $columns,
            implode(', ', $rowPlaceholders)
        );

        $stmt = self::$db->prepare($sql);
        return $stmt->execute($bindValues);
    }
}
