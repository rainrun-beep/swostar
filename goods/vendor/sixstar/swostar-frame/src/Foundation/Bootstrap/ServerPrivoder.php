<?php
namespace SwoStar\Foundation\Bootstrap;

use SwoStar\Foundation\Application;

/**
 *
 */
class ServerPrivoder
{

    public function bootstrap(Application $app)
    {
        $priovders = $app->make('config')->get('app.priovders');

        // dd($priovders, "注册的服务");
        // 先是 register
        foreach ($priovders as $key => $priovder) {
            $p = new $priovder($app);
            $p->register();
            $p->boot();
        }
        // // 先是 boot
        // foreach ($priovders as $key => $priovder) {
        //
        // }
    }
}
