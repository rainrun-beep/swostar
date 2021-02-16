<?php
namespace SwoStar\Event;

/**
 *
 */
class Event
{
    // 存储所有定义的事件
    protected $events = [];
    // 注册事件方法
    public function register($flag, $callback)
    {
        // 统一标识 大小写
        $flag = \strtolower($flag);
        // 注册事件
        $this->events[$flag] = [
            'callback' => $callback,
            // ""
        ];
    }

    // 触发事件
    // $flag 事件标识
    // $params 给事件传递的参数
    public function trigger($flag, $params = [])
    {
        // 统一标识 大小写
        $flag = \strtolower($flag);

        // 判断是否存在事件
        if (isset($this->events[$flag])) {
            ($this->events[$flag]['callback'])(...$params);
            return true;
        }
    }

    public function getEvents()
    {
        return $this->events;
    }
}
