<?php
namespace App\Http\Controller;

use App\Rpc\Client\DemoClient;

class IndexController
{
    public function demo()
    {
        return app('consul-agent')->health('order');
        // return "this is serverice  indexcontroller demo";
    }

    public function rpc()
    {
        (new DemoClient)->getList();
        // return app('consul-agent')->health('order');
        // return "this is serverice  indexcontroller demo";
    }
}
