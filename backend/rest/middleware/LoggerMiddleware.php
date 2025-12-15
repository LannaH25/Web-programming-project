<?php
function logRequest($userId = null) {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];
    $time = date('Y-m-d H:i:s');
    $user = $userId ?? 'Guest';

    $log = "[$time] $method $uri - User: $user" . PHP_EOL;
    if (!is_dir(__DIR__ . '/../logs')) {
        mkdir(__DIR__ . '/../logs', 0777, true);
    }
    file_put_contents(__DIR__ . '/../logs/app.log', $log, FILE_APPEND);
}
