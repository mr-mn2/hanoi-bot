<?php
namespace App\Core\Routing;

use App\Core\request;
use App\Core\Routing\Route;
use Exception;

class Router
{
    private $request;
    private $routes;
    private $current_routes;
    const BASE_CONTROLER = "App\controller\\";
    public function __construct()
    {
        $this->request = new request();
        $this->routes = Route::routes();
        $this->current_routes = $this->findRoute($this->request) ?? null;
        $this->run_middleware();
    }
    private function run_middleware()
    {
        $middleware = $this->current_routes['middlewares'] ?? false;
        if (!$middleware) {
            return false;
        }
        foreach ($middleware as $middlewareClass) {
            $middlewareobj = new $middlewareClass;
            $middlewareobj->handle();
        }
        var_dump($this->current_routes['middlewares']);
    }
    public function findRoute(request $request)
    {
        foreach ($this->routes as $route) {
            if (!$request->RequestType() == $route['method']) {
                return false;
            }
            if ($this->regax_match($route)) {
                return $route;
            }
        }
        return null;
    }

    public function regax_match($route)
    {
        foreach ($route['commend'] as $commend) {
            if ($this->request->getMessage() == $commend) {
                return true;
            }
        }
        return false;
    }

    public function run()
    {

        $this->dispatch($this->current_routes);
    }

    private static function dispatch($route): void
    {
        $action = $route['action'] ?? null; // function
        if (is_null($action) or empty($action)) {
            return;
        }
        if (is_callable($action)) {
            $action();
        }

        if (is_string($action)) {
            $action = explode("@", $action);
        }

        if (is_array($action)) {

            $class_name = self::BASE_CONTROLER . $action[0];
            $methodName = $action[1];

            if (!class_exists($class_name)) {
                throw new Exception("class $class_name not Exists");
            }

            $controller = new $class_name();

            if (!method_exists($controller, $methodName)) {
                throw new Exception("method $methodName not Exists");
            }

            $controller->{$methodName}();
        }

    }
}
