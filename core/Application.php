<?php

namespace App\Core;


use App\Core\Router;
use App\Core\Request;
use App\Core\Database;
use App\Core\Controller;
use Jenssegers\Blade\Blade;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Blade $blade;
    public Router $router;
    public Request $request;
    public Controller $controller;
    public Response $response;

    public function __construct($rootPath, array $config)
    {
        
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request;
        $this->blade = new Blade($rootPath.'/views/', $rootPath.'/cache/');
        $this->response = new Response;
        $this->router = new Router($this->request, $this->blade);

        $this->db = new Database($config['db']);
    }

    public function run()
    {
        $this->router->resolve();
    }
}
