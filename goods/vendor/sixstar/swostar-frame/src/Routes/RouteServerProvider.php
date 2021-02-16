<?php
namespace SwoStar\Routes;

use SwoStar\Supper\ServerPriovder;

/**
 *
 */
class RouteServerProvider extends ServerPriovder
{
    // 记录路由文件,以及路由信息
    protected $map;

    public function boot()
    {
        // dd($this->map, "这是注册的route地址");
        $this->app->bind('route', Route::getInstance()->registerRoute($this->map));

        dd($this->app->make("route")->getRoutes());
    }
}
