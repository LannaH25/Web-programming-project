<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

declare(strict_types=1);


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/backend/rest/routes/AuthRoutes.php';

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Database.php';

require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/UsersService.php';
require_once __DIR__ . '/rest/services/AdminsService.php';
require_once __DIR__ . '/rest/services/PropertiesService.php';
require_once __DIR__ . '/rest/services/FavoritesService.php';
require_once __DIR__ . '/rest/services/MessagesService.php';


use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::register('auth_service', 'AuthService');
Flight::register('userService', 'UsersService');
Flight::register('adminService', 'AdminsService');
Flight::register('propertyService', 'PropertiesService');
Flight::register('favoriteService', 'FavoritesService');
Flight::register('messageService', 'MessagesService');

Flight::route('/*', function () {
    $url = Flight::request()->url;


    if (
        $url === '/' ||
        str_starts_with($url, '/auth/login') ||
        str_starts_with($url, '/auth/register')
    ) {
        return true;
    }


    $headers = getallheaders();
    $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;

    if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
        Flight::json(['error' => 'Missing or invalid Authorization header. Use: Bearer <token>'], 401);
        return false;
    }

    $token = trim(substr($authHeader, 7));

    try {
        $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded);
        return true;
    } catch (Exception $e) {
        Flight::json(['error' => 'Invalid or expired token'], 401);
        return false;
    }
}, true); 


require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/rest/routes/AdminsRoutes.php';
require_once __DIR__ . '/rest/routes/PropertiesRoutes.php';
require_once __DIR__ . '/rest/routes/FavoritesRoutes.php';
require_once __DIR__ . '/rest/routes/MessagesRoutes.php';


Flight::map('notFound', function () {
    Flight::json(['error' => 'Route not found'], 404);
});

Flight::map('error', function (Exception $ex) {
    Flight::json(['error' => 'Server error: ' . $ex->getMessage()], 500);
});


Flight::route('/', function () {
    Flight::json(['message' => 'Real Estate API is running! Welcome 🚀']);
});



Flight::start();