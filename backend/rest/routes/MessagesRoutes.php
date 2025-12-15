<?php
require_once __DIR__ . '/../services/MessagesService.php';

$service = new MessagesService();

/**
 * @OA\Get(
 *     path="/messages",
 *     summary="Get all messages",
 *     @OA\Response(response=200, description="List of messages")
 * )
 */
Flight::route('GET /messages', function() use ($service) {
    Flight::json($service->getAll());
});

/**
 * @OA\Get(
 *     path="/messages/{id}",
 *     summary="Get message by ID",
 *     @OA\Parameter(name="id", in="path", required=true, description="Message ID"),
 *     @OA\Response(response=200, description="Message object")
 * )
 */
Flight::route('GET /messages/@id', function($id) use ($service) {
    Flight::json($service->getById($id));
});

/**
 * @OA\Post(
 *     path="/messages",
 *     summary="Create a message",
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=201, description="Message created")
 * )
 */
Flight::route('POST /messages', function() use ($service) {
    $data = Flight::request()->data->getData();
    Flight::json($service->create($data));
});

/**
 * @OA\Put(
 *     path="/messages/{id}",
 *     summary="Update a message",
 *     @OA\Parameter(name="id", in="path", required=true, description="Message ID"),
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=200, description="Message updated")
 * )
 */
Flight::route('PUT /messages/@id', function($id) use ($service) {
    $data = Flight::request()->data->getData();
    Flight::json($service->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/messages/{id}",
 *     summary="Delete a message",
 *     @OA\Parameter(name="id", in="path", required=true, description="Message ID"),
 *     @OA\Response(response=200, description="Message deleted")
 * )
 */
Flight::route('DELETE /messages/@id', function($id) use ($service) {
    $service->delete($id);
    Flight::json(["status" => "success"]);
});
