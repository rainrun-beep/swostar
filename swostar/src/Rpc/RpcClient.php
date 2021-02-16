<?php
namespace SwoStar\Rpc;

use \Swoole\Coroutine\Client;
/**
 *
 */
class RpcClient
{
    protected $classType ;

    protected $service ;

    // 通过它来调用指定的rpc服务端
    protected function proxy($method, $params)
    {
        /*
        json {
          "method" : class::method,
          "params" : 参数
        }
         */
        $data = [
            'method' => $this->classType."::".$method,
            'params' => $params
        ];

        // 获取服务的配置信息
        // $config = app("config")->get("service.".$this->service);
        $service = app('rpc-proxy')->getService($this->service);
        // 发送
        return $this->send($service['host'], $service['port'], $data);
    }

    public function send($host, $port, $data)
    {
        $client = new Client(SWOOLE_SOCK_TCP);
        if (!$client->connect($host, $port, 0.5))
        {
            throw new \Exception("连接不上服务", 500);
        }
        $client->send(\json_encode($data));
        $ret = $client->recv(4);
        $client->close();
        return $ret;
    }

    public function __call($method, $args)
    {
        return $this->proxy($method, $args);
    }
    public static function __callStatic($method, $args)
    {
        return self::proxy($mehtod, $args);
    }
}
