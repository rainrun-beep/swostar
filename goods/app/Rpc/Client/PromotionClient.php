<?php
namespace App\Rpc\Client;

use SwoStar\Rpc\RpcClient;

class PromotionClient extends RpcClient
{
    protected $classType = \App\Rpc\Service\PromotionService::class;

    protected $service = "activities";
}
