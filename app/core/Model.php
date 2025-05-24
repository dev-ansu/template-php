<?php
namespace app\core;

use PDO;

abstract class Model extends DBManager{
    
    protected string | null $name;
    protected string $table;
    protected array $columns = [];

    public function all():array{
        $stmt = $this->connection($this->name)->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($key, $value): ?array{
        
        $key = $this->validateColumn($key);

        $stmt = $this->connection($this->name)->prepare("SELECT * FROM {$this->table} WHERE {$key} = :{$key}");
        $stmt->execute(["$key" => $value]);
        $result = $stmt->fetch();
        return $result ?: null;

    }

    public function delete($key, $value): bool
    {   
        $key = $this->validateColumn($key);
        
        $stmt = $this->connection($this->name)->prepare("DELETE FROM {$this->table} WHERE {$key} = :{$key}");
        return $stmt->execute(["$key" => $value]);
    }

    public function update(int $id, array $data): bool
    {
        $fields = array_keys($data);
        $set = implode(", ", array_map(fn($field) => "$field = :$field", $fields));
        $data['id'] = $id;

        $stmt = $this->connection($this->name)->prepare("UPDATE {$this->table} SET $set WHERE id = :id");
        return $stmt->execute($data);
    }

    public function create(array $data): bool
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($key) => ":$key", array_keys($data)));

        $stmt = $this->connection($this->name)->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        return $stmt->execute($data);
    }


    protected function validateColumn($key){
        if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $key)) {
            throw new \InvalidArgumentException("Coluna inválida: $key");
        }
        if (!in_array($key, $this->columns)) {
            throw new \InvalidArgumentException("Coluna inválida: $key");
        }
        return $key;
    }



}