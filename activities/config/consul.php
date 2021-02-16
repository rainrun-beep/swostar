<?php
return [
    'app' => [
        "host" => "192.168.169.100",
        "port" => 8500
    ],
    "service" => [
        'ID'                => "activities-1",
        'Name'              => "activities",
        'Tags'              => [
            'rpc'
        ],
        'Address'           => "192.168.169.100",
        'Port'              => 7801,
        // 健康检查
        // "Check" => [
        //     "name"     => "swoft.goods.server",
        //     // 192.168.169.200 这是 swoft 的服务宿主机地址
        //     "tcp"      => "192.168.169.200:".env("CONSUL_CHECK_PORT"),
        //     "interval" => '10s',
        //     "timeout"  => '2s'
        // ],
    ]
];
