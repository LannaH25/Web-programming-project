<?php
require_once __DIR__ . '/../config/Database.php';

class BaseDao {
    /** @var PDO */
    protected PDO $connection;

    protected string $table;
    public string $pk;

    public function __construct(string $table, string $pk = 'id') {
        $this->table = $table;
        $this->pk = $pk;

        // Correct: create Database instance and get PDO connection
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function getAll(): array {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): ?array {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$this->pk} = :id");
        $stmt->bindValue(':id', $id, is_int($id) ? PDO::PARAM_INT : PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function insert(array $data): int {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        return (int)$this->connection->lastInsertId();
    }

    public function update($id, array $data): bool {
        $fields = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE {$this->table} SET $fields WHERE {$this->pk} = :id";
        $stmt = $this->connection->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id): bool {
        $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE {$this->pk} = :id");
        $stmt->bindValue(':id', $id, is_int($id) ? PDO::PARAM_INT : PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function query_unique(string $query, array $params = []): ?array {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
