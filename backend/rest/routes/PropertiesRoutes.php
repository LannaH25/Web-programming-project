<?php
require_once __DIR__ . '/../services/PropertiesService.php';

$service = new PropertiesService();

/**
 * @OA\Get(
 *     path="/properties",
 *     summary="Get all properties",
 *     @OA\Response(response=200, description="List of properties")
 * )
 */
Flight::route('GET /properties', function() use ($service) {
    Flight::json($service->getAll());
});

/**
 * @OA\Get(
 *     path="/properties/{id}",
 *     summary="Get property by ID",
 *     @OA\Parameter(name="id", in="path", required=true, description="Property ID"),
 *     @OA\Response(response=200, description="Property object")
 * )
 */
Flight::route('GET /properties/@id', function($id) use ($service) {
    Flight::json($service->getById($id));
});

/**
 * @OA\Post(
 *     path="/properties",
 *     summary="Create a property",
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=201, description="Property created")
 * )
 */
Flight::route('POST /properties', function() use ($service) {
    $data = Flight::request()->data->getData();
    Flight::json($service->create($data));
});

/**
 * @OA\Put(
 *     path="/properties/{id}",
 *     summary="Update a property",
 *     @OA\Parameter(name="id", in="path", required=true, description="Property ID"),
 *     @OA\RequestBody(required=true, @OA\JsonContent(type="object")),
 *     @OA\Response(response=200, description="Property updated")
 * )
 */
Flight::route('PUT /properties/@id', function($id) use ($service) {
    $data = Flight::request()->data->getData();
    Flight::json($service->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/properties/{id}",
 *     summary="Delete a property",
 *     @OA\Parameter(name="id", in="path", required=true, description="Property ID"),
 *     @OA\Response(response=200, description="Property deleted")
 * )
 */
Flight::route('DELETE /properties/@id', function($id) use ($service) {
    $service->delete($id);
    Flight::json(["status" => "success"]);
});
