<?php
namespace SwoStar\Event;

use SwoStar\Config\Config;

use SwoStar\Supper\ServerPriovder;

/**
 *
 */
class EventServerProvider extends ServerPriovder
{

    public function boot()
    {
        $event = new Event();

        $config = $this->app->make('config');
        // 根据app/config/event.php中Listeners配置加载事件
        $this->registeListenenrs($event, $config);
        // 根据app/config/event.php中event配置加载
        $this->registeEvents($event, $config);

        $this->app->bind('event', $event);

        // var_dump($this->app->make('event')->getEvents());
    }
    // 根据app/config/event.php中Listeners配置加载
    public function registeListenenrs(Event $event, Config $config)
    {
        $listeners = $config->get('event.listeners');

        foreach ($listeners as $key => $listener) {
            // 根据指定的地址查询下面的PHP文件
            $files = scandir($this->app->getBasePath().$listener['path']);
            $data = null;
            // 2. 读取文件信息
            foreach ($files as $key => $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                 // 创建对象
                $class = $listener['namespace'].explode(".",$file)[0];

                if (class_exists($class)) {
                    $listener = new $class($this->app);
                    $event->register($listener->getName(), [$listener, 'handler']);
                }
            }

        }
    }
    // 根据app/config/event.php中event配置加载
    public function registeEvents(Event $event, Config $config)
    {
        $events = $config->get('event.events');
        // dd($events);
        foreach ($events as $key => $class) {
           if (class_exists($class)) {
               dd($class, "添加");
               $listener = new $class($this->app);
               $event->register($listener->getName(), [$listener, 'handler']);
           }
        }
    }
}
