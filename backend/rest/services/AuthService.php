<?php

require_once __DIR__ . '/../config/Database.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService
{
    private $db;
    private $secretKey;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->secretKey = 'your_super_secret_key_here';
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function register(string $username, string $email, string $password): ?array
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            return null; 
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user' 
        ]);

        $id = $this->db->lastInsertId();

        return [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'role' => 'user'
        ];
    }

    public function login(string $email, string $password): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return null;
        if (!password_verify($password, $user['password'])) return null;

        unset($user['password']);
        return $user;
    }

    public function validateToken(string $token): ?array
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return (array)$decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
}

$authService = new AuthService();
