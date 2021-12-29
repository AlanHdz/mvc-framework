<?php

namespace App\Core;

use App\Core\Session;
use App\Core\Response;
use Jenssegers\Blade\Blade;

class Router
{

    protected Request $request;
    protected Response $response;
    protected Session $session;
    protected array $routes = [];
    protected Blade $blade;

    public function __construct(Request $request, Blade $blade, Response $response, Session $session) {
        $this->request = $request;
        $this->response = $response;
        $this->session = $session;
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
        return call_user_func($callback, $this->request, $this->response, $this->session);
    }

    public function renderView($view, $params = [])
    {
        echo $this->blade->render($view, $params);
    }
}