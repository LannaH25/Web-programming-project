<?php

function validateRequest(array $requiredFields, array $data) {
    $missing = [];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $missing[] = $field;
        }
    }

    if (!empty($missing)) {
        Flight::halt(400, json_encode([
            'error' => 'Missing required fields',
            'fields' => $missing
        ]));
    }

    return true;
}
