<?php
namespace App\Rpc\Client;

use SwoStar\Rpc\RpcClient;

class OrderClient extends RpcClient
{
    protected $classType = \App\Rpc\Service\OrderService::class;

    protected $service = "order";
}
