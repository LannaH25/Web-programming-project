<?php
require_once __DIR__ . '/BaseDao.php';

class AuthDao extends BaseDao {
    protected $table_name;

    public function __construct() {
        $this->table_name = "users";
        parent::__construct($this->table_name, 'user_ID'); 
    }

    public function add(array $entity) {
        return parent::insert($entity); 
    }

    public function get_user_by_email(string $email) {
        $stmt = $this->connection->prepare(
            "SELECT user_ID AS id, email, password, role FROM {$this->table} WHERE email = :email"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
