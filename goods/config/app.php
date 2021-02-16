<?php
return [
    'extr' => "shineyork很帅气 666",

    "priovders" => [
        // 存放
        \App\Providers\RouteServerProvider::class,
        \App\Providers\RpcServerPriovder::class,
        \SwoStar\Event\EventServerProvider::class,
        \SwoStar\Consul\ConsulServerPriovder::class,
    ],
];
