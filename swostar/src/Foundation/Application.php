<?php
namespace SwoStar\Foundation;

use SwoStar\Console\Input;
use SwoStar\Container\Container;
use SwoStar\Rpc\RpcServer;

use SwoStar\Server\Http\Server as HttpServer;

class Application extends Container
{
    protected const SWOSTAR_WELCOME = "
      _____                     _____     ___
     /  __/             ____   /  __/  __/  /__   ___ __      __  __
     \__ \  | | /| / / / __ \  \__ \  /_   ___/  /  _`  |    / /_/ /
     __/ /  | |/ |/ / / /_/ /  __/ /   /  /_    |  (_|  |   /  ___/
    /___/   |__/\__/  \____/  /___/    \___/     \___/\_|  /__/
    ";

    protected $basePath = "";

    protected $bootstraps = [
        Bootstrap\LoadConfiguration::class,
        Bootstrap\ServerPrivoder::class
    ];

    function __construct($path)
    {
        if (!empty($path)) {
            $this->setBasePath($path);
        }
        self::setInstance($this);
        // 加载框架驱动
        $this->bootstrap();

        Input::info(self::SWOSTAR_WELCOME, "启动项目");
    }

    public function bootstrap()
    {
        foreach ($this->bootstraps as $key => $bootstrap) {
            (new $bootstrap())->bootstrap($this);
        }
    }


    public function run($argv)
    {
        $server = null;
        switch ($argv[1]) {
          case 'http:start':
            $server = new HttpServer($this);
            break;

          default:
            break;
        }
        // 判断是否开启rpc
        if ($this->make("config")->get("server.rpc.flag")) {
            new RpcServer($this,$server);
        }

        // 就是启动swostar
        $server->start();
    }

    public function getConfigPath()
    {
        return $this->getBasePath()."/config";
    }

    public function setBasePath($path)
    {
        $this->basePath = \rtrim($path, '\/');
    }
    public function getBasePath()
    {
        return $this->basePath;
    }
}
