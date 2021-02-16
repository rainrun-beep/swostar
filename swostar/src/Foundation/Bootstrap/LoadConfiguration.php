<?php
namespace SwoStar\Foundation\Bootstrap;

use SwoStar\Config\Config;
use SwoStar\Foundation\Application;

/**
 *
 */
class LoadConfiguration
{
    public function bootstrap(Application $app)
    {
        // $config = new Config($app->getConfigPath());
        $app->bind('config', new Config($app->getConfigPath()));
    }
}
