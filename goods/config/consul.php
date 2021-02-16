<?php
return [
    'app' => [
        "host" => "192.168.169.100",
        "port" => 8500
    ],
    "service" => [
        'ID'                => "swostar-1",
        'Name'              => "swostar",
        'Tags'              => [
            'rpc'
        ],
        'Address'           => "127.0.0.1",
        'Port'              => 9801,
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
