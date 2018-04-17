<?php

return [
    'channels' => [
        'database' => [
            'driver' => 'custom',
            'via'=> \App\Logging\MysqlLogger::class,
            'table'=> env('DB_LOG_TABLE', 'logs'),
            'connection' => env('DB_LOG_CONNECTION', env('DB_CONNECTION', 'mysql')),
        ],
    ],
];