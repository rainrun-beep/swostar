<?php
namespace SwoStar\Rpc;

class Proxy
{
    // 用于存储源 -- 服务源地址
    protected $services;

    public function __construct($services = null)
    {
        $this->services = $services;
    }
    // 获取服务信息
    public function services($sname = '')
    {
        if (is_array($this->services)) {
            return $this->services;
        }

        if ($this->services instanceof \Closure) {
            return ($this->services)($sname);
        }

        if (empty($this->services)) {
            return app('config')->get('service.'.$sname);
        }
    }

    public function getService($sname = '')
    {
        $services = $this->services($sname);
        return $services[\array_rand($services, 1)];
    }
}
