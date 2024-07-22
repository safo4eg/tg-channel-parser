<?php

return [
    'database' => [
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'tg-channel-parser'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', 'root')
    ],

    'api' => [
        'id' => env('TELEGRAM_API_ID', null),
        'hash' => env('TELEGRAM_API_HASH', null)
    ],

    'sessions_directory' => 'madeline_sessions'
];