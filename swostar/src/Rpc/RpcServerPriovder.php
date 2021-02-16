<?php
namespace SwoStar\Rpc;

use SwoStar\Supper\ServerPriovder;

/**
 *
 */
class RpcServerPriovder extends ServerPriovder
{

    protected $services;

    public function boot()
    {
        $this->provider();

        $this->app->bind('rpc-proxy', new Proxy($this->services));
    }

    protected function provider()
    {

    }
}
