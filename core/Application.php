<?php

namespace App\Core;


use App\Core\Router;
use App\Models\User;
use App\Core\Request;
use App\Core\Session;
use App\Core\Database;
use App\Core\Controller;
use Jenssegers\Blade\Blade;
use Flasher\Toastr\Prime\ToastrFactory;

class Application
{
    public string $userClass;
    public static string $ROOT_DIR;
    public static Application $app;
    public Blade $blade;
    public Router $router;
    public Request $request;
    public Controller $controller;
    public Response $response;
    public Session $session;
    public ?User $user = null;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request;
        $this->blade = new Blade($rootPath.'/views/', $rootPath.'/cache/');
        $this->response = new Response;
        $this->session = new Session();
        $this->router = new Router($this->request, $this->blade, $this->response, $this->session);
        $this->db = new Database($config['db']);

        $primaryKey = $this->session->get('user');
        if ($primaryKey) {
            $this->user = $this->userClass::where('id', '=', $primaryKey)->first();
        }

    }

    public function run()
    {
        $this->router->resolve();
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function login(User $user)
    {
        $this->user = $user;
        Application::$app->session->set('user', $this->user->id);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
