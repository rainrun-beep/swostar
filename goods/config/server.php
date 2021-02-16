<?php
return [
    'http' => [
        'host' => '0.0.0.0',
        'port' => 9800
    ],
    'rpc' => [
        'flag' => true,
        'type' => SWOOLE_SOCK_TCP,
        'host' => '127.0.0.1',
        'port' => 9801,
        'swoole' => [

        ]
    ],
];
