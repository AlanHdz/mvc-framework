<?php

namespace App\Core;

use Jenssegers\Blade\Blade;

class Router
{

    protected Request $request;
    protected array $routes = [];
    protected Blade $blade;

    public function __construct(Request $request, Blade $blade) {
        $this->request = $request;
        $this->blade = $blade;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            echo 'Not Found';
            exit;
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        echo $this->blade->render($view, $params);
    }
}