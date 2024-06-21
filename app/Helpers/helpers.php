<?php

use Firebase\JWT\JWT;

if (! function_exists('generateToken')) {
    function generateToken($payload): string
    {
        $key = config('services.onlyoffice.jwt_secret');
        return JWT::encode($payload, $key, 'HS256');
    }
}

if (! function_exists('verifyToken')) {
    function verifyToken($token): string
    {
        $key = config('services.onlyoffice.jwt_secret');
        try {
            JWT::decode($token, $key);
            return true;
        } catch (\Exception) {
            return false;
        }
    }
}

if (! function_exists('sendlog')) {
    function sendlog($msg, $method = "", $logFileName = "web.log"): void
    {
        $message = "Method: $method ; Message: $msg ;End" . PHP_EOL;
        file_put_contents(storage_path('logs') . $logFileName, $message, FILE_APPEND);
    }
}
