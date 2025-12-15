<?php


require_once __DIR__ . '/../services/AuthService.php';


function protectRoute(?string $requiredRole = null): void
{
    global $authService;

    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;

    if (!$authHeader) {
        Flight::halt(401, json_encode(['error' => 'Authorization header missing']));
    }

   
    $token = str_replace('Bearer ', '', $authHeader);


    $decoded = $authService->validateToken($token);
    if (!$decoded) {
        Flight::halt(401, json_encode(['error' => 'Invalid or expired token']));
    }


    if ($requiredRole && ($decoded['role'] ?? null) !== $requiredRole) {
        Flight::halt(403, json_encode(['error' => 'Forbidden: insufficient permissions']));
    }

   
    Flight::set('user', $decoded);
}


function getCurrentUser(): ?array
{
    return Flight::get('user') ?? null;
}
