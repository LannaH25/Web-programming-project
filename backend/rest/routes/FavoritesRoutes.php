<?php
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../middleware/RequestValidationMiddleware.php';

Flight::register('auth_service', 'AuthService');


Flight::route('POST /auth/register', function() {
    $data = Flight::request()->data->getData();
    validateRequest(['email', 'password'], $data);

    $response = Flight::auth_service()->register($data);
    if ($response['success']) {
        Flight::json(['message' => 'User registered', 'data' => $response['data']]);
    } else {
        Flight::halt(409, $response['error']);
    }
});


Flight::route('POST /auth/login', function() {
    $data = Flight::request()->data->getData();
    validateRequest(['email', 'password'], $data);

    $response = Flight::auth_service()->login($data);
    if ($response['success']) {
        Flight::json(['message' => 'User logged in', 'data' => $response['data']]);
    } else {
        Flight::halt(401, $response['error']);
    }
});
