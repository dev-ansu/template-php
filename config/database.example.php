<?php


return [
    'default' => $_ENV['APP_ENV'] ?? 'development',

    'connections' => [
        'development' => [
            'driver' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8mb4',
            'port' => $_ENV['DB_PORT'] ?? 3306
        ],


        'production' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'projeto',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'port' => 3306
        ],

        'sqlite' =>[
            'driver' => 'sqlite',
            'path' => $_ENV['DB_LOG_PATH'] ?? __DIR__ . '/../storage/database.sqlite',
        ]
    ]
];