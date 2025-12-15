<?php
require_once __DIR__ . '/../services/UsersService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/LoggerMiddleware.php';
require_once __DIR__ . '/../middleware/RequestValidationMiddleware.php';

$service = new UsersService();

/**
 * @OA\Get(
 *     path="/users",
 *     summary="Get all users",
 *     @OA\Response(response=200, description="List of all users")
 * )
 */
Flight::route('GET /users', function() use ($service) {
    protectRoute();                  // check JWT
    $user = getCurrentUser();        // get authenticated user
    logRequest($user['sub'] ?? null);

    $users = $service->getAllUsers();
    Flight::json($users);
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     summary="Get user by ID",
 *     @OA\Parameter(name="id", in="path", required=true, description="User ID"),
 *     @OA\Response(response=200, description="User object"),
 *     @OA\Response(response=404, description="User not found")
 * )
 */
Flight::route('GET /users/@id', function($id) use ($service) {
    protectRoute();
    $user = getCurrentUser();
    logRequest($user['sub'] ?? null);

    $result = $service->getById((int)$id);
    if (!$result) {
        Flight::halt(404, 'User not found');
    }
    Flight::json($result);
});

/**
 * @OA\Post(
 *     path="/users",
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name","email","password"},
 *             @OA\Property(property="full_name", type="string"),
 *             @OA\Property(property="email", type="string", example="demo@gmail.com"),
 *             @OA\Property(property="password", type="string", example="password123")
 *         )
 *     ),
