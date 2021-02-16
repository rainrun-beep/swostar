<?php
namespace App;

use SwoStar\Event\Listener;
use Swoole\Coroutine;
/**
 *
 */
class StopListener extends Listener
{
    // 注册的事件执行节点
    protected $name = "swoole:stop";

    public function handler($swostarServer, $swooleServer)
    {
        // dd("this is  stop --- listener handler");
        
        Coroutine::create(function(){
            $this->deregisterConsul();
        });
    }

    protected function deregisterConsul()
    {
        $consul = $this->app->make("consul-agent");

        $config = $this->app->make("config")->get("consul.service");

        dd($config['ID'], "注销服务信息");

        $consul->deregisterService($config['ID']);
    }
}
