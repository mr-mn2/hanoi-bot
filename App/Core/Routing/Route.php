<?php
namespace App\Core\Routing;

class Route
{
    private static $routes = [];

    public static function add($method, $commend, $action = null, $middleware = [])
    {
        $commend = is_array($commend) ? $commend : [$commend];
        self::$routes[] = ["commend" => $commend, 'method' => $method, "action" => $action, "middlewares" => $middleware];
    }
    public function addMessage($commend, $action, $middleware)
    {
        self::$routes[] = $this->add('message', $commend, $action, $middleware);
    }
    public function addCallback_query($commend, $action, $middleware)
    {
        self::$routes[] = $this->add('callback_query', $commend, $action, $middleware);
    }

    public static function routes()
    {
        return self::$routes;
    }

}
