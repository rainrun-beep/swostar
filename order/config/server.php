<?php
return [
    'http' => [
        'host' => '0.0.0.0',
        'port' => 8800
    ],
    'rpc' => [
        'flag' => true,
        'type' => SWOOLE_SOCK_TCP,
        'host' => '192.168.169.100',
        'port' => 8801,
        'swoole' => [

        ]
    ],
];
