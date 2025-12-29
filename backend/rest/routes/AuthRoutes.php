<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../../services/AuthService.php';

Flight::route('POST /auth/register', function () {
    $data = Flight::request()->data->getData();

    $username = trim($data['username'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';

    if (!$username || !$email || !$password) {
        Flight::halt(400, json_encode(['error' => 'All fields are required']));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Flight::halt(400, json_encode(['error' => 'Invalid email']));
    }


    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{6,}$/', $password)) {
        Flight::halt(400, json_encode([
            'error' => 'Password must be at least 6 characters and include uppercase, lowercase, number, and special character.'
        ]));
    }

    global $authService;
    $user = $authService->register($username, $email, $password);
    if (!$user) {
        Flight::halt(409, json_encode(['error' => 'User already exists']));
    }

    Flight::json(['message' => 'User registered', 'user' => $user]);
});

Flight::route('POST /auth/login', function () {
    $data = Flight::request()->data->getData();

    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';

    if (!$email || !$password) {
        Flight::halt(400, json_encode(['error' => 'Email and password are required']));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Flight::halt(400, json_encode(['error' => 'Invalid email']));
    }

    global $authService;
    $user = $authService->login($email, $password);
    if (!$user) {
        Flight::halt(401, json_encode(['error' => 'Invalid credentials']));
    }

    $payload = [
        'sub' => $user['id'],
        'email' => $user['email'],
        'role' => $user['role'],
        'iat' => time(),
        'exp' => time() + 3600
    ];

    $jwt = JWT::encode($payload, $authService->getSecretKey(), 'HS256');

    Flight::json(['message' => 'Login successful', 'token' => $jwt]);
});
