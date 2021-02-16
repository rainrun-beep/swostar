<?php
namespace App\Rpc\Service;

/**
 *
 */
class OrderService
{
    public function getStock()
    {

        sleep(2);
        return [
            "goodsid" => 1,
            "stock" => 200,
        ];
    }
}
