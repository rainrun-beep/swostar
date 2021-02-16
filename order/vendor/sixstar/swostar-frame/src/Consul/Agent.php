<?php
namespace SwoStar\Consul;

class Agent
{
    /**
     * @var Consul
     */
    protected $consul;

    public function __construct($consul)
    {
        $this->consul = $consul;
    }

    public function services()
    {
        return $this->consul->get('/v1/agent/services');
    }
    /**
     * 从consul中获取健康服务
     * @method health
     * @param  [type] $sname [description]
     * @return [type]        [description]
     */
    public function health($sname)
    {
        return $this->consul->get('/v1/health/service/'.$sname."?passing=true");
    }

    public function registerService(array $service)
    {
        $params = [
            'body' => $service,
        ];

        return $this->consul->put('/v1/agent/service/register', $params);
    }
    public function deregisterService(string $serviceId)
    {
        return $this->consul->put('/v1/agent/service/deregister/' . $serviceId);
    }
}
