<?php

namespace App\Core;

use App\Core\Application;

class Controller
{

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function auth($user)
    {
        return Application::$app->login($user);
    }

    public function logoutUser()
    {
        return Application::$app->logout();
    }

}