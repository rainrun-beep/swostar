<?php
namespace SwoStar\Consul;

use SwoStar\Supper\ServerPriovder;

/**
 *
 */
class ConsulServerPriovder extends ServerPriovder
{

    public function boot()
    {
        $config = $this->app->make("config");

        $this->app->bind("consul-agent",
            new Agent(
              new Consul($config->get('consul.app.host'), $config->get('consul.app.port')
              )
            )
        );
    }
}
