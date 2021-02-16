<?php
namespace SwoStar\Routes;

class Route
{
    protected static $instance = null;
    // 路由本质实现是会有一个容器在存储解析之后的路由
    protected $routes = [];

    // 定义了访问的类型
    protected $verbs = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
    // 区分服务类型
    protected $flag;

    // protected $map;

    protected $namespace;

    protected function __construct( )
    {
        // $this->map = $map;
    }

    public static function getInstance()
    {
        if (\is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance ;
    }

    public function get($uri, $action)
    {
        return $this->addRoute(['GET'], $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->addRoute(['POST'], $uri, $action);
    }

    public function any($uri, $action)
    {
        return $this->addRoute(self::$verbs, $uri, $action);
    }

    /**
     * 注册路由
     */
    protected function addRoute($methods, $uri, $action)
    {
        foreach ($methods as $method ) {
            if ($action instanceof \Closure) {
                $this->routes[$this->flag][$method][$uri] = $action;
            } else {
                $this->routes[$this->flag][$method][$uri] = $this->namespace."\\".$action;
            }
        }
        return $this;
    }
    // 路由请求校验的方法
    public function match($pathinfo, $flag, $method)
    {
        $action = null;
        // 根据传递服务标识，请求类型查找route
        foreach ($this->routes[$flag][$method] as $uri => $value) {
            // 保持route标识与pathinfo一致性
            $uri = ($uri && \substr($uri, 0, 1) != '/') ? "/".$uri : $uri;

            if ($pathinfo === $uri) {
                $action = $value;
                break;
            }
        }
        // 判断是否查找到route
        if (!empty($action)) {
            // 执行方法操作
            return $this->runAction($action);
        }
        dd($action, "没有查找到方法");
        return "404";
    }
    // 这是运行实际方法
    public function runAction($action)
    {
        if ($action instanceof \Closure) {
            return $action();
        } else {
            $arr = \explode("@", $action);
            $class = new $arr[0]();
            return $class->{$arr[1]}();
        }
    }
    // 注册路由
    public function registerRoute(Array $map)
    {
        foreach ($map as $key => $route) {
            $this->flag = $key;
            $this->namespace = $route['namespace'];
            // 根据route文件引入执行
            require_once $route['path'];
        }
        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
