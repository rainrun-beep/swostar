<?php
namespace App\Listener;

use SwoStar\Event\Listener;
use Swoole\Coroutine;
/**
 *
 */
class StartListener extends Listener
{
    // 注册的事件执行节点
    protected $name = "swoole:start";

    public function handler($swostarServer, $swooleServer)
    {
        Coroutine::create(function(){

            $this->registerConsul();
        });
    }

    protected function registerConsul()
    {
        $consul = $this->app->make("consul-agent");

        $config = $this->app->make("config")->get("consul.service");

        dd($config, "注册的服务信息");

        $consul->registerService($config);
    }
}
