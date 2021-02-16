<?php
namespace App\Providers;

use SwoStar\Routes\RouteServerProvider as ServerProvider;
// App\Providers\RouteServerProvider
class RouteServerProvider extends ServerProvider
{

    public function boot()
    {
        $this->mapRouteHttp();

        parent::boot();
    }

    public function mapRouteHttp()
    {
        $this->map['http'] = [
            'namespace' => 'App\Http\Controller',
            'path' => $this->app->getBasePath()."/route/http.php",
            // 'flag' => 'http'
        ];
    }

    public function mapRouteWS()
    {
        $this->map['websocket'] = [
            'namespace' => 'App\WebSocket\Controller',
            'path' => $this->app->getBasePath()."/route/websocket.php",
            // 'flag' => 'ws'
        ];
    }
}
