<?php
require_once __DIR__ . '/../services/AdminsService.php';

$service = new AdminsService();

/**
 * @OA\Get(
 *     path="/admins",
 *     summary="Get all admins",
 *     @OA\Response(response=200, description="List of admins")
 * )
 */
Flight::route('GET /admins', function() use ($service) {
    Flight::json($service->getAll());
});

/**
 * @OA\Get(
 *     path="/admins/{id}",
 *     summary="Get admin by ID",
 *     @OA\Parameter(name="id", in="path", required=true, description="Admin ID"),
 *     @OA\Response(response=200, description="Admin object")
 * )
 */
Flight::route('GET /admins/@id', function($id) use ($service) {
    Flight::json($service->getById($id));
});

/**
 * @OA\Post(
 *     path="/admins",
 *     summary="Create an admin",
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=201, description="Admin created")
 * )
 */
Flight::route('POST /admins', function() use ($service) {
    $data = Flight::request()->data->getData();
    Flight::json($service->create($data));
});

/**
 * @OA\Put(
 *     path="/admins/{id}",
 *     summary="Update an admin",
 *     @OA\Parameter(name="id", in="path", required=true, description="Admin ID"),
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=200, description="Admin updated")
 * )
 */
Flight::route('PUT /admins/@id', function($id) use ($service) {
    $data = Flight::request()->data->getData();
    Flight::json($service->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/admins/{id}",
 *     summary="Delete an admin",
 *     @OA\Parameter(name="id", in="path", required=true, description="Admin ID"),
 *     @OA\Response(response=200, description="Admin deleted")
 * )
 */
Flight::route('DELETE /admins/@id', function($id) use ($service) {
    $service->delete($id);
    Flight::json(["status" => "success"]);
});
