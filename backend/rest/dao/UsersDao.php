<?php
require_once __DIR__ . '/BaseDao.php';

class UsersDao extends BaseDao {

    public function __construct() {
        parent::__construct('users', 'User_ID');
    }

    public function add(array $user): array {
        $this->insert($user);
        return $user;
    }

    public function getAllUsers(): array {
        return $this->getAll();
    }

    
    public function getById($id): ?array { return parent::getById($id); }


    public function getByEmail(string $email): ?array {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE Email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function updateUser(int $id, array $user): bool {
        return $this->update($id, $user);
    }

    public function deleteUser($id): bool {
        return $this->delete($id);
    }
}
