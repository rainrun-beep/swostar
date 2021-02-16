<?php
namespace SwoStar\Server\Http;

use SwoStar\Console\Input;
use SwoStar\Message\Response;

use SwoStar\Server\ServerBase;
use SwoStar\Message\Http\Request;

class Server extends ServerBase
{

    /**
     * 因为不同的服务构建不一样
     */
    protected function createServer(){
        $this->server = new \Swoole\Http\Server($this->host, $this->port);

        Input::info("http:\\\\".swoole_get_local_ip()['ens33'].":".$this->port, "访问地址");
    }
    /**
     * 因为不同的服务构建不一样
     */
    protected function initServerConfig(){
        $this->port = $this->app->make("config")->get("server.http.port");
        $this->host = $this->app->make("config")->get("server.http.host");
    }
    /**
     * 因为不同的服务构建不一样
     */
    protected function initEvent(){
        $this->setEvent('sub', [
          'request' => 'onRequest'
        ]);
    }

    public function onRequest($request, $response)
    {

        if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
            $response->end();
            return;
        }
        // 获取请求对象
        $httpRequest = Request::init($request);
        // 解析路由并响应请求
        $return = $this->app->make('route')->match($httpRequest->getUriPath(), "http", $httpRequest->getMethod());

        // dd($return, "执行成功");
        // dd(app("config")->get("app"), "获取到配置文件信息");
        // dd("http 服务编辑ok");
        $response->end(Response::send($return));
    }
}
