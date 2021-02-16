<?php
return [
    'app' => [
        "host" => "192.168.169.100",
        "port" => 8500
    ],
    "service" => [
        'ID'                => "order-1",
        'Name'              => "order",
        'Tags'              => [
            'rpc'
        ],
        'Address'           => "192.168.169.100",
        'Port'              => 8801,
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
