<?php


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/../../services/AuthService.php';

Flight::route('POST /auth/register', function () {
    $data = Flight::request()->data->getData();

    $username = $data['username'] ?? null;
    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if (!$username || !$email || !$password) {
        Flight::halt(400, json_encode(['error' => 'Missing required fields']));
    }

    global $authService;
    $user = $authService->register($username, $email, $password);

    if (!$user) {
        Flight::halt(409, json_encode(['error' => 'User already exists']));
    }

    Flight::json(['message' => 'User registered successfully', 'user' => $user]);
});


Flight::route('POST /auth/login', function () {
    $data = Flight::request()->data->getData();

    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if (!$email || !$password) {
        Flight::halt(400, json_encode(['error' => 'Missing email or password']));
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
