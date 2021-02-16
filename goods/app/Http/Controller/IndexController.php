<?php
namespace App\Http\Controller;

use App\Rpc\Client\DemoClient;
use App\Rpc\Client\PromotionClient;
use App\Rpc\Client\OrderClient;
use Swoole\Coroutine\Channel;
use Swoole\Coroutine\Barrier;

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

    public function show()
    {

        $lowTime = time();
        // $chan = new Channel(2);// 常量
        // $wg = new \Swoole\Coroutine\WaitGroup();
        $barrier = Barrier::make();
        $result = [
          "desc" => "这是商品服务",
        ];

        // $wg->add();
        go(function () use ($barrier, &$result) {
           $prom = (new PromotionClient)->index();
           $result["prom" ] = $prom;
           // $chan->push(["prom" => $prom]);
           // $wg->done();
        });
        // 获取活动 信息
        // 获取库存
        // $wg->add();
        go(function () use ($barrier, &$result) {
           $stock = (new OrderClient)->getStock();
           $result["stock"] = $stock;
           // $chan->push(["stock" => $stock]);
           // $wg->done();
        });
        // $wg->wait();
        Barrier::wait($barrier);
        $newTime = time();
        $result += [
          "lowTime" => $lowTime,
          "newTime" => $newTime,
          "time" => $newTime - $lowTime
        ];

        return $result;
    }
}
