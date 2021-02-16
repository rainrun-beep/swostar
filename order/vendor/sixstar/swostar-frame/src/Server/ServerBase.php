<?php
namespace SwoStar\Server;

use SwoStar\Foundation\Application;

abstract class ServerBase
{
    /**
     * @var SwoStar\Foundation\Application
     */
    protected $app;
    /**
     * @var Swoole\Server
     */
    protected $server;

    protected $host = '0.0.0.0';

    protected $port = 9500;

    protected $serverConfig = [
        'task_worker_num' => 0,
    ];

    protected $serverEvent = [
        "server" => [ // 有swoole的本身的事件 -- 是在swoole的整体生命周期
            'start' => 'onStart',
            'Shutdown' => "onShutdown"
         ],
        "sub" => [], // http - websocket 是记录明确swoole服务独有的事件
        "ext" => [], // 根据用户扩展task事件
    ];

    function __construct(Application $app)
    {
        $this->app = $app;
        // 初识化服务的设置
        $this->initServerConfig();
        // 创建服务
        $this->createServer();
        // 初识事件
        $this->initEvent();
        // 设置回调函数
        $this->setSwooleEvent();
    }
    /**
     * 因为不同的服务构建不一样
     */
    abstract protected function initServerConfig();
    /**
     * 因为不同的服务构建不一样
     */
    abstract protected function createServer();
    /**
     * 因为不同的服务构建不一样
     */
    abstract protected function initEvent();


    public function onStart($server) {
        $this->app->make('event')->trigger("swoole:start", [$this, $server]);
    }
    public function onShutdown($server) {
        $this->app->make('event')->trigger("swoole:stop", [$this, $server]);
    }

    /**
     * 设置swoole的回调事件
     */
    protected function setSwooleEvent()
    {
        foreach ($this->serverEvent as $type => $events) {
            foreach ($events as $event => $func) {
                $this->server->on($event, [$this, $func]);
            }
        }
    }


    public function start()
    {
        $this->server->set($this->serverConfig);

        $this->server->start();
    }

    /**
     * @param array
     *
     * @return static
     */
    public function setEvent($type, $event)
    {
        // 暂时不支持直接设置系统的回调事件
        if ($type == "server") {
            return;
        }
        $this->serverEvent[$type] = $event;
    }


    public function getServer()
    {
        return $this->server;
    }

}
