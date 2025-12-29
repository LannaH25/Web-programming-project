<?php
require_once __DIR__ . '/../services/MessagesService.php';

$service = new MessagesService();

Flight::route('POST /messages', function() use ($service) {
    $data = Flight::request()->data->getData();
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $message = trim($data['message'] ?? '');

    if (!$name || !$email || !$message) {
        Flight::halt(400, json_encode(['error' => 'All fields are required']));
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Flight::halt(400, json_encode(['error' => 'Invalid email']));
    }

    $data['message'] = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    Flight::json($service->create($data));
});
