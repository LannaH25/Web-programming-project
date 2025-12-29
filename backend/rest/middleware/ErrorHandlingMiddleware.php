<?php
Flight::map('error', function(Exception $ex){
    $code = $ex->getCode() ?: 500;
    http_response_code($code);
    Flight::json([
        'error' => $ex->getMessage()
    ]);
});
