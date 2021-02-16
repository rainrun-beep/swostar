<?php
namespace SwoStar\Message\Http;

use Swoole\Http\Request as SwooleRequest;

class Request
{

    protected $method; // 记录请求方式是get还是 port

    protected $uriPath; // 记录后续请求地址 / /dd /index/dd

    protected $swooleRequest;

    public function getMethod()
    {
        return $this->method;
    }

    public function getUriPath()
    {
        return $this->uriPath;
    }
    /**
     * [init description]
     * @param  SwooleRequest $request [description]
     * @return Request                 [description]
     */
    public static function init(SwooleRequest $request)
    {
        $self = new static;

        $self->swooleRequest = $request;
        $self->server = $request->server;

        $self->method = $request->server['request_method'] ?? '';
        $self->uriPath = $request->server['request_uri'] ?? '';
        return $self;
    }
}
