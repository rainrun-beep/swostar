<?php
namespace SwoStar\Rpc;

use SwoStar\Foundation\Application;
use SwoStar\Message\Response;

use SwoStar\Server\ServerBase;

class RpcServer
{
    /**
     * [protected description]
     * @var Application
     */
    protected $app;

    protected $config;
    /**
     * [protected description]
     * @var ServerBase
     */
    protected $server;

    protected $listen;

    function __construct(Application $app, ServerBase $server)
    {
        $this->app = $app;
        $this->server = $server;
        $this->config = $this->app->make("config");

        // 获取创建的swoole服务对象 调用多端口listen
        $this->listen = $server->getServer()->listen($this->config->get("server.rpc.host"),$this->config->get("server.rpc.port"),$this->config->get("server.rpc.type"));

        // 注册事件
        $this->listen->on('receive', [$this, 'receive']);
        $this->listen->on('connect', [$this, 'connect']);
        $this->listen->on('close', [$this, 'close']);

        // 一定要做的事情设置，swoole的配置为空或者覆盖
        $this->listen->set($this->config->get("server.rpc.swoole"));


        dd('tcp:\\\\'.$this->config->get("server.rpc.host").":".$this->config->get("server.rpc.port"), '启动rpc服务');
    }

    public function receive($ser, $fd, $from_id, $data)
    {

        /*
        json {
          "method" : class::method,
          "params" : 参数
        }
         */
        $oper = \json_decode($data, true);

        // 执行对象
        $class = explode("::", $oper['method'])[0];
        $class = new $class();
        // 得到执行的方法
        $method = explode("::", $oper['method'])[1];
        // 执行
        $ret = $class->{$method}(...$oper['params']);
        // 返回结果
        $ser->send($fd, Response::send($ret));

        dd('receive'.$fd, 'rpc');
    }

    public function connect($ser, $fd)
    {
        dd('connect'.$fd, 'rpc');
    }

    public function close($ser, $fd)
    {
        dd('close'.$fd, 'rpc');
    }
}
