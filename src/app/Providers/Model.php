<?php

namespace App\Providers;

use PDO;

abstract class Model
{
    protected DB $db;
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $fillable = [];

    public function __construct()
    {
        $this->db = App::db();
    }

    /*----------------------------------------------------------------------------------------------*/

    public function __call($name, $arguments)
    {
        $name .= 'Internal';
        if (!method_exists($this, $name)) {
            throw new \BadMethodCallException("Method $name does not exist on " . static::class);
        }

        return $this->$name(...$arguments);
    }

    /*----------------------------------------------------------------------------------------------*/

    public static function __callStatic($name, $arguments)
    {
        $instance = new static();
        $name .= 'Internal';
        if (!method_exists($instance, $name)) {
            throw new \BadMethodCallException("Method $name does not exist on " . static::class);
        }

        return $instance->$name(...$arguments);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function findInternal(int $id): ?array
    {
        $this->db->prepare(sprintf("SELECT * FROM %s WHERE %s = :id", $this->table, $this->primaryKey));
        $this->db->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $this->db->fetch()[0] ?? null;

        return $result ?: null;
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function allInternal(): array
    {
        $stmt = $this->db->prepare(sprintf("SELECT * FROM %s", $this->table));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function createInternal(array $data): bool
    {
        $data = array_intersect_key($data, array_flip($this->fillable));
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

        $this->db->prepare(sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table, $columns, $placeholders));

        return $this->db->execute($data);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function updateInternal(int $id, array $data): bool
    {
        $data = array_intersect_key($data, array_flip($this->fillable));
        $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));

        $this->db->prepare(sprintf("UPDATE %s SET %s WHERE %s = :id", $this->table, $setClause, $this->primaryKey));
        $data['id'] = $id;

        return $this->db->execute($data);
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function deleteInternal(int $id): bool
    {
        $this->db->prepare(sprintf("DELETE FROM %s WHERE %s = :id", $this->table, $this->primaryKey));
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    /*----------------------------------------------------------------------------------------------*/

    protected function insertInternal(array $records): bool
    {
        if (empty($records)) {
            return false;
        }

        $columns = "`" . implode('`, `', array_keys(array_intersect_key($records[0], array_flip($this->fillable)))) . "`";

        $rowPlaceholders = [];
        $bindValues = [];

        foreach ($records as $record) {
            $record = array_intersect_key($record, array_flip($this->fillable));
            $placeholders = '(' . implode(', ', array_fill(0, count($record), '?')) . ')';
            $rowPlaceholders[] = $placeholders;

            foreach ($record as $value) {
                $bindValues[] = $value;
            }
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES %s",
            $this->table,
            $columns,
            implode(', ', $rowPlaceholders)
        );

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($bindValues);
    }
}
