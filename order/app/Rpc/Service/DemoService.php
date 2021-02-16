<?php
namespace App\Rpc\Service;

/**
 *
 */
class DemoService
{
    public function getList()
    {
        return ["shineyork" => '帅气的 666 ！！！'];
    }

    public function getUser()
    {
        return ["shineyork" => '还是很 6666 ！！！'];
    }
}
