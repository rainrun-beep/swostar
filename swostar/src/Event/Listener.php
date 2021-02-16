<?php
namespace SwoStar\Event;

use SwoStar\Foundation\Application;

abstract class Listener
{
    /**
     * @var Application
     */
    protected $app;
    // 定义注册的事件类型
    protected $name = "listener";

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    // public abstract function handler();

    public function getName()
    {
        return $this->name;
    }
}
